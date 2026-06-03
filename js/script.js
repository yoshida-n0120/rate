// アップロードしたときの日時を教えるためのjs(jQuery)
function uptime(){
    const now = new Date();
    
    // 日本のタイムゾーン（+9時間）を考慮した年・月・日・時・分・秒を抽出
    const yyyy = now.getFullYear();
    const mm   = String(now.getMonth() + 1).padStart(2, '0');
    const dd   = String(now.getDate()).padStart(2, '0');
    const hh   = String(now.getHours()).padStart(2, '0');
    const mi   = String(now.getMinutes()).padStart(2, '0');
    const ss   = String(now.getSeconds()).padStart(2, '0');
    
    // PHPやMySQLが絶対に誤解しない「YYYY-MM-DD HH:mm:ss」の形を作る
    const mysqlFormat = `${yyyy}-${mm}-${dd} ${hh}:${mi}:${ss}`;
    
    $('#client_upload_time').val(mysqlFormat);
}
// フォームが送信されるときに、定義した関数を実行する
$('#up').on('submit', function() {
    uptime(); 
});

$('.main-slider').slick ({
    centerMode: true,
    centerPadding: '25%',
    dots: false,
    autoplay: true,
    autoplaySpeed: 1500
})

lightbox.option({
    'wrapAround': true,  // 最後の画像までいったら、自動で最初の画像に戻る
    'fadeDuration': 300, // フワッと表示される速度（ミリ秒）
    'resizeDuration': 200 // 画像サイズが変わるときの動く速度
});
