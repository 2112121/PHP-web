<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '售後服務';

// 引入頭部文件
require_once('header.php'); 
?>

<section>
    <div class="container">
        <div id="ckeditor" class="page_content">
            <span class="ckeditor">
                <br>
                <h1>關於退貨退款</h1>
                <p style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">1. 如果您所訂購的商品有瑕疵，您可以要求換貨。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">2. 您在</span><span style="font-size: small; box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">所訂購的商品，都可以在七天之內要求退貨退款；但是，下列商品不在此限：</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="font-size: small; box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">※</span><strong style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">產品一經<u style="box-sizing: border-box;">拆封使用</u>,恕不退貨退款</strong><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">※依照您所要求或註明的規格、需求或時間，所訂製、調整或送達的商品。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">※為完成交付，需要您另外提供除單純收受以外的協力之商品，包括且不限於完成相關登記或過戶等。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">※報紙、雜誌、期刊、或其他定期發行的商品。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">※依照通常運送條件，貨物取回時已逾保存期限、或已變質或損壞的商品。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                    <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">3. 您所退回的商品，必須保持所有商品、贈品、附件、包裝、及所有附隨文件或資料的完整性，如果有實體發票，並應連同發票一併退回；否則，</span><span style="font-size: small; box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">得拒絕接受您的退貨退款要求。</span>
                </p>
                <div>&nbsp;</div>
            </span>
        </div>
    </div>
</section>
<br>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?> 