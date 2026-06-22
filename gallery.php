<?php
// 読み込み側のファイルの先頭にも追加
date_default_timezone_set('Asia/Tokyo');
// 先頭でロジックファイルを読み込む
require_once 'gallery_logic.php';
?>
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
    <!-- light box-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <!--slick-->
    <link rel="stylesheet" href="js/slick/slick.css">
    <link rel="stylesheet" href="js/slick/slick-theme.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="mt-5">
        <div class="container d-flex justify-content-around align-items-center">
            <h1>
                <a href="index.php"><i class="fa-solid fa-paw"></i>Rate-album</a>
            </h1>
            <nav>
                <a href="index.php" class="btn btn-outline-dark btn-sm me-2">TOP</a>
                <a href="gallery.php" class="btn btn-dark btn-sm">Gallery</a>
            </nav>
        </div>
    </header>

    <main class="container mt-5">
        
        <section class="gallery-section">
            <h2 class="text-center mb-5 ">思い出一覧</h2>

            <div class="row g-4">
                <?php if (count($files) > 0): ?>
                    <?php foreach ($files as $file): ?>
                        
                        <div class="col-6 col-md-4 col-lg-3">
                            
                            <article class="card h-100 shadow-sm position-relative">
                                <a href="img/<?= htmlspecialchars($file['file_name'], ENT_QUOTES, 'UTF-8') ?>" data-lightbox="latte-album">
                                    <img src="img/<?= htmlspecialchars($file['file_name'], ENT_QUOTES, 'UTF-8') ?>" 
                                    class="card-img-top gallery-img" alt="ラテの写真" style="height: 200px; object-fit: cover;">
                                </a>
                                
                                <div class="card-body p-2 d-flex justify-content-between align-items-center">
                                    
                                    <time datetime="<?= $file['uploaded_at'] ?>" class="text-muted small">
                                        <?= date('Y/m/d H:i', strtotime($file['uploaded_at'])) ?>
                                    </time>
                                    
                                    <form action="delete.php" method="POST" onsubmit="return confirm('この写真を本当に削除しますか？');">
                                        <input type="hidden" name="id" value="<?= $file['id'] ?>">
                                        <input type="hidden" name="file_name" value="<?= htmlspecialchars($file['file_name'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" class="btn btn-link text-danger p-0 border-0" aria-label="この写真を削除する">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>

                                </div>
                            </article>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">まだ写真がありません。トップページからアップロードしてください。</p>
                <?php endif; ?>
            </div>
        </section>

        <?php if ($total_pages > 1): ?>
            <nav class="mt-5" aria-label="ギャラリーページナビゲーション">
                <ul class="pagination justify-content-center">
                    
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link text-dark" href="gallery.php?page=<?= $current_page - 1 ?>">前へ</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i === $current_page) ? 'active' : '' ?>">
                            <a class="page-link <?= ($i === $current_page) ? 'bg-dark border-dark text-white' : 'text-dark' ?>" href="gallery.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link text-dark" href="gallery.php?page=<?= $current_page + 1 ?>">次へ</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </nav>
        <?php endif; ?>
        
    </main>

    <footer class="py-4 mt-5 border-top text-center text-muted small">
        <p>&copy; Rate-album All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>