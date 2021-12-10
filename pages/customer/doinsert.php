<?php
require_once("../../components/pdo-connect.php");
//新增
include_once("../var.php");
include_once("../signin/do-authorize.php");

// function redirect($url)
// {
//     header("Location:$url");
//     // exit;
//     die();
// }
//
$rowsMemebr = NULL;
//if(!isset($_GET["id"])){
//    echo "您不是從正常程序進入此頁";
//    exit();
//}
$name = $_POST["name"];
$account = $_POST["account"];
$password = $_POST["password"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
$subscribe = $_POST["subscribe"];
$tag_id = $_POST["tag"];
//echo"$name,$account,$password,$email,$phone,$gender,$birthday,$subscribe";

$sqlCheck = "SELECT * FROM member WHERE account=? AND email=? ";
$stmt = $db_host->prepare($sqlCheck);
try {
    $stmt->execute([$account, $email]);
    $memberExist = $stmt->rowCount();
    if ($memberExist > 0) {
        //        echo "帳號已存在";
        $row = $stmt->fetch();
        $user = [
            "id" => $row["id"],
            "account" => $row["account"],
            "name" => $row["name"],
            "email" => $row["email"]
        ];
        $_SESSION["user"] = $user;
        header("location:create-member.php");
        // redirect('create-member.php');
        //        exit();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($memberExist == 0) {
    $now = date("Y-m-d H:i:s");
    $crPassword = md5($password); // 密碼加密
    $sql = "INSERT INTO member (account,name,password,email,phone,gender,birthday,subscribe,created_at,valid,tag_id) VALUES (?,?,?,?,?,?,?,?,?,1,?)";
    $stmt = $db_host->prepare($sql);
    try {
        $result = $stmt->execute([$account, $name, $crPassword, $email, $phone, $gender, $birthday, $subscribe, $now, $tag_id]);
        //        echo "新增會員成功";
        header("location:user-list.php?table=member");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
