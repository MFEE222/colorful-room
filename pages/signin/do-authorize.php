<?php
include_once('../var.php');
session_start();
// 檢查登入狀態
if ($_SESSION['status'] === NULL || !$_SESSION['status']) {
    header("Location: $url_page_signin");
}
