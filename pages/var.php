<?php
// ============================================================================
// GET
// 變數名稱格式：<query>_<GET 參數名稱]>_<自訂名稱> 
// 想要 GET 參數值，變數就下 query ...
// ============================================================================
$query_page = $_GET['page'];
$query_page_order   = 'order';
$query_page_product = 'product';
$query_page_customer = 'customer';
$query_page_add_customer = 'add_customer';
$query_page_doinsert = 'do_insert';

// ============================================================================
// URL
// 變數名稱格式：<url>_<路徑資料夾>_<自訂名稱>
// 想要 網址位置，變數就下 url ...
// ============================================================================
// 總覽
$url_page_summary   = 'index.php';
// 訂單
$url_page_order     = 'index.php?page=' . $query_page_order;
// 商品
$url_page_product   = 'index.php?page=' . $query_page_product;
// 顧客
$url_page_customer  = 'index.php?page=' . $query_page_customer;
$url_page_add_customer = 'index.php?page=' . $query_page_add_customer;
$url_page_doinsert = 'index.php?page=' . $query_page_doinsert;
// 登入
$url_page_signin    = 'index.php/pages/signin/signin.php';


// ============================================================================
// Page
// 變數名稱格式：<路徑資料夾>_<自訂名稱>
// 想要 實際資源路徑，變數就下 page ...
// ============================================================================
// 總覽
$page_summary   = 'pages/summary/summary.php';
// 訂單
$page_order     = 'pages/order/order.php';
// 商品
$page_product   = 'pages/product/product.php';
// 顧客
$page_customer  = 'pages/customer/user-list.php';
$page_add_customer = 'pages/customer/create-member.php';
$page_doinsert  = 'pages/customer/doinsert.php';
// 登入
$page_signin    = 'pages/signin/signin.php';

// ============================================================================
// Session
// 會話狀態
// ============================================================================
$session = $_SESSION;
