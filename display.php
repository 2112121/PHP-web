<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '商品頁面';

// 為此頁面添加特殊樣式
$additionalStyles = '
			.glyphicon { margin-right:5px; }
			.thumbnail
			{
				margin-bottom: 20px;
				padding: 0px;
				-webkit-border-radius: 0px;
				-moz-border-radius: 0px;
				border-radius: 0px;
				height: 100%;
				box-shadow: 0 2px 5px rgba(0,0,0,0.1);
				transition: all 0.3s ease;
			}
			
			.thumbnail:hover {
				box-shadow: 0 5px 15px rgba(0,0,0,0.2);
				transform: translateY(-3px);
			}

			.item.list-group-item
			{
				float: none;
				width: 100%;
				background-color: #fff;
				margin-bottom: 10px;
			}
			.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
			{
				background: #428bca;
			}

			.item.list-group-item .list-group-image
			{
				margin-right: 10px;
			}
			.item.list-group-item .thumbnail
			{
				margin-bottom: 0px;
			}
			.item.list-group-item .caption
			{
				padding: 9px 9px 0px 9px;
			}
			.item.list-group-item:nth-of-type(odd)
			{
				background: #eeeeee;
			}

			.item.list-group-item:before, .item.list-group-item:after
			{
				display: table;
				content: " ";
			}

			.item.list-group-item img
			{
				float: left;
			}
			.item.list-group-item:after
			{
				clear: both;
			}
			.list-group-item-text
			{
				margin: 0 0 11px;
			}
			
			/* 修改圖片容器樣式，讓圖片完整顯示 */
			.product-img-container {
				width: 100%;
				height: 250px;
				overflow: hidden;
				position: relative;
				margin-bottom: 10px;
				background-color: #f9f9f9;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			
			.product-img-container img {
				max-width: 100%;
				max-height: 100%;
				object-fit: contain;
				display: block;
			}
			
			.item {
				margin-bottom: 20px;
				height: 470px;
			}
			
			/* 美化商品名稱 */
			.product-title {
				height: 48px;
				overflow: hidden;
				margin-bottom: 15px;
				font-weight: 600;
				font-size: 16px;
			}
			
			.product-title a {
				color: #333;
				text-decoration: none;
				transition: color 0.2s ease;
				display: -webkit-box;
				-webkit-line-clamp: 2;
				-webkit-box-orient: vertical;
				overflow: hidden;
				text-overflow: ellipsis;
			}
			
			.product-title a:hover {
				color: #4CAF50;
			}
			
			/* 美化價格顯示 */
			.product-price {
				font-weight: bold;
				font-size: 20px;
				color: #e74c3c;
				margin-bottom: 15px;
			}
			
			/* 美化加入購物車按鈕 */
			.btn-add-to-cart {
				background-color: #4CAF50;
				color: white;
				border: none;
				border-radius: 30px;
				padding: 8px 20px;
				font-size: 14px;
				transition: all 0.3s ease;
				text-transform: uppercase;
				width: 100%;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				letter-spacing: 0.5px;
				font-weight: 500;
				box-shadow: 0 2px 5px rgba(0,0,0,0.1);
			}
			
			.btn-add-to-cart:hover {
				background-color: #45a049;
				box-shadow: 0 4px 8px rgba(0,0,0,0.2);
				transform: translateY(-2px);
			}
			
			.btn-add-to-cart .glyphicon {
				margin-right: 5px;
			}
			
			.btn-out-of-stock {
				background-color: #e74c3c;
				opacity: 0.8;
				cursor: not-allowed;
			}
			
			.btn-out-of-stock:hover {
				background-color: #e74c3c;
				transform: none;
			}
';

// 引入頭部文件
require_once('header.php'); 

// 以下是display.php的主要內容
?>

<div class="container main-content">
    <div class="well well-sm">
        <strong>商品展示</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
			</div>
    <div id="products" class="row list-group">
				<?php 
    // 查詢資料庫中的產品列表
    $db_ip="127.0.0.1";
    $db_user="root";
    $db_pwd=""; // 密碼為空值
    
    try {
        $db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
        if(!$db_link) {
            throw new Exception("資料連結錯誤");
        }
        
        // 初始化SQL查詢
        $sql = "SELECT * FROM `product` WHERE 1=1";
        $where_clauses = [];
        
        // 根據搜索條件篩選產品
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $where_clauses[] = "(`Pname` LIKE '%" . mysqli_real_escape_string($db_link, $search) . "%' 
                            OR `specifications` LIKE '%" . mysqli_real_escape_string($db_link, $search) . "%' 
                            OR `Smell` LIKE '%" . mysqli_real_escape_string($db_link, $search) . "%'
                            OR `Ingredients` LIKE '%" . mysqli_real_escape_string($db_link, $search) . "%')";
            // 只在用戶從搜索框搜尋時顯示提醒
            echo "<div class='alert alert-info'>您正在搜尋: " . htmlspecialchars($search) . "</div>";
        }
        
        // 根據規格篩選產品
        if(isset($_GET['size']) && !empty($_GET['size'])) {
            $size = $_GET['size'];
            // 修正規格匹配邏輯，確保準確匹配
            // 使用正則表達式或更精確的條件匹配
            if ($size == '5ml') {
                // 精確匹配5ml規格，排除15ml
                $where_clauses[] = "(`specifications` LIKE '5ml %' OR `specifications` LIKE '% 5ml %' OR `specifications` LIKE '% 5ml' OR `specifications` = '5ml')";
            } elseif ($size == '15ml') {
                // 精確匹配15ml規格
                $where_clauses[] = "(`specifications` LIKE '15ml %' OR `specifications` LIKE '% 15ml %' OR `specifications` LIKE '% 15ml' OR `specifications` = '15ml')";
            } elseif ($size == '30ml') {
                // 精確匹配30ml規格
                $where_clauses[] = "(`specifications` LIKE '30ml %' OR `specifications` LIKE '% 30ml %' OR `specifications` LIKE '% 30ml' OR `specifications` = '30ml')";
            } else {
                // 其他情況使用一般匹配
                $where_clauses[] = "`specifications` LIKE '%" . mysqli_real_escape_string($db_link, $size) . "%'";
            }
            // 從下拉選單選擇規格時不顯示提醒
        }
        
        // 組合WHERE條件
        if(!empty($where_clauses)) {
            $sql .= " AND " . implode(" AND ", $where_clauses);
        }
        
        $result = mysqli_query($db_link, $sql);
        if(!$result) {
            throw new Exception("查詢失敗: " . mysqli_error($db_link));
        }
        
        $found = false;
        while($row = $result->fetch_row()) {
            $found = true;
            ?>
            <div class="item col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <a href="product_detail.php?id=<?php echo $row[0]; ?>">
                        <div class="product-img-container">
                            <img class="group list-group-image" src="<?php echo $row[7]; ?>" onerror="this.src='https://via.placeholder.com/400x250?text=商品圖片'" alt="<?php echo $row[1]; ?>" />
                        </div>
                    </a>
                    <div class="caption">
                        <h4 class="product-title">
                            <a href="product_detail.php?id=<?php echo $row[0]; ?>">
                                <?php echo $row[1]; ?>
                            </a>
                        </h4>
                        <div class="product-price">
                            NT$<?php echo $row[2]; ?>
                        </div>
                        <div class="text-center">
                            <?php
                            // 檢查庫存
                            if($row[3] > 0) {
                                // 保留尺寸參數在購物車連結中
                                $size_param = isset($_GET['size']) ? "&size=" . urlencode($_GET['size']) : "";
                                $search_param = isset($_GET['search']) ? "&search=" . urlencode($_GET['search']) : "";
                                echo '<a class="btn btn-add-to-cart" href="cart_add.php?ids=' . $row[0] . '&page=display' . $search_param . $size_param . '"><span class="glyphicon glyphicon-shopping-cart"></span> 加入購物車</a>';
                            } else {
                                echo '<button class="btn btn-add-to-cart btn-out-of-stock" disabled><span class="glyphicon glyphicon-remove"></span> 庫存不足</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        
        if(!$found) {
            echo '<div class="col-xs-12 text-center"><div class="alert alert-warning">沒有找到相關商品</div></div>';
        }
        
    } catch(Exception $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>
							</div>
						</div>
	
	<script>
				$(document).ready(function() {
    $('#list').click(function(event){
        event.preventDefault();
        $('#products .item').addClass('list-group-item');
    });
    $('#grid').click(function(event){
        event.preventDefault();
        $('#products .item').removeClass('list-group-item');
        $('#products .item').addClass('grid-group-item');
    });
		});
	</script>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>





