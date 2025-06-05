<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

// 設置頁面標題
$pageTitle = '首頁';

// 任何該頁面特定的樣式
$additionalStyles = '
			.carousel-control { 
				width: 8%;
				width: 0px;
			}
			.carousel-control.left,
			.carousel-control.right { 
				margin-right: 40px;
				margin-left: 32px; 
				background-image: none;
				opacity: 1;
			}
			.carousel-control > a > span {
				color: black;
				  font-size: 40px !important;
			}

			.carousel-col { 
				position: relative; 
	min-height: 350px; 
	padding: 10px; 
				float: left;
			 }

			 .active > div { display:none; }
			 .active > div:first-child { display:block; }

			/*xs*/
			@media (max-width: 767px) {
			  .carousel-inner .active.left { left: -50%; }
			  .carousel-inner .active.right { left: 50%; }
				.carousel-inner .next        { left:  50%; }
				.carousel-inner .prev		     { left: -50%; }
			  .carousel-col                { width: 50%; }
				.active > div:first-child + div { display:block; }
			}

			/*sm*/
			@media (min-width: 768px) and (max-width: 991px) {
			  .carousel-inner .active.left { left: -50%; }
			  .carousel-inner .active.right { left: 50%; }
				.carousel-inner .next        { left:  50%; }
				.carousel-inner .prev		     { left: -50%; }
			  .carousel-col                { width: 50%; }
				.active > div:first-child + div { display:block; }
			}

			/*md*/
			@media (min-width: 992px) and (max-width: 1199px) {
			  .carousel-inner .active.left { left: -33%; }
			  .carousel-inner .active.right { left: 33%; }
				.carousel-inner .next        { left:  33%; }
				.carousel-inner .prev		     { left: -33%; }
			  .carousel-col                { width: 33%; }
				.active > div:first-child + div { display:block; }
			  .active > div:first-child + div + div { display:block; }
			}

			/*lg*/
			@media (min-width: 1200px) {
			  .carousel-inner .active.left { left: -25%; }
			  .carousel-inner .active.right{ left:  25%; }
				.carousel-inner .next        { left:  25%; }
				.carousel-inner .prev		     { left: -25%; }
			  .carousel-col                { width: 25%; }
				.active > div:first-child + div { display:block; }
			  .active > div:first-child + div + div { display:block; }
				.active > div:first-child + div + div + div { display:block; }
			}

			.block {
	width: 400px;
	height: 350px;
	margin: 0 auto;
}

/* 新設計的產品卡片樣式 - 更緊湊版本 */
.product-card {
	background: #fff;
	border-radius: 5px;
	padding: 10px;
	margin: 10px 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.1);
	position: relative;
	transition: all 0.3s ease;
	height: auto;
	min-height: 320px;
}

.product-card:hover {
	box-shadow: 0 3px 10px rgba(0,0,0,0.15);
}

.product-card img {
	height: 160px;
	width: 80%;
	object-fit: contain;
	margin: 5px auto;
	display: block;
}

.product-card h4 {
	font-size: 15px;
	font-weight: 500;
	text-align: center;
	margin: 5px 0;
	min-height: 40px;
	overflow: hidden;
}

.product-card h3 {
	color: #e74c3c;
	font-size: 22px;
	text-align: center;
	font-weight: bold;
	margin: 5px 0 0 0;
}

.product-card .stock {
	color: #777;
	font-size: 13px;
	text-align: center;
	margin: 3px 0 8px;
}

.product-card .btn {
	display: block;
	width: 90%;
	margin: 0 auto;
	border-radius: 3px;
	background-color: #f8f9fa;
	border: 1px solid #ddd;
	padding: 6px 0;
	font-size: 14px;
}

.bestseller-badge {
	position: absolute;
	top: 10px;
	right: 10px;
	background-color: #e74c3c;
	color: white;
	padding: 5px 15px;
	border-radius: 20px;
	font-size: 14px;
	font-weight: bold;
					}

.bestseller-section {
	padding: 20px 0;
	margin: 0;
	background-color: #f8f8f8;
}

.bestseller-title {
	text-align: center;
	font-size: 32px;
	font-weight: bold;
	margin-bottom: 20px;
	position: relative;
	color: #333;
}

.bestseller-title:after {
	content: "";
	display: block;
	width: 60px;
	height: 3px;
	background: #e74c3c;
	margin: 5px auto 0;
					}

.carousel-control.left, 
.carousel-control.right {
	background-image: none;
	width: 40px;
	color: #333;
}

