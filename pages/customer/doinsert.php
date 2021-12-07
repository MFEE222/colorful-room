<?php
require_once("../../components/pdo-connect.php");
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
        header("Refresh:3;url=create-member.php");
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
        header("Refresh:2;url=user-list-test.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Create Member</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-4 my-4 ">
                <h3 class="font-bold text-center">
                    <?php if (isset($result)) : ?>
                        <?php echo "帳號新增成功<br>2秒後將自動返回會員列表頁面"; ?>
                    <?php else : ?>
                        <?php echo "帳號已被註冊過<br>2秒後將自動返回新增會員頁面"; ?>
                    <?php endif; ?>
                </h3>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>