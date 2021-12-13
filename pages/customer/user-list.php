<?php
require_once("../../components/pdo-connect.php");
include_once("../var.php");
include_once("../signin/do-authorize.php");
$rowsMemebr = NULL;

$form_action = "user-list.php?" . $_GET['table'];
// echo $form_action;
// user-list.php?keyword=anna&table=member
// user-list.php?keyword=anna&table=customer

if (isset($_GET['keyword'])) {
    // 致緯...
    //搜尋member
    if ($_GET['table'] == 'member') {
        $search1 = $_GET["keyword"];
        $search2 = $_GET["keyword"];
        $sql = "SELECT member. * ,tag.name AS tag_name FROM member
                jOIN tag ON member.tag_id = tag.id
                WHERE member.valid=1 AND member.account LIKE :SERCH1 OR member.name LIKE :SERCH2";
        $stmt = $db_host->prepare($sql);
        //$result=$conn->query($sql);
        //$resultCount=$result->num_rows;
        try {
            $stmt->execute([
                'SERCH1' => '%' . $search1 . '%',
                'SERCH2' => '%' . $search2 . '%'
            ]);
            $rowsMember = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        //搜尋customer
    } elseif ($_GET['table'] == 'customer') {
        $search3 = $_GET["keyword"];
        $search4 = $_GET["keyword"];
        $sql = "SELECT customer. * FROM customer
                WHERE customer.valid=1 AND customer.account LIKE :SERCH3 OR customer.name LIKE :SERCH4";
        $stmt = $db_host->prepare($sql);
        try {
            $stmt->execute([
                'SERCH3' => '%' . $search3 . '%',
                'SERCH4' => '%' . $search4 . '%'
            ]);
            $rowsCustomer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    //member的資料
    $sqlMember = "SELECT member. *,tag.name AS tag_name FROM member
                    JOIN tag ON member.tag_id = tag.id
                    WHERE valid=1 LIMIT 50";

    //$sqlMember="SELECT * FROM member WHERE valid=1";
    $stmt = $db_host->prepare($sqlMember);
    try {
        $stmt->execute();
        $rowsMember = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowsCountMember = $stmt->rowCount();
        //    var_dump($rowsMember);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    //customer的資料
    $sqlCustomer = "SELECT * FROM customer WHERE valid=1 LIMIT 50";
    $stmt = $db_host->prepare($sqlCustomer);
    try {
        $stmt->execute();
        $rowsCustomer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowsCount = $stmt->rowCount();
        //    var_dump($rows);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// var_dump($_SESSION);
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
        <div class="row">
            <p class="h6">搜尋</p>
            <form action="<?= $form_action ?>" method="GET">
                <input type="text" name="table" value="<?= $_GET['table'] ?>" class="d-none">
                <div class="col-lg-5 d-flex align-items-center">
                    <input type="search" class="form-control border border-secondary me-3 " name="keyword" value="<?php if(isset($_GET['keyword']))echo $_GET['keyword'] ?>">
                    <button type="submit" class="btn btn-primary  text-nowrap m-0">搜尋</button>
                </div>
            </form>
            <div class="my-5 d-flex justify-content-start">

                <a class="btn btn-primary me-4" href="create-member.php">新增使用者</a>
                <?php if(isset($rowsCountMember) && $rowsCount):?>
                <div>
                    共 <?=  $rowsCountMember ?> 位會員
                    <br>
                    共 <?= $rowsCount ?> 位非會員
                </div>
                <?php endif ; ?>
            </div>

        </div>
        <div class="nav nav-tabs pb-3" id="nav-tab" role="tablist">
            <!-- <button class="nav-link active" id="nav-member-tab" data-bs-toggle="tab" data-bs-target="#nav-member" type="button" role="tab" aria-controls="nav-member" aria-selected="true">會員</button>
            <button class="nav-link" id="nav-customer-tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="false">非會員</button> -->
            <!-- 送出 GET 參數 -->
            <a href="user-list.php?table=member" style="cursor: pointer;" class="me-4 btn btn-outline-primary <?php if ($_GET['table'] == 'member') echo 'active'; ?>">會員</a>
            <a href="user-list.php?table=customer" style="cursor: pointer;" class="btn btn-outline-primary <?php if ($_GET['table'] == 'customer') echo 'active'; ?>">非會員</a>

<!--            <a type="button" href="user-list.php?table=member" style="cursor: pointer;" class="nav-link --><?php //if ($_GET['table'] == 'member') echo 'active'; ?><!--">會員</a>-->
<!--            <a href="user-list.php?table=customer" style="cursor: pointer;" class="nav-link --><?php //if ($_GET['table'] == 'customer') echo 'active'; ?><!--">非會員</a>-->
        </div>
        <?php if ($_GET['table'] == 'member') : ?>
            <div class="tab-content mt-3" id="nav-tabContent">
                <div class="tab-pane fade show active " id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                    <table class="table table-hover align-items-center col-lg-10">
                        <thead class="mt-2">
                            <tr>
                                <th class="text-uppercase text-secondary text-center" scope="col">ID</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">Account</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">Name</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">Email</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">Phone</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">生日</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">訂閱方案</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">標籤</th>
                                <th class="text-uppercase text-secondary text-center" scope="col">操作</th>
                            </tr>

                        </thead>
                        <?php foreach ($rowsMember as $value) : ?>
                            
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center m-4"><?= $value["id"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["account"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["name"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["email"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["phone"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["birthday"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["subscribe"] ?></td>
                                    <td class="align-middle text-center m-4"><?= $value["tag_name"] ?></td>
                                    <td class="align-middle text-center ps-4">
                                        <!-- index.php -->
                                        <a class="btn btn-primary btn-sm m-2" href="<?= $url_page_member . '?id=' . $value['id'] ?>">內容</a>
                                        <a class="btn btn-primary btn-sm m-2" href="<?= $url_page_member_edit . '?id=' . $value['id'] ?>">修改</a>
                                        <a class="btn btn-primary btn-sm m-2" data-bs-toggle="modal" data-bs-target="<?= '#staticBackdrop' . $value['id'] ?>">刪除</a>

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
            </div>
        <?php elseif ($_GET['table'] == "customer") : ?>
            <div class="tab-pane mt-3" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                <table class="table table-hover j align-items-start col-lg-5">
                    <thead class="mt-2">
                        <tr>
                            <th class="text-uppercase text-secondary text-center" scope="col">ID</th>
                            <th class="text-uppercase text-secondary text-center" scope="col">Account</th>
                            <th class="text-uppercase text-secondary text-center" scope="col">Name</th>
                            <th class="text-uppercase text-secondary text-center" scope="col">Email</th>
                            <th class="text-uppercase text-secondary text-center" scope="col">Phone</th>
                            <th class="text-uppercase text-secondary text-center" scope="col">操作</th>
                        </tr>
                    </thead>
                    <?php foreach ($rowsCustomer as $value) :?>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center m-4"><?= $value["id"] ?></td>
                                <td class="align-middle text-center m-4"><?= $value["account"] ?></td>
                                <td class="align-middle text-center m-4"><?= $value["name"] ?></td>
                                <td class="align-middle text-center m-4"><?= $value["email"] ?></td>
                                <td class="align-middle text-center m-4"><?= $value["phone"] ?></td>
                                <td class="align-middle text-center ps-4">
                                    <a class="btn btn-primary btn-sm me-2" href="customer.php?id=<?= $value["id"] ?>">內容</a>
                                    <a class="btn btn-primary btn-sm me-2" href="customer-edit.php?id=<?= $value["id"] ?>">修改</a>
                                    <a class="btn btn-primary btn-sm" role="button" data-bs-toggle="modal" data-bs-target="<?= '#staticBackdrop1' . $value['id'] ?>">刪除</a>

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
        <?php endif; ?>
    </div>
</div>

<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>