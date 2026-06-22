<?php
<<<<<<< HEAD

=======
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
// PHPに日本時間であることを叩き込む
date_default_timezone_set('Asia/Tokyo');
// まずは上の共通接続ファイルを読み込む
require_once 'db_connection.php';

<<<<<<< HEAD
// 安全対策：ファイルデータ（photo-name）がちゃんと送られてきているかだけをチェックする
if (!isset($_FILES['photo-name']) || $_FILES['photo-name']['error'] === UPLOAD_ERR_NO_FILE) {
    echo "<script>
            alert('直接このページにアクセスすることはできません。トップページからアップロードしてください。');
            window.location.href = 'index.php';
        </script>";
    exit;
}

// PHP側で「今この瞬間」の日本時間を作成
$now_time = date('Y-m-d H:i:s');

$original_name = $_FILES['photo-name']['name'];
// ファイル名に使う日時も、PHPが作った確実な時間から生成
$file_name     = date('Ymd_His', strtotime($now_time)) . '_' . basename($original_name);

$tmp_name   = $_FILES['photo-name']['tmp_name'];
$upload_dir = 'img/';
=======
// もしフォームからデータが送られてきて「いない」なら、処理を中断する（安全対策）
if (!isset($_FILES['photo-name']) || !isset($_POST['client_upload_time'])) {
    die('直接このページにアクセスすることはできません。トップページからアップロードしてください。');
}

$original_name = $_FILES['photo-name']['name']; 
$uploaded_at   = $_POST['client_upload_time'];
$file_name     = date('Ymd_His', strtotime($uploaded_at)) . '_' . basename($original_name); 

$tmp_name   = $_FILES['photo-name']['tmp_name']; 
$upload_dir = 'img/'; 
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

<<<<<<< HEAD
$upload_path = $upload_dir . $file_name;
=======
$upload_path = $upload_dir . $file_name; 
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19

if (move_uploaded_file($tmp_name, $upload_path)) {
    $sql = "INSERT INTO photo (file_name, uploaded_at) VALUES (:file_name, :uploaded_at)";
    $stmt = $pdo->prepare($sql);
<<<<<<< HEAD

    // データベースに、PHPが作った正確な現在日時をそのまま叩き込む
    $stmt->execute([
        ':file_name'   => $file_name,
        ':uploaded_at' => $now_time
=======
    
    $stmt->execute([
        ':file_name'   => $file_name,
        ':uploaded_at' => date('Y-m-d H:i:s', strtotime($uploaded_at)) 
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
    ]);

    // 文字をそのまま出すのではなく、JSのポップアップを実行してTOPへ戻す
    echo "<script>
            alert('アップロードとDB保存が成功しました！🐾');
            window.location.href = 'index.php';
        </script>";
    exit; // 処理をここで確実に終了させる

} else {
<<<<<<< HEAD
    // 失敗したときも同様にポップアップで教えてTOPに戻す
=======
    // 失敗したときも同様にポップアップで教えてTOPに戻すと親切です
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
    echo "<script>
            alert('ファイルの移動に失敗しました。もう一度やり直してください。');
            window.location.href = 'index.php';
        </script>";
    exit;
}
<<<<<<< HEAD
=======
?>
>>>>>>> 32d0940d205a6f17ea01377ca746e07966ab6d19
