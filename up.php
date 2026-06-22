<?php

// PHPに日本時間であることを叩き込む
date_default_timezone_set('Asia/Tokyo');
// まずは上の共通接続ファイルを読み込む
require_once 'db_connection.php';

// 安全対策（client_upload_time のチェックを外し、ファイルがあるかだけを見る）
if (!isset($_FILES['photo-name'])) {
    die('直接このページにアクセスすることはできません。トップページからアップロードしてください。');
}

$original_name = $_FILES['photo-name']['name'];

// JSからではなく、PHP側で現在の正確な日時を生成する
$current_time  = date('Y-m-d H:i:s');
// ファイル名用のフォーマット（例: 20260622_153000_photo.jpg）
$file_time_str = date('Ymd_His', strtotime($current_time));
$file_name     = $file_time_str . '_' . basename($original_name);

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
        ':uploaded_at' => $current_time // 生成した時間をそのまま入れる
    ]);

    // 文字をそのまま出すのではなく、JSのポップアップを実行してTOPへ戻す
    echo "<script>
            alert('アップロードとDB保存が成功しました！🐾');
            window.location.href = 'index.php';
        </script>";
    exit;

} else {
    echo "<script>
            alert('ファイルの移動に失敗しました。もう一度やり直してください。');
            window.location.href = 'index.php';
        </script>";
    exit;
}
