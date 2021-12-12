<?php
require_once('../../components/pdo-connect.php');
include_once('../var.php');
include_once('../signin/do-authorize.php');

// ============================================================================
//  Reminder
// ============================================================================
//  1. customer and member table 要合併，並新增 registered 欄位
//  2. 暫時先只抓 member table
// ============================================================================
//  Global Variable / Function
// ============================================================================
$url_back = NULL;
$limit = NULL;
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

function like($condition, $fix = '%')
{
    return $fix . $condition . $fix;
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
//  Verify
// ============================================================================
if (post('keyword') == NULL && post('filter_time') == NULL && post('filter_status') == NULL) {
    $limit = 50;
}

// ============================================================================
//  Main
// ============================================================================
if ($limit != NULL) {
    $sql = "SELECT orders.*,
                   member.name,
                   member.phone
                FROM orders
                JOIN member ON orders.member_id = member.id
            LIMIT 50";
} else {
    $sql = "SELECT orders.*,
                   member.name,
                   member.phone
                FROM orders
                JOIN member ON orders.member_id = member.id
            WHERE orders.oid = :orders_id
                OR member.name LIKE :member_name
                OR member.phone LIKE :member_phone";
}
try {
    $pdo = $db_host->prepare($sql);
    if ($limit != NULL)
        $pdo->execute();
    else
        $pdo->execute([
            ':orders_id' => post('keyword'),
            ':member_name' => like(post('keyword')),
            ':member_phone' => like(post('keyword'))
        ]);

    if ($pdo->rowCount() > 0) {
        $rows = $pdo->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($rows);
        // meta data 
        $_SESSION['orders_head'] = [
            'total' => $pdo->rowCount()
        ];
        // data
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