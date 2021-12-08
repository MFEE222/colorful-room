<?php
include_once('../var.php');

if (!isset($_GET["id"])) {
    echo "您不是從正常程序進入此頁";
    exit();
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}
require_once("../../components/pdo-connect.php");
$sqlCustomer = "SELECT * FROM customer WHERE id=? AND valid=1";
$stmt = $db_host->prepare($sqlCustomer);
try {
    $stmt->execute([$id]);
    $rowCustomer = $stmt->fetch();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="py-2 my-3">
                <a href="<?= $url_page_user_list ?>" class="btn btn-primary">回列表</a>
            </div>
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Account</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">建立時間</th>
                        <th scope="col">修改時間</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $rowCustomer["id"] ?></td>
                        <td><?= $rowCustomer["account"] ?></td>
                        <td><?= $rowCustomer["name"] ?></td>
                        <td><?= $rowCustomer["email"] ?></td>
                        <td><?= $rowCustomer["phone"] ?></td>
                        <td><?= $rowCustomer["created_at"] ?></td>
                        <td><?= $rowCustomer["edit_at"] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>