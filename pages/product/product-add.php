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
    <label for="fname">Product Name:</label>
    <input type="text" name="product_name"><br>
    <label for="fname">Product Price:</label>
    <input type="text" name="product_price"><br>
    <label for="fname">Descriptions</label>
    <input type="text" name="descriptions"><br>
    <label for="fname">Category</label>
    <input type="text" name="category_id"><br>

    <!-- 人像1 -->
    <label for="img">image_before:</label>
    <input type="file" id="img" name="image_before" accept="image/*">
    <label for="img">image_after:</label>
    <input type="file" id="img" name="image_after" accept="image/*">
    <label for="img">dng_pkg:</label>
    <input type="file" id="img" name="dng_pkg" accept="image/*">



    <button type="submit">Submit</button>
</form>

<script src="../../assets/js/core/bootstrap.bundle.min.js"></script>

<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>