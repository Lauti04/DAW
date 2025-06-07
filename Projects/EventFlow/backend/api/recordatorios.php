<?php
// backend/api/recordatorios.php

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
                id_recordatorio   AS id_recordatorio,
                mensaje,
                fecha_hora        AS dateTime,
                created_at
            FROM recordatorios
            WHERE id_usuario_fk = :user_id
            ORDER BY fecha_hora ASC
        ");
        $stmt->execute(['user_id' => $userId]);
        $reminders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $reminders]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al listar recordatorios.']);
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
        // CREAR RECORDATORIO
        // ────────────────────────────────────────────────────────────────
        case 'crear':
            $mensaje   = trim($payload['mensaje'] ?? '');
            $fechaHora = $payload['fecha_hora'] ?? '';

            $errors = [];
            if ($mensaje === '') {
                $errors[] = 'El mensaje es obligatorio.';
            }
            if ($fechaHora === '') {
                $errors[] = 'La fecha y hora son obligatorias.';
            }
            if (count($errors) > 0) {
                echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
                exit;
            }

            try {
                $stmt = $pdo->prepare("
                    INSERT INTO recordatorios
                        (id_usuario_fk, mensaje, fecha_hora)
                    VALUES
                        (:user_id, :mensaje, :fecha_hora)
                ");
                $stmt->execute([
                    'user_id'    => $userId,
                    'mensaje'    => $mensaje,
                    'fecha_hora' => $fechaHora
                ]);
                $newId = $pdo->lastInsertId();
                // Devolvemos 'id_recordatorio' para ser consistente con el SELECT de listar
                echo json_encode(['success' => true, 'id_recordatorio' => $newId]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al crear recordatorio.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // EDITAR RECORDATORIO
        // ────────────────────────────────────────────────────────────────
        case 'editar':
            $idRem = (int)($payload['id_recordatorio'] ?? 0);
            if ($idRem <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'ID de recordatorio inválido.']);
                exit;
            }

            $campos     = [];
            $parametros = [
                'id_recordatorio' => $idRem,
                'user_id'         => $userId
            ];

            if (isset($payload['mensaje'])) {
                $campos[]                  = 'mensaje = :mensaje';
                $parametros['mensaje']     = trim($payload['mensaje']);
            }
            if (isset($payload['fecha_hora'])) {
                $campos[]                   = 'fecha_hora = :fecha_hora';
                $parametros['fecha_hora']   = $payload['fecha_hora'];
            }

            if (empty($campos)) {
                echo json_encode(['success' => false, 'error' => 'No hay campos para actualizar.']);
                exit;
            }

            $sql = 'UPDATE recordatorios SET ' . implode(', ', $campos) .
                   ' WHERE id_recordatorio = :id_recordatorio AND id_usuario_fk = :user_id';

            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute($parametros);

                if ($stmt->rowCount() === 0) {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'error' => 'Recordatorio no existe o sin permiso.']);
                    exit;
                }
                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al editar recordatorio.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // BORRAR RECORDATORIO
        // ────────────────────────────────────────────────────────────────
        case 'borrar':
            $idRem = (int)($payload['id_recordatorio'] ?? 0);
            if ($idRem <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'ID de recordatorio inválido.']);
                exit;
            }

            try {
                $stmt = $pdo->prepare("
                    DELETE FROM recordatorios
                     WHERE id_recordatorio = :id_recordatorio
                       AND id_usuario_fk   = :user_id
                ");
                $stmt->execute([
                    'id_recordatorio' => $idRem,
                    'user_id'         => $userId
                ]);

                if ($stmt->rowCount() === 0) {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'error' => 'Recordatorio no existe o sin permiso.']);
                    exit;
                }
                echo json_encode(['success' => true]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'error' => 'Error al borrar recordatorio.']);
            }
            exit;


        // ────────────────────────────────────────────────────────────────
        // ACCIÓN INVÁLIDA
        // ────────────────────────────────────────────────────────────────
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Acción inválida en recordatorios.']);
            exit;
    }
}

// Si llegan otros métodos HTTP, devolver 405
http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
exit;