<?php
/**
 * Database settings, resolved in this order:
 *   1. Environment variables (Docker, cloud hosts): DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS
 *   2. includes/config.local.php (shared hosting; git-ignored, copy config.example.php)
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
        'name' => $env('DB_NAME', 'pasteleria'),
        'user' => $env('DB_USER', 'root'),
        'pass' => $env('DB_PASS', ''),
    ];

    return $settings;
}
