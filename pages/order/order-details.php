<?php
include_once('../var.php');
// include('../signin/do-authorize.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}
require_once("../../components/pdo-connect.php");

// $sqlorder = "SELECT * FROM order_tracking WHERE id = $id";
$sqlorder = "SELECT *
                FROM order_tracking
                JOIN member ON order_tracking.user_id = member.id
             WHERE order_tracking.oid = ?";
// "SELECT order_detail. *,tag.name AS tag_name FROM order_detail
// JOIN tag ON order_detail.tag_id = tag.id
// WHERE  order_detail.id=? AND order_detail.valid=1";

$stmt = $db_host->prepare($sqlorder);


try {
    $stmt->execute([$id]);
    $rowsOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rowsOrder);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<style>
    body {
        /* font-family: 'Pacifico', cursive; */
        font-size: 18px;
    }

    a:link {
        text-decoration: none;
        color: #fff;
    }

    a:hover {
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

<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php"; ?>
<!--  -->
<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
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
                <p>訂單編號 : <?= $value["order_num"] ?></p>
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
                    <td><?= $value["product_id"] ?></td>
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
                    <p class="card-text">顧客姓名 : <?= $value["name"] ?></p>
                    <p class="card-text">電話號碼 : <?= $value["phone"] ?></p>
                    <p class="card-text">電子郵件 : <?= $value["email"] ?></p>
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

<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>