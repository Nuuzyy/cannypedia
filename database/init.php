<?php

require_once __DIR__ . '/../config/database.php';

if (!is_dir(dirname(DB_PATH))) mkdir(dirname(DB_PATH), 0777, true);

$pdo = new PDO('sqlite:' . DB_PATH);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('PRAGMA foreign_keys = ON');

$sql = file_get_contents(__DIR__ . '/schema.sql');
$pdo->exec($sql);

$admin = password_hash('admin123', PASSWORD_BCRYPT);
$customer = password_hash('customer123', PASSWORD_BCRYPT);

$stmt = $pdo->prepare('INSERT OR IGNORE INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
$stmt->execute(['Administrator', 'admin@cannypedia.com', $admin, 'admin']);
$stmt->execute(['Customer Demo', 'customer@cannypedia.com', $customer, 'customer']);

$pdo->exec("INSERT OR IGNORE INTO categories (id, name, description) VALUES (1, 'Elektronik', 'Perangkat elektronik'), (2, 'Fashion', 'Pakaian dan aksesori'), (3, 'Rumah', 'Perlengkapan rumah')");
$pdo->exec("INSERT OR IGNORE INTO products (id, category_id, name, description, price, stock) VALUES (1, 1, 'Headphone Wireless', 'Suara jernih dan nyaman dipakai', 350000, 15), (2, 2, 'Tote Bag Canvas', 'Tas serbaguna berbahan kanvas', 125000, 30), (3, 3, 'Lampu Meja LED', 'Lampu hemat energi dengan desain modern', 210000, 20)");

echo "Database berhasil diinisialisasi.\n";
