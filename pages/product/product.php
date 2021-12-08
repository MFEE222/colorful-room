  <?php
  require_once("../../components/pdo-connect.php");
  include_once("../var.php");
  include_once("../signin/do-authorize.php");

  //產品分類
  $sqlCategory = "SELECT * FROM category ";
  $stmt = $db_host->prepare($sqlCategory);
  try {
  $stmt->execute();
  $categoryArr = [];
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //        var_dump($row);

  //    while ($row = $stmt->fetch()) {
  //        $categoryArr[$row["id"]] = $row["name"];
  ////        var_dump($categoryArr);
  //    }
  } catch (PDOException $e) {
  echo $e->getMessage();
  }

  // 搜尋
  if (isset($_GET["s"]) && isset($_GET["cate"]) && $_GET["s"]!= "" && $_GET["cate"]!="請選擇類別") {
  $search = $_GET["s"];
  $cate = $_GET["cate"];
  $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE products.category_id=:cate AND products.name LIKE :SEARCH  ";
  $stmt = $db_host->prepare($sql);
  try {
  $stmt->execute([
  'cate' => $cate,
  'SEARCH' => '%' . $search . '%'
  ]);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  echo "search&cate";
  } catch (PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["sold"]) && $_GET["sold"]!=" " && $_GET["s"]== "" && $_GET["cate"]=="請選擇類別"){
//  echo "sold";
  $sold = $_GET["sold"];
  $sql= "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.sold_total=?";
  $stmt=$db_host->prepare($sql);
  try {
  $stmt->execute([$sold]);
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["s"]) && $_GET["s"]!= "") {
  $search = $_GET["s"];
  //        $search = '%'.$search.'%';
  $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.name LIKE :SEARCH  ";
  //    products.valid=1 AND
  $stmt = $db_host->prepare($sql);
  try {
  $stmt->execute([
  'SEARCH'=> '%'.$search.'%']);
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
//  echo "search";
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  } else if (isset($_GET["cate"]) && $_GET["cate"]!= "" ){
  $cate = $_GET["cate"];
  $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE products.category_id=? ";
  //    echo "cate1";
  $stmt = $db_host->prepare($sql);
  try {
  $stmt->execute([$cate]);
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
//  echo "cate";
  //    var_dump($rows);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["view"])){
  $sql= "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id";
  $stmt=$db_host->prepare($sql);
  try {
  $stmt->execute();
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["valid"]) && $_GET["valid"] =="1"){
  $sql= "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=1";
  $stmt=$db_host->prepare($sql);
  try {
  $stmt->execute();
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["valid"]) && $_GET["valid"] =="2"){
  $sql= "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=2";
  $stmt=$db_host->prepare($sql);
  try {
  $stmt->execute();
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }else if(isset($_GET["valid"]) && $_GET["valid"] =="0"){
  $sql= "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=0";
  $stmt=$db_host->prepare($sql);
  try {
  $stmt->execute();
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
  echo $e->getMessage();
  }
  }
  else {
  //    $sql = "SELECT * FROM products WHERE valid=1";
  $sql = "SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id
  ";
  //WHERE products.valid=1
  $stmt = $db_host->prepare($sql);
  try {
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//          echo "all";
  //        var_dump($rows);
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
  <link rel="stylesheet" href="../../assets/css/products-css/style.css">
<div class="container">
  <form action="product.php" method="get">
      <div class="mt-3 ">
          <label class="m-3" id="search">商品名稱</label>
          <input type="text" id="search" name="s" value="<?php if(isset($search))echo $search; ?>" placeholder="請輸入...">
          <!--原本-->
          <label class="m-3" id="cate">類別</label>
          <select  name="cate" id="cate">
              <option selected >請選擇類別</option>
              <?php foreach ($row as $value): ?>
                  <option value="<?php if(isset($value["category_id"]))echo $value["category_id"]; ?>" selected="<?php if(isset($value["category_id"]))echo "selected"; ?>"> <?=$value["category_name"]?> </option>
              <?php endforeach; ?>
          </select>
          <label class="m-3" id="sold">已售出</label>
          <input  type="text" id="sold"  name="sold" value="<?php if(isset($sold))echo $sold; ?>">
          <button type="submit" class="btn btn-primary mx-3">搜尋</button>
          <a type="reset"  role="button" value="Reset" class="btn btn-secondary" href="product.php">重設</a>

      </div>
  </form>
  <div>
      <ul class="nav nav-pills category-list">
          <li class="nav-item ">
              <a class="nav-link <?php if(isset($view) )echo "active" ?>" aria-current="page" href="product.php?view">全部</a>
          </li>
          <li class="nav-item ">
              <a class="nav-link <?php if(isset($valid) && $valid==="1")echo "active" ?>" href="product.php?valid=1">架上商品</a>
          </li>
          <li class="nav-item ">
              <a class="nav-link <?php if(isset($valid) && $valid==="2" )echo "active" ?>" href="product.php?valid=2">未上架</a>
          </li>
          <li class="nav-item">
              <a class="nav-link  <?php if(isset($valid) && $valid==="0" )echo "active" ?>" href="product.php?valid=0">已下架</a>
          </li>
      </ul>
  </div>

  <div class="row product-list">
      <div class="col-md-6 col-lg-4 mb-3">
          <table class="table table-hover mt-3">
              <thead  >
              <tr class="table-secondary" >
                  <th scope="col">商品名稱</th>
                  <th scope="col">類別</th>
                  <th scope="col">價格</th>
                  <th scope="col">描述</th>
                  <th scope="col">修圖前</th>
                  <th scope="col">修圖後</th>
                  <th scope="col">已售出</th>
                  <th scope="col">檔案</th>
                  <th scope="col">操作</th>
              </tr>
              </thead>
              <?php foreach($rows as $value): ?>
                  <tbody>
                  <tr>
                      <th><?=$value["name"]?></th>
                      <td><?=$value["category_name"]?></td>
                      <td><?=$value["price"]?></td>
                      <td><?=$value["descriptions"]?></td>
                      <td><?=$value["image_before"]?></td>
                      <td><?=$value["image_after"]?></td>
                      <td><?=$value["sold_total"]?></td>
                      <td><?=$value["dng_pkg"]?></td>
                      <td><a class="btn btn-primary" role="button" href="#">編輯</a> <a class="btn btn-primary" role="button" href="#">更多</a></td>
                  </tr>
                  </tbody>
              <?php endforeach; ?>
          </table>
      </div>
  </div>
<!--原本的-->
<!--  <div>-->
<!--        <ul class="nav nav-pills">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link active" aria-current="page" href="#">全部(不寫valid)</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">架上商品(valid=1)</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">未上架(valid=2)</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">已下架(valid=0)</a>-->
<!--            </li>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div class="bg-white">-->
<!--        <form>-->
<!--            <div class="mt-3">-->
<!--                <span class="m-3" id="basic-addon1">商品名稱</span>-->
<!--                <input id="basic-addon1" type="text" placeholder="請輸入...">-->
<!--                <span class="m-3" id="basic-addon1">類別</span>-->
<!--                <input id="basic-addon1" type="text" placeholder="請輸入...">-->
<!--                <span class="m-3" id="basic-addon1">已售出</span>-->
<!--                <input id="basic-addon1" type="text" placeholder="請輸入...">-->
<!--                <button type="submit" class="btn btn-primary mx-3">搜尋</button>-->
<!--                <button type="submit" class="btn btn-secondary">重設</button>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <h3 class="m-3">20 Products</h3>-->
<!--        <button type="button" class="btn btn-danger m-2">新增商品</button>-->
<!--        <button type="button" class="btn btn-light m-2">批次工具</button>-->
<!---->
<!--        <table class="table table-hover mt-3">-->
<!--            <thead>-->
<!--                <tr class="table-secondary">-->
<!--                    <th scope="col">商品名稱</th>-->
<!--                    <th scope="col">類別</th>-->
<!--                    <th scope="col">價格</th>-->
<!--                    <th scope="col">已售出</th>-->
<!--                    <th scope="col">操作</th>-->
<!--                </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--                <tr>-->
<!--                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱1</th>-->
<!--                    <td>類別1</td>-->
<!--                    <td>價格1</td>-->
<!--                    <td>已售出1</td>-->
<!--                    <td><a href="#">編輯</a> <a href="#">更多</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱2</th>-->
<!--                    <td>類別2</td>-->
<!--                    <td>價格2</td>-->
<!--                    <td>已售出2</td>-->
<!--                    <td><a href="#">編輯</a> <a href="#">更多</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>-->
<!--                    <td>類別3</td>-->
<!--                    <td>價格3</td>-->
<!--                    <td>已售出3</td>-->
<!--                    <td><a href="#">編輯</a> <a href="#">更多</a></td>-->
<!--                <tr>-->
<!--                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>-->
<!--                    <td>類別4</td>-->
<!--                    <td>價格4</td>-->
<!--                    <td>已售出4</td>-->
<!--                    <td><a href="#">編輯</a> <a href="#">更多</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><img src="https://picsum.photos/200/100" alt="Italian Trulli">商品名稱3</th>-->
<!--                    <td>類別5</td>-->
<!--                    <td>價格5</td>-->
<!--                    <td>已售出5</td>-->
<!--                    <td><a href="#">編輯</a> <a href="#">更多</a></td>-->
<!--                </tr>-->
<!--                </tr>-->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->

  <!-- body 2 > main 3 : 右側主內容下方頁尾 -->
  <?php include "../../template/body-main-footer.php" ?>

  <!-- body 3 : 右下頁面設定按鈕  -->
  <?php include "../../template/body-corner.php" ?>