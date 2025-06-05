		<?php
					$db_ip="127.0.0.1";
					$db_user="root";
$db_pwd="";

if(isset($_POST['reset'])) {
	if (session_status() == PHP_SESSION_NONE) {
						session_start();
	}
	
	if($_SESSION['password']==$_POST['password']) {
		if($_POST['newpassword']==$_POST['renewpassword']) {
								$_SESSION['password']=$_POST['newpassword'];
			
			try {
								$db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
				if(!$db_link) {
					throw new Exception("資料連結錯誤");
				}
				
								$sql="UPDATE `member` SET `password` = '".$_POST['newpassword']."' WHERE `member`.`name` = '".$_SESSION['name']."'";
								$result=mysqli_query($db_link, $sql);
				
				mysqli_close($db_link);
				echo'<script>alert("用戶密碼已修改完成");location.href="homepage首頁.php";</script>';
			} catch (Exception $e) {
				echo '<script>alert("資料連結錯誤: ' . $e->getMessage() . '");location.href="5修改密碼.php";</script>';
							}
		} else {
			echo'<script>alert("新密碼和新密碼確認不相同");location.href="5修改密碼.php";</script>';
						}
	} else {
		echo'<script>alert("密碼錯誤");location.href="5修改密碼.php";</script>';
					}
} else {
	// 處理登出或刪除用戶
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	if(isset($_GET['email'])) {
		// 刪除用戶
		try {
							$db_link=@mysqli_connect($db_ip,$db_user,$db_pwd,"database");
			if(!$db_link) {
				throw new Exception("資料連結錯誤");
			}
			
							$sql="DELETE FROM `member` WHERE `mail` = '".$_GET['email']."'";
							$result=mysqli_query($db_link, $sql);
			
			mysqli_close($db_link);
			
			session_destroy();
			echo'<script>alert("用戶已刪除");location.href="homepage首頁.php?out=1";</script>';
		} catch (Exception $e) {
			echo '<script>alert("資料連結錯誤: ' . $e->getMessage() . '");location.href="homepage首頁.php";</script>';
		}
	} else {
		// 簡單登出
		session_destroy();
		echo'<script>alert("用戶已登出");location.href="homepage首頁.php?out=1";</script>';
	}
}
?>



