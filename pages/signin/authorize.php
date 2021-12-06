<?php
session_start();
include_once('../var.php');

$session = $_SESSION;


// 檢查登入狀態
if (!$session['status']) {
    header('Location: pages.html');
}
