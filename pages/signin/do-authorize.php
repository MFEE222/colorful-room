<?php
session_start();
include_once('../var.php');


// 檢查登入狀態
if (!$_SESSION['status']) {
    header("Location: $page_singnin");
}