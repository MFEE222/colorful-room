  <?php
  require_once("../../components/pdo-connect.php");
  include_once("../var.php");
  include_once("../signin/do-authorize.php");
  
  ?>
  <!-- html head 標籤 -->
  <!-- !!! include 中路徑記得自己改 !!! -->
  <?php include "../../template/head.php"; ?>

  <!-- body 1 : 左側功能導覽列 -->
  <?php include "../../template/body-aside.php"; ?>

  <!-- body 2 > main 1 : 右側主內容上方導覽列 -->
  <?php include "../../template/body-main-header.php" ?>

  <!-- body 2 > main 2 : 右側主內容頁 -->
  <div>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">全部(不寫valid)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">架上商品(valid=1)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">未上架(valid=2)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">已下架(valid=0)</a>
            </li>
            </li>
        </ul>
    </div>

    <!--valid=0 -> 下架 ；valid=1 -> 已上架 ; valid=2 ; 未上架 -->

    <div class="bg-white">
        <form>
            <div class="mt-3">
                <span class="m-3" id="basic-addon1">商品名稱</span>
                <input id="basic-addon1" type="text" placeholder="請輸入...">
                <span class="m-3" id="basic-addon1">類別</span>
                <input id="basic-addon1" type="text" placeholder="請輸入...">
                <span class="m-3" id="basic-addon1">已售出</span>~<span class="m-3" id="basic-addon2">已售出</span>
                <input id="basic-addon1" type="text" placeholder="請輸入...">
                <button type="submit" class="btn btn-primary mx-3">搜尋</button>
                <button type="submit" class="btn btn-secondary">重設</button>
            </div>
        </form>

        <h3 class="m-3">20 Products</h3>
        <button type="button" class="btn btn-danger m-2">新增商品</button>
        <button type="button" class="btn btn-light m-2">批次工具</button>

        <table class="table table-hover mt-3">
            <thead>
                <tr class="table-secondary">
                    <th scope="col">商品名稱</th>
                    <th scope="col">類別</th>
                    <th scope="col">價格</th>
                    <th scope="col">已售出</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱1</th>
                    <td>類別1</td>
                    <td>價格1</td>
                    <td>已售出1</td>
                    <td><a href="#">編輯</a> <a href="#">更多</a></td>
                </tr>
                <tr>
                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱2</th>
                    <td>類別2</td>
                    <td>價格2</td>
                    <td>已售出2</td>
                    <td><a href="#">編輯</a> <a href="#">更多</a></td>
                </tr>
                <tr>
                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>
                    <td>類別3</td>
                    <td>價格3</td>
                    <td>已售出3</td>
                    <td><a href="#">編輯</a> <a href="#">更多</a></td>
                <tr>
                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>
                    <td>類別4</td>
                    <td>價格4</td>
                    <td>已售出4</td>
                    <td><a href="#">編輯</a> <a href="#">更多</a></td>
                </tr>
                <tr>
                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>
                    <td>類別5</td>
                    <td>價格5</td>
                    <td>已售出5</td>
                    <td><a href="#">編輯</a> <a href="#">更多</a></td>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>

  <!-- body 2 > main 3 : 右側主內容下方頁尾 -->
  <?php include "../../template/body-main-footer.php" ?>

  <!-- body 3 : 右下頁面設定按鈕  -->
  <?php include "../../template/body-corner.php" ?>