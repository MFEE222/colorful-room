<?php
require_once "/../xampp/htdocs/colorful-room/components/pdo-connect.php";


$sqlorder="SELECT * FROM order_tracking WHERE id ";

$stmt = $db_host->prepare($sqlorder);

try {
    $stmt->execute();
    $rowsOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rowsOrder);
} catch (PDOException $e) {
    echo $e->getMessage();
}


$sqluser="SELECT * FROM member WHERE id ";

$stmt = $db_host->prepare($sqluser);

try {
    $stmt->execute();
    $rowsuser = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    print_r($rowsuser);
} catch (PDOException $e) {
    echo $e->getMessage();
}




?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        a:link{
            text-decoration:none;
        }
    </style>
</head>

<body>
<div class="container">
        <h3>訂單查詢</h3>
        <div>
            <table class="table table-striped table-hover">
                <tr>
                    <th><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></th>
                    <th>訂單編號</th>
                    <th>顧客名稱</th>
                    <th>建立時間</th>
                    <th>付款狀態</th>
                    <th>付款方式</th>
                    <th>訂單狀態</th>
                    <th>金額</th>
                    <th>備註</th>
                </tr>
                <?php 
                foreach ($rowsOrder as $value) :
            
                ?>

                <tr>
                    <td><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                    <td><?= $value["order-num"] ?></td>
                    <td><?=
                        // foreach ($rowsuser as $row) {
                        //     if ($row['id'] == $value['user-id']) {
                        //         // echo $row['name'];
                        //         print_r($row);
                        //     }
                        //  }

                        // $rowsuser[$value["user-id"]] 
                        $value["user-id"]?></td>
                    <td><?= $value["date"] ?></td>
                    <td><?= $value["payment-status"] ?></td>
                    <td><?= $value["payment-method"] ?></td>
                    <td>
                        <select>
                            <option>處理中</option>
                            <option>待付款</option>
                            <option>已完成</option>
                            <option>不成立</option>
                            <option>退貨/退款</option>
                            <option>已取消</option>
                        </select>
                    </td>
                    <td><?= $value["sum"] ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-danger"><a href="/pages/order/order-details.php">明細</a></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <!-- <tr>
                    <td><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                    <td><?= $value["order-num"] ?></td>
                    <td><?= $value["user-id"] ?></td>
                    <td><?= $value["date"] ?></td>
                    <td><?= $value["payment-status"] ?></td>
                    <td><?= $value["payment-method"] ?></td>
                    <td>
                        <select>
                            <option>處理中</option>
                            <option>待付款</option>
                            <option>已完成</option>
                            <option>不成立</option>
                            <option>退貨/退款</option>
                            <option>已取消</option>
                        </select>
                    </td>
                    <td><?= $value["sum"] ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-danger"><a href="/pages/order/order-details.php">明細</a></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                    <td><?= $value["order-num"] ?></td>
                    <td><?= $value["user-id"] ?></td>
                    <td><?= $value["date"] ?></td>
                    <td><?= $value["payment-status"] ?></td>
                    <td><?= $value["payment-method"] ?></td>
                    <td>
                        <select>
                            <option>處理中</option>
                            <option>待付款</option>
                            <option>已完成</option>
                            <option>不成立</option>
                            <option>退貨/退款</option>
                            <option>已取消</option>
                        </select>
                    </td>
                    <td><?= $value["sum"] ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-danger"><a href="/pages/order/order-details.php">明細</a></button>
                        </div>
                    </td>
                </tr> -->
            </table>
        </div>
    </div>