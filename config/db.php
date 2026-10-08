<?php

require_once __DIR__ . '/config.php';

function db(): PDO {
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $required = [
        'DB_HOST' => DB_HOST,
        'DB_NAME' => DB_NAME,
        'DB_USER' => DB_USER,
        'DB_PASS' => DB_PASS,
    ];

    foreach ($required as $name => $value) {
        if ($value === '' || str_starts_with($value, 'YOUR_')) {
            throw new RuntimeException('Configura la variable ' . $name . ' antes de conectar con la base de datos.');
        }
    }

    if (DB_PORT < 1 || DB_PORT > 65535) {
        throw new RuntimeException('DB_PORT no es válido.');
    }

    $dsn = 'mysql:host=' . DB_HOST
        . ';port=' . DB_PORT
        . ';dbname=' . DB_NAME
        . ';charset=utf8mb4';

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // La aplicación trabaja con el horario oficial de República Dominicana (UTC-4).
    $pdo->exec("SET time_zone = '-04:00'");

    return $pdo;
}
