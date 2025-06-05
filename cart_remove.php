<?php
  // 啟動會話前先檢查是否已經啟動
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

 // 檢查是否請求清空購物車
 if(isset($_GET["clear"]) && $_GET["clear"] == 1) {
    // 將購物車中所有商品庫存還原
    if(isset($_SESSION["gwc"]) && is_array($_SESSION["gwc"])) {
      $db_ip="127.0.0.1";
      $db_user="root";
      $db_pwd=""; // 密碼為空值

      try {
          $db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
          if(!$db_link) {
              throw new Exception("資料連結錯誤");
          }
          
          // 遍歷購物車中的所有商品，將庫存還原
          foreach($_SESSION["gwc"] as $item) {
              $product_id = $item[0];
              $quantity = $item[1];
              
              // 查詢商品當前庫存
              $sql = "SELECT `inventory` FROM `product` WHERE `Psin`=".$product_id;
              $result = mysqli_query($db_link, $sql);
              $row = $result->fetch_row();
              $current_inventory = $row[0];
              
              // 更新庫存（增加購物車中的數量）
              $sql = "UPDATE `product` SET `inventory` = ".($current_inventory + $quantity)." WHERE `Psin`=".$product_id;
              mysqli_query($db_link, $sql);
          }
          
          mysqli_close($db_link);
      } catch (Exception $e) {
          echo "資料連結錯誤: " . $e->getMessage();
      }
    }
    
    // 清空購物車
    $_SESSION["gwc"] = array();
    
    // 重定向到來源頁面
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
    
    header("location:".$url);
    exit;
 } 

 // 移除單個商品的處理
 $sy = $_GET["sy"];
 $ids = $_GET["ids"];
 
 // 直接從購物車中移除該項商品，不論數量多少
 $arr = $_SESSION["gwc"];
 
 // 獲取要刪除的商品的數量，用於庫存恢復
 $quantity_to_restore = $arr[$sy][1];
 
 // 從購物車數組中移除該商品
 unset($arr[$sy]);
 // 重新索引數組
 $arr = array_values($arr);

 $_SESSION["gwc"] = $arr;
 
 // 更新商品庫存
 $db_ip="127.0.0.1";
 $db_user="root";
 $db_pwd=""; // 密碼為空

 try {
     $db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
     if(!$db_link) {
         throw new Exception("資料連結錯誤");
     }
     
     // 查詢當前庫存
     $sql = "SELECT `inventory` FROM `product` WHERE `Psin`=".$ids;
     $result = mysqli_query($db_link, $sql);
     $row = $result->fetch_row();
     $current_inventory = $row[0];
     
     // 更新庫存（增加購物車中的數量）
     $sql = "UPDATE `product` SET `inventory` = ".($current_inventory + $quantity_to_restore)." WHERE `Psin`=".$ids;
     mysqli_query($db_link, $sql);
     
     mysqli_close($db_link);
 } catch (Exception $e) {
     // 處理錯誤但不顯示給用戶
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

// 添加其他參數
if(isset($_GET['ooo'])) {
    $params[] = "ooo=1";
}

// 組合URL
$url = $return_page.".php";
if(count($params) > 0) {
    $url .= "?".implode("&", $params);
}

header("location:".$url);
exit;
?> 