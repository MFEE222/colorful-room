<?php
require_once "../../components/pdo-connect.php";
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

echo 123;
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
        a:link {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
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
                        <th></th>
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
                                $value["user-id"] ?></td>
                            <td><?= $value["date"] ?></td>
                            <td><?= $value["payment-status"] ?></td>
                            <td><?= $value["payment-method"] ?></td>
                            <td>
                                <select>
                                    <option><?= $value["order-status"] ?></option>
                                    <option>處理中</option>
                                    <option>待付款</option>
                                    <option>已完成</option>
                                    <option>不成立</option>
                                    <option>退貨/退款</option>
                                    <option>已取消</option>
                                </select>
                            </td>
                            <td><?= $value["sum"] ?></td>
                            <td></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="./order-details.php?id=<?= $value["id"] ?>" class="btn btn-danger">明細</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <nav aria-label="Page navigation example">
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
        </nav>
    </div>
</body>

</html>