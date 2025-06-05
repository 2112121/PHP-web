<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '會員註冊';

// 添加響應式設計的額外樣式
$additionalStyles = '
/* 註冊頁面響應式設計 */
.register-form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.register-form {
    background-color: #f5f5f5;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.register-heading {
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}

.register-btn-container {
    margin-top: 20px;
    text-align: center;
			}
			
.register-btn {
    margin: 5px;
    padding: 10px 30px;
    min-width: 120px;
}

@media (max-width: 768px) {
    .register-form {
        padding: 15px;
    }
    
    .register-form .form-group {
        margin-bottom: 15px;
    }
    
    .form-horizontal .control-label {
        text-align: left;
        margin-bottom: 5px;
    }
}

@media (max-width: 576px) {
    .register-btn {
        width: 100%;
        margin: 5px 0;
    }
    
    .register-form .input-group {
        width: 100%;
    }
}
';

// 引入頭部文件
require_once('header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="register-form-container">
                <form class="register-form form-horizontal" action="1會員登入.php" method="POST">
                    <h3 class="register-heading">會員註冊</h3>

                    <!-- 姓名輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="name">姓名</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="name" name="name" placeholder="請輸入姓名" class="form-control" type="text">
						 </div>
						</div>
					</div>
				
                    <!-- 電子郵件輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="mail">電子郵件</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="mail" name="mail" placeholder="請輸入電子郵件" class="form-control" type="email">
                            </div>
						</div>
					</div>

                    <!-- 密碼輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="password">密碼</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" name="password" placeholder="請輸入密碼" class="form-control" type="password">
		</div>
				</div>
			</div>

                    <!-- 確認密碼輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="repassword">確認密碼</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="repassword" name="repassword" placeholder="請再次輸入密碼" class="form-control" type="password">
				</div>
				</div>
			</div>

                    <!-- 按鈕區域 -->
                    <div class="form-group">
                        <div class="col-xs-12 register-btn-container">
                            <input type="submit" name="newregister" class="btn btn-primary register-btn" value="註冊">
                            <a href="1會員登入.php" class="btn btn-default register-btn">返回登入</a>
				</div>
			</div>
		</form>
		</div>
		  </div>
	  </div>
	  </div>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>





