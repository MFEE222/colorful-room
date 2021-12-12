<?php
require_once("../../components/pdo-connect.php");
include_once("../var.php");
include_once("../signin/do-authorize.php");
//全部商品
$sqlValidAll = "SELECT COUNT(valid) FROM products ";
// $sqlValidAll = "SELECT COUNT(valid) AS 'pd' FROM products WHERE valid=1";
$stmt = $db_host->prepare($sqlValidAll);
$stmt->execute();
$rowAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $row = $stmt->fetch();
// var_dump($rowAll);
// echo $rowAll[0]["COUNT(valid)"] . '<br>';

//valid=0 已下架
$sqlValid0 = "SELECT COUNT(valid) FROM products WHERE valid=0";
$stmt = $db_host->prepare($sqlValid0);
$stmt->execute();
$row0 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo $row0[0]["COUNT(valid)"];
//echo "$count0";

//valid=1架上
$sqlValid1 = "SELECT COUNT(valid) FROM products WHERE valid=1";
$stmt = $db_host->prepare($sqlValid1);
$stmt->execute();
$row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo $row1[0]["COUNT(valid)"];

//valid=2 未上架
$sqlValid2 = "SELECT COUNT(valid) FROM products WHERE valid=2";
$stmt = $db_host->prepare($sqlValid2);
$stmt->execute();
$row2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo $row2[0]["COUNT(valid)"];

//new
$conditions=[];
$parameters=[];
if (!empty($_GET["s"]) && !empty($_GET["cate"] ) && $_GET["cate"] != "請選擇類別"){
    $search = $_GET["s"];
    $cate = $_GET["cate"];
    $conditions []= 'products.category_id:cate AND  products.name LIKE :SEARCH ';
    $parameters []=  ['cate' => $cate,];
    $parameters []= ['SEARCH' => '%' . $search . '%'];
}

if (!empty($_GET["sold_min"]) && !empty($_GET["sold_max"])){
    $conditions []='products.sold_total >=? AND  products.sold_total <=? ORDER BY products.sold_total ASC';
    $parameters []='$_GET["sold_min"],$_GET["sold_max"]';
}

if (!empty($_GET["s"])){
    $conditions []='products.name LIKE ?';
    $parameters []=['%' . $_GET["s"] . '%'];
}

if (!empty($_GET["cate"])){
    $conditions []= 'products.category_id=?';
    $parameters []= '$_GET["cate"';
}


if (!empty( $_GET["valid"]) && $_GET["valid"]==="1"){
    $conditions []='products.valid=1';
    $parameters []='$_GET["valid"]';
}

if (!empty( $_GET["valid"]) && $_GET["valid"] == "2"){
    $conditions []='products.valid=2';
    $parameters []='$_GET["valid"]';
}

if (!empty( $_GET["valid"]) && $_GET["valid"] == "0"){
    $conditions []='products.valid=0';
    $parameters []='$_GET["valid"]';
}
$sql="SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id";

if ($conditions)
{
    $sql .= " WHERE ".implode($conditions);
}

// the usual prepare/execute/fetch routine
$stmt = $db_host->prepare($sql);
//丟入參數
$stmt->execute($parameters);
$rows = $stmt->fetchAll();

//var_dump($rows);

?>

<!-- html head 標籤 -->
<!-- !!! include 中路徑記得自己改 !!! -->
<?php include "../../template/head.php"; ?>

