<?php
require_once('../../components/pdo-connect.php');
include_once('../var.php');
include_once('../signin/do-authorize.php');

// ============================================================================
//  Global Variable / Function
// ============================================================================
$url_back = NULL;
$sql = NULL;
$pdo = NULL;
$row = NULL;


function redirect($url)
{
    header("Location: $url");
    die();
}

function post($name)
{
    if (isset($_POST[$name]) && !empty($_POST[$name]))
        return $_POST[$name];
    return $_POST[$name] = NULL;
}
// ============================================================================
//  Initialize
// ============================================================================
$url_back = $url_page_order_search
    . '?keyword=' . post('keyword')
    . '&filter_time=' . post('filter_time')
    . '&filter_status=' . post('filter_status');
$_SESSION['orders_head'] = NULL;
$_SESSION['orders_body'] = NULL;
// ============================================================================
//  Main
// ============================================================================
$sql = "SELECT orders.*, member.*, customer.*
            FROM orders
            JOIN member ON orders.member_id = member.id
            JOIN customer ON orders.customer_id = customer.id
        WHERE orders.oid = :order_id
            OR member.name LIKE :member_name
            OR member.phone LIKE :member_phone
            OR customer.name LIKE :customer_name
            OR customer.phone LIKE :customer_phone";
try {
    $pdo = $db_host->prepare($sql);
    $pdo->execute([
        ':order_id' => post('keyword'),
        ':member_name' => post('keyword'),
        ':member_phone' => post('keyword'),
        ':customer_name' => post('keyword'),
        ':customer_phone' => post('keyword')
    ]);
    if ($pdo->rowCount() > 0) {
        // 此處可嘗試改成 fecth 過濾掉一些資料再存入 Session 減少記憶體空間 
        $rows = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['orders_head'] = [
            'total' => $pdo->rowCount(),
        ];
        $_SESSION['orders_body'] = $rows;
        redirect($url_back);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
// ============================================================================
// Test
// ============================================================================
// echo $url_page_orders_search . '<br>';
// echo post('keyword') . '<br>';
// echo post('filter_time') . '<br>';
// echo post('filter_status') . '<br>';
// ============================================================================
// Doing
// ============================================================================
// 限制檔案抓取數量 Limit

// ============================================================================
// Flow
// ============================================================================
// 檢查 POST 參數
// 組合 SQL 語法
// 資料庫抓取資料
// 成功 or 失敗都存入 SESSION


// ============================================================================
// Database
// ============================================================================