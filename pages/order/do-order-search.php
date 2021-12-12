<?php
require_once('../../components/pdo-connect.php');
include_once('../var.php');
include_once('../signin/do-authorize.php');

redirect($url_page_order_search . "?order_search_keyword=" . post('order_search_keyword') . "&order_search_filter_time=" . post('order_search_filter_time') . "&order_search_filter_status=" . post('order_search_filter_status'));
// redirect($url_page_order_search . "?order_search_keyword=" . post('order_search_keyword') . "&order_search_filter_time=" . post('order_search_filter_time') . "&order_search_filter_status=" . post('order_search_filter_status'));
// ============================================================================
//  Test
// ============================================================================
// echo post('order_search_keyword') . '<br>';
// echo post('order_search_filter_time') . '<br>';
// echo post('order_search_filter_status') . '<br>';
// ============================================================================
//  Doing
// ============================================================================
// 限制檔案抓取數量 Limit

// ============================================================================
//  Flow
// ============================================================================
//  檢查 POST 參數
//  組合 SQL 語法
//  資料庫抓取資料
//  成功 or 失敗都存入 SESSION
// ============================================================================
//  Global Variable / Function
// ============================================================================
// 設定值
$settings = [
    'error_not_data' => '沒有相關資料'
];
// 儲存訂單資訊的資訊
$orders_head = [
    'error' => NULL,
    'count' => NULL
];
// 儲存訂單資訊
$orders_body = NULL;
// 資料庫
$sql = NULL;
$pdo = NULL;

function post($name)
{
    if (isset($_POST[$name]) && !empty($_POST[$name]))
        return $_POST[$name];
    return $_POST[$name] = NULL;
}
function redirect($url)
{
    header("Location: $url");
    die();
}
// ============================================================================
//  Initialize
// ============================================================================

// ============================================================================
//  Verify
// ============================================================================

// ============================================================================
//  Database
// ============================================================================

$sql = "SELECT order.* member.* customer.*
            FROM order
            JOIN member ON order.user_id = member.id
            JOIN customer ON order.user_id = customer.id
        WHERE order.order_id LIKE %keyword%
            OR order.order_created_at LIKE ...
            OR order.order_status = $status";

redirect($url_page_order_search . "?order_search_keyword=" . post('order_search_keyword') . "&order_search_filter_time=" . post('order_search_filter_time') . "&order_search_filter_status=" . post('order_search_filter_status'));
