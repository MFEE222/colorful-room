<?php
require_once ("../../components/pdo-connect.php");

if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}

$sqlCustomer="SELECT * FROM customer WHERE id=? AND valid=1";
$stmt=$db_host->prepare($sqlCustomer);
try{
    $stmt->execute([$id]);
    $rowsCountCustomer=$stmt->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Customer Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="py-2 my-3">
                <a href="user-list.php" class="btn btn-primary">回列表</a>
            </div>
            <?php if($rowsCountCustomer==0): ?>
                <p class="font-bold">使用者不存在</p>
            <?php else:
                $rowsCustomer=$stmt->fetch();
//            var_dump($rowsCustomer);
                ?>
                <form action="customerDoUpdate.php" method="post">
                    <div class="mb-3 input-group-sm">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?=$rowsCustomer["id"]?>"  readonly>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" id="account" name="account" value="<?=$rowsCustomer["account"]?>">
                        <?php if (isset($_SESSION["customer"]["account"])) :?>
                            <p class="fs-6 text-danger"><?=($_SESSION["customer"]["account"])?>帳號已存在</p>
                        <?php endif;?>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?=$rowsCustomer["name"]?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email"  name="email" value="<?=$rowsCustomer["email"]?>" >
                        <?php if (isset($_SESSION["customer"]["email"])) :?>
                            <p class="fs-6 text-danger"><?=($_SESSION["customer"]["email"])?>帳號已存在</p>
                        <?php endif;?>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?=$rowsCustomer["phone"]?>">
                    </div>
                    <button class="btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">送出</button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">確認修改非會員嗎?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    可以再檢查一下喔!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-primary" href="member-edit.php" >確定</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php if(isset($_SESSION["customer"])) :?>
               <?php unset($_SESSION["customer"]);?>
            <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>