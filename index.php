<?php
//目前測試絕對路徑無法
require_once("components/pdo-connect.php");
include_once("pages/var.php");
?>
<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "template/body-aside.php"; ?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div>

</div>
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "template/body-corner.php" ?>