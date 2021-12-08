<?php
// if (isset($_GET["id"])) {
//     $id = $_GET["id"];
// } else {
//     $id = 0;
// }
// require_once("../../components/pdo-connect.php");
// $sqlMember = "SELECT member. *,tag.name AS tag_name FROM member
// JOIN tag ON member.tag_id = tag.id
// WHERE  member.id=? AND member.valid=1";

// //$sqlMember="SELECT * FROM member WHERE valid=1";
// $stmt = $db_host->prepare($sqlMember);
// try {
//     $stmt->execute([$id]);
//     $rowsMember = $stmt->fetch();
//     //    $rowsCountMember=$stmt->rowCount();
//     //    var_dump($rows);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }
?>



<!doctype html>
<html lang="en">

<head>
    <title>order details</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .card{
            height: 200px;
            margin: 10px 0px 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>訂單明細</h3>
        <div class="row">
            <div class="col-9">
                <p>訂單編號:</p>
                <p>訂購日期:</p>
            </div>
            <div class="col-3">
                <a href="order-edit.php" class="btn btn-outline-danger">編輯訂單</a>
                <a href="order.php" class="btn btn-danger">回列表</a>
            </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">訂購人資訊</h5>
                        <hr>
                        <p class="card-text">name</p>
                        <p class="card-text">phome</p>
                        <p class="card-text">email</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">付款</h5>
                        <hr>
                        <p class="card-text">付款狀態 :</p>
                        <p class="card-text">付款方式 :</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>商品品項</th>
                        <th></th>
                        <th>價格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">商品小計</td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">折扣小計</td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">訂單總金額</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

</body>

</html>