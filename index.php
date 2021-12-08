<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!-- 
    1. require_once 
    2. set GET/POST, get GET/POST
 -->
<?php
require_once("components/pdo-connect.php");
include_once("pages/var.php");
?>

<!-- html head 標籤 -->
<?php include "template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "template/body-aside.php"; ?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->


<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "template/body-corner.php" ?>