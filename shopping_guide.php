<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '購物須知';

// 引入頭部文件
require_once('header.php'); 
?>

<section>
    <div class="container">
        <div id="ckeditor" class="page_content">
            <span class="ckeditor">
                <p>&nbsp;</p>

                <div style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;"><span style="font-size:16px;"><strong>氣味圖書館網路購物電子商務約定條款</strong></span></div>

                <div style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">&nbsp;</div>

                <p><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">歡迎您在氣味圖書館進行消費；請您先詳細閱讀以下約定條款：</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">本約定條款的目的，是為了保護</span><span style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif; font-size: small;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">以及您的利益，如果您點選「我同意」或類似語意的選項、或在</span><span style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif; font-size: small;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">進行訂購、付款、消費或進行相關行為，就視為您事先已經知悉、並同意本約定條款的所有約定。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <strong style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">一、個人資料安全</strong><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">1. 為了完成交易，包括且不限於完成付款及交付等，您必須擔保在加入成為會員或訂購過程中所留存的所有資料均為完整、正確、與當時情況相符的資料，如果事後有變更，您應該即時通知</span><span style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif; font-size: small;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">。</span><br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <br style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">
                <span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">2. 對於您所留存的資料，</span><span style="box-sizing: border-box; color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif; font-size: small;">氣味圖書館</span><span style="color: rgb(57, 57, 57); font-family: &quot;Open Sans&quot;, sans-serif;">除了採用安全交易模式外，並承諾負保密義務，除了為完成交易或提供顧客服務而提供給相關商品或服務之配合廠商以外，不會任意洩漏或提供給第三人。</span></p>
            </span>
        </div>
    </div>
</section>
<br>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>