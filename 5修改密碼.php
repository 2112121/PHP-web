<?php 
// 啟動會話前先檢查是否已經啟動
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 設置頁面標題
$pageTitle = '修改密碼';

// 添加響應式設計的額外樣式
$additionalStyles = '
/* 修改密碼頁面響應式設計 */
.password-form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.password-form {
    background-color: #f5f5f5;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.password-heading {
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}

.password-btn-container {
    margin-top: 20px;
    text-align: center;
}

.password-btn {
    margin: 5px;
    padding: 10px 30px;
    min-width: 120px;
}

@media (max-width: 768px) {
    .password-form {
        padding: 15px;
    }
    
    .password-form .form-group {
        margin-bottom: 15px;
    }
    
    .form-horizontal .control-label {
        text-align: left;
        margin-bottom: 5px;
    }
}

@media (max-width: 576px) {
    .password-btn {
        width: 100%;
        margin: 5px 0;
    }
    
    .password-form .input-group {
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
            <div class="password-form-container">
                <form class="password-form form-horizontal" action="4刪除登出.php" method="POST">
                    <h3 class="password-heading">修改帳戶密碼</h3>

                    <!-- 目前密碼輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="password">目前密碼</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" name="password" placeholder="請輸入目前密碼" class="form-control" type="password">
                            </div>
                        </div>
                    </div>

                    <!-- 新密碼輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="newpassword">新密碼</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="newpassword" name="newpassword" placeholder="請輸入新密碼" class="form-control" type="password">
                            </div>
                        </div>
                    </div>

                    <!-- 確認新密碼輸入 -->
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-md-4" for="renewpassword">確認新密碼</label>
                        <div class="col-sm-9 col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="renewpassword" name="renewpassword" placeholder="請再次輸入新密碼" class="form-control" type="password">
                            </div>
                        </div>
                    </div>

                    <!-- 按鈕區域 -->
                    <div class="form-group">
                        <div class="col-xs-12 password-btn-container">
                            <input type="submit" name="reset" class="btn btn-primary password-btn" value="確認修改">
                            <a href="homepage首頁.php" class="btn btn-default password-btn">返回首頁</a>
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






