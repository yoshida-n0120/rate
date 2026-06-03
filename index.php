<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate-album</title>
    <!-- Google Fonts からフォントを読み込む -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&display=swap" rel="stylesheet">
    <!-- reset.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--slick-->
    <link rel="stylesheet" href="js/slick/slick.css">
    <link rel="stylesheet" href="js/slick/slick-theme.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="mt-3 mb-5">
        <div class="container d-flex justify-content-around align-items-center">
            <h1 class="h4 mb-0 ">
                <a href="index.php"><i class="fa-solid fa-paw"></i>Rate-album</a>
            </h1>
            <nav>
                <a href="index.php" class="btn btn-outline-dark btn-sm me-2">TOP</a>
                <a href="gallery.php" class="btn btn-dark btn-sm">Gallery</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="slideshow-container mb-5">
            <?php
                // 読み込み側のファイルの先頭にも追加
                date_default_timezone_set('Asia/Tokyo');
                // DB接続ファイルを読み込む
                require_once 'db_connection.php';

                // SQLを実行
                $sql = "SELECT file_name FROM photo ORDER BY RAND() LIMIT 20";
                $stmt = $pdo->query($sql);
                $files = $stmt->fetchAll();
            ?>

            <div class="main-slider">
                <?php foreach ($files as $file): ?>
                    <div class="slider-item">
                        <img src="img/<?= htmlspecialchars($file['file_name'], ENT_QUOTES, 'UTF-8') ?>" alt="ラテの写真">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="upload-area mb-5">
            <h2 class="h5 mb-4 text-center">ラテの写真をアップロード</h2>
            <form action="up.php" method="post" enctype="multipart/form-data" class="row justify-content-center g-3" id="up" >
                <input type="hidden" name="client_upload_time" id="client_upload_time">
                <div class="col-md-6">
                    <input type="file" name="photo-name" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary px-4">アップロードする</button>
                </div>
            </form>
        </section>
        
    </main>


    <footer>

    </footer>
    <!-- Bootstrap 5 & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/slick/slick.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>