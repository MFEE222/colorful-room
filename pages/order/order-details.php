<?php
include_once('../var.php');
// include('../signin/do-authorize.php');

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
    <title>Order Details</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Special+Elite&display=swap" rel="stylesheet">
    <style>
        body {
            /* font-family: 'Pacifico', cursive; */
            font-size: 18px;
        }
        a:link {
            text-decoration: none;
            color: #fff;
        }
        a:hover{
            color: #fff;
        }
        .demo {
            /* display: block; */
            margin: 5px;
            padding: 5px 20px;
            font-size: 18px;
            color: white;
            background-color: #4ebeba;
            border: none;
            border-radius: 5px;

        }

        .demo:hover {
            cursor: pointer;
            transition: .5s;
            box-shadow: 0 0 5px 1px #fff;
        }


        .card {
            height: 250px;
            margin: 10px 0px 30px;

        }

        .table {
            width: 100%;
            border-collapse: separate;
            ;
        }

        .table caption {
            padding: 10px;
            font-size: 30px;
            background-color: #f3f6f9;
        }

        .table thead th {
            padding: 5px 0px;
            color: #fff;
            background-color: #AD5A5A;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .table tbody td {
            padding: 5px 0px;
            color: #555;
            text-align: center;
            background-color: #fff;
            border-bottom: 1px solid #915957;
        }

        .table tfoot td {
            padding: 5px 0px;
            text-align: center;
            background-color: #d6d6a5;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>訂單明細</h3>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-10">
            </div>
            <div class="col-2">
                <a href="./order.php" class="demo">回列表</a>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <?php
                foreach ($rowsOrder as $value) :
                ?>
                    <p>訂單編號 : <?= $value["order-num"] ?></p>
                    <p>訂購日期 : <?= $value["date"] ?></p>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>商品品項</th>
                        <th></th>
                        <th>價格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $value["product-id"] ?></td>
                        <td></td>
                        <td>NT &#36 <?= $value["sum"] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">商品小計</td>
                        <td>NT &#36 <?= $value["sum"] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">折扣小計</td>
                        <td>NT &#36 <?= $value["discount"] ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-right">訂單總金額</td>
                        <td>NT &#36 <?= $value["sum"] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">付款</h5>
                        <hr>
                        <p class="card-text">付款方式 : <?= $value["payment_method"] ?></p>
                        <p class="card-text">付款狀態 : <?= $value["payment_status"] ?></p>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">訂購人資訊</h5>
                        <hr>
                        <p class="card-text">顧客姓名 : <?= $value["user-id"] ?></p>
                        <p class="card-text">電話號碼 : <?= $value["user-phone"] ?></p>
                        <p class="card-text">電子郵件 : <?= $value["user-email"] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">備註</h5>
                        <hr>
                        <p class="card-text">顧客備註 : <?= $value["remark"] ?></p>
                        <p class="card-text">商家備註 : <?= $value["remark"] ?></p>
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
                    <p class="card-text text-danger"> <?= $value["record"] ?>
                    </p>
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