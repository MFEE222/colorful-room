<!-- 上架頁面 -->
<?php

include_once("../var.php");
include_once("../signin/do-authorize.php");
?>

<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php";
?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>


<form action="./do-product-add.php" method="POST">
    <label for="fname">名稱:</label>
    <input type="text" name="product_name"><br>
    <label for="fname">價格:</label>
    <input type="text" name="product_price"><br>
    <label for="fname">描述:</label>
    <input type="text" name="descriptions"><br>
    <label for="fname">類別:</label>
    <input type="text" name="category_id"><br>

    <!-- 圖片上傳 -->
    <label for="img">修圖前:</label>
    <input type="file" id="img" name="image_before" accept="image/*">
    <label for="img">修圖後:</label>
    <input type="file" id="img" name="image_after" accept="image/*">
    <label for="img">DNG檔案:</label>
    <input type="file" id="img" name="dng_pkg" accept="image/*">

    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    
</form>

<a type="button" class="btn btn-lg btn-success" href="product.php">返回</a>

<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>