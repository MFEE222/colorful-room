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


<!-- As a heading -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">商品上架</span>
  </div>
</nav>

<form action="./do-product-add.php" method="POST">
    <div class="m-5">
    <label class="mb-5" for="fname">名稱：</label>
    <input type="text" name="product_name">
    <label class="mb-5" for="fname">價格：</label>
    <input type="text" name="product_price">
    <label class="mb-5" for="fname">自動上架時間：</label>
    <input type="datetime-local" name="auto_create_date"><br>
    <label class="mb-5" for="fname">描述：</label>
    <input type="text" name="descriptions">
    <label class="mb-5" for="fname">類別：</label>
    <input type="text" name="category_id">
    <label for="fname">自動下架時間：</label>
    <input type="datetime-local" name="auto_delete_date"><br>

    <!-- 圖片上傳 -->
    <label class="mb-5" for="img">修圖前：</label>
    <input type="file" id="img" name="image_before" accept="image/*">
    <label class="mb-5" for="img">修圖後：</label>
    <input type="file" id="img" name="image_after" accept="image/*">
    <label class="mb-5" for="img">DNG檔案：</label>
    <input type="file" id="img" name="dng_pkg" accept="image/*"><br>

    

    <button type="submit" class="btn btn-lg btn-primary text-center">Submit</button>
    <a type="button" class="btn btn-lg btn-success" href="product.php">返回</a>
    </div>
</form>



<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>