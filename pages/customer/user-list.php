<?php
require_once("../../components/pdo-connect.php");
include_once("../var.php");
include_once("../signin/do-authorize.php");
$rowsMemebr = NULL;

if (isset($_GET['keyword'])) {
    // 致緯...
    if ($_GET['table'] == 'member') {
    } elseif ($_GET['table'] == 'customer') {
    }
} else {
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
}
?>

<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php"; ?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div class="container-fluid py-4">
    <div class="container ">

        <div class="row ">
            <label for="">搜尋</label>
            <form action="user-list.php" method="get">
                <div class="col-4 d-flex align-items-center ">
                    <input type="search" class="form-control mx-3" name="keyword" value="">
                    <button type="submit" class="btn btn-primary text-nowrap ">搜尋</button>
                </div>
            </form>
            <div class="p-2 d-flex justify-content-between">
                <div>
                    共 ? 位使用者
                </div>
                <a class="btn btn-primary" href="create-member.php">新增使用者</a>
            </div>
        </div>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-member-tab" data-bs-toggle="tab" data-bs-target="#nav-member" type="button" role="tab" aria-controls="nav-member" aria-selected="true">會員</button>
            <button class="nav-link" id="nav-customer-tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="false">非會員</button>
            <!-- a href -->
            <!-- <a class="nav-link" href="user-list.php?table=customer"></a>
                    <a class="nav-link" href="user-list.php?table=member"></a> -->

        </div>
        <?php //if ($_GET['table'] == 'member') : 
        ?>
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
                                    <a class="btn btn-primary btn-sm" href="<?= $url_page_member . '?id=' . $value['id'] ?>">內容</a>
                                    <a class="btn btn-primary btn-sm" href="<?= $url_page_member_edit . '?id=' . $value['id'] ?>">修改</a>
                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="<?= '#staticBackdrop' . $value['id'] ?>">刪除</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="<?= 'staticBackdrop' . $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    <a class="btn btn-primary" href="memberDoDelete.php?id=<?= $value["id"] ?>">確定</a>
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
            <?php // elseif ($_GET['table'] == "customer") :
            ?>
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
                                    <a class="btn btn-primary btn-sm" role="button" data-bs-toggle="modal" data-bs-target="<?= '#staticBackdrop1' . $value['id'] ?>">刪除</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="<?= 'staticBackdrop1' . $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
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
                                                    <a class="btn btn-primary" href="customerDoDelete.php?id=<?= $value["id"] ?>">確定</a>
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
            <?php //endif;
            ?>
        </div>
    </div>
</div>

<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>