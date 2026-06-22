<?php
// gallery_logic.php
require_once 'db_connection.php';

$max_view = 20;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int)$_GET['page'];
} else {
    $current_page = 1;
}

try {
    // 全件数と総ページ数の計算
    $total_count = $pdo->query("SELECT COUNT(*) FROM photo")->fetchColumn();
    $total_pages = ceil($total_count / $max_view);

    // 読み込み開始位置の計算
    $offset = ($current_page - 1) * $max_view;

    // ★ 削除で狙い撃ちできるように「id」も追加して取得！
    $sql = "SELECT id, file_name, uploaded_at FROM photo ORDER BY uploaded_at DESC LIMIT :max_view OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':max_view', $max_view, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $files = $stmt->fetchAll();

} catch (PDOException $e) {
    die('エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
// このファイルはPHPの処理だけなので、末尾の ?> 