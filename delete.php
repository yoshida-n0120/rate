<?php
// delete.php
require_once 'db_connection.php';

// POSTでデータが届いていない場合はギャラリーに戻す（不正アクセス対策）
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !isset($_POST['file_name'])) {
    header('Location: gallery.php');
    exit;
}

$id        = (int)$_POST['id'];
$file_name = $_POST['file_name'];
$target_path = 'img/' . $file_name; // 実際の画像のパス

try {
    // 1. まずは「img/」フォルダから実際の画像ファイルを削除する
    if (file_exists($target_path)) {
        unlink($target_path); // unlink() がファイルを物理消去する関数です
    }

    // 2. データベースから該当する写真のレコードを削除する
    $sql = "DELETE FROM photo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    // 3. 削除がすべて成功したら、ギャラリーページにリダイレクトで戻る
    header('Location: gallery.php?delete=success');
    exit;

} catch (PDOException $e) {
    die('削除エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}