<!-- body 1 : 左側功能導覽列 -->
<?php include "../../template/body-aside.php";
?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div class="container">
    <form action="products-test.php" method="get">
        <div class="row mt-3 justify-content-evenly">
            <div class="col-lg-3 d-flex align-items-center ">
                <label class="my-0 me-3 form-label text-nowrap" id="search">商品名稱</label>
                <input type="search" class="form-control border border-secondary "id="search" name="s" value="<?php if (isset($search))echo $search; ?>" placeholder="請輸入...">
            </div>

            <div class="col-lg-3 d-flex align-items-center ">
                <label class="my-0 me-3 form-label text-nowrap" id="cate">類別</label>
                <select name="cate" id="cate" class="form-control border border-secondary">
                    <option selected>請選擇類別</option>
                    <!--                selected="--><?php //if (isset($value["category_id"])) echo "selected";
                    ?>
                    <?php foreach ($rows as $value) : ?>
                        <option value="<?=$value["category_id"] ?>" <?php if (isset($_GET["cate"]) && $_GET["cate"]==$value["category_id"]) echo "selected";
                        ?>> <?= $value["category_name"] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-lg-4 d-flex align-items-center ">
                <label class="me-3 my-0 text-nowrap" id="sold">已售出</label>
                <input class="form-control border border-secondary" type="text" id="sold" name="sold_min" value="<?php if (isset($sold_min)) echo $sold_min; ?>">
                <span class="mx-2">~</span>
                <input class="form-control border border-secondary" type="text" id="sold" name="sold_max" value="<?php if (isset($sold_max)) echo $sold_max; ?>">
            </div>

            <div class="col-lg-2 d-flex align-items-center ">
                <button type="submit" class="btn btn-primary text-nowrap m-0">搜尋</button>
                <a type="reset" class="btn btn-primary m-0 text-nowrap m-3" role="button" href="products-test.php">重設</a>
            </div>
    </form>

    <div class="col-lg-12 d-flex justify-content-start ">
        <a class="btn btn-lg btn-success my-4"  role="button"  href="product-add.php">商品上架</a>
    </div>

    <div class="d-flex mt-2">
        <ul class="nav nav-pills category-list mb-2">
            <li class="nav-item <?php if (isset($view)) echo "active"; ?>">
                <a class="nav-link " aria-current="page" href="products-test.php?view">全部<span class="badge text-dark"><?php echo $rowAll[0]["COUNT(valid)"];?></span></a>
            </li>
            <li class="nav-item <?php if (isset($valid) && $valid === "1") echo "active"; ?>">
                <a class="nav-link " href="products-test.php?valid=1">架上商品<span class="badge text-dark"><?php echo $row1[0]["COUNT(valid)"]; ?></span></span></a>
            </li>
            <li class="nav-item <?php if (isset($valid) && $valid === "2") echo "active"; ?>">
                <a class="nav-link " href="products-test.php?valid=2">未上架<span class="badge text-dark"><?php echo $row2[0]["COUNT(valid)"];; ?></span></a>
            </li>
            <li class="nav-item <?php if (isset($valid) && $valid === "0") echo "active"; ?>">
                <a class="nav-link " href="products-test.php?valid=0">已下架<span class="badge text-dark"><?php echo $row0[0]["COUNT(valid)"];; ?></span></a>
            </li>
        </ul>
    </div>

    <div class="row product-list">
        <div class="col-lg-12 mb-3">
            <table class="table table-hover align-items-center mt-3">
                <thead>
                    <tr class="table-secondary">
                        <th class="align-middle ps-1" scope="col">商品名稱</th>
                        <th class="align-middle ps-1" scope="col">商品狀態</th>
                        <th class="align-middle ps-1" scope="col">類別</th>
                        <th class="align-middle ps-1" scope="col">價格</th>
                        <th class="align-middle ps-1" scope="col">描述</th>
                        <th class="align-middle ps-1" scope="col">修圖前</th>
                        <th class="align-middle ps-1" scope="col">修圖後</th>
                        <th class="align-middle ps-1" scope="col">已售出</th>
                        <th class="align-middle ps-1" scope="col">檔案</th>
                        <th class="align-middle ps-1" scope="col">操作</th>
                    </tr>
                </thead>
                <?php foreach ($rows as $value) : ?>
                    <tbody>
                        <tr>
                            <td class="ps-1"><?= $value["name"] ?></td>
                            <td class="ps-1"><?php switch ($value["valid"]):
                                    case "0":
                                        echo "已下架";
                                        break;
                                    case "1":
                                        echo "架上商品";
                                        break;
                                    case "2":
                                        echo "未上架";
                                        break;
                                ?>
                                <?php endswitch; ?>
                            </td>
                            <td class="ps-1"><?= $value["category_name"] ?></td>
                            <td class="ps-1"><?= $value["price"] ?></td>
                            <td class="ps-1"><?= $value["descriptions"] ?></td>
                            <td class="ps-1"><?= $value["image_before"] ?></td>
                            <td class="ps-1"><?= $value["image_after"] ?></td>
                            <td class="ps-1"><?= $value["sold_total"] ?></td>
                            <td class="ps-1"><?= $value["dng_pkg"] ?></td>
                            <td class="ps-1"><a class="btn btn-primary" role="button" href="#">編輯</a> <a class="btn btn-primary" role="button" href="#">更多</a></td>
                        </tr>
                    </tbody>

                <?php endforeach; ?>
            </table>
        </div>
    </div>


    <!-- body 2 > main 3 : 右側主內容下方頁尾 -->
    <?php include "../../template/body-main-footer.php" ?>

    <!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>