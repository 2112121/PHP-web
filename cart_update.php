<?php
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 獲取參數
$sy = isset($_GET['sy']) ? $_GET['sy'] : 0; // 購物車中的索引
$ids = isset($_GET['ids']) ? $_GET['ids'] : 0; // 商品ID
$action = isset($_GET['action']) ? $_GET['action'] : ''; // 操作類型：'inc'增加，'dec'減少，'set'設置指定數量
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1; // 指定數量

if(isset($_SESSION["gwc"]) && !empty($_SESSION["gwc"])) {
    $arr = $_SESSION["gwc"];
    
    if(isset($arr[$sy]) && is_array($arr[$sy])) {
        $db_ip="127.0.0.1";
        $db_user="root";
        $db_pwd=""; // 密碼為空值
        
        try {
            // 連接資料庫以獲取庫存信息
            $db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
            if(!$db_link) {
                throw new Exception("資料連結錯誤");
            }
            
            // 查詢商品庫存
            $sql = "SELECT inventory FROM product WHERE Psin = " . $ids;
            $result = mysqli_query($db_link, $sql);
            $inventory_row = mysqli_fetch_assoc($result);
            $current_inventory = intval($inventory_row['inventory']);
            
            $current_quantity = $arr[$sy][1];
            $new_quantity = $current_quantity;
            
            // 根據不同操作調整數量
            switch($action) {
                case 'inc': // 增加數量
                    $new_quantity = $current_quantity + 1;
                    break;
                    
                case 'dec': // 減少數量
                    if($current_quantity > 1) {
                        $new_quantity = $current_quantity - 1;
                    }
                    break;
                    
                case 'set': // 設置指定數量
                    $new_quantity = max(1, $quantity); // 確保至少為1
                    break;
            }
            
            // 檢查庫存是否足夠
            if($new_quantity <= $current_inventory + $current_quantity) {
                $arr[$sy][1] = $new_quantity;
                $_SESSION["gwc"] = $arr;
            }
            
            mysqli_close($db_link);
            
        } catch (Exception $e) {
            echo "資料連結錯誤: " . $e->getMessage();
        }
    }
}

// 處理頁面重定向邏輯
$return_page = isset($_GET['page']) ? $_GET['page'] : 'homepage首頁';

// 構建查詢參數數組
$params = [];

// 添加產品ID (如果在產品詳情頁)
if($return_page == 'product_detail' && isset($_GET['product_id'])) {
    $params[] = "id=".$_GET['product_id'];
}

// 添加size參數
if(isset($_GET['size'])) {
    $params[] = "size=".urlencode($_GET['size']);
}

// 添加search參數
if(isset($_GET['search'])) {
    $params[] = "search=".urlencode($_GET['search']);
}

// 組合URL
$url = $return_page.".php";
if(count($params) > 0) {
    $url .= "?".implode("&", $params);
}

// 如果來自結帳確認頁面，使用特殊處理
if($return_page == 'checkout_confirm') {
    header("location:checkout_confirm.php");
    exit;
}

header("location:".$url);
exit;
?> 