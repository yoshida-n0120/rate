<?php
$dsn      = 'mysql:dbname=photo;host=localhost;charset=utf8mb4';
$user     = 'root'; // ★ここを一旦 'root' にしてください！
$password = '';     // ★ここを一旦空（パスワードなし）にしてください！

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('DB接続エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
?>