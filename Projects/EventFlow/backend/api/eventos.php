<?php
// backend/api/eventos.php

header('Content-Type: application/json');
require_once __DIR__ . '/../auth/session.php';
require_once __DIR__ . '/../db.php';

$userId = $_SESSION['id_usuario'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

// 1) LISTAR (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare("
            SELECT 
                id_evento       AS id,
                titulo          AS title,
                descripcion,
                fecha_inicio    AS start,
                fecha_fin       AS end,
                ubicacion,
                id_categoria_fk AS categoryId,
                created_at
            FROM eventos
            WHERE id_usuario_fk = :user_id
            ORDER BY fecha_inicio ASC
        ");
        $stmt->execute(['user_id' => $userId]);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'data' => $events]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al listar eventos.']);
    }
    exit;
}

// 2) CREAR, EDITAR, BORRAR (POST + action)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    if (!$payload || !isset($payload['action'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'JSON inválido o falta "action".']);
        exit;
    }

    $action = $payload['action'];

    switch ($action) {

        // ────────────────────────────────────────────────────────────────
        // CREAR EVENTO
        // ────────────────────────────────────────────────────────────────
        case 'crear':
            $titulo       = trim($payload['titulo'] ?? '');
            $fechaInicio  = trim($payload['fecha_inicio'] ?? '');
            $fechaFin     = trim($payload['fecha_fin'] ?? null);
            $descripcion  = trim($payload['descripcion'] ?? '');
            $ubicacion    = trim($payload['ubicacion'] ?? '');
            $idCategoria  = $payload['id_categoria'] ?? null;

            $errors = [];
            if ($titulo === '') {
                $errors[] = 'El título es obligatorio.';
            }
            if ($fechaInicio === '') {
                $errors[] = 'La fecha de inicio es obligatoria.';
            }
            if (count($errors) > 0) {
                echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
                exit;
            }

            try {
                $stmt = $pdo->prepare("
                    INSERT INTO eventos
                        (id_usuario_fk, titulo, descripcion, fecha_inicio, fecha_fin, ubicacion, id_categoria_fk)
                    VALUES
                        (:user_id, :titulo, :descripcion, :fecha_inicio, :fecha_fin, :ubicacion, :id_categoria)
                ");
                $stmt->execute([
                    'user_id'      => $userId,
                    'titulo'       => $titulo,
                    'descripcion'  => $descripcion ?: null,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin'    => $fechaFin   ?: null,
                    'ubicacion'    => $ubicacion ?: null,
                    'id_categoria' => $idCategoria ?: null
                ]);

                echo json_encode(['success' => true, 'id_evento' => $pdo->lastInsertId()]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al crear evento.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // EDITAR EVENTO
        // ────────────────────────────────────────────────────────────────
        case 'editar':
            $idEvento = (int)($payload['id_evento'] ?? 0);
            if ($idEvento <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'ID de evento inválido.']);
                exit;
            }

            $campos     = [];
            $parametros = [
                'id_evento' => $idEvento,
                'user_id'   => $userId
            ];

            if (isset($payload['titulo'])) {
                $campos[]                    = 'titulo = :titulo';
                $parametros['titulo']        = trim($payload['titulo']);
            }
            if (isset($payload['descripcion'])) {
                $campos[]                       = 'descripcion = :descripcion';
                $parametros['descripcion']      = trim($payload['descripcion']);
            }
            if (isset($payload['fecha_inicio'])) {
                $campos[]                         = 'fecha_inicio = :fecha_inicio';
                $parametros['fecha_inicio']       = $payload['fecha_inicio'];
            }
            if (array_key_exists('fecha_fin', $payload)) {
                $campos[]                    = 'fecha_fin = :fecha_fin';
                $parametros['fecha_fin']     = $payload['fecha_fin'] ?: null;
            }
            if (isset($payload['ubicacion'])) {
                $campos[]                  = 'ubicacion = :ubicacion';
                $parametros['ubicacion']   = trim($payload['ubicacion']);
            }
            if (array_key_exists('id_categoria', $payload)) {
                $campos[]                        = 'id_categoria_fk = :id_categoria';
                $parametros['id_categoria']      = $payload['id_categoria'] ?: null;
            }

            if (empty($campos)) {
                echo json_encode(['success' => false, 'error' => 'No hay campos para actualizar.']);
                exit;
            }

            $sql = 'UPDATE eventos SET ' . implode(', ', $campos) .
                   ' WHERE id_evento = :id_evento AND id_usuario_fk = :user_id';

            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute($parametros);

                if ($stmt->rowCount() === 0) {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'error' => 'Evento no existe o sin permiso.']);
                    exit;
                }
                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al editar evento.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // BORRAR EVENTO
        // ────────────────────────────────────────────────────────────────
        case 'borrar':
            $idEvento = (int)($payload['id_evento'] ?? 0);
            if ($idEvento <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'ID de evento inválido.']);
                exit;
            }

            try {
                $stmt = $pdo->prepare("
                    DELETE FROM eventos 
                    WHERE id_evento = :id_evento AND id_usuario_fk = :user_id
                ");
                $stmt->execute([
                    'id_evento' => $idEvento,
                    'user_id'   => $userId
                ]);

                if ($stmt->rowCount() === 0) {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'error' => 'Evento no existe o sin permiso.']);
                    exit;
                }
                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al borrar evento.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // ACCIÓN INVÁLIDA
        // ────────────────────────────────────────────────────────────────
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Acción inválida en eventos.']);
            exit;
    }
}

// Métodos HTTP no permitidos
http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
exit;