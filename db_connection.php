<?php
<<<<<<< HEAD

$dsn      = 'mysql:dbname=photo;host=localhost;charset=utf8mb4';
$user     = 'root';
$password = '';
=======
$dsn      = 'mysql:dbname=photo;host=localhost;charset=utf8mb4';
$user     = 'root'; // ★ここを一旦 'root' にしてください！
$password = '';     // ★ここを一旦空（パスワードなし）にしてください！
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
<<<<<<< HEAD
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+09:00'"
=======
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
    ]);
} catch (PDOException $e) {
    die('DB接続エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
<<<<<<< HEAD
=======
?>
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
