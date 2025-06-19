<?php
// send_notifications.php

// 1) Mostrar errores y DEBUG
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2) Forzar zona horaria en CLI
date_default_timezone_set('Europe/Madrid');
echo "[".date('Y-m-d H:i:s')."] (ES) Iniciando send_notifications.php\n\n";

// 3) Conexión a MySQL
require_once __DIR__ . '/db.php';
$offset = (new DateTime())->format('P');
$pdo->exec("SET time_zone = '$offset'");

// 4) Conexión a SQLite para controlar envíos
try {
    $sqliteFile = __DIR__ . '/notified.db';
    $dbSqlite = new PDO('sqlite:' . $sqliteFile);
    $dbSqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbSqlite->exec("
      CREATE TABLE IF NOT EXISTS notifications_sent (
        tipo      TEXT NOT NULL,
        item_id   INTEGER NOT NULL,
        sent_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(tipo, item_id)
      )
    ");
} catch (PDOException $e) {
    echo "ERROR SQLite: " . $e->getMessage() . "\n";
    // seguimos adelante solo con MySQL
}

// 5) Helper para enviar HTML
function sendMailHTML($to, $subject, $htmlBody) {
    echo "  → Enviando (HTML) a: $to …\n";
    $boundary = md5(time());
    $headers  = "From: EventFlow <no-reply@lautidev.com>\r\n";
    $headers .= "Reply-To: no-reply@lautidev.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";

    // fallback texto plano
    $text = strip_tags(str_replace(['<br>','<br/>','<br />'], "\n", $htmlBody));

    $body  = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
    $body .= $text . "\r\n\r\n";
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
    $body .= $htmlBody . "\r\n\r\n";
    $body .= "--$boundary--";

    if (mail($to, $subject, $body, $headers)) {
        echo "    ✔ Enviado: $subject\n";
    } else {
        echo "    ✖ Error al enviar: $subject\n";
    }
}

// 6) Definir ventanas
$ventanaEventos = (new DateTime())->modify('+15 minutes')->format('Y-m-d H:i:s');
$ventanaTareas  = (new DateTime())->modify('+1 hour')->format('Y-m-d H:i:s');
$ventanaRecord  = (new DateTime())->modify('+5 minutes')->format('Y-m-d H:i:s');

// 7) Función para generar el HTML del correo (igual que tu preview)
function buildHtml($tipo, $titulo, $fecha) {
    $logo    = 'https://lautidev.com/EventFlow/assets/img/logos/logo.png';
    $primary = '#007acc';
    $text    = '#333333';
    $icons = [
      'evento'       => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="'.$primary.'" stroke-width="2" width="24" height="24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-14 4h18m-2-10H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>',
      'tarea'        => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="'.$primary.'" stroke-width="2" width="24" height="24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 3h6a2 2 0 012 2M9 3v2m6-2v2M9 12h6m-6 4h6"/></svg>',
      'recordatorio' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="'.$primary.'" stroke-width="2" width="24" height="24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
    ];
    return "
<html lang='es'><body style='margin:0;padding:20px;background-color:#f4f4f4;font-family:Roboto,sans-serif;color:$text;'>
  <div style='max-width:600px;margin:auto;background:white;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.1);'>
    <div style='background:$primary;padding:20px;text-align:center;'>
      <img src='$logo' alt='EventFlow' style='max-width:140px;background:white;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,0.1);' />
    </div>
    <div style='padding:20px;'>
      <h2 style='display:flex;align-items:center;gap:8px;font-size:20px;font-family:Montserrat,sans-serif;color:$primary;margin:0;'>
        {$icons[$tipo]} Notificación de ".ucfirst($tipo)."
      </h2>
      <p style='margin:8px 0;font-size:16px;'>
        ".($tipo==='evento'? 'Tienes un evento próximo':'Tu '.($tipo==='tarea'?'tarea está a punto de vencer':'recordatorio')).":
      </p>
      <p style='margin:4px 0;font-weight:bold;font-size:18px;'>$titulo</p>
      <p style='margin:4px 0;color:#6b7280;'>$fecha</p>
    </div>
    <div style='padding:16px;text-align:center;background-color:#000000;color:#ffffff;font-size:14px;'>
      — El equipo de <span style='color:#ff8c00;'>EventFlow</span>
    </div>
  </div>
</body></html>";
}

// 8) Procesar y notificar cada tipo, formateando conteos

// EVENTOS
$stmt = $pdo->prepare("
  SELECT e.id_evento, e.titulo, e.fecha_inicio, u.email
    FROM eventos e
    JOIN usuarios u ON u.id_usuario = e.id_usuario_fk
   WHERE e.fecha_inicio BETWEEN NOW() AND :hasta
");
$stmt->execute(['hasta'=>$ventanaEventos]);
echo "  → [Eventos]       " . str_pad($stmt->rowCount(), 3, ' ', STR_PAD_LEFT) . " encontrados\n";
foreach ($stmt as $r) {
  $skip = isset($dbSqlite)
        && $dbSqlite->query("SELECT 1 FROM notifications_sent WHERE tipo='evento' AND item_id={$r['id_evento']}")->fetch();
  if ($skip) continue;
  sendMailHTML($r['email'], "🚀 Evento próximo: {$r['titulo']}", buildHtml('evento',$r['titulo'],$r['fecha_inicio']));
  if (isset($dbSqlite)) {
    $dbSqlite->prepare("INSERT INTO notifications_sent(tipo,item_id) VALUES('evento',?)")
             ->execute([$r['id_evento']]);
  }
}

// TAREAS
$stmt = $pdo->prepare("
  SELECT t.id_tarea, t.titulo, t.fecha_vencimiento, u.email
    FROM tareas t
    JOIN usuarios u ON u.id_usuario = t.id_usuario_fk
   WHERE t.fecha_vencimiento BETWEEN NOW() AND :hasta
");
$stmt->execute(['hasta'=>$ventanaTareas]);
echo "  → [Tareas]        " . str_pad($stmt->rowCount(), 3, ' ', STR_PAD_LEFT) . " encontradas\n";
foreach ($stmt as $r) {
  $skip = isset($dbSqlite)
        && $dbSqlite->query("SELECT 1 FROM notifications_sent WHERE tipo='tarea' AND item_id={$r['id_tarea']}")->fetch();
  if ($skip) continue;
  sendMailHTML($r['email'], "⏰ Tarea a punto de vencer: {$r['titulo']}", buildHtml('tarea',$r['titulo'],$r['fecha_vencimiento']));
  if (isset($dbSqlite)) {
    $dbSqlite->prepare("INSERT INTO notifications_sent(tipo,item_id) VALUES('tarea',?)")
             ->execute([$r['id_tarea']]);
  }
}

// RECORDATORIOS
$stmt = $pdo->prepare("
  SELECT r.id_recordatorio, r.mensaje, r.fecha_hora, u.email
    FROM recordatorios r
    JOIN usuarios u ON u.id_usuario = r.id_usuario_fk
   WHERE r.fecha_hora BETWEEN NOW() AND :hasta
");
$stmt->execute(['hasta'=>$ventanaRecord]);
echo "  → [Recordatorios] " . str_pad($stmt->rowCount(), 3, ' ', STR_PAD_LEFT) . " encontrados\n\n";
foreach ($stmt as $r) {
  $skip = isset($dbSqlite)
        && $dbSqlite->query("SELECT 1 FROM notifications_sent WHERE tipo='recordatorio' AND item_id={$r['id_recordatorio']}")->fetch();
  if ($skip) continue;
  sendMailHTML($r['email'], "🔔 Recordatorio", buildHtml('recordatorio',$r['mensaje'],$r['fecha_hora']));
  if (isset($dbSqlite)) {
    $dbSqlite->prepare("INSERT INTO notifications_sent(tipo,item_id) VALUES('recordatorio',?)")
             ->execute([$r['id_recordatorio']]);
  }
}

echo "[".date('Y-m-d H:i:s')."] send_notifications.php finalizado\n";