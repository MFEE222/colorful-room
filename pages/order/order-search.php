<?php
include_once("../var.php");
include('../signin/do-authorize.php');
// ============================================================================
//  Reminder
// ============================================================================
//  1. orders_detail table 同樣的 orders_id 會有不同的 member_id
//  2. 
// ============================================================================
//  Structure
// ============================================================================
// 搜尋：
//  搜尋輸入
//  確認按鈕（考慮不做，離開輸入狀態直接搜尋？）
//  篩選條件
// 欄位：
//  勾選方框（應該不需要，訂單沒有多選執行動作）
//  訂單編號：可點擊連結到訂單明細，側邊有『排序按鈕』
//  顧客名稱：側邊有『排序按鈕』
//  顧客電話：側邊有『排序按鈕』
//  建立時間：側邊有『排序按鈕』
//      修改時間：側邊有『排序按鈕』
//  訂單狀態：側邊有『排序按鈕』
//      付款方式：側邊有『排序按鈕』(考慮放明細？超商代碼付款、線上刷卡、第三方支付)
//  付款狀態
//  退貨狀態：側邊有『排序按鈕』
//  金額：側邊有『排序按鈕』
//  ** 排序按鈕用 JavaScript 做
// 篩選器：
//  時間區段(當天、當週、當月、當季、當年度、自定義區段)
//  訂單狀態（待付款、已付款、已取消、退貨中、已退貨）
//  
// 分頁功能
// ============================================================================
//  Flow
// ============================================================================
// 搜尋：
//  輸入關鍵字 -> 回車鍵 -> 進入資料庫查詢
//  點擊篩選條件 -> 進入資料庫查詢

class OrderSearch
{
    public $form_action = './do-order-search.php';
    public $page_header = '訂單管理';
    public $search_header = '搜尋訂單';
    public $search_keyword_hint = '訂單編號 or 會員名稱 or 會員電話';
}
$os = new OrderSearch();

// Get parameter
//  - keyword
//  - filter_time
//  - filter_status

// Session (array)
$orders_head = ["total"=>0];
$orders_body = [];
if (isset($_SESSION['orders_head']))
    $orders_head = $_SESSION['orders_head'];
if (isset($_SESSION['orders_body']))
    $orders_body = $_SESSION['orders_body'];

function get($query_string)
{
    if (isset($_GET[$query_string]))
        return $_GET[$query_string];
    return '';
}

