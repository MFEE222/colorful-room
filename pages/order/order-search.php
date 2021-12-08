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
//  勾選方框
//  訂單編號：可點擊連結到訂單明細，側邊有『排序按鈕』
//  顧客名稱：側邊有『排序按鈕』
//  建立時間：側邊有『排序按鈕』
//  修改時間：側邊有『排序按鈕』
//  付款狀態：側邊有『排序按鈕』
//  付款方式：側邊有『排序按鈕』(考慮放明細？)
//  退貨狀態：側邊有『排序按鈕』
//  金額：側邊有『排序按鈕』
// ============================================================================
//  Flow
// ============================================================================
// 搜尋：
//  輸入關鍵字 -> 回車鍵 -> 進入資料庫查詢
//  點擊篩選條件 -> 進入資料庫查詢


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

        </div>
    </div>

    <div class="row">

    </div>

    <script>
        var input = document.querySelector("#order-search-input");

        input.addEventListener('keyup', function(event) {
            // number 13 is the 'enter' key on the keyboard
            if (event.keyCode === 13) {
                // cancel the default action, if needed
                event.preventDefault();
                // trigger the button element to submit form
                document.querySelector('#order-search-submit').click();
            }
        })
    </script>
</div>


<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>