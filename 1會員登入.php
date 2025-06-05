<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '會員登入';

// 添加響應式設計的額外樣式
$additionalStyles = '
/* 登入頁面響應式設計 */
.login-form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
}

.login-form {
    background-color: #f5f5f5;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.login-heading {
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}

.login-btn-container {
    margin-top: 20px;
    text-align: center;
					}

.login-btn {
    margin: 5px;
    padding: 10px 30px;
}

@media (max-width: 576px) {
    .login-form {
        padding: 15px;
    }
    
    .login-form .form-group {
        margin-bottom: 15px;
					}
    
    .login-btn {
        width: 100%;
        margin: 5px 0;
        padding: 8px;
    }
}
';

// 引入頭部文件
require_once('header.php'); 
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
			<div class="login-form-container">
				<form class="login-form" method="POST" action="login_process.php" id="contact_form">
					<h3 class="login-heading">會員登入</h3>
					
					<!-- 電子郵件輸入 -->
					<div class="form-group">
						<label for="mail">電子郵件</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input id="mail" name="mail" placeholder="請輸入您的Email" class="form-control" type="email">
						</div>
					</div>
				
					<!-- 密碼輸入 -->
					<div class="form-group">
						<label for="password">密碼</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" name="password" placeholder="請輸入您的密碼" class="form-control" type="password">
						</div>
					</div>
					
					<!-- 按鈕區域 -->
					<div class="login-btn-container">
						<input type="submit" value="登入" name="login" class="btn btn-primary login-btn">
						<input type="submit" value="註冊" name="register" class="btn btn-default login-btn">
					</div>
				</form>
			</div>
		</div>
				</div>
			</div>

		<?php
// 保留原始註冊處理邏輯
			if(isset($_POST['newregister']))
			{
				if($_POST['password']==$_POST['repassword'])
				{
					if($_POST['name']!=null && $_POST['mail']!=null)
					{
						$db_ip="127.0.0.1";
						$db_user="root";
			$db_pwd=""; // 修改密碼為空值
						echo'<script>alert("註冊成功請重新登入");</script>';
			
			try {
						$db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
				if(!$db_link) {
					throw new Exception("資料連結錯誤");
				}
						$sql2="SELECT Count(`number`) FROM `member`";
						$result2=mysqli_query($db_link, $sql2);
						$row2 = $result2->fetch_assoc();
						$a=$row2['Count(`number`)']+1;
				$sql="INSERT INTO `member` (`number`, `name`, `mail`, `password`) VALUES ('".$a."', '".$_POST['name']."', '".$_POST['mail']."', md5('".$_POST['password']."'))";
						$result=mysqli_query($db_link, $sql);
				echo'<script>alert("註冊成功請重新登入");</script>';
			} catch (Exception $e) {
				echo "資料連結錯誤: " . $e->getMessage();
			}
		}
		else
		{
			echo'<script>alert("資料不完全請重新輸入");</script>';
					}
				}
				else
	{
		echo'<script>alert("兩次密碼不一致請重新輸入");</script>';
	}
}
?>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>






