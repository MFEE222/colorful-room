<?php
// require_once("../../components/pdo-connect.php");
//member的資料
$sqlMember = "SELECT member. *,tag.name AS tag_name FROM member
JOIN tag ON member.tag_id = tag.id
WHERE member.valid=1";

//$sqlMember="SELECT * FROM member WHERE valid=1";
$stmt = $db_host->prepare($sqlMember);
try {
    $stmt->execute();
    $rowsMember = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rowsMember);
} catch (PDOException $e) {
    echo $e->getMessage();
}
//customer的資料
$sqlCustomer = "SELECT * FROM customer WHERE valid=1";
$stmt = $db_host->prepare($sqlCustomer);
try {
    $stmt->execute();
    $rowsCustomer = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    $rowsCountCustomer=$stmt->rowCount();
    //    var_dump($rows);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- <!doctype html>
<html lang="en">

<head>
    <title>user list</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-5.0.1/web-fonts-with-css/css/fontawesome-all.min.css">

</head>

<body> -->
<div class="container ">
    <div class="row mb-2">
        <label for="">搜尋</label>
        <form action="" method="get">
            <div class="col-4 d-flex align-items-center">
                <input type="search" class="form-control me-2" name="" value="">
                <button type="submit" class="btn btn-primary text-nowrap">搜尋</button>
            </div>
        </form>
        <div class="p-2 d-flex justify-content-between">
            <div>
                共 ? 位使用者
            </div>
        </div>
    </div>
    <div class="p-2 d-flex justify-content-end">
        <a class="btn btn-primary" href="pages/customer/create-member.php">新增使用者</a>
    </div>

    <nav class="col-lg-10">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-member-tab" data-bs-toggle="tab" data-bs-target="#nav-member" type="button" role="tab" aria-controls="nav-member" aria-selected="true">會員</button>
            <button class="nav-link" id="nav-customer-tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="false">非會員</button>
        </div>
    </nav>
    <div class="tab-content col-lg-10" id="nav-tabContent">
        <div class="tab-pane fade show active " id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Account</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">生日</th>
                        <th scope="col">訂閱方案</th>
                        <th scope="col">標籤</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php foreach ($rowsMember as $value) : ?>
                    <tbody>
                        <tr>
                            <td><?= $value["id"] ?></td>
                            <td><?= $value["account"] ?></td>
                            <td><?= $value["name"] ?></td>
                            <td><?= $value["email"] ?></td>
                            <td><?= $value["phone"] ?></td>
                            <td><?= $value["birthday"] ?></td>
                            <td><?= $value["subscribe"] ?></td>
                            <td><?= $value["tag_name"] ?></td>
                            <td class="text-center d-flex justify-content-evenly">
                                <!-- index.php -->
                                <a class="btn btn-primary btn-sm" href="pages/customer/member.php?id=<?= $value["id"] ?>">內容</a>
                                <a class="btn btn-primary btn-sm" href="pages/customer/member-edit.php?id=<?= $value["id"] ?>">修改</a>
                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">刪除</a>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">確認刪除<?= $value["account"] ?>會員嗎?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                可以再思考一下喔!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                <a class="btn btn-primary" href="pages/customer/memberDoDelete.php?id=<?= $value["id"] ?>">確定</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>

            </table>

        </div>

        <div class="tab-pane fade " id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Account</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <?php foreach ($rowsCustomer as $value) : ?>
                    <tbody>
                        <tr>
                            <td><?= $value["id"] ?></td>
                            <td><?= $value["account"] ?></td>
                            <td><?= $value["name"] ?></td>
                            <td><?= $value["email"] ?></td>
                            <td><?= $value["phone"] ?></td>
                            <td class="text-center d-flex justify-content-evenly">
                                <a class="btn btn-primary btn-sm me-2" href="customer.php?id=<?= $value["id"] ?>">內容</a>
                                <a class="btn btn-primary btn-sm me-2" href="customer-edit.php?id=<?= $value["id"] ?>">修改</a>
                                <a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">刪除</a>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel1">確認刪除<?= $value["account"] ?>非會員嗎?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                可以再思考一下喔!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                <a type="submit" class="btn btn-primary" href="customerDoDelete.php?id=<?= $value["id"] ?>">確定</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html> -->