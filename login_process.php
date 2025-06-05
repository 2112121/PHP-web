<html>
	<head></head>
	<body>
		<?php
			
			if(isset($_POST['login']))
			{
				// 啟動會話前先檢查是否已經啟動
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				$db_ip="127.0.0.1";
				$db_user="root";
				$db_pwd=""; // 修改密碼為空值
				
				try {
					$db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
					if(!$db_link) {
						throw new Exception("資料連結錯誤");
					}
					
					$sql="SELECT * FROM `member` WHERE mail='".$_POST["mail"]."' and password='".$_POST["password"]."'";
					$result=mysqli_query($db_link, $sql);
					$row = $result->fetch_assoc();
					if($row==null)
						echo'<script>alert("電子郵件或密碼錯誤或該電子郵件從未註冊!");location.href="1會員登入.php";</script>';
					else
					{
						$_SESSION['name']=$row['name'];
						$_SESSION['password']=$row['password'];
						$_SESSION['mail']=$row['mail'];
						$_SESSION['address']=$row['address'];
						$_SESSION['phone']=$row['phone'];
						$_SESSION['birthday']=$row['birthday'];
						echo'<script>alert("登入成功!");location.href="homepage首頁.php";</script>';
					}
					
					mysqli_close($db_link); // 修正為mysqli_close
				} catch (Exception $e) {
					echo '<script>alert("資料連結錯誤: ' . $e->getMessage() . '");location.href="1會員登入.php";</script>';
				}
			}
			else if(isset($_POST['register']))
				echo'<script>location.href="3註冊頁面.php";</script>';
		?>
	
	</body>
</html> 