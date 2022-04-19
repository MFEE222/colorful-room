<?php
require_once('../../components/pdo-connect.php');
include_once('../var.php');
include_once('../signin/do-authorize.php');

// ============================================================================
//  Test
// ============================================================================
// redirect($url_page_order_search
//     . '?keyword=' . post('keyword')
//     . '&filter_time=' . post('filter_time')
//     . '&filter_status=' . post('filter_status'));

// ============================================================================
//  Reminder
// ============================================================================
//  1. customer and member table 要合併，並新增 registered 欄位
//  2. 暫時先只抓 member table
// ============================================================================
//  Test
// ============================================================================
// if (!NULL) {
//     echo 'rrr';
// }
// ============================================================================
//  Global Variable / Function
// ============================================================================
$url_back = NULL;
$sql = [
    'prepare' => NULL,
    'execute' => [],
    'is_keyword' => false,
    'is_filter_time' => false,
    'is_filter_status' => false,
    'is_limit' => false,
    'keyword' => NULL,
    'filter_time' => NULL,
    'filter_status' => NULL,
    'limit' => NULL
];
$pdo = NULL;
$row = NULL;


function redirect($url)
{
    header("Location: $url");
    die();
}

function post($name)
{
    if (isset($_POST[$name]))
        return $_POST[$name];
    return $_POST[$name] = NULL;
}

function like($condition, $fix = '%')
{
    return $fix . $condition . $fix;
}

function where(&$sql, $condition, $operator = 'AND')
{
    if (str_contains($sql, 'WHERE')) {
        $sql .= " " . $operator . " " . "(" . $condition . ")";
    } else {
        $sql .= " " . "WHERE" . " " . "(" . $condition . ")";
    }
}

function ecbo($l)
{
    echo 'BreakPoint: ' . $l . '<br>';
}
// ============================================================================
//  Initialize
// ============================================================================
$url_back = $url_page_order_search
    . '?keyword=' . post('keyword')
    . '&filter_time=' . post('filter_time')
    . '&filter_status=' . post('filter_status');
$_SESSION['orders_head'] = [
    'total' => 0
];
$_SESSION['orders_body'] = NULL;
// 處理空格？多關鍵字？
if (post('keyword') != NULL) {
    $sql['is_keyword'] = true;
    $sql['keyword'] = '%' . post('keyword') . '%';
}
if (post('filter_time') != NULL && post('filter_time') != 0) {
    $sql['is_filter_time'] = true;
    $sql['filter_time'] = post('filter_time');
}
if (post('filter_status') != NULL && post('filter_status') != 0) {
    $sql['is_filter_status'] = true;
    $sql['filter_status'] = post('filter_status');
}
if (!post('keyword') && !post('filter_time') && !post('filter_status')) {
    $sql['is_limit'] = true;
    $sql['limit'] = 50;
}
// ============================================================================
//  Main
// ============================================================================
// $sql['prepare'] = "SELECT orders.*,
//                           member.name,
//                           member.phone,
//                           orders_status.description AS status_desc
//                         FROM orders
//                         JOIN member ON orders.member_id = member.id
//                         JOIN orders_status ON orders.status = orders_status.id";

$sql['prepare'] = "SELECT orders.*,
                          member.name AS member_name,
                          member.phone AS member_phone
                        FROM orders
                        JOIN member ON orders.member_id = member.id";

if ($sql['is_keyword']) {
    where($sql['prepare'], "orders.id = :orders_id OR member.name LIKE :member_name OR member.phone LIKE :member_phone");
    $sql['execute'] += [
        // ':orders_id' => $sql['keyword'],
        ':orders_id' => post('keyword'),
        ':member_name' => $sql['keyword'],
        ':member_phone' => $sql['keyword']
        // ':member_phone' => '%' . $sql['keyword'] . '%'
    ];
}

if ($sql['is_filter_time']) {
}
if ($sql['is_filter_status']) {
    where($sql['prepare'], "orders.status = :orders_status_id");
    $sql['execute'] += [
        ':orders_status_id' => $sql['filter_status']
    ];
}
if ($sql['is_limit']) {
    $sql['prepare'] .= " LIMIT " . $sql['limit'];
}


try {
    $pdo = $db_host->prepare($sql['prepare']);
    $pdo->execute($sql['execute']);

    var_dump($pdo->rowCount());
    if ($pdo->rowCount() > 0) {
        // $rows = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $rows = $pdo->fetchAll();

        $_SESSION['orders_head'] = [
            'total' => $pdo->rowCount()
        ];
        $_SESSION['orders_body'] = $rows;
        // var_dump($_SESSION['orders_head']);
        // echo '<br><br>';
        // var_dump($_SESSION['orders_body']);
        // redirect($url_back);
    }

    redirect($url_back);
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