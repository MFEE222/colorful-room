<?php
include_once("../var.php");
include('../signin/do-authorize.php');

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
//  建立時間：側邊有『排序按鈕』
//  修改時間：側邊有『排序按鈕』
//  付款狀態：側邊有『排序按鈕』
//  付款方式：側邊有『排序按鈕』(考慮放明細？)
//  退貨狀態：側邊有『排序按鈕』
//  金額：側邊有『排序按鈕』
// 分頁功能
// ============================================================================
//  Flow
// ============================================================================
// 搜尋：
//  輸入關鍵字 -> 回車鍵 -> 進入資料庫查詢
//  點擊篩選條件 -> 進入資料庫查詢


$order_search_keyword = $_GET['order_search_keyword'];


function get($query_string)
{
    if (isset($_GET[$query_string]) && !empty($_GET[$query_string]))
        return $_GET[$query_string];
    return '';
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
                        <!-- <div class="text-white ps-4">
                            <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                        </div> -->
                        <p class="h3 text-white px-4 py-3">訂單管理</p>
                    </div>
                    <!-- <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sales</p>
                        <h4 class="mb-0">$103,430</h4>
                    </div> -->
                </div>
                <hr class="dark horizontal my-0">
                <!-- card 2 body -->
                <div class="card-body p-3">
                    <form action="./do-order-search.php" method="POST" role="form">
                        <!-- form : input keyword -->
                        <div class="row px-3 py-2">
                            <div class="col-auto form-group">
                                <label for="order-search-input" class="form-label m-0 font-weight-bold">Order Search</label>
                                <input type="text" class="form-control border-bottom border-2 rounded-0 py-1" id="order-search-input" placeholder="enter keyword..." name="order-search-keyword" value="<?= get('order_search_keyword') ?>">
                                <small class="form-text text-muted">order number, member name, member account, member phone</small>
                                <!-- <small class="form-text text-muted">訂單編號 / 會員名稱 / 帳號 / 電話</small> -->
                                <span class="form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- form : filter -->
                        <div class="row px-3 py-2">
                            <div class="form-check">
                                <label for="1-month" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="" id="1-month">
                                    + 1 month
                                </label>
                            </div>
                        </div>
                        <!-- form : submit !is hidden! -->
                        <div class="row">
                            <button type="submit" id="order-search-submit" class="d-none"></button>
                        </div>
                    </form>
                </div>
                <hr class="dark horizontal my-0">
                <!-- card 3 body -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Job Position</th>
                                <th>Since</th>
                                <th class="text-right">Salary</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Andrew Mike</td>
                                <td>Develop</td>
                                <td>2013</td>
                                <td class="text-right">&euro; 99,225</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>John Doe</td>
                                <td>Design</td>
                                <td>2012</td>
                                <td class="text-right">&euro; 89,241</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-round">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Alex Mike</td>
                                <td>Design</td>
                                <td>2010</td>
                                <td class="text-right">&euro; 92,144</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-simple">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- card 3 footer -->
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

    <script>
        // order search input 
        var input = document.querySelector("#order-search-input");

        input.addEventListener('keyup', function(event) {
            // number 13 is the 'enter' key on the keyboard
            if (event.keyCode === 13) {
                // cancel the default action, if needed
                event.preventDefault();
                // trigger the button element to submit form
                document.querySelector('#order-search-submit').click();
            }
        });
    </script>
</div>


<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>