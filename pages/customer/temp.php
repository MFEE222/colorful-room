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
                                    <a class="btn btn-primary btn-sm" href="member.php?id=<?= $value["id"] ?>">內容</a>
                                    <a class="btn btn-primary btn-sm" href="member-edit.php?id=<?= $value["id"] ?>">修改</a>
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
                                    <a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="<?= '#staticBackdrop1' . $value['id'] ?>">刪除</a>
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