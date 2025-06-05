<?php
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 接收返回頁面參數
$return_page = $_GET['returnpage'] ?? 'homepage首頁';
$search = isset($_GET['search']) ? "&search=".$_GET['search'] : "";

// 確認購物車有商品
if (!isset($_SESSION["gwc"]) || empty($_SESSION["gwc"])) {
    // 如果購物車為空，直接返回首頁
    header("Location: ".$return_page.".php".$search);
    exit;
}

// 數據庫連接
$db_ip = "127.0.0.1";
$db_user = "root";
$db_pwd = "";
$db_name = "database";

try {
    // 連接數據庫
    $db_link = @mysqli_connect($db_ip, $db_user, $db_pwd, $db_name);
    if (!$db_link) {
        throw new Exception("資料連結錯誤: " . mysqli_connect_error());
    }
    
    // 開始交易，確保庫存更新的一致性
    mysqli_begin_transaction($db_link);
    
    $success = true;
    $arr = $_SESSION["gwc"];
    
    // 處理每個購物車中的商品
    foreach ($arr as $k => $v) {
        $product_id = $v[0];
        $quantity = $v[1];
        
        // 查詢當前庫存
        $sql = "SELECT inventory FROM product WHERE Psin = ?";
        $stmt = mysqli_prepare($db_link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $current_inventory = $row['inventory'];
            
            // 確認庫存充足
            if ($current_inventory >= $quantity) {
                // 更新庫存
                $new_inventory = $current_inventory - $quantity;
                $update_sql = "UPDATE product SET inventory = ? WHERE Psin = ?";
                $update_stmt = mysqli_prepare($db_link, $update_sql);
                mysqli_stmt_bind_param($update_stmt, "ii", $new_inventory, $product_id);
                
                if (!mysqli_stmt_execute($update_stmt)) {
                    $success = false;
                    break;
                }
            } else {
                // 庫存不足
                $success = false;
                break;
            }
        } else {
            // 商品不存在
            $success = false;
            break;
        }
    }
    
    if ($success) {
        // 如果所有操作成功，提交事務
        mysqli_commit($db_link);
        
        // 清空購物車
        unset($_SESSION["gwc"]);
        
        // 添加成功訊息到session
        $_SESSION['checkout_success'] = true;
        
        // 跳轉到成功頁面
        header("Location: ".$return_page.".php?checkout_success=1".$search);
    } else {
        // 如果有任何問題，回滾事務
        mysqli_rollback($db_link);
        
        // 添加錯誤訊息到session
        $_SESSION['checkout_error'] = "結帳處理失敗，可能是庫存不足或商品不存在";
        
        // 跳轉到錯誤頁面
        header("Location: checkout_confirm.php?error=1&returnpage=".$return_page.$search);
    }
    
    // 關閉數據庫連接
    mysqli_close($db_link);
    
} catch (Exception $e) {
    // 處理異常
    $_SESSION['checkout_error'] = "結帳處理時發生錯誤: " . $e->getMessage();
    header("Location: checkout_confirm.php?error=1&returnpage=".$return_page.$search);
}
?> 