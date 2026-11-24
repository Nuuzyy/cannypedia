<?php

const DB_PATH = __DIR__ . '/../database/cannypedia.sqlite';

function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;

    $dsn = 'sqlite:' . DB_PATH;
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');

    if (!file_exists(DB_PATH) || filesize(DB_PATH) === 0) {
        throw new RuntimeException('Database belum diinisialisasi. Jalankan database/init.php.');
    }

    return $pdo;
}
