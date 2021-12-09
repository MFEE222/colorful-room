<?php
include_once('../var.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}
require_once("../../components/pdo-connect.php");

$sqlorder = "SELECT * FROM order_tracking WHERE id = $id";
// "SELECT order_detail. *,tag.name AS tag_name FROM order_detail
// JOIN tag ON order_detail.tag_id = tag.id
// WHERE  order_detail.id=? AND order_detail.valid=1";

$stmt = $db_host->prepare($sqlorder);

try {
    $stmt->execute();
    $rowsOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rowsOrder);
} catch (PDOException $e) {
    echo $e->getMessage();
}

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Special+Elite&display=swap" rel="stylesheet">
    <style>
        .card {
            height: 200px;
            margin: 10px 0px 30px;
        }

        .table {
            margin: 10px 10px;
        }
    </style>
</head>

<body>
        <div class="container">
        
            <div class="row">
                <div class="col">
                    <h3>訂單明細</h3>
                </div>
                <div class="col-md-3 offset-md-9">
                    <a href="order-edit.php" class="btn btn-outline-danger">編輯訂單</a>
                    <a href="order.php" class="btn btn-danger">回列表</a>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <?php
                    foreach ($rowsOrder as $value) :
                    ?>
                        <p>訂單編號：<?= $value["order-num"] ?></p>
                        <p>訂購日期：<?= $value["date"] ?></p>
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
                            <th><?= $value["product-id"] ?></th>
                            <td></td>
                            <td><?= $value["sum"] ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">商品小計</td>
                            <td><?= $value["sum"] ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">折扣小計</td>
                            <td><?= $value["discount"] ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">訂單總金額</td>
                            <td><?= $value["sum"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">付款</h5>
                            <hr>
                            <p class="card-text">付款方式：<?= $value["payment-method"] ?></p>
                            <p class="card-text">付款狀態：<?= $value["payment-status"] ?></p>
                            <button class="btn btn-outline-danger">確認收款</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">訂購人資訊</h5>
                            <hr>
                            <p class="card-text">顧客姓名：<?= $value["user-id"] ?></p>
                            <p class="card-text">電話號碼：<?= $value["user-phone"] ?></p>
                            <p class="card-text">電子郵件：<?= $value["user-email"] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">訂單備註</h5>
                            <hr>
                            <p class="card-text">目前無備註</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">發票</h5>
                            <hr>
                            <p class="card-text">電子發票</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card1">
                    <div class="card-body">
                        <h5 class="card-title">訂單操作紀錄</h5>
                        <hr>
                        <p class="card-text text-danger">2021-12-07</p>
                        <p class="card-text">10:05 訂單 <?= $value["order-num"] ?> 已傳送商品下載連結至訂購信箱</p>
                        <p class="card-text">10:00 已成功接收款項</p>
                        <p class="card-text">07:59 建立訂單</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

</body>

</html>