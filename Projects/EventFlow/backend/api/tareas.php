<?php
// backend/api/tareas.php

// Siempre devolvemos JSON
header('Content-Type: application/json; charset=utf-8');

// ----------------------------------------------------------------
// 1) Arrancamos la sesión y verificamos que el usuario esté autenticado
// ----------------------------------------------------------------
require_once __DIR__ . '/../auth/session.php';
// En session.php hacemos session_start() y comprobamos $_SESSION['id_usuario']
// Si no existe, session.php redirige al login_view.php y termina la ejecución.

$userId = $_SESSION['id_usuario'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

// ----------------------------------------------------------------
// 2) Conexión a la base de datos
// ----------------------------------------------------------------
require_once __DIR__ . '/../db.php';
// En db.php:
// try {
//   $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//   die("Error de conexión: " . $e->getMessage());
// }

// ----------------------------------------------------------------
// 3) Leemos el cuerpo bruto y validamos que sea JSON
// ----------------------------------------------------------------
$raw = file_get_contents('php://input');
if (empty($raw)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El cuerpo JSON está vacío']);
    exit;
}

$input = json_decode($raw, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
      'success' => false,
      'error'   => 'JSON inválido: ' . json_last_error_msg()
    ]);
    exit;
}

if (!isset($input['action'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Falta “action”']);
    exit;
}

// ----------------------------------------------------------------
// 4) Procesamos la acción solicitada
// ----------------------------------------------------------------
switch ($input['action']) {
    // ────────────────────────────────────────────────────────────────
    // LISTAR TODAS LAS TAREAS DEL USUARIO
    // ────────────────────────────────────────────────────────────────
    case 'listar':
        try {
            $stmt = $pdo->prepare("
                SELECT 
                  id_tarea            AS id,
                  titulo,
                  descripcion,
                  fecha_vencimiento,
                  estado,
                  prioridad,
                  id_categoria_fk     AS id_categoria,
                  id_evento_fk
                FROM tareas
                WHERE id_usuario_fk = :u
                ORDER BY fecha_vencimiento ASC
            ");
            $stmt->execute([':u' => $userId]);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $lista]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
              'success' => false,
              'error'   => 'Error BD al listar tareas: ' . $e->getMessage()
            ]);
        }
        break;

    // ────────────────────────────────────────────────────────────────
    // CREAR NUEVA TAREA
    // ────────────────────────────────────────────────────────────────
    case 'crear':
        // Validar campos obligatorios: titulo y fecha_vencimiento
        if (empty($input['titulo']) || empty($input['fecha_vencimiento'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Título o fecha de vencimiento faltante']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("
                INSERT INTO tareas
                  (titulo, descripcion, fecha_vencimiento, estado, prioridad, id_categoria_fk, id_evento_fk, id_usuario_fk)
                VALUES
                  (:t, :d, :fv, 'pendiente', :p, :ic, :ie, :ui)
            ");
            $stmt->execute([
                ':t'  => trim($input['titulo']),
                ':d'  => trim($input['descripcion'] ?? ''),
                ':fv' => $input['fecha_vencimiento'],
                ':p'  => $input['prioridad']       ?? 'media',
                ':ic' => $input['id_categoria_fk'] ?: null,
                ':ie' => $input['id_evento_fk']    ?: null,
                ':ui' => $userId,
            ]);
            $newId = $pdo->lastInsertId();
            echo json_encode(['success' => true, 'id_tarea' => $newId]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
              'success' => false,
              'error'   => 'Error BD al crear tarea: ' . $e->getMessage()
            ]);
        }
        break;

    // ────────────────────────────────────────────────────────────────
    // EDITAR TAREA EXISTENTE
    // ────────────────────────────────────────────────────────────────
    case 'editar':
        $idTarea = (int)($input['id_tarea'] ?? 0);
        if ($idTarea <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'ID de tarea inválido.']);
            exit;
        }

        // Construir dinámicamente la lista de campos a actualizar
        $campos     = [];
        $parametros = [
            'id_tarea' => $idTarea,
            'user_id'  => $userId
        ];

        if (isset($input['titulo'])) {
            $campos[]              = 'titulo = :titulo';
            $parametros['titulo']  = trim($input['titulo']);
        }
        if (isset($input['descripcion'])) {
            $campos[]                 = 'descripcion = :descripcion';
            $parametros['descripcion'] = trim($input['descripcion']);
        }
        if (isset($input['fecha_vencimiento'])) {
            $campos[]                        = 'fecha_vencimiento = :fecha_vencimiento';
            $parametros['fecha_vencimiento'] = $input['fecha_vencimiento'];
        }
        if (isset($input['estado'])) {
            $campos[]               = 'estado = :estado';
            $parametros['estado']   = $input['estado'];
        }
        if (isset($input['prioridad'])) {
            $campos[]                  = 'prioridad = :prioridad';
            $parametros['prioridad']   = $input['prioridad'];
        }
        if (array_key_exists('id_categoria_fk', $input)) {
            $campos[]                         = 'id_categoria_fk = :id_categoria_fk';
            $parametros['id_categoria_fk']    = $input['id_categoria_fk'] ?: null;
        }
        if (array_key_exists('id_evento_fk', $input)) {
            $campos[]                      = 'id_evento_fk = :id_evento_fk';
            $parametros['id_evento_fk']   = $input['id_evento_fk'] ?: null;
        }

        if (empty($campos)) {
            echo json_encode(['success' => false, 'error' => 'No hay campos para actualizar.']);
            exit;
        }

        $sql = 'UPDATE tareas SET ' . implode(', ', $campos) .
               ' WHERE id_tarea = :id_tarea AND id_usuario_fk = :user_id';

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($parametros);

            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Tarea no existe o sin permiso.']);
                exit;
            }
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Error al editar tarea: ' . $e->getMessage()]);
        }
        break;

    // ────────────────────────────────────────────────────────────────
    // BORRAR TAREA
    // ────────────────────────────────────────────────────────────────
    case 'borrar':
        $idTarea = (int)($input['id_tarea'] ?? 0);
        if ($idTarea <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'ID de tarea inválido.']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("
                DELETE FROM tareas
                 WHERE id_tarea      = :id_tarea
                   AND id_usuario_fk = :user_id
            ");
            $stmt->execute([
                ':id_tarea' => $idTarea,
                ':user_id'  => $userId
            ]);

            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Tarea no existe o sin permiso.']);
                exit;
            }
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Error al borrar tarea: ' . $e->getMessage()]);
        }
        break;

    // ────────────────────────────────────────────────────────────────
    // ACCIÓN INVÁLIDA
    // ────────────────────────────────────────────────────────────────
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Acción inválida para tareas']);
        break;
}

// Si este script llega al final, no hay nada más que procesar.
exit;