<?php
if (!isset($_GET["id"])) {
    echo "您不是從正常程序進入此頁";
    exit();
}
require_once("../../components/pdo-connect.php");
$id = $_GET["id"];
$sql = "UPDATE member SET valid=0 WHERE id=?";
 $stmt = $db_host->prepare($sql);
try {
    if ($stmt->execute([$id]) === TRUE) {
        //      echo "刪除資料完成" ;
        header("Refresh:2;url=user-list.php");
    }
} catch (PDOException $e) {
    echo  $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Delete Member</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-4 my-4 ">
                <h3 class="font-bold text-center">
                    <?php if ($stmt->execute([$id]) === TRUE) : ?>
                        <?php echo "刪除資料完成<br>2秒後將自動返回使用者列表"; ?>
                    <?php endif; ?>
                </h3>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>