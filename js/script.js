
$('.main-slider').slick ({
    centerMode: true,
    centerPadding: '25%',
    dots: false,
    autoplay: true,
    autoplaySpeed: 1000
})

/* ==========================================================
* アップロードファイルが選択されたら、ファイル名を画面に表示する
* ========================================================== */
    $('#file_upload').on('change', function() {
        // 選択されたファイルの情報を取得
        const file = this.files[0];
        
        if (file) {
            // ファイルがあったら、その名前を書き換えて表示する
            $('#file-name-preview').text('選択中: ' + file.name)
                                    .addClass('bg-dark text-white') // 少し目立たせる
                                    .removeClass('bg-white text-dark');
        } else {
            // キャンセルされたら元に戻す
            $('#file-name-preview').text('選択されていません')
                                    .addClass('bg-white text-dark')
                                    .removeClass('bg-dark text-white');
        }
    });


lightbox.option({
    'wrapAround': true,  // 最後の画像までいったら、自動で最初の画像に戻る
    'fadeDuration': 300, // フワッと表示される速度（ミリ秒）
    'resizeDuration': 200 // 画像サイズが変わるときの動く速度
});

