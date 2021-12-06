<?php
// GET 的值：query 開頭的都是 GET 值
// 格式：<query>_<GET 參數名稱]>_<自訂名稱> 
$query_page = $_GET['page'];
$query_page_order   = 'order';
$query_page_product = 'product';
$query_page_customer = 'customer';
$query_page_add_customer = 'add_customer';
$query_page_doinsert = 'do_insert';

// URL 網址：url 開頭的都是 網址位置
// 格式：<url>_<路徑資料夾>_<自訂名稱>
// <a href= ""> 
$url_page_summary   = 'index.php';
$url_page_order     = 'index.php?page=' . $query_page_order;
$url_page_product   = 'index.php?page=' . $query_page_product;
$url_page_customer  = 'index.php?page=' . $query_page_customer;
$url_page_add_customer = 'index.php?page=' . $query_page_add_customer;
$url_page_signin    = 'index.php/pages/signin/signin.php';
$url_page_doinsert = 'index.php?page=' . $query_page_doinsert;

// Page 開頭的都是實際檔案位置 
// 格式：<路徑資料夾>_<自訂名稱>
$page_summary   = 'pages/summary/summary.php';
$page_order     = 'pages/order/order.php';
$page_product   = 'pages/product/product.php';
$page_customer  = 'pages/customer/user-list.php';
$page_add_customer = 'pages/customer/create-member.php';
$page_signin    = 'pages/signin/signin.php';
$page_doinsert = 'pages/customer/doinsert.php';
