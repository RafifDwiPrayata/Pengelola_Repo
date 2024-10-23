<?php

$host = 'localhost';
$dbname = 'creative_db';
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Database '$dbname' berhasil dibuat atau sudah ada.<br>";

    $pdo->exec("USE $dbname");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )");
    echo "Tabel 'users' berhasil dibuat atau sudah ada.<br>";

    $pdo->exec("CREATE TABLE IF NOT EXISTS creators (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        image_url VARCHAR(255),
        works TEXT
    )");
    echo "Tabel 'creators' berhasil dibuat atau sudah ada.<br>";

    $adminUsername = 'admin';
    $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);

    $checkAdmin = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $checkAdmin->execute([$adminUsername]);
    if ($checkAdmin->fetchColumn() == 0) {
        $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute([$adminUsername, $adminPassword]);
        echo "Admin default berhasil ditambahkan (Username: admin, Password: admin123).<br>";
    } else {
        echo "Admin default sudah ada.<br>";
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}