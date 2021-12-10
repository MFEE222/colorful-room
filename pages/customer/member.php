<?php
include_once('../var.php');
include_once("../signin/do-authorize.php");

// ============================================================================
//  返回 Order Search
// ============================================================================
$from = (!empty($_POST['from'])) ? $_POST['from'] : NULL;
// ============================================================================
//  ...  
// ============================================================================
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
$sqlMember = "SELECT member. *,tag.name AS tag_name FROM member
JOIN tag ON member.tag_id = tag.id
WHERE  member.id=? AND member.valid=1";

//$sqlMember="SELECT * FROM member WHERE valid=1";
$stmt = $db_host->prepare($sqlMember);
try {
    $stmt->execute([$id]);
    $rowsMember = $stmt->fetch();
    //    $rowsCountMember=$stmt->rowCount();
    //    var_dump($rows);
} catch (PDOException $e) {
    echo $e->getMessage();
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="py-2 my-3">
                <?php if ($from != NULL) : ?>
                    <a href="<?= $from ?>" class="btn btn-primary">回列表</a>
                <?php else : ?>
                    <a href="<?= $url_page_user_list ?>" class="btn btn-primary">回列表</a>
                <?php endif; ?>
            </div>
            <table class="table table-bordered table-hover table-sm">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Account</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">生日</th>
                        <th scope="col">性別</th>
                        <th scope="col">訂閱方案</th>
                        <th scope="col">標籤</th>
                        <th scope="col">建立時間</th>
                        <th scope="col">修改時間</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $rowsMember["id"] ?></td>
                        <td><?= $rowsMember["account"] ?></td>
                        <td><?= $rowsMember["name"] ?></td>
                        <td><?= $rowsMember["email"] ?></td>
                        <td><?= $rowsMember["phone"] ?></td>
                        <td><?= $rowsMember["birthday"] ?></td>
                        <td><?= $rowsMember["gender"] ?></td>
                        <td><?= $rowsMember["subscribe"] ?></td>
                        <td><?= $rowsMember["tag_name"] ?></td>
                        <td><?= $rowsMember["created_at"] ?></td>
                        <td><?= $rowsMember["edit_at"] ?></td>
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