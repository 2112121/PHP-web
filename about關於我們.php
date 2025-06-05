				<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
					session_start();
}

// 設置頁面標題
$pageTitle = '關於我們';

// 引入頭部文件
require_once('header.php'); 
?>

	<section>
            <div class="jumbotron jumbotron-fluid jumbotron-bg d-flex align-items-end">
        <div class="container jumbotron-text text-white p-4">
					<h1 class="display-4 " style="font-weight: bold;">氣味圖書館</h1>
					<p class="lead">致力於收集每天生活週遭的氣味，例如：自然與生活中的泥土、海風、雨水、花草樹木、皮革、巧克力脆片、蛋糕等等，氣味圖書館認為氣味可以提升我們的生活, 可以使人更幸福! 我們主張"氣味" 是我們的產品, 無論是牙膏、香水、乳液、室芳、或按摩油等, 都是傳達氣味的媒介! 
					不同於其他業界, 我們是第一個提出氣味對於生活應該是種體驗，且圖書館目標為收納全世界天然且獨特的氣味商品; 到了氣味圖書館, 你/妳可以找到一般市面上看不到又優質的產品, 讓我們生活的小環境中, 充滿了趣味與幸福感!</p>
					<p class="lead" style="font-weight: bold;">氣味圖書館希望每個人都能來體驗, 並找出屬於「自己」的味道！</p>
				</div><br>
        <div class="container jumbotron-text text-white p-4">
					<h1 class="display-4 " style="font-weight: bold;">全台實體門市資訊</h1><br>
					<p class="lead" style="font-weight: bold;">因美國新冠肺炎疫情嚴重影響供貨狀況，全台灣門市已於2020年8月1日起暫停營業，不便之處還請見諒。</p>
				</div><br>
			</div>
    <div class="container">
		<div class="row">
            <div class="col-xs-12">
                <img src="https://shop.r10s.com/b9d30ce0-f52c-11e4-9162-005056b75bda/upload/aboutDemeter-730.jpg" class="img-responsive">
            </div>
		  </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <img src="https://shop.r10s.com/b9d30ce0-f52c-11e4-9162-005056b75bda/upload/12SCENT-730.jpg" class="img-responsive">
		  </div>
	  </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <img src="https://shop.r10s.com/b9d30ce0-f52c-11e4-9162-005056b75bda/upload/Perfume730.jpg" class="img-responsive">
            </div>
	  </div>
	  </div>
    <br>
</section>
	
<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>






