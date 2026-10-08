<?php

declare(strict_types=1);

// VIVA TURNOS - configuración de aplicación.

// En servidores sin variables de entorno, usa config.local.php (ignorado por Git).
$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    require_once $localConfig;
}

if (!defined('APP_NAME')) {
    define('APP_NAME', getenv('APP_NAME') !== false ? (string) getenv('APP_NAME') : 'VIVA TURNOS');
}

// Si se publica dentro de una subcarpeta, ajusta BASE_URL.
if (!defined('BASE_URL')) {
    define('BASE_URL', getenv('BASE_URL') !== false ? (string) getenv('BASE_URL') : '');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', getenv('DB_HOST') !== false ? (string) getenv('DB_HOST') : 'YOUR_DB_HOST');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', getenv('DB_NAME') !== false ? (string) getenv('DB_NAME') : 'YOUR_DB_NAME');
}

if (!defined('DB_USER')) {
    define('DB_USER', getenv('DB_USER') !== false ? (string) getenv('DB_USER') : 'YOUR_DB_USERNAME');
}

if (!defined('DB_PASS')) {
    $dbPassword = getenv('DB_PASSWORD');

    if ($dbPassword === false || $dbPassword === '') {
        $dbPassword = getenv('DB_PASS');
    }

    define('DB_PASS', $dbPassword !== false && $dbPassword !== ''
        ? (string) $dbPassword
        : 'YOUR_DB_PASSWORD');
}

if (!defined('DB_PORT')) {
    define('DB_PORT', (int) (getenv('DB_PORT') ?: 3306));
}

// Contraseña utilizada únicamente por install.php/upgrade.php para crear usuarios iniciales.
// Debe configurarse fuera del repositorio.
if (!defined('INITIAL_USER_PASSWORD')) {
    define(
        'INITIAL_USER_PASSWORD',
        getenv('INITIAL_USER_PASSWORD') !== false
            ? (string) getenv('INITIAL_USER_PASSWORD')
            : ''
    );
}

// Cierre automático después de 3 horas sin actividad del usuario.
const SESSION_IDLE_TIMEOUT = 3 * 60 * 60;

// El monitor no expira por inactividad; el heartbeat mantiene su sesión viva.
const MONITOR_SESSION_MAX_AGE = 30 * 24 * 60 * 60;


date_default_timezone_set('America/Santo_Domingo');

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.gc_maxlifetime', (string) MONITOR_SESSION_MAX_AGE);

    session_set_cookie_params([
        'lifetime' => MONITOR_SESSION_MAX_AGE,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}
