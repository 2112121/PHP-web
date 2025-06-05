<?php 
// 結帳並清空購物車的重定向程式
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 獲取所有可能的URL參數
$search_param = isset($_GET['search']) ? "&search=".urlencode($_GET['search']) : "";
$size_param = isset($_GET['size']) ? "&size=".urlencode($_GET['size']) : "";

// 檢查購物車是否為空
if (!isset($_SESSION['gwc']) || empty($_SESSION['gwc'])) {
    // 如果購物車為空，返回來源頁面並顯示提示
    $page = isset($_GET['page']) ? $_GET['page'] : 'homepage首頁';
    $redirect_url = $page.".php?".$search_param.$size_param;
    header("location:".$redirect_url);
    exit;
}

// 檢查page參數，如果是homepage則使用正確的檔案名稱
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
if ($page == 'homepage') {
    $page = 'homepage首頁';
}

// 構建重定向URL
$redirect_url = "checkout_confirm.php?returnpage=".$page.$search_param.$size_param;
header("location:".$redirect_url); // 重定向到結帳確認頁面
exit;

	
	

 