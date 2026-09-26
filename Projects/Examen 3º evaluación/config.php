<?php
/**
 * Database settings, resolved in this order:
 *   1. Environment variables (Docker, cloud hosts): DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS
 *   2. config.local.php (shared hosting; git-ignored, copy config.example.php)
 *   3. Local development defaults (XAMPP / MAMP)
 * Never commit real credentials to this repository.
 */
function db_settings(): array
{
    static $settings = null;
    if ($settings !== null) {
        return $settings;
    }

    $local = [];
    $localFile = __DIR__ . '/config.local.php';
    if (is_file($localFile)) {
        $local = require $localFile;
    }

    $env = static function (string $key, string $fallback) use ($local): string {
        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }
        return (string) ($local[$key] ?? $fallback);
    };

    $settings = [
        'host' => $env('DB_HOST', 'localhost'),
        'port' => $env('DB_PORT', '3306'),
        'name' => $env('DB_NAME', 'malagasupercars'),
        'user' => $env('DB_USER', 'root'),
        'pass' => $env('DB_PASS', ''),
    ];

    return $settings;
}

/** mysqli connection used by the form pages. */
function db_mysqli(): mysqli
{
    $db = db_settings();
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($db['host'], $db['user'], $db['pass'], $db['name'], (int) $db['port']);

    if ($conn->connect_error) {
        error_log('Malaga Supercars DB connection failed: ' . $conn->connect_error);
        http_response_code(500);
        die('Error de conexión con la base de datos.');
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}

/** PDO connection used by the catalogue page. */
function db_pdo(): PDO
{
    $db = db_settings();
    $pdo = new PDO(
        "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4",
        $db['user'],
        $db['pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
