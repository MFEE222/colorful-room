<?php
require_once('../../components/pdo-connect.php');
include '../var.php';
session_start();
// 檢查 SESSION 參數
//      超過限制：返回登入頁（錯誤訊息）
// 檢查 POST 參數
//      格式錯誤：返回登入頁（錯誤訊息）

// 比對資料庫
//      內容錯誤：返回登入頁（錯誤訊息）
//      內容正確：寫入 SESSION, COOKIE

// 導向後台頁面
// ============================================================================
//  Doing
// ============================================================================
//  1. 增加 Cookie 紀錄使用者 Remeber 功能
//  2. 增加 密碼提示
//  3. 增加 
// ============================================================================
//  Test Area
// ============================================================================
// $_SESSION['status'] = '';
// unset($_SESSION['status']);
// var_dump($_SESSION['status'] === NULL); // true , not defined
// var_dump(empty($_SESSION['status']));   // true , not defined or defined but empty
// var_dump(isset($_SESSION['status']));    // false, not defined
// var_dump(time()); // int, time stamp
// $a = $b = 2; var_dump($a); var_dump($b);
// $c = 123; echo '123' . $c;

// var_dump(filter_has_var(INPUT_POST, 'admin_account'));
// var_dump(isset($_POST['admin_account']));
// var_dump(filter_input(INPUT_POST, 'admin_account'));
// var_dump($_POST['admin_account']);
// var_dump(empty($_POST['admin_account']));
// var_dump($_POST['admin_account'] === '');
// echo $_POST['admin_account'];
// ============================================================================
//  Global Variable / Function
// ============================================================================
$setting = [
    'max_attempt_times' => 3,
    'error_empty_account' => '帳號不能為空<br>',
    'error_empty_password' => '密碼不能為空<br>',
    'error_rest_times' => '剩餘嘗試次數：',
    'error_reach_limit' => '已達嘗試次數上限，請稍後再試',
    'reset_attempt_time' => 10
];

// $session = [
//     'account' => NULL,
//     'name'    => NULL,
//     'attempt_times' => NULL,
//     'last_time' => NULL,
//     'error' => NULL,
//     'status' => NULL
// ];

// $post = [
//     'account' => NULL,
//     'password' => NULL,
//     'remember' => NULL
// ];

$sql = NULL;
$pdo = NULL;
$data = NULL;

function redirect($url)
{
    header("Location:$url");
    die();
}
// ============================================================================
//  Initialize
// ============================================================================
if ($_SESSION['attempt_times'] === NULL) {
    $_SESSION['attempt_times'] = 0;
}
if (time() - $_SESSION['last_time'] > $setting['reset_attempt_time']) {
    $_SESSION['attempt_times'] = 0;
}

$_SESSION['attempt_times']++;
$_SESSION['last_time'] = time();
$_SESSION['error'] = '';
$_SESSION['status'] = false;

// $_POST['admin_account'];
// $_POST['admin_password'];
// $_POST['admin_remember_me'];
echo 'init<br>';
// ============================================================================
//  Verify Session
// ============================================================================
$rest_times = $setting['max_attempt_times'] - $_SESSION['attempt_times'];
if ($rest_times <= 0) {
    $_SESSION['error'] = $setting['error_reach_limit'];
    // echo __LINE__ . '<br>';
    redirect($url_page_signin);
}
echo 'verify session<br>';
// ============================================================================
//  Verify Post
// ============================================================================
if (empty($_POST['admin_account'])) {
    $_SESSION['error'] .= $setting['error_empty_account'];
    $_SESSION['error'] .= $setting['error_rest_times'] . $rest_times;
    // echo __LINE__ . '<br>';
    redirect($url_page_signin);
}
if (empty($_POST['admin_password'])) {
    $_SESSION['error'] .= $setting['error_empty_password'];
    $_SESSION['error'] .= $setting['error_rest_times'] . $rest_times;
    // echo __LINE__ . '<br>';
    redirect($url_page_signin);
}
echo 'verify post<br>';
// ============================================================================
//  Database
// ============================================================================
$sql = "SELECT *
            FROM admin
        WHERE admin_account = :acc AND admin_password = :pass AND admin_valid = 1";

try {
    $pdo = $db_host->prepare($sql);
    $pdo->execute([
        ':acc' => $_POST['admin_account'],
        ':pass' => $_POST['admin_password']
    ]);
    if ($pdo->rowCount() > 0) {
        $data = $pdo->fetch();
        $_SESSION['account'] = $data['admin_account'];
        $_SESSION['name'] = $data['admin_name'];
        $_SESSION['status'] = true;
        // echo __LINE__ . '<br>';
        redirect($url_page_index);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
echo 'database<br>';
