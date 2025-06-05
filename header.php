<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title><?php echo isset($pageTitle) ? $pageTitle : '氣味圖書館'; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<style>
		.navbar-brand {
			  transform: translateX(-50%);
			  left: 50%;
			  position: absolute;
			}
		.panel-body {
			  transform: translateX(-50%);
			  left: 90.5%;
			  position: absolute;
			}
		.col-centered {
				float: none;
				margin: 0 auto;
			}

		/* 導航欄圖片樣式優化 */
		.navbar-brand img {
			height: 30px;
			width: auto;
			margin-top: -5px;
			display: inline-block;
		}
		
		@media (min-width: 768px) {
			.navbar-brand img {
				height: 40px;
			}
			
			.navbar {
				min-height: 60px;
			}
			
			.navbar-nav > li > a {
				padding-top: 20px;
				padding-bottom: 20px;
			}
		}

		/* 修正页眉和页脚的样式 */
		.navbar-default {
			box-shadow: 0 2px 5px rgba(0,0,0,0.1);
		}
		
		/* 修正底部固定位置，避免遮挡内容 */
		.fixed-bottom {
			position: relative !important;
		}
		
		/* 修正图片响应式显示 */
		.img-responsive {
			max-width: 100%;
			height: auto;
		}
		
		/* 为整体页面添加更好的间距 */
		.container {
			padding-bottom: 20px;
		}
		
		/* 调整下拉菜单位置 */
		.dropdown-menu {
			margin-top: 0;
			border-radius: 0;
		}
		
		/* 頁面在小屏幕設備上的導航欄響應式優化 */
		@media (max-width: 767px) {
			body {
				padding-top: 70px !important;
			}
			
			.container {
				padding-left: 10px;
				padding-right: 10px;
			}
			
			.navbar-fixed-top .container-fluid {
				padding-left: 10px;
				padding-right: 10px;
			}
			
			.nav-pills.nav-justified > li {
				display: block;
				width: 100%;
				margin-bottom: 5px;
			}
			
			.navbar-fixed-top .nav-pills {
				margin-left: -15px;
				margin-right: -15px;
			}
			
			.navbar-nav .open .dropdown-menu {
				position: static;
				float: none;
				width: auto;
				margin-top: 0;
				background-color: transparent;
				border: 0;
				box-shadow: none;
			}
			
			.dropdown-menu > li > a {
				padding: 8px 15px;
			}
			
			#navbar {
				max-height: 350px;
				overflow-y: auto;
			}
			
			/* 確保購物車下拉菜單在移動設備上可見 */
			.navbar-nav .dropdown-menu.dropdown-menu-right {
				background-color: #fff;
				border: 1px solid rgba(0,0,0,.15);
				box-shadow: 0 6px 12px rgba(0,0,0,.175);
				right: 0;
				left: auto;
			}
		}

		/* 全局響應式樣式 */
		html, body {
			overflow-x: hidden; /* 防止水平滾動條出現 */
			margin: 0;
			padding: 0;
			width: 100%;
			min-height: 100vh;
		}
		
		body {
			display: flex;
			flex-direction: column;
		}
		
		.main-content {
			flex: 1 0 auto;
		}

		/* 購物車樣式改進 */
		.cart-dropdown {
			min-width: 350px; 
			max-width: 450px; 
			padding: 15px; 
			box-shadow: 0 5px 15px rgba(0,0,0,0.15); 
			border-radius: 5px;
		}
		
		.cart-header {
			margin-bottom: 15px;
		}
		
		.cart-header h5 {
			margin-top: 0; 
			padding-bottom: 10px; 
			border-bottom: 1px solid #eee; 
			color: #333; 
			font-weight: 600;
			text-align: center;
		}
		
		.cart-body {
			max-height: 400px;
			overflow-y: auto;
		}
		
		.cart-item {
			padding: 10px 0;
			border-bottom: 1px solid #f3f3f3;
			position: relative;
		}
		
		.cart-item-name {
			font-weight: 600;
			margin-bottom: 5px;
			font-size: 14px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		
		.cart-item-price {
			color: #e74c3c;
			font-weight: 500;
			font-size: 14px;
			margin-top: 5px;
		}
		
		.cart-item-subtotal {
			font-weight: bold;
			font-size: 15px;
			white-space: nowrap;
		}
		
		.cart-summary {
			border-top: 1px solid #eee; 
			padding: 12px 0; 
			margin: 10px 0 15px;
			background-color: #f9f9f9;
			border-radius: 4px;
			padding: 10px;
		}
		
		.cart-total {
			font-weight: bold;
		}
		
		.cart-total-price {
			color: #e74c3c;
			font-weight: bold;
			font-size: 16px;
		}

		.cart-total-items {
			font-size: 13px;
			color: #555;
		}
		
		.cart-actions .btn {
			margin-bottom: 10px;
		}
		
		.checkout-btn {
			font-weight: 500; 
			padding: 10px;
			background-color: #337ab7;
			border-color: #2e6da4;
			transition: all 0.2s ease;
		}
		
		.checkout-btn:hover, .checkout-btn:focus {
			background-color: #286090;
			border-color: #204d74;
		}
		
		.clear-cart-btn {
			font-weight: 500; 
			padding: 8px;
			background-color: #d9534f;
			border-color: #d43f3a;
			transition: all 0.2s ease;
		}
		
		.clear-cart-btn:hover, .clear-cart-btn:focus {
			background-color: #c9302c;
			border-color: #ac2925;
		}
		
		/* 購物車刪除按鈕 */
		.cart-delete-btn {
			border-radius: 50%; 
			padding: 4px 5px;
			transition: all 0.25s ease;
			background-color: #b71c1c; /* 更暗的紅色 */
			border-color: #8b0000;
			color: white;
			width: 32px;
			height: 32px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 2px 5px rgba(0,0,0,0.4);
			font-size: 16px;
			position: relative;
			opacity: 1;
		}
		
		.cart-delete-btn:hover {
			background-color: #f44336;
			border-color: #d32f2f;
			color: white;
			transform: scale(1.1);
			box-shadow: 0 3px 6px rgba(0,0,0,0.5);
		}
		
		.cart-delete-btn:hover:after {
			content: "刪除商品";
			position: absolute;
			top: -30px;
			left: 50%;
			transform: translateX(-50%);
			background-color: #333;
			color: white;
			padding: 3px 8px;
			border-radius: 4px;
			font-size: 12px;
			white-space: nowrap;
			z-index: 10;
			opacity: 0.9;
		}
		
		/* 購物車表格樣式 */
		.cart-table {
			margin-bottom: 0;
		}
		
		.cart-table > tbody > tr > td {
			vertical-align: middle;
			border-top: none;
			padding: 8px 4px;
		}
		
		/* 購物車數量控制器樣式 */
		.quantity-control {
			display: flex;
			align-items: center;
			justify-content: flex-start;
			margin: 8px 0;
			background: #f5f5f5;
			border-radius: 20px;
			padding: 3px 6px;
			border: 1px solid #e0e0e0;
			max-width: 120px;
		}
		
		.quantity-control .btn {
			border-radius: 50%;
			width: 26px;
			height: 26px;
			padding: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: white;
			border: 1px solid #ddd;
			transition: all 0.2s ease;
			margin: 0;
			font-size: 12px;
		}
		
		.quantity-control .btn:hover {
			background-color: #337ab7;
			border-color: #337ab7;
			color: white;
		}
		
		.quantity-control .btn:focus {
			outline: none;
		}
		
		.quantity-control span {
			margin: 0 10px;
			font-size: 14px;
			min-width: 20px;
			text-align: center;
			font-weight: 500;
			color: #333;
		}
		
		/* 購物車空狀態樣式 */
		.cart-empty {
			padding: 20px 10px;
			text-align: center;
			margin: 10px 0;
		}
		
		.cart-empty-icon {
			font-size: 40px;
			color: #ddd;
			margin-bottom: 15px;
			animation: float 3s ease-in-out infinite;
		}
		
		@keyframes float {
			0% { transform: translateY(0px); }
			50% { transform: translateY(-5px); }
			100% { transform: translateY(0px); }
		}
		
		.cart-empty-text {
			color: #999;
			font-size: 14px;
		}

		/* 搜尋下拉選單樣式 */
		.search-dropdown {
			min-width: 300px;
			padding: 20px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.15);
			border-radius: 5px;
		}

		/* 在移動設備上的搜索下拉菜單樣式 */
		@media (max-width: 767px) {
			.search-dropdown {
				min-width: 250px;
				width: 100%;
				padding: 15px;
			}
			
			.search-input {
				height: 38px;
				padding: 8px 12px;
			}
			
			.search-btn {
				padding: 8px 12px;
			}
		}

		.search-form {
			position: relative;
		}

		.search-input {
			border-radius: 20px;
			padding: 10px 15px;
			height: 40px;
			box-shadow: none;
			border: 1px solid #ddd;
			font-size: 14px;
			transition: all 0.2s ease;
			background-color: #f8f8f8;
		}

		.search-input:focus {
			border-color: #337ab7;
			box-shadow: 0 0 5px rgba(51, 122, 183, 0.3);
			background-color: #fff;
		}
		
		.search-input::placeholder {
			color: #aaa;
			font-style: italic;
		}

		.search-btn {
			font-weight: 500;
			padding: 10px 15px;
			border-radius: 20px;
			margin-top: 12px;
			transition: all 0.2s ease;
			background-color: #5bc0de;
			border-color: #46b8da;
		}

		.search-btn:hover {
			background-color: #31b0d5;
			border-color: #269abc;
		}

		.search-icon {
			margin-right: 5px;
			vertical-align: text-top;
		}

		/* 在移動設備上的購物車下拉菜單樣式 */
		@media (max-width: 767px) {
			.cart-dropdown {
				min-width: 280px;
				padding: 10px;
			}
			
			.cart-item {
				padding: 8px 0;
			}
			
			.cart-item-name {
				font-size: 13px;
			}
			
			.cart-item-price {
				font-size: 12px;
			}
			
			.quantity-control {
				max-width: 110px;
				padding: 2px 4px;
			}
			
			.quantity-control .btn {
				width: 22px;
				height: 22px;
				font-size: 10px;
			}
			
			.quantity-control span {
				margin: 0 6px;
				font-size: 13px;
			}
			
			.cart-total-items {
				font-size: 12px;
			}
			
			.cart-delete-btn {
				width: 28px;
				height: 28px;
				padding: 3px;
				font-size: 12px;
			}
		}

		/* 結帳確認頁樣式 */
		.checkout-container {
			margin-top: 30px;
			margin-bottom: 30px;
		}

		.checkout-panel {
			border: 1px solid #337ab7;
			border-radius: 4px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.checkout-header {
			background-color: #337ab7;
			color: white;
			padding: 15px;
			border-radius: 3px 3px 0 0;
		}

		.checkout-header h3 {
			margin: 0;
			font-size: 18px;
			font-weight: bold;
		}

		.checkout-body {
			padding: 20px;
		}

		.checkout-table {
			width: 100%;
			border-collapse: collapse;
		}

		.checkout-table th,
		.checkout-table td {
			padding: 12px 8px;
			text-align: center;
			border: 1px solid #ddd;
		}

		.checkout-table th {
			background-color: #f5f5f5;
		}

		.checkout-table th:first-child,
		.checkout-table td:first-child {
			text-align: left;
		}

		.checkout-quantity {
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 8px 0;
			background: #f5f5f5;
			border-radius: 20px;
			padding: 3px 6px;
			border: 1px solid #e0e0e0;
			max-width: 120px;
			margin: 0 auto;
		}

		.checkout-quantity .btn {
			width: 26px;
			height: 26px;
			padding: 0;
			border-radius: 50%;
			margin: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: white;
			border: 1px solid #ddd;
			transition: all 0.2s ease;
			font-size: 12px;
		}

		.checkout-quantity .btn:hover {
			background-color: #337ab7;
			border-color: #337ab7;
			color: white;
		}

		.checkout-quantity span {
			margin: 0 10px;
			font-size: 14px;
			min-width: 20px;
			text-align: center;
			font-weight: 500;
			color: #333;
		}

		.checkout-total {
			text-align: right;
			padding: 10px;
			border-top: 2px solid #ddd;
			margin-top: 10px;
			font-size: 16px;
			font-weight: bold;
		}

		.checkout-actions {
			display: flex;
			justify-content: space-between;
			margin-top: 20px;
		}

		.checkout-actions .btn {
			padding: 10px 20px;
			font-weight: 500;
		}

		.cart-item-quantity {
			margin: 4px 0;
			display: flex;
			align-items: center;
		}

		.checkout-delete-btn {
			border-radius: 50%; 
			padding: 4px 5px;
			transition: all 0.25s ease;
			background-color: #d9534f;
			border-color: #d43f3a;
			color: white;
			width: 32px;
			height: 32px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 2px 5px rgba(0,0,0,0.2);
			font-size: 14px;
		}
		
		.checkout-delete-btn:hover {
			background-color: #c9302c;
			border-color: #ac2925;
			color: white;
			transform: scale(1.1);
			box-shadow: 0 3px 6px rgba(0,0,0,0.3);
		}

		<?php if (isset($additionalStyles)) { echo $additionalStyles; } ?>
		</style>
		
		<?php if (isset($additionalHead)) { echo $additionalHead; } ?>
	</head>
	<body style="padding-top:140px" class="d-flex flex-column min-vh-100">
	
		<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="homepage首頁.php" class="navbar-brand"><img src="//cdn.cybassets.com/s/files/10316/theme/31745/assets/img/navbar_logo.png?1553848033" height="40px" width="auto" alt="氣味圖書館"></a>
				<button type="button" class="navbar-toggle collapsed" 
					data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">導覽按鈕</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
				<?php 
					if(isset($_GET['out'])){
						session_destroy();
					}
					if(isset($_SESSION['name']))
					{
						echo"<li class=dropdown>
							<a class=dropdown-toggle data-toggle=dropdown href=#>
								".$_SESSION['name']."你好
								<span class=caret></span>
							</a>
							
							<ul class=dropdown-menu>
								<li><a href='4刪除登出.php'>會員登出</a></li>
								<li><a href='5修改密碼.php'>修改密碼</a></li>
								<li><a href='4刪除登出.php?email=".$_SESSION['mail']."'>註銷用戶</a></li>
							</ul>
						</li>";
					}
					else
					{
						echo"<li class=dropdown>
							<a class=dropdown-toggle data-toggle=dropdown href=#>
								登入/註冊
								<span class=caret></span>
							</a>
							
							<ul class=dropdown-menu>
								<li><a href='1會員登入.php'>會員登入</a></li>
								<li><a href='3註冊頁面.php'>註冊新會員</a></li>
							</ul>
						</li>";
					}
					
				?>
				<li class="dropdown ml-auto">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"
						aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
					<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
					</svg>購物車
						
					</a>
					<div class="dropdown-menu dropdown-menu-right cart-dropdown" aria-labelledby="dropdownMenuButton">
						<div class="cart-header">
							<h5 class="text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" style="margin-right: 8px; vertical-align: text-bottom;">
									<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</svg>購物車內容
							</h5>
						</div>
						<div class="cart-body">
							<div class="table-responsive">
								<table class="table table-hover cart-table">
								<tbody>
								<?php
										$arr = $_SESSION["gwc"] ?? array(); // 使用null合併運算符確保即使session變量未設置也不會出錯
									if(isset($_GET['out2'])){
											echo"</tbody>
											</table>
											<div class='cart-empty'>
												<div class='cart-empty-icon'>
													<svg xmlns='http://www.w3.org/2000/svg' width='60' height='60' fill='currentColor' class='bi bi-cart' viewBox='0 0 16 16'>
														<path d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
													</svg>
												</div>
												<p class='cart-empty-text'>購物車目前沒有商品</p>
											</div>";
										 
										 session_destroy();
										 
									}
									else{
									$db_ip="127.0.0.1";
									$db_user="root";
										$db_pwd="";  // 試用空密碼
									$db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
									if(!$db_link)
										die("資料連結錯誤");
									$sum = 0;
										if(!empty($arr)) { // 確保購物車不為空時才執行以下操作
									 foreach($arr as $k=>$v)
									{
										$v[0]; $v[1];
										$sql = "select * from `product` where `Psin`=".$v[0]."";
										$result=mysqli_query($db_link, $sql);
										$result = $db_link -> query($sql);
										$row = $result->fetch_row();
										
										$subtotal = $v[1] * $row[2]; // 計算小計
									
										echo"<tr>
											<td style='width:60%'>
												<div class='cart-item'>
													<div class='cart-item-name'>".$row[1]."</div>
													<div class='cart-item-quantity'>
														<div class='quantity-control'>
															<a href='cart_update.php?sy={$k}&ids={$row[0]}&action=dec&page=".basename($_SERVER['PHP_SELF'], '.php')."' class='btn' title='減少數量'>
																<span class='glyphicon glyphicon-minus'></span>
															</a>
															<span>".$v[1]."</span>
															<a href='cart_update.php?sy={$k}&ids={$row[0]}&action=inc&page=".basename($_SERVER['PHP_SELF'], '.php')."' class='btn' title='增加數量'>
																<span class='glyphicon glyphicon-plus'></span>
															</a>
														</div>
													</div>
													<div class='cart-item-price'>NT$".$row[2]."</div>
												</div>
											</td>
											<td style='width:25%; text-align:right; vertical-align:middle;'>
												<div class='cart-item-subtotal'>NT$".$subtotal."</div>
											</td>
											<td style='width:15%; text-align:center; vertical-align:middle;'>";
												
										// 構建刪除鏈接，處理產品詳情頁的特殊情況
										$delete_link = 'cart_remove.php?sy='.$k.'&page='.basename($_SERVER['PHP_SELF'], '.php').'&ids='.$row[0];
										
										// 添加當前頁面的size參數
										if(isset($_GET['size'])) {
											$delete_link .= '&size='.urlencode($_GET['size']);
										}
										
										// 添加產品詳情頁的特殊參數
										if(strpos($_SERVER['PHP_SELF'], 'product_detail.php') !== false && isset($_GET['id'])) {
											$delete_link .= '&product_id='.$_GET['id'];
										}
										
										// 添加搜索參數
										if(isset($_GET['search'])) {
											$delete_link .= '&search='.urlencode($_GET['search']);
										}
										
										echo "<a href='".$delete_link."' class='btn btn-danger cart-delete-btn' title='刪除此商品'>
													<span class='glyphicon glyphicon-trash'></span>
												</a>
											</td>
										</tr>"; 
										$sum = $sum +$v[1]*$row[2];
											}
									} else {
										echo "<tr><td colspan='3' class='text-center'>
											<div class='cart-empty'>
												<div class='cart-empty-icon'>
													<svg xmlns='http://www.w3.org/2000/svg' width='60' height='60' fill='currentColor' class='bi bi-cart' viewBox='0 0 16 16'>
														<path d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
													</svg>
												</div>
												<p class='cart-empty-text'>購物車目前沒有商品</p>
											</div>
										</td></tr>";
									}
									
								?>
								</tbody>
								
							</table>
							</div>
						</div>
						 <div class="cart-footer">
							 <?php
							 $gs = count($arr);//購物車裏面有幾個商品
							 
							 if($gs > 0) {
								 echo "<div class='cart-summary'>
									<div class='row'>
										<div class='col-xs-6'>
											<div class='cart-total-items'>總商品數: <strong>{$gs}</strong> 種</div>
										</div>
										<div class='col-xs-6 text-right'>
											<div class='cart-total'>總計: <span class='cart-total-price'>NT$".$sum."</span></div>
										</div>
									</div>
								</div>";
							 }
							}
							 ?>
							<div class="cart-actions">
								<div class="row">
									<div class="col-xs-12">
										<a href="checkout_redirect.php?&page=homepage" class="btn btn-primary btn-block checkout-btn">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16" style="margin-right: 8px; vertical-align: text-top;">
												<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
												<path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
											</svg>
											立即結帳
										</a>
									</div>
								</div>
								<?php if(!empty($arr)) { ?>
								<div class="row" style="margin-top: 10px;">
									<div class="col-xs-12">
										<?php
										// 構建清空購物車的鏈接
										$clear_link = 'cart_remove.php?clear=1&page='.basename($_SERVER['PHP_SELF'], '.php');
										
										// 添加size參數
										if(isset($_GET['size'])) {
											$clear_link .= '&size='.urlencode($_GET['size']);
										}
										
										// 添加product_id參數(如果在商品詳情頁)
										if(strpos($_SERVER['PHP_SELF'], 'product_detail.php') !== false && isset($_GET['id'])) {
											$clear_link .= '&product_id='.$_GET['id'];
										}
										
										// 添加search參數
										if(isset($_GET['search'])) {
											$clear_link .= '&search='.urlencode($_GET['search']);
										}
										?>
										<a href="<?php echo $clear_link; ?>" onclick="return confirm('確定要清空購物車嗎？')" class="btn btn-danger btn-block clear-cart-btn">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="margin-right: 8px; vertical-align: text-top;">
												<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
												<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
											</svg>
											清空購物車
										</a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				
				</li>
				<li class="dropdown ml-auto">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"
						aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search search-icon" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg> 搜尋
					</a>
					<div class="dropdown-menu dropdown-menu-right search-dropdown" aria-labelledby="dropdownMenuButton">
						<form method="GET" action="display.php" class="search-form">
							<div class="form-group">
								<input type="text" name="search" class="form-control search-input" placeholder="輸入關鍵字搜尋...">
							</div>
							<button class="btn btn-info btn-block search-btn" type="submit" name="ooo">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search search-icon" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
								</svg>
								按此搜尋
							</button>
						</form>
					</div>
				</li>
				</ul>
				<br><br><br><br>
				<ul class="nav nav-pills nav-justified"><!--nav-justified:平均分配寬度導覽頁-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black">
							❤噴式香水
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href='display.php?size=30ml'>30ml</a></li>
							<li><a href='display.php?size=5ml'>5ml</a></li>
						</ul>
					</li>
					<li><a href='display.php?size=15ml' style="color:black">❤抹式香水</a></li><!--active:啟用導覽標籤-->
					<li><a href="about關於我們.php"style="color:black">❤關於我們</a></li>
				</ul>
				
			</div>
		</div>
	</nav>
	
	<?php
	// 顯示結帳成功消息 - 確保完全顯示在導航欄下方
	if (isset($_GET['checkout_success']) || isset($_SESSION['checkout_success'])) {
		// 如果存在session訊息，優先使用並清除
		if (isset($_SESSION['checkout_success'])) {
			unset($_SESSION['checkout_success']);
		}
		echo '<div class="container">
			<div class="row" style="padding-top: 20px;">
				<div class="col-xs-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>恭喜！</strong> 您的訂單已成功完成，感謝您的購買！
					</div>
				</div>
			</div>
		</div>';
	}
	?>
</body>
</html> 