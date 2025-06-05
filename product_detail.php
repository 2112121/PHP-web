<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題（稍後會根據商品名稱動態更新）
$pageTitle = '商品詳情';

// 為此頁面添加特殊樣式
$additionalStyles = '
.product-image {
    max-height: 500px;
    width: auto;
    margin: 0 auto;
    display: block;
}

.product-details {
    margin-top: 20px;
    padding: 20px;
    border-radius: 5px;
}

.product-price {
    font-size: 24px;
    color: #e74c3c;
    font-weight: bold;
    margin: 15px 0;
}

.product-title {
    font-size: 24px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.product-specs {
    margin: 20px 0;
}

.product-specs-label {
    font-weight: bold;
    margin-bottom: 5px;
}

.product-spec-item {
    display: flex;
    margin-bottom: 10px;
}

.product-spec-name {
    width: 50px;
    font-weight: bold;
}

.product-spec-value {
    flex: 1;
}

.product-description {
    margin: 20px 0;
    line-height: 1.6;
}

.inventory-status {
    margin: 10px 0;
    font-weight: 500;
}

.in-stock {
    color: #27ae60;
}

.out-of-stock {
    color: #e74c3c;
}

.quantity-selector {
    display: flex;
    align-items: center;
    margin: 15px 0;
}

.quantity-selector button {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: #fff;
    font-size: 16px;
    font-weight: bold;
}

.quantity-selector input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 1px solid #ddd;
    margin: 0 5px;
}

.add-to-cart {
    margin-top: 20px;
}

.btn-add-to-cart {
    padding: 10px 30px;
    font-size: 16px;
}

.back-link {
    margin-top: 20px;
    display: inline-block;
}

@media (max-width: 768px) {
    .product-image {
        max-height: 350px;
    }
    .product-title {
        font-size: 20px;
    }
}
';

// 引入頭部文件
require_once('header.php');

// 顯示加入購物車成功提示
if (isset($_GET['added']) && $_GET['added'] == 1) {
    echo '<div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>成功!</strong> 商品已成功加入購物車。
                </div>
            </div>
        </div>
    </div>';
}

// 獲取商品ID
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 如果沒有指定商品ID，重定向到商品列表頁面
if ($product_id <= 0) {
    echo '<script>window.location.href = "display.php";</script>';
    exit;
}

// 從資料庫獲取商品信息
$db_ip = "127.0.0.1";
$db_user = "root";
$db_pwd = ""; // 密碼為空值
$product = null;

try {
    $db_link = @mysqli_connect($db_ip, $db_user, $db_pwd, "database");
    if (!$db_link) {
        throw new Exception("資料連結錯誤");
    }
    
    // 使用參數化查詢，防止SQL注入
    $stmt = $db_link->prepare("SELECT * FROM `product` WHERE `Psin` = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        $product = $row;
        // 更新頁面標題
        $pageTitle = $product['Pname'] . ' - 商品詳情';
    } else {
        throw new Exception("找不到指定的商品");
    }
} catch (Exception $e) {
    echo '<div class="container mt-4">
            <div class="alert alert-danger">' . $e->getMessage() . '</div>
            <a href="display.php" class="btn btn-primary">返回商品列表</a>
         </div>';
    require_once('footer.php');
    exit;
}
?>

<div class="container">
    <!-- 返回按鈕 -->
    <div class="row mt-4">
        <div class="col-xs-12">
            <a href="javascript:history.back();" class="back-link">
                <span class="glyphicon glyphicon-chevron-left"></span> 返回上一頁
            </a>
        </div>
    </div>

    <?php if ($product): ?>
    <div class="row">
        <!-- 商品圖片 -->
        <div class="col-md-6">
            <div class="product-image-container">
                <img src="<?php echo $product['pic']; ?>" onerror="this.src='https://via.placeholder.com/500x500?text=商品圖片'" class="product-image img-responsive" alt="<?php echo $product['Pname']; ?>">
            </div>
        </div>
        
        <!-- 商品信息 -->
        <div class="col-md-6">
            <div class="product-details">
                <h1 class="product-title"><?php echo $product['Pname']; ?></h1>
                
                <div class="product-price">
                    NT$<?php echo $product['price']; ?>
                </div>
                
                <!-- 庫存狀態 -->
                <div class="inventory-status">
                    <?php if ($product['inventory'] > 0): ?>
                        <span class="in-stock"><span class="glyphicon glyphicon-ok-circle"></span> 有庫存 (<?php echo $product['inventory']; ?>)</span>
                    <?php else: ?>
                        <span class="out-of-stock"><span class="glyphicon glyphicon-remove-circle"></span> 無庫存</span>
                    <?php endif; ?>
                </div>
                
                <!-- 規格信息 -->
                <div class="product-specs">
                    <div class="product-specs-label">商品規格：</div>
                    <div class="product-spec-item">
                        <div class="product-spec-name">規格：</div>
                        <div class="product-spec-value"><?php echo $product['specifications']; ?></div>
                    </div>
                    <div class="product-spec-item">
                        <div class="product-spec-name">成分：</div>
                        <div class="product-spec-value"><?php echo $product['Ingredients']; ?></div>
                    </div>
                </div>
                
                <!-- 商品描述 -->
                <div class="product-description">
                    <div class="product-specs-label">嗅點描述：</div>
                    <p><?php echo nl2br($product['Smell']); ?></p>
                </div>
                
                <!-- 加入購物車 -->
                <?php if ($product['inventory'] > 0): ?>
                    <form action="cart_add.php" method="GET" class="add-to-cart">
                        <input type="hidden" name="ids" value="<?php echo $product['Psin']; ?>">
                        <input type="hidden" name="page" value="product_detail">
                        <input type="hidden" name="id" value="<?php echo $product['Psin']; ?>">
                        
                        <div class="quantity-selector">
                            <button type="button" class="quantity-decrease" onclick="decreaseQuantity()">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $product['inventory']; ?>">
                            <button type="button" class="quantity-increase" onclick="increaseQuantity()">+</button>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-add-to-cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span> 加入購物車
                        </button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-danger disabled btn-add-to-cart">
                        <span class="glyphicon glyphicon-remove"></span> 庫存不足
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// 數量增減功能
function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentValue = parseInt(quantityInput.value);
    var maxValue = parseInt(quantityInput.getAttribute('max'));
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
}
</script>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?> 