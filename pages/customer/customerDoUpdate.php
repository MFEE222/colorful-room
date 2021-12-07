<?php
require_once ("../../components/pdo-connect.php");
if(!isset($_POST["id"])){
    echo "您不是從正常程序進入此頁";
//    header("Refresh:2;url=user-list-test.php");
    exit();
}
$id=$_POST["id"];
$account=$_POST["account"];
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$editNow=date("Y-m-d H:i:s");
$sqlCheck="SELECT * FROM customer WHERE account=? AND email=? AND name=? AND phone=?";
$stmt=$db_host->prepare($sqlCheck);
try {
    $stmt->execute([$account,$email,$name,$phone]);
    $customerExist=$stmt->rowCount();
     if($customerExist>0) {
//        echo "帳號已存在";
         $row = $stmt->fetch();
         $customer = [
             "account" => $row["account"],
             "email" => $row["email"],
         ];
         $_SESSION["customer"] = $customer;
//         var_dump( $_SESSION["customer"]);
//         header("Refresh:3;url=user-list-test.php");
//        exit();
     }else{
         $sql="UPDATE customer SET account=?, name=?, email=?, phone=?, edit_at=? WHERE id=?";
         $stmt=$db_host->prepare($sql);
         try {
             $result=$stmt->execute([$account,$name,$email,$phone,$editNow,$id]);
//    var_dump($result);
             header("Refresh:2;url=user-list-test.php");
         }catch(PDOException $e){
             echo $e->getMessage();
         }
     }
}catch(PDOException $e){
    echo $e->getMessage();
}



?>
<!doctype html>
<html lang="en">
<head>
    <title>Edit Member</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100" >
        <div class="col-lg-4 my-4 ">
            <h3 class="font-bold text-center">
                <?php if (isset($result)):?>
                    <?php echo "非會員資料修改成功<br>2秒後將自動返回會員列表頁面" ;?>
                <?php else: ?>
                    <form action="customer-edit.php?id=<?=$id?>" method="post">
                        <button class="btn btn-primary "  type="submit">返回</button>
                        <br>
                    <?php echo "帳號已被註冊過<br>請返回非會員修改頁面重新編輯";   ?>
                    </form>
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

