<?php
require_once("../../components/pdo-connect.php");
include_once("../var.php");
include_once("../signin/do-authorize.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}

$sqlCustomer = "SELECT * FROM customer WHERE id=? AND valid=1";
$stmt = $db_host->prepare($sqlCustomer);
try {
    $stmt->execute([$id]);
    $rowsCountCustomer = $stmt->rowCount();
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
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="py-2 my-3">
                <a href="<?= $url_page_user_list ?>" class="btn btn-primary">回列表</a>
            </div>
            <?php if ($rowsCountCustomer == 0) : ?>
                <p class="font-bold">使用者不存在</p>
            <?php else :
                $rowsCustomer = $stmt->fetch();
                //            var_dump($rowsCustomer);
            ?>

                <form action="customerDoUpdate.php" method="post">
                    <div class="mb-3 input-group-sm">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $rowsCustomer["id"] ?>" readonly>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" id="account" name="account" value="<?= $rowsCustomer["account"] ?>">
                        <?php if (isset($_SESSION["customer"]["account"])) : ?>
                            <p class="fs-6 text-danger"><?= ($_SESSION["customer"]["account"]) ?>帳號已存在</p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $rowsCustomer["name"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $rowsCustomer["email"] ?>">
                        <?php if (isset($_SESSION["customer"]["email"])) : ?>
                            <p class="fs-6 text-danger"><?= ($_SESSION["customer"]["email"]) ?>帳號已存在</p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $rowsCustomer["phone"] ?>">
                    </div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">送出</button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">確認修改非會員嗎?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    可以再檢查一下喔!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-primary" href="member-edit.php">確定</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            <?php endif; ?>
        </div>
            <?php unset($_SESSION["customer"]); ?>
    </div>
</div>
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>