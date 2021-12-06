<?php
//include_once('../var.php');
require_once("../../components/pdo-connect.php");

if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
}
//session_start();
?>
<html lang="en">

<head>
    <title>Create member</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2 d-flex  mx-5">
            <div>
                <!-- <a class="btn btn-primary" href="user-list.php">使用者列表</a> -->
                <a class="btn btn-primary" href=create-member.php ?>>使用者列表</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <!-- <form action="doinsert.php" method="post"> -->
                <form action="doinsert.php " method="post">
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

                    <!--                <input class="btn btn-primary" type="reset">清除</input>-->
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
                                    <button type="submit" class="btn btn-primary" href="create-member.php">確定</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>