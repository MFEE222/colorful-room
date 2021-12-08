<?php
require_once ("../../components/pdo-connect.php");
//新增
include_once("../var.php");
include_once("../signin/do-authorize.php");
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
/*         header("location:customer-edit.php?id=<?php=$id?>");*/
//        exit();
     }else{
         $sql="UPDATE customer SET account=?, name=?, email=?, phone=?, edit_at=? WHERE id=?";
         $stmt=$db_host->prepare($sql);
         try {
             $result=$stmt->execute([$account,$name,$email,$phone,$editNow,$id]);
//    var_dump($result);
             header("location:user-list.php");
         }catch(PDOException $e){
             echo $e->getMessage();
         }
     }
}catch(PDOException $e){
    echo $e->getMessage();
}



?>
<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>Edit Member</title>-->
<!--   Required meta tags -->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!---->
<!--    Bootstrap CSS v5.0.2 -->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
<!---->
<!--</head>-->
<!--<body>-->

<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php"; ?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div class="container">
    <div class="row justify-content-start  min-vh-100" >
        <div class="col-lg-4 my-4 ">
            <p class="font-bold text-start">
                <?php if (isset($result)):?>
                    <?php echo "非會員資料修改成功<br>2秒後將自動返回會員列表頁面" ;?>
                <?php else: ?>
                    <form action="customer-edit.php?id=id=<?=$id?>" method="get">
<!--                        <button class="btn btn-primary "  type="submit">返回</button>-->
<!--                        <br>-->
                       <a class="btn btn-primary " role="button" type="submit" href="customer-edit.php?id=<?=$id?>">回非會員修改頁面</a>
                        <br>
                    <?php echo "帳號已被註冊過，請返回非會員修改頁面重新編輯";   ?>
                    </form>
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>
<!-- Bootstrap JavaScript Libraries -->
<!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>-->
<!--</body>-->
<!--</html>-->
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>
