<?php
// ★一番上にこれをつける（PHPに日本時間であることを叩き込む）
date_default_timezone_set('Asia/Tokyo');
// まずは上の共通接続ファイルを読み込む
require_once 'db_connection.php';

// もしフォームからデータが送られてきて「いない」なら、処理を中断する（安全対策）
if (!isset($_FILES['photo-name']) || !isset($_POST['client_upload_time'])) {
    die('直接このページにアクセスすることはできません。トップページからアップロードしてください。');
}

$original_name = $_FILES['photo-name']['name']; 
$uploaded_at   = $_POST['client_upload_time'];
$file_name     = date('Ymd_His', strtotime($uploaded_at)) . '_' . basename($original_name); 

$tmp_name   = $_FILES['photo-name']['tmp_name']; 
$upload_dir = 'img/'; 

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$upload_path = $upload_dir . $file_name; 

if (move_uploaded_file($tmp_name, $upload_path)) {
    $sql = "INSERT INTO photo (file_name, uploaded_at) VALUES (:file_name, :uploaded_at)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':file_name'   => $file_name,
        ':uploaded_at' => date('Y-m-d H:i:s', strtotime($uploaded_at)) 
    ]);

    echo "アップロードとDB保存が成功しました！";
} else {
    echo "ファイルの移動に失敗しました。";
}
?>