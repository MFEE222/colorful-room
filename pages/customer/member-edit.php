<?php
include_once('../var.php');
include_once("../signin/do-authorize.php");

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
    //    $rowsMember=$stmt->fetch();
    $rowsCountMember = $stmt->rowCount();
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
            <?php if ($rowsCountMember == 0) : ?>
                <p class="font-bold">使用者不存在</p>
            <?php else :
                $rowsMember = $stmt->fetch();
            ?>
                <form action="memberDoUpdate.php" method="post">
                    <div class="mb-3 input-group-sm">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $rowsMember["id"] ?>" readonly>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" id="account" name="account" value="<?= $rowsMember["account"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $rowsMember["name"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $rowsMember["email"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $rowsMember["phone"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" value="<?= $rowsMember["birthday"] ?>">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="gender" class="form-label">性別</label> <span class="text-secondary"> male:1;female:0</span>
                        <input type="text" class="form-control" id="gender" name="gender" value="<?= $rowsMember["gender"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="subscribe" class="form-label">訂閱方案</label> <span class="text-secondary">會員原先訂閱方案:<?= $rowsMember["subscribe"] ?></span>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm " name="subscribe">
                            <option selected>請選擇訂閱方案</option>
                            <option value="1">30天</option>
                            <option value="2">60天</option>
                            <option value="3">90天</option>
                            <option value="4">1年</option>
                        </select>
                        <!--                    <input type="text" class="form-control" id="subscribe" name="subscribe" value="--><? //=$rowsMember["subscribe"]
                                                                                                                                    ?>
                        <!--">-->
                        <!--                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tag" required>-->
                        <!--                        <option value="1" --><?php //if(isset($rowsMember) && $rowsMember["tag_id"]===1 )echo "selected" 
                                                                            ?>
                        <!--</option>-->
                        <!--                        <option value="2" --><?php //if(isset($rowsMember) && $rowsMember["tag_id"]===2 )echo "selected" 
                                                                            ?>
                        <!--</option>-->
                        <!--                    </select>-->
                    </div>
                    <div class="mb-3">
                        <label for="tag">會員等級</label> <span class="text-secondary">會員原先等級:<?= $rowsMember["tag_name"] ?></span>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tag">
                            <option value="1">VIP</option>
                            <option value="2" selected>一般會員</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">送出</button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">確認修改會員嗎?</h5>
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
    </div>
</div>
<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>