function status_desc($sts_id)
{
    switch ($sts_id) {
        case 1:
            return '未付款';
        case 2:
            return '已付款';
        case 3:
            return '已取消';
        case 4:
            return '退貨中';
        case 5:
            return '已退貨';
    }
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
<div class="container-fluid py-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- card 1 : header -->
                <div class="card-header d-flex p-3 pt-2">
                    <div class="d-flex align-items-center align-content-center bg-gradient-info shadow-info text-center border-radius-xl mt-n4">
                        <p class="h3 text-white px-4 py-3"><?= $os->page_header ?></p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <!-- card 2 body -->
                <div class="card-body p-3">
                    <form action="<?= $os->form_action ?>" method="POST" role="form">
                        <!-- 關鍵字搜尋 -->
                        <div class="row px-3 py-2">
                            <div class="col-4 form-group">
                                <label for="s_keyword" class="form-label m-0 font-weight-bold h5 text-dark"><?= $os->search_header ?></label>
                                <input type="text" class="form-control border-bottom border-2 rounded-0 py-1" id="s_keyword" placeholder="enter keyword..." name="keyword" value="<?= get('keyword') ?>">
                                <small class="form-text text-muted"><?= $os->search_keyword_hint ?></small>
                                <span class="form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- 篩選器：時間 -->
                        <!-- 
                        <div>
                            <div class="form-check form-check-inline m-0 ps-3">
                                <label for="ft_none" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '0') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_none" name="filter_time" value="0" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_none" name="filter_time" value="0">
                                    <?php endif; ?>
                                    無
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="ft_today" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '1') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_today" name="filter_time" value="1" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_today" name="filter_time" value="1">
                                    <?php endif; ?>
                                    當日
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="ft_week" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '2') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_week" name="filter_time" value="2" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_week" name="filter_time" value="2">
                                    <?php endif; ?>
                                    當週
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="ft_month" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '3') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_month" name="filter_time" value="3" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_month" name="filter_time" value="3">
                                    <?php endif; ?>
                                    當月
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="ft_season" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '4') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_season" name="filter_time" value="4" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_season" name="filter_time" value="4">
                                    <?php endif; ?>
                                    當季
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="ft_year" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_time') === '5') : ?>
                                        <input type="radio" class=" form-check-input" id="ft_year" name="filter_time" value="5" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="ft_year" name="filter_time" value="5">
                                    <?php endif; ?>
                                    當年度
                                </label>
                            </div>

                        </div> -->

                        <!-- 篩選器：訂單狀態 -->
                        <div>
                            <div class="form-check form-check-inline m-0 ps-3">
                                <label for="fs_none" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '0') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_none" name="filter_status" value="0" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_none" name="filter_status" value="0">
                                    <?php endif; ?>
                                    <!-- none -->
                                    無
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="fs_non_payment" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '1') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_non_payment" name="filter_status" value="1" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_non_payment" name="filter_status" value="1">
                                    <?php endif; ?>
                                    <!-- non-payment -->
                                    未付款
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="fs_paid" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '2') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_paid" name="filter_status" value="2" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_paid" name="filter_status" value="2">
                                    <?php endif; ?>
                                    <!-- paid -->
                                    已付款
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="fs_cancelled" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '3') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_cancelled" name="filter_status" value="3" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_cancelled" name="filter_status" value="3">
                                    <?php endif; ?>
                                    <!-- cancelled -->
                                    已取消
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="fs_returning" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '4') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_returning" name="filter_status" value="4" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_returning" name="filter_status" value="4">
                                    <?php endif; ?>
                                    <!-- returning -->
                                    退貨中
                                </label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <label for="fs_returned" class="form-check-label text-dark ms-0">
                                    <?php if (get('filter_status') === '5') : ?>
                                        <input type="radio" class=" form-check-input" id="fs_returned" name="filter_status" value="5" checked>
                                    <?php else : ?>
                                        <input type="radio" class=" form-check-input" id="fs_returned" name="filter_status" value="5">
                                    <?php endif; ?>
                                    <!-- returned -->
                                    已退貨
                                </label>
                            </div>

                        </div>
                        <!-- 表單提交按鈕 : 隱藏-->
                        <div class="row">
                            <button type="submit" id="s_submit" class="d-none"></button>
                        </div>
                    </form>
                </div>
                <!-- row head info -->
                <div>
                    <p class="h6 p-3 me-3 float-end">
                        共
                        <?= $orders_head['total'] ?>
                        筆
                    </p>
                </div>
                <hr class="dark horizontal my-0">
                <!-- card 3 body -->
                <div class="card-body p-3">

                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="px-3 align-middle text-center text-dark">訂單編號</th>
                                <th class="px-3 align-middle text-center text-dark">顧客名稱</th>
                                <th class="px-3 align-middle text-center text-dark">顧客電話</th>
                                <th class="px-3 align-middle text-center text-dark">建立時間</th>
                                <th class="px-3 align-middle text-center text-dark">訂單狀態</th>
                                <th class="px-3 align-middle text-center text-dark">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 
                            <tr>
                                <td class="p-0 text-center text-dark">測試用｜443
                                </td>
                                <td class="p-0 text-center text-dark">多多</td>
                                <td class="p-0 text-center text-dark">123456789</td>
                                <td class="p-0 text-center text-dark">2021-12-07 07:59:51</td>
                                <td class="p-0 text-center text-dark">Paid</td>
                                <td class="p-0 text-center text-dark">
                                    <div class="mt-3">
                                        <form action="<?= $url_page_member . '?id=1' ?>" method="POST" class="d-inline">
                                            <?php $from = $url_page_order_search . '?keyword=' . get('keyword') . '&filter_time=' . get('filter_time') . '$filter_status=' . get('filter_status');  ?>
                                            <input type="text" name="from" value="<?= $from ?>" class="d-none">
                                            <button type="submit" rel="tooltip" class="btn btn-round btn-success px-3">
                                                <i class="material-icons">person</i>
                                                Member
                                            </button>
                                        </form>
                                        <a href="<?= $url_page_order_detail . '?id=12'  ?>" rel="tooltip" class="btn btn-round btn-danger px-3">
                                            <i class="material-icons">receipt</i>
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            -->
                            <?php foreach ($orders_body as $order) : ?>
                                <tr>
                                    <td class="p-0 text-center text-dark"><?= $order['id'] ?></td>
                                    <td class="p-0 text-center text-dark"><?= $order['member_name'] ?></td>
                                    <td class="p-0 text-center text-dark"><?= $order['member_phone'] ?></td>
                                    <td class="p-0 text-center text-dark"><?= $order['created_at'] ?></td>
                                    <td class="p-0 text-center text-dark"><?= status_desc($order['status_id']) ?></td>
                                    <td class="p-0 text-center text-dark">
                                        <div class="mt-3">
                                            <form action="<?= $url_page_member . '?id=' . $order['member_id'] ?>" method="POST" class="d-inline">
                                                <?php $from = $url_page_order_search . '?keyword=' . get('keyword') . '&filter_time=' . get('filter_time') . '$filter_status=' . get('filter_status');  ?>
                                                <input type="text" name="from" value="<?= $from ?>" class="d-none">
                                                <button type="submit" rel="tooltip" class="btn btn-round btn-info px-3">
                                                    <i class="material-icons">person</i>
                                                    Member
                                                </button>
                                            </form>
                                            <a href="<?= $url_page_order_detail . '?id=' . $order['id'] ?>" rel="tooltip" class="btn btn-round btn-danger px-3">
                                                <i class="material-icons">receipt</i>
                                                Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- card 3 footer -->
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <!-- <p class="px-3 mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

    <script>
        // order search keyword 
        var input = document.querySelector("#s_keyword");

        input.addEventListener('keyup', function(event) {
            // number 13 is the 'enter' key on the keyboard
            if (event.keyCode === 13) {
                // cancel the default action, if needed
                event.preventDefault();
                // trigger the button element to submit form
                document.querySelector('#s_submit').click();
            }
        });
        // order search filter
        var filters = document.querySelectorAll(`form input[type="radio"]`);

        filters.forEach(function(element) {
            element.addEventListener('change', function(event) {
                event.preventDefault();
                document.querySelector('#s_submit').click();
            })
        });
    </script>
</div>


<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>