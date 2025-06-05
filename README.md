# 氣味圖書館網站使用說明

## 頁面導航欄和頁腳設置指南

為了確保網站風格一致性並簡化維護工作，我們使用了共用的header.php和footer.php元件文件。以下是如何在您的頁面中使用這些元件的指南：

### 使用共用元件的基本步驟

在您的PHP頁面中，使用以下結構：

```php
<?php 
// 設置頁面標題
$pageTitle = '您的頁面標題';

// 如果需要添加頁面特定的樣式
$additionalStyles = '
    /* 在這裡添加您的CSS樣式 */
    .your-css-class {
        property: value;
    }
';

// 如果需要添加頁面特定的JavaScript
$additionalHead = '
    <script>
        // 您的JavaScript代碼
        $(document).ready(function(){
            // ...
        });
    </script>
';

// 引入頭部文件
require_once('header.php'); 
?>

<!-- 您的頁面內容 -->
<div class="container">
    <!-- 頁面主要內容 -->
</div>

<?php 
// 引入頁腳文件
require_once('footer.php'); 
?>
```

### 重要變量

以下是您可以在引入header.php之前設置的變量：

1. `$pageTitle` - 設置頁面的標題
2. `$additionalStyles` - 添加頁面特定的CSS樣式
3. `$additionalHead` - 添加頁面特定的JavaScript或其他head元素

### 結帳成功訊息

如果需要顯示結帳成功訊息，您可以使用以下參數：

```php
// 通過URL參數
header("Location: homepage首頁.php?checkout_success=true");

// 或通過SESSION變量
$_SESSION['checkout_success'] = true;
header("Location: homepage首頁.php");
```

### 購物車功能

購物車功能完全整合在導航欄中，無需額外設置。確保在checkout_process.php中處理庫存扣減。

### 對現有頁面的修改

1. 移除所有頁面中的HTML頭部、導航欄和頁腳部分
2. 添加頁面標題和其他必要變量
3. 使用require_once引入header.php和footer.php

### 文件說明

- `header.php`: 包含網站頭部、導航欄及基本樣式
- `footer.php`: 包含網站頁腳

### 注意事項

- 確保所有頁面都使用共用元件
- 如果需要特定頁面的樣式或腳本，使用上述變量而非直接嵌入
- 在移動任何元素之前，確保了解其在導航結構中的作用

如有任何問題或需要添加新功能，請聯繫網站維護團隊。 