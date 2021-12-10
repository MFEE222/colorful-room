<?php
require_once "../../components/pdo-connect.php";
// include('../signin/do-authorize.php');

$sqlorder = "SELECT * FROM order_tracking";

$stmt = $db_host->prepare($sqlorder);

try {
    $stmt->execute();
    $rowsOrder = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rowsOrder);
} catch (PDOException $e) {
    echo $e->getMessage();
}


// bug...
$sqlMember = "SELECT *,tag.name AS tag_name FROM member
JOIN tag ON member.tag_id = tag.id
WHERE member.valid=1";

$stmt = $db_host->prepare($sqlMember);

try {
    $stmt->execute();
    $sqlMember = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    print_r($rowsuser);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>order</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            /* font-family: 'Pacifico', cursive; */
            background: #fff;
        }

        a:link {
            text-decoration: none;

        }

        .btn {
            position: relative;
            display: block;
            padding: 5px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
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
        <div class="row align-items-center">
            <div class="col">
                <h3>訂單查詢</h3>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>訂單編號</th>
                    <th>顧客名稱</th>
                    <th>建立時間</th>
                    <th>付款狀態</th>
                    <th>付款方式</th>
                    <th>訂單狀態</th>
                    <th>金額</th>
                    <th>備註</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            foreach ($rowsOrder as $value) :

            ?>
                <tbody>
                    <tr>
                        <td></td>
                        <td><?= $value["order-num"] ?></td>
                        <td><?=
                            // foreach ($rowsuser as $row) {
                            //     if ($row['id'] == $value['user-id']) {
                            //         // echo $row['name'];
                            //         print_r($row);
                            //     }
                            //  }

                            // $rowsuser[$value["user-id"]] 
                            $value["user-id"] ?></td>
                        <td><?= $value["date"] ?></td>
                        <td><?= $value["payment_status"] ?></td>
                        <td><?= $value["payment_method"] ?></td>
                        <td>處理中</td>
                        <td>NT &#36 <?= $value["sum"] ?></td>
                        <td></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="./order-details.php?id=<?= $value["id"] ?>" class="btn btn-danger">明細</a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="./detail-edit.php?id=<?= $value["id"] ?>" class="btn btn-danger">修改</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
        </table>
    </div>
    </div>
    <!-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav> -->
    </div>
</body>

</html>