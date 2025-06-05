<?php
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '結帳確認';

// 定義額外的樣式
$additionalStyles = '
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
}

.checkout-quantity .btn {
    width: 30px;
    height: 30px;
    padding: 0;
    border-radius: 50%;
    margin: 0 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f8f8;
    border: 1px solid #ddd;
}

.checkout-quantity .btn:hover {
    background-color: #e7e7e7;
}

.checkout-quantity span {
    min-width: 30px;
    text-align: center;
    font-size: 16px;
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

@media (max-width: 767px) {
    .checkout-table th,
    .checkout-table td {
        padding: 8px 4px;
    }
    
    .checkout-quantity .btn {
        width: 24px;
        height: 24px;
    }
    
    .checkout-quantity span {
        font-size: 14px;
    }
}

.checkout-delete-btn {
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
}

.checkout-delete-btn:hover {
    background-color: #f44336;
    border-color: #d32f2f;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 3px 6px rgba(0,0,0,0.5);
}

.checkout-delete-btn:hover:after {
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
';

// 引入頭部文件
require_once('header.php'); 
?>

<div class="container checkout-container">
    <div class="checkout-panel">
        <div class="checkout-header">
            <h3>結帳確認</h3>
        </div>
        <div class="checkout-body">
            <?php 
            // 顯示錯誤訊息
            if (isset($_GET['error']) || isset($_SESSION['checkout_error'])) {
                echo '<div class="alert alert-danger" role="alert">
                    <strong>錯誤：</strong> ';
                // 優先顯示session中的錯誤消息
                if (isset($_SESSION['checkout_error'])) {
                    echo $_SESSION['checkout_error'];
                    unset($_SESSION['checkout_error']);
                } else {
                    echo '結帳過程中發生錯誤，請稍後再試。';
                }
                echo '</div>';
            }
            ?>
            
            <div class="table-responsive">
                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th width="40%">品名</th>
                            <th width="20%">數量</th>
                            <th width="20%">單價</th>
                            <th width="20%">小計</th>
                            <th width="5%">刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $arr = $_SESSION["gwc"] ?? array();
                        $db_ip="127.0.0.1";
                        $db_user="root";
                        $db_pwd=""; // 修改密碼為空值
                        $sum = 0;
                        
                        try {
                            $db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
                            if(!$db_link) {
                                throw new Exception("資料連結錯誤");
                            }
                            
                            if(!empty($arr)) { // 確保購物車不為空時才執行以下操作
                                foreach($arr as $k=>$v) {
                                    $sql = "select * from `product` where `Psin`=".$v[0]."";
                                    $result=mysqli_query($db_link, $sql);
                                    $result = $db_link -> query($sql);
                                    $row = $result->fetch_row();
                                    $subtotal = $v[1] * $row[2];
                                    $sum += $subtotal;
                                
                                    echo"<tr>
                                        <td>".$row[1]."</td>
                                        <td>
                                            <div class='checkout-quantity'>
                                                <a href='cart_update.php?sy=".$k."&ids=".$row[0]."&action=dec&page=checkout_confirm' class='btn' title='減少數量'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </a>
                                                <span>".$v[1]."</span>
                                                <a href='cart_update.php?sy=".$k."&ids=".$row[0]."&action=inc&page=checkout_confirm' class='btn' title='增加數量'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>NT$".$row[2]."</td>
                                        <td>NT$".$subtotal."</td>
                                        <td width='5%'>
                                            <a href='cart_remove.php?sy=".$k."&page=checkout_confirm&ids=".$row[0]."' class='btn btn-danger checkout-delete-btn' title='刪除此商品'>
                                                <span class='glyphicon glyphicon-trash'></span>
                                            </a>
                                        </td>
                                    </tr>"; 
                                }
                            }
                            
                            mysqli_close($db_link);
                        } catch (Exception $e) {
                            echo "資料連結錯誤: " . $e->getMessage();
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            
            <div class="checkout-total">
                總計：NT$<?php echo $sum; ?>
            </div>
            
            <div class="alert alert-info" role="alert">
                <p>請確認您的訂單內容無誤後，點擊「確認購買」按鈕完成結帳。</p>
            </div>
            
            <div class="checkout-actions">
                <?php
                    $return_page = $_GET['returnpage'] ?? 'homepage首頁';
                    $search = isset($_GET['search']) ? "&search=".$_GET['search'] : "";
                    $size = isset($_GET['size']) ? "&size=".$_GET['size'] : "";
                ?>
                <a href="<?php echo $return_page.'.php'.$search.$size; ?>" class="btn btn-default">返回購物</a>
                <a href="<?php echo 'checkout_process.php?returnpage='.$return_page.$search.$size; ?>" class="btn btn-success">確認購買</a>
            </div>
        </div>
    </div>
</div>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?> 