/* 產品卡片響應式調整 */
@media (max-width: 767px) {
	.product-card {
		min-height: 350px;
		max-width: 280px;
		margin-left: auto;
		margin-right: auto;
	}
	
	.product-card img {
		height: 140px;
	}
	
	.product-card h4 {
		font-size: 14px;
	}
	
	.product-card h3 {
		font-size: 20px;
	}
	
	.bestseller-title {
		font-size: 24px;
	}
	
	#myCarousel .item img {
		height: auto;
					}
					
	/* 改善bestseller部分的小屏幕顯示 */
	.bestseller-section .carousel .item .row {
		margin-left: 0;
		margin-right: 0;
	}
	
	.bestseller-section .col-xs-12 {
		padding-left: 5px;
		padding-right: 5px;
	}
	
	#carousel .carousel-control {
		width: 30px;
		height: 30px;
		top: 50%;
		margin-top: -15px;
		font-size: 20px;
		color: #333;
	}
}

/* 平板設備的響應式調整 */
@media (min-width: 768px) and (max-width: 991px) {
	.product-card {
		min-height: 330px;
	}
	
	.product-card img {
		height: 150px;
	}
	
	/* 改善bestseller部分的平板顯示 */
	.bestseller-section .col-sm-6 {
		width: 48%;
		margin: 0 1%;
	}
}

/* 為bestseller輪播增加自定義控制樣式 */
.carousel-indicators-custom {
	margin: 10px 0;
}

.carousel-indicators-custom .btn {
	margin: 0 2px;
	width: 30px;
	height: 30px;
	border-radius: 50%;
	padding: 5px 0;
	box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.carousel-indicators-custom .btn-primary {
	background-color: #e74c3c;
	border-color: #e74c3c;
}

/* 產品輪播的樣式 */
.product-slider {
	position: relative;
	padding: 0 10px;
	margin-bottom: 30px;
}

/* 美化輪播控制按鈕 */
#product-carousel .carousel-control {
	width: 40px; 
	height: 40px;
	top: 50%;
	margin-top: -20px; /* 垂直置中 */
	border-radius: 50%;
	background: rgba(255, 255, 255, 0.8);
	box-shadow: 0 2px 5px rgba(0,0,0,0.3);
	color: #333;
	text-shadow: none;
	opacity: 0.9;
}

#product-carousel .carousel-control:hover {
	opacity: 1;
	background: rgba(255, 255, 255, 0.9);
}

#product-carousel .carousel-control .glyphicon {
	font-size: 20px;
	width: 20px;
	height: 20px;
	margin-top: -10px;
	margin-left: -10px;
}

#product-carousel .carousel-control.left {
	left: -5px;
									}
									
#product-carousel .carousel-control.right {
	right: -5px;
}

/* 美化輪播指示器 */
#product-carousel .carousel-indicators {
	bottom: -40px;
}

#product-carousel .carousel-indicators li {
	width: 10px;
	height: 10px;
	border-radius: 50%;
	margin: 0 5px;
	background-color: #ddd;
	border: 1px solid #ccc;
}

#product-carousel .carousel-indicators .active {
	width: 12px;
	height: 12px;
	margin: 0 5px;
	background-color: #e74c3c;
	border: 1px solid #e74c3c;
}

/* 美化商品行間距 */
#product-carousel .products-row {
	margin: 10px 0;
}

.product-item {
	transition: all 0.3s ease;
	margin-bottom: 20px;
}

@media (max-width: 575px) {
	.product-item {
		width: 100%;
		max-width: 300px;
		margin-left: auto;
		margin-right: auto;
	}
	
	#product-carousel .carousel-control {
		top: 30%;
	}
}

/* 確保輪播上方有足夠空間 */
.bestseller-section {
	padding-top: 30px;
	padding-bottom: 60px; /* 為指示器留出空間 */
}
';

// 任何該頁面特定的JavaScript
$additionalHead = '
<script>
$(document).ready(function(){
	// 處理bestseller輪播
	$(\'#carousel\').carousel({
		interval: 6000
	});
	
	// 讓輪播按鈕和指示器能同步更新狀態
	$(\'#carousel\').on(\'slid.bs.carousel\', function() {
		var activeIndex = $(\'.carousel-inner .active\').index();
		$(\'.carousel-indicators-custom .btn\').removeClass(\'btn-primary\').addClass(\'btn-default\');
		$(\'.carousel-indicators-custom .btn\').eq(activeIndex).removeClass(\'btn-default\').addClass(\'btn-primary\');
	});
	
	// 為手機尺寸添加手勢滑動支持
	var touchStartX = 0;
	var touchEndX = 0;
	
	$(\'.bestseller-section\').on(\'touchstart\', function(e) {
		touchStartX = e.originalEvent.touches[0].pageX;
	});
	
	$(\'.bestseller-section\').on(\'touchend\', function(e) {
		touchEndX = e.originalEvent.changedTouches[0].pageX;
		handleGesture();
	});
	
	function handleGesture() {
		if (touchEndX < touchStartX - 50) {
			// 向左滑動
			$(\'#carousel\').carousel(\'next\');
		}
		if (touchEndX > touchStartX + 50) {
			// 向右滑動
			$(\'#carousel\').carousel(\'prev\');
		}
	}
});
</script>
';

// 引入頭部文件
require_once('header.php'); 
?>
	
	<div class="container">
   <div class="carousel slide" id="myCarousel" data-interval="120000" data-ride="carousel" data-wrap="true">
			<ol class="carousel-indicators">
		  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
			</ol>
		  <div class="carousel-inner">
			<div class="item active">
		  <img src="//cdn.cybassets.com/s/files/10316/theme/31745/assets/img/main_slider_item_3_md.jpg?1559752221" onerror="this.src='https://via.placeholder.com/800x400?text=圖片無法載入'" class="img-responsive center-block">
			</div>
			<div class="item">
		  <img src="//cdn.cybassets.com/s/files/10316/theme/31745/assets/img/main_slider_item_2_md.jpg?1553847595" onerror="this.src='https://via.placeholder.com/800x400?text=圖片無法載入'" class="img-responsive center-block">
			</div>
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span></a>
			<a href="#myCarousel" class="carousel-control right" data-slide="next">
			  <span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		  </div>
		</div>
	</div>
	<br><br>
 <section class="bestseller-section">
            <div class="container">
        <h1 class="bestseller-title">BESTSELLER暢銷</h1>
				
		<div class="product-slider">
							<?php
			// 數據庫連接配置
							$db_ip="127.0.0.1";
							$db_user="root";
			$db_pwd=""; 
			try {
				$db_link = @mysqli_connect($db_ip, $db_user, $db_pwd, "database");
				if(!$db_link) {
					throw new Exception("數據庫連接失敗: " . mysqli_connect_error());
				}
				
				// 獲取所有產品並按庫存(銷量)排序
				$sql="SELECT * FROM `product` ORDER BY `product`.`inventory` ASC LIMIT 12";
							$result=mysqli_query($db_link, $sql);
				if(!$result) {
					throw new Exception("查詢失敗: " . mysqli_error($db_link));
				}
				
				$products = array();
				while($row = $result->fetch_row()) {
					$products[] = $row;
				}
				
				if(count($products) == 0) {
					throw new Exception("未找到產品數據");
				}
				
				// 產品輪播容器
				echo '<div id="product-carousel" class="carousel slide" data-ride="carousel" data-interval="120000" data-wrap="true" data-cycle="true">';
				
				// 輪播指示器
				echo '<ol class="carousel-indicators">';
				$groups = array_chunk($products, 4); // 預設每頁4個產品，會根據屏幕大小動態調整
				foreach($groups as $index => $group) {
					echo '<li data-target="#product-carousel" data-slide-to="'.$index.'" '.($index == 0 ? 'class="active"' : '').'></li>';
				}
				echo '</ol>';
				
				// 輪播內容
				echo '<div class="carousel-inner">';
				
				foreach($groups as $index => $group) {
					echo '<div class="item '.($index == 0 ? 'active' : '').'">';
					echo '<div class="row products-row">';
					
					foreach($group as $i => $product) {
						echo '<div class="product-item col-xs-6 col-sm-3">
							<div class="product-card">
								<span class="bestseller-badge">TOP '.($index * 4 + $i + 1).'</span>
								<img src="'.$product[7].'" alt="'.$product[1].'" onerror="this.src=\'https://via.placeholder.com/250x150?text=產品圖片\'">
								<h4>'.$product[1].'</h4>
								<h3>NT'.$product[2].'</h3>
								<p class="stock">剩餘庫存: '.$product[3].'</p>';
								
						if($product[3] > 0) {
							echo '<a href="cart_add.php?ids='.$product[0].'&page=homepage" class="btn btn-default">加入購物車</a>';
						} else {
							echo '<button class="btn btn-default disabled">已售完</button>';
														}
			
						echo '</div>
						</div>';
					}
					
					echo '</div></div>';
									}
				
				echo '</div>';
				
				// 輪播控制
				echo '<a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">上一頁</span>
				</a>
				<a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">下一頁</span>
				</a>';
				
				echo '</div>';
				
			} catch(Exception $e) {
				// 處理錯誤情況
				echo "<div class='alert alert-warning' role='alert'>
					<strong>提示:</strong> ".$e->getMessage()."。請檢查數據庫連接或聯絡網站管理員。
				</div>";
				
				// 顯示備用內容
				echo '<div id="product-carousel" class="carousel slide" data-ride="carousel" data-interval="120000" data-wrap="true" data-cycle="true">
					<div class="carousel-inner">
						<div class="item active">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="product-card">
										<span class="bestseller-badge">TOP 1</span>
										<img src="https://via.placeholder.com/250x150?text=示例產品1" alt="示例產品">
										<h4>【聖水】Holy water</h4>
										<h3>NT1100</h3>
										<p class="stock">剩餘庫存: 5</p>
										<a href="#" class="btn btn-default">加入購物車</a>
									</div>
							</div>
							</div>
						</div>
					</div>
					<a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">上一頁</span>
					</a>
					<a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">下一頁</span>
					</a>
				</div>';
						}

			// 關閉數據庫連接
			if(isset($db_link) && $db_link) {
				mysqli_close($db_link);
					}
			?>
			</div>
        </div>
    </section>
	
<!-- 產品輪播專用JavaScript -->
<script>
$(document).ready(function(){
	// 確保產品輪播正確初始化並循環
	$('#product-carousel').carousel({
		interval: 120000,
		pause: "hover",
		wrap: true  // 確保循環
	});
	
	// 確保主輪播正確初始化並循環
	$('#myCarousel').carousel({
		interval: 120000,
		pause: "hover",
		wrap: true  // 確保循環
	});
	
	// 手動處理循環邏輯 - 當到達最後一頁時，自動跳回第一頁
	$("#product-carousel").on('slid.bs.carousel', function(e) {
		var $this = $(this);
		var $items = $this.find('.item');
		var $active = $this.find('.active');
		var activeIndex = $items.index($active);
		
		// 如果當前是最後一頁，則在下一次滑動時跳回第一頁
		if (activeIndex === $items.length - 1) {
			setTimeout(function() {
				$this.carousel(0); // 跳回第一頁
			}, 120000); // 在2分鐘後跳回
		}
	});
	
	// 手動強制確保循環 - 每隔2分鐘檢查一次
	function ensureCarouselCycling() {
		// 檢查產品輪播
		var $productCarousel = $('#product-carousel');
		var $productItems = $productCarousel.find('.item');
		var $productActive = $productCarousel.find('.active');
		
		// 如果已經到達最後一項並且沒有活動指示器，或者活動指示器在最後一項，則回到第一項
		if ($productActive.length === 0 || $productItems.index($productActive) === $productItems.length - 1) {
			$productCarousel.carousel(0);
		}
		
		// 檢查主輪播
		var $mainCarousel = $('#myCarousel');
		var $mainItems = $mainCarousel.find('.item');
		var $mainActive = $mainCarousel.find('.active');
		
		// 如果已經到達最後一項並且沒有活動指示器，或者活動指示器在最後一項，則回到第一項
		if ($mainActive.length === 0 || $mainItems.index($mainActive) === $mainItems.length - 1) {
			$mainCarousel.carousel(0);
		}
		
		// 每2分鐘重新檢查一次
		setTimeout(ensureCarouselCycling, 120000);
	}
	
	// 啟動循環檢查
	ensureCarouselCycling();
	
	// 響應式輪播邏輯
	function updateCarouselItems() {
		var windowWidth = $(window).width();
		var groupSize = 4; // 預設大螢幕顯示4個
		
		// 根據螢幕大小決定每組顯示的產品數量
		if(windowWidth < 576) {
			groupSize = 1; // 特小螢幕顯示1個
		} else if(windowWidth < 768) {
			groupSize = 2; // 手機螢幕顯示2個
		} else if(windowWidth < 992) {
			groupSize = 3; // 平板螢幕顯示3個
		}
		
		// 重新設置輪播狀態
		$('#product-carousel').attr('data-group-size', groupSize);
		
		// 獲取所有產品項目
		var $allItems = $('.product-item');
		
		// 如果產品數量或分組發生變化，需要重建輪播
		if($allItems.length > 0) {
			// 調整每個產品項目的尺寸
			if(groupSize === 1) {
				$allItems.removeClass('col-xs-6').addClass('col-xs-12');
			} else {
				$allItems.removeClass('col-xs-12').addClass('col-xs-6');
			}
		}
	}
	
	// 頁面加載和窗口大小改變時更新輪播
	$(window).on('load resize', function(){
		updateCarouselItems();
	});
	
	// 手機觸摸滑動支持
	$('#product-carousel').on('touchstart', function(event){
		var xStart = event.originalEvent.touches[0].pageX;
		$(this).on('touchmove', function(event){
			var xMove = event.originalEvent.touches[0].pageX;
			if(Math.floor(xStart - xMove) > 10) {
				$(this).carousel('next');
			} else if(Math.floor(xStart - xMove) < -10) {
				$(this).carousel('prev');
			}
		});
	}).on('touchend', function(){
		$(this).off('touchmove');
	});
	
	// 按鈕懸停時暫停輪播
	$('.carousel-control').hover(
		function() { $('#product-carousel').carousel('pause'); },
		function() { $('#product-carousel').carousel('cycle'); }
	);
});
</script>
	
	<?php
// 引入頁腳文件
require_once('footer.php'); 
			?>






