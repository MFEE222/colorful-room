<?php
if(!isset($_GET["id"])){
    echo "您不是從正常程序進入此頁";
    exit();
}
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("../../components/pdo-connect.php");
$sqlCustomer="SELECT * FROM customer WHERE id=? AND valid=1";
$stmt=$db_host->prepare($sqlCustomer);
try{
    $stmt->execute([$id]);
    $rowCustomer=$stmt->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Customer Detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-lg-8">
            <div class="py-2 my-3">
                <a href="user-list.php" class="btn btn-primary">回列表</a>
            </div>
            <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Account</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">建立時間</th>
                    <th scope="col">修改時間</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$rowCustomer["id"]?></td>
                        <td><?=$rowCustomer["account"]?></td>
                        <td><?=$rowCustomer["name"]?></td>
                        <td><?=$rowCustomer["email"]?></td>
                        <td><?=$rowCustomer["phone"]?></td>
                        <td><?=$rowCustomer["created_at"]?></td>
                        <td><?=$rowCustomer["edit_at"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
