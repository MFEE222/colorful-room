<?php
require_once("../../../components/pdo-connect.php");
// insert admin account to database
// require_once('../../../components/pdo-connect.php');

// $sql_stmt = "INSERT INTO admin(admin_id, admin_account, admin_password, admin_name)
//                 VALUES (':admin_id', :admin_account', ':admin_password', ':admin_name')";

// $pdo_stmt = $db_host->prepare($sql_stmt);

// try {
//     $admin_password = md5('admin1234');
//     $pdo_stmt->execute([
//         ':admin_id' => '1',
//         ':admin_account' => 'admin',
//         ':admin_passowrd' => $admin_password,
//         ':admin_name' => 'MFEE222'
//     ]);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

// 資料
session_start();
$authorize = [
    'auth_format_account' => filter_has_var(INPUT_POST, 'admin_account') && strlen(filter_input(INPUT_POST, 'admin_account')) > 0,
    'auth_format_password' => filter_has_var(INPUT_POST, 'admin_password') && strlen(filter_input(INPUT_POST, 'admin_password')) > 0,
    'account' => filter_input(INPUT_POST, 'admin_account'),
    'passowrd' => md5(filter_input(INPUT_POST, 'admin_password')),
    'remember_me' => filter_input(INPUT_POST, 'admin_remember_me'),
    'max_attempt_times' => 3,
    'error_message_account' => '帳號不能為空' . '<br>',
    'error_message_passowrd' => '密碼不能為空' . '<br>',
    'error_message_attempt' => '剩餘嘗試次數： ',
    'error_message_lock' => '已達嘗試次數上限，請稍後再試',
    'reset_time' => 10 * 60
];
$session = [
    'account' => NULL, // string
    'name' => NULL, // string
    'rest_attempt_times' => NULL, // int
    'last_signin' => NULL, // string
    'error_message' => NULL, // string
    'status' => NULL    // boolean
];

// 返回登入頁
function back_page_signin()
{
    header('Location: ../signin.php');
}
// 驗證登入資料
function authorize_signin_info()
{
    global $session, $authorize;
    $session = $_SESSION;
    if ($session['rest_attempt_times'] <= 0) {
        $session['error_message'] = $authorize['error_message_lock'];
        back_page_signin();
    }
    if (!$authorize['auth_format_account']) {
        $session['error_message'] = $authorize['error_message_account'];
        back_page_signin();
    }
    if (!$authorize['auth_format_password']) {
        $session['error_message'] = $authorize['error_message_password'];
        back_page_signin();
    }
    return $session['status'];
}

// 查找資料庫
function search_data()
{
    global $db_host, $authorize;
    $sql = "SELECT *
                    FROM admin
                WHERE admin_account = :account AND admin_password = :passowrd";
    $pdo = $db_host->prepare($sql);
    $data = NULL;

    try {
        $pdo->execute([
            ':account' => $authorize['account'],
            ':password' => $authorize['password']
        ]);
        if ($pdo->rowCount() <= 0) {
            return false;
        }
        $data = $pdo->fetch();
    } catch (PDOException $e) {
        $e->getMessage();
        return false;
    }

    return $data;
}



// 成功：寫入 SESSION (if remember_me is true, wirte in cookie)

// 失敗：返回 signin.php


if (authorize_signin_info()) {
    header('../../../index.php');
}
