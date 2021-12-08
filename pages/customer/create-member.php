<?php
require_once("../../components/pdo-connect.php");
if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
}
//session_start();
?>
<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php"; ?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div class="py-2 d-flex  mx-5">
    <div>
        <a class="btn btn-primary" href="user-list.php">使用者列表</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-3">
        <!-- index.php?page=customer_doinsert -->
        <form action="doinsert.php" method="post">
            <div class="mb-4 input-group-sm">
                <label for="name">姓名</label>
                <input id="name" type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-4 input-group-sm">
                <label for="account">帳號</label>
                <input id="account" type="account" name="account" class="form-control" required>
                <?php if (isset($_SESSION["user"]["account"])) : ?>
                    <p class="fs-6 text-danger"><?= ($_SESSION["user"]["account"]) ?>帳號已存在</p>
                <?php endif; ?>
            </div>
            <div class="mb-4 input-group-sm">
                <label for="password">密碼</label>
                <input id="password" type=" password" name="password" class="form-control" required>
            </div>
            <div class="mb-4 input-group-sm">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="form-control" required>
                <?php if (isset($_SESSION["user"]["email"])) : ?>
                    <p class="fs-6 text-danger"><?= ($_SESSION["user"]["email"]) ?>信箱已註冊過</p>
                <?php endif; ?>
            </div>
            <div class="mb-4 input-group-sm">
                <label for="phone">電話</label>
                <input id="phone" type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-check form-check-inline mb-4 input-group-sm">
                <input class="form-check-input" type="checkbox" id="male" value="1" name="gender" checked>
                <label class="form-check-label" for="male">male</label>
            </div>
            <div class="form-check form-check-inline mb-4 input-group-sm">
                <input class="form-check-input" type="checkbox" id="female" value="0" name="gender">
                <label class="form-check-label" for="female">female</label>
            </div>
            <div class="mb-4 input-group-sm">
                <label for="birthday">出生年月日</label>
                <input id="birthday" type="text" name="birthday" class="form-control" placeholder="西元/月/日 19xx/xx/xx">
            </div>
            <div class="mb-4">
                <label for="subscribe">訂閱方案</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="subscribe">
                    <option selected>請選擇訂閱方案</option>
                    <option value="1">30天</option>
                    <option value="2">60天</option>
                    <option value="3">90天</option>
                    <option value="4">1年</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tag">會員等級</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tag" required>
                    <option value="1">VIP</option>
                    <option value="2" selected>一般會員</option>
                </select>
            </div>
            <?php unset($_SESSION["user"]); ?>

            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">送出</button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">確認新增會員嗎?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            可以再檢查一下喔!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary" href="pages/customer/create-member.php">確定</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>