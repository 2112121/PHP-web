<?php
  // 啟動會話前先檢查是否已經啟動
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
 //取到傳過來的主鍵值，並且添加到購物車的SESSION裏面
  $ids = $_GET["ids"];
  
  // 獲取商品數量，如果未指定則默認為1
  $quantity = isset($_GET["quantity"]) ? intval($_GET["quantity"]) : 1;
  // 確保數量至少為1
  $quantity = max(1, $quantity);
  
  //如果是第一次添加購物車,造一個二維數組存到SESSION裏面
  //如果不是第一次添加，有兩種情況
 //1.如果該商品購物車裏面不存在，造一個一維數組扔到二維裏面
 //2.如果該商品在購物車存在，讓數量累加
 
 if(empty($_SESSION["gwc"]))
 {
     //如果是第一次添加購物車,造一個二維數組存到SESSION裏面
     $arr = array(
         array($ids, $quantity)
    );
     
     $_SESSION["gwc"] = $arr;
}
 else
 {
     $arr = $_SESSION["gwc"];
     $bs = false; //是否出現
     foreach($arr as $v)
    {
       if($v[0]==$ids)
        {
             $bs = true;
        }
     }
     
     if($bs)
     {
        //2.如果該商品在購物車存在，讓數量累加
         foreach($arr as $k=>$v)
        {
            if($v[0] == $ids)
             {
                 $arr[$k][1] += $quantity;  // 累加指定數量
             }
         }
         $_SESSION["gwc"] = $arr;
        
    }
     else
     {
         //1.如果該商品購物車裏面不存在，造一個一維數組扔到二維裏面
         $attr = array($ids, $quantity);
         $arr[] = $attr;
        $_SESSION["gwc"] = $arr;
     }
 }

// 處理重定向
// 如果是從商品詳情頁來的，返回到該商品的詳情頁
if ($_GET['page'] == 'product_detail') {
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    header("location:product_detail.php?id=".$product_id."&added=1");
}
// 檢查page參數，如果是homepage則使用正確的檔案名稱
else if ($_GET['page'] == 'homepage') {
  if(isset($_GET['ooo']))
     header("location:homepage首頁.php?ooo=1&search=".($_GET['search'] ?? "")."");
  else
     header("location:homepage首頁.php?search=".($_GET['search'] ?? "")."");
}
// 處理其他頁面的重定向
else {
  // 構建查詢參數
  $params = [];
  if(isset($_GET['size'])) {
    $params[] = "size=".urlencode($_GET['size']);
  }
  if(isset($_GET['search'])) {
    $params[] = "search=".urlencode($_GET['search']);
  }
  
  // 組合URL
  $url = $_GET['page'].".php";
  if(count($params) > 0) {
    $url .= "?".implode("&", $params);
  }
  
  header("location:".$url);
}

// 移除庫存扣除的程式碼段落，使加入購物車時不影響庫存
?> 