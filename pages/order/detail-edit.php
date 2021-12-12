<?php
include_once('../var.php');
include('../signin/do-authorize.php');
require_once("../../components/pdo-connect.php");
// 
// 1 筆訂單 -> 多 個明細
// 1 筆明細 -> 1 個商品
// 1 筆明細 -> 1 個會員 or 顧客


// 檢查GET
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}

$url_back = $url_page_order_detail . $_GET['from'];

$sql = "SELECT orders_detail.*,
               products.name AS p_name,
               products.price AS p_price,
               member.name AS m_name,
               member.email AS m_email,
               member.phone AS m_phone,
               orders.status_id AS o_status,
               orders.payment_id AS o_payment,
               payment.description AS o_payment_desc,
               orders_status.description AS o_status_desc 
            FROM orders_detail
            JOIN products ON orders_detail.products_id = products.id
            JOIN member ON orders_detail.member_id = member.id
            JOIN orders ON orders_detail.orders_id = orders.id
            JOIN payment ON orders.payment_id = payment.id
            JOIN orders_status ON orders.status_id = orders_status.id
        WHERE orders_id = :orders_id";
// echo 'breakpoint' . __LINE__ . '<br>';

$pdo = $db_host->prepare($sql);
try {
    $pdo->execute([$id]);
    var_dump($pdo->rowCount());
    if ($pdo->rowCount() > 0) {
        $rowsOrder = $pdo->fetchAll(PDO::FETCH_ASSOC);
        // echo $pdo->rowCount();
        // var_dump($rows);
    } else {
        $rowsOrder = '暫時抓不到資料';
    }
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
        padding: 6px 7px;
        font-size: 18px;
        color: white;
        background-color: #4ebeba;
        border: none;
        border-radius: 5px;

    }

    .demo:hover {
        background-color: #008B8B;
        cursor: pointer;
        transition: .5s;
        color: #fff;
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
    <form action="do-detail-update.php" method="post">
        <div class="row justify-content-end">
            <div class="col-10">
            </div>
            <div class="col-2">
                <a href="<?= $url_page_order_search ?>" class="demo">回列表</a>
                <!-- <button class="demo" id="demo">Demo</button> -->
                <a type="submit" class="demo" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    送出</a>
                <!-- <button><a href="./order.php" class="demo">取消</a></button> -->
                <!-- <a href="./order.php" class="demo">回列表</a> -->

                <!-- <button class="demo" type="button" data-bs-toggle="modal" data-bs-target="">重置</button> -->
                <!-- <button class="demo" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">儲存</button> -->
            </div>
        </div>
        <input type="text" name="order_id" value=<?= $value['id'] ?> class="d-none">
        <div class="row">
            <div class="col-9">
                <p>訂單編號 : <?= $value["orders_id"] ?></p>
                <p>訂購日期 : <?= $value["created_at"] ?></p>
            </div>
        </div>
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
                    <td><?= $value["p_name"] ?></td>
                    <td></td>
                    <td>NT &#36 <?= $value["p_price"] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-right">商品小計</td>
                    <td>NT &#36 <?= $value["p_price"] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-right">折扣小計</td>
                    <td>NT &#36 3</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td class="text-right">訂單總金額</td>
                    <td>NT &#36 <?= $value["p_price"] - 3 ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="row input-group-sm">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">付款</h5>
                        <hr>
                        <label for="o_payment_desc" class="card-text form-label d-block">
                            付款方式 :
                            <input type="text" class="form-control border border-secondary" id="o_payment_desc" name="o_payment_desc" value="<?= $value["o_payment_desc"] ?>" required>
                        </label>
                        <label for="o_status_desc" class="card-text form-label d-block">
                            付款狀態 :
                            <input type="text" class="form-control border border-secondary" id="o_status_desc" name="o_status_desc" value="<?= $value["o_status_desc"] ?>" required>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">訂購人資訊</h5>
                        <hr>
                        <p class="card-text">顧客姓名 : <?= $value["m_name"] ?></p>
                        <p class="card-text">電話號碼 : <?= $value["m_phone"] ?></p>
                        <p class="card-text">電子郵件 : <?= $value["m_email"] ?></p>
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
                        <p class="card-text">顧客備註 : <?= $value["message"] ?></p>
                        <label for="message" class="card-text form-label">商家備註<input type="text" class="form-control border border-secondary card-text" id="message" name="message" value="<?= $value["message"] ?>" required>
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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">訂單操作紀錄</h5>
                    <hr>
                    <p class="card-text text-danger"> <?= $value["modified_at"] ?></p>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">確定修改訂單嗎?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        檢查一下再送出唷
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" href="do-detail-update.php">確定</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- body 2 > main 3 : 右側主內容下方頁尾 -->
    <?php include "../../template/body-main-footer.php" ?>

    <!-- body 3 : 右下頁面設定按鈕  -->
    <?php include "../../template/body-corner.php" ?>