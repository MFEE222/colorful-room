<?php
include_once("../var.php");
include_once("../signin/do-authorize.php");
require_once("../../components/pdo-connect.php");

function post($query)
{
    echo $_POST[$query] . '<br>';
}
post('id');
post('payment_method');
post('order_status');
post('message');
$sql = "UPDATE order_tracking
            SET payment_method = ?,
                payment_status = ?,
                remark = ?
        WHERE oid = ?";

try {
    $pdo = $db_host->prepare($sql);

    $pdo->execute(
        [
            $_POST['payment_method'],
            $_POST['payment_status'],
            $_POST['remark'],
            $_POST['order_id']
        ]
    );

    // var_dump($pdo->rowCount());
    if ($pdo->rowCount() > 0)
        header("location:order.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!-- <!doctype html>
<html lang="en">

<head>
    <title>Edit Member</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-4 my-4 ">
                <h3 class="font-bold text-center">
                    <?php //if (isset($result)) : 
                    ?>
                        <?php //echo "訂單資料修改成功<br>2秒後將自動返回訂單列表頁面"; 
                        ?>
                    <?php //endif; 
                    ?>
                </h3>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html> -->