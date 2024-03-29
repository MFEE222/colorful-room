<head>
    <link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">
</head>



<?php
require_once("../../components/pdo-connect.php");
include_once("../var.php");
include_once("../signin/do-authorize.php");


//group by
//$sql="SELECT  COUNT(valid) FROM products GROUP BY valid ";
//$stmt = $db_host->prepare($sql);
//$stmt->execute();
//$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($row);
//echo $row[0]["COUNT(valid)"];
//echo $row[1]["COUNT(valid)"];
//echo $row[2]["COUNT(valid)"];

// valid badge
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
// 名稱排序 名稱遞減、名稱遞增、價格遞增、價格遞減
if (isset($_GET["order"])) {
    //    echo "Line: ", __LINE__ . "<br>";
    $order = $_GET["order"];
    if ($order === "nameDesc") {
        $sql = " SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id ORDER BY name DESC LIMIT 50";
    } else if ($order === "nameAsc") {
        $sql = " SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id ORDER BY name ASC LIMIT 50";
    } else if ($order === "priceAsc") {
        $sql = " SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id ORDER BY price ASC LIMIT 50";
    } else if ($order === "priceDesc") {
        $sql = " SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id ORDER BY price DESC LIMIT 50";
    }
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //  echo "search&cate";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 名稱 ＋ 類別搜尋
else if (isset($_GET["s"]) && isset($_GET["cate"]) && $_GET["s"] != "" && $_GET["cate"] != "請選擇類別") {

    //    echo "Line: ", __LINE__ . "<br>";
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
}
// 已售出 數量搜尋
else if (isset($_GET["sold_min"]) && $_GET["sold_min"] != " " && isset($_GET["sold_max"]) && $_GET["sold_max"] != " " && $_GET["s"] == "" && $_GET["cate"] == "請選擇類別") {
    //    echo "Line: ", __LINE__ . "<br>";
    //    echo "sold";
    $sold_min = $_GET['sold_min'];
    $sold_max = $_GET['sold_max'];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.sold_total >=? AND  products.sold_total <=? ORDER BY products.sold_total DESC ";
    $stmt = $db_host->prepare($sql);
    //    echo "sold 2";
    try {
        $stmt->execute([$sold_min, $sold_max]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 單純名字搜尋
else if (isset($_GET["s"]) && $_GET["s"] != "") {
    //    echo "Line: ", __LINE__ . "<br>";
    $search = $_GET["s"];
    print_r('%' . $search . '%');
    //        $search = '%'.$search.'%';
    $sql = "SELECT products.*,
                   category.*
                FROM products
                JOIN category ON products.category_id = category.category_id
            WHERE  products.name LIKE :SEARCH";
    //    products.valid=1 AND
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute([
            ':SEARCH' => '%' . $search . '%'
        ]);
        var_dump($stmt->rowCount());
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //  echo "search";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 單純類別搜尋
else if (isset($_GET["cate"]) && $_GET["cate"] != "") {
    //    echo "Line: ", __LINE__ . "<br>";
    $cate = $_GET["cate"];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE products.category_id=? ";
    //    echo "cate1";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute([$cate]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //  echo "cate";
        //    var_dump($rows);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 全部商品
else if (isset($_GET["view"])) {
    //    echo "Line: ", __LINE__ . "<br>";
    $view = $_GET['view'];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id LIMIT 50";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 架上商品
else if (isset($_GET["valid"]) && $_GET["valid"] == "1") {
    //    echo "Line: ", __LINE__ . "<br>";
    $valid = $_GET['valid'];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=1 LIMIT 50";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 未上架商品
else if (isset($_GET["valid"]) && $_GET["valid"] == "2") {
    //    echo "Line: ", __LINE__ . "<br>";
    $valid = $_GET['valid'];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=2 LIMIT 50";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 已下架商品
else if (isset($_GET["valid"]) && $_GET["valid"] == "0") {
    //    echo "Line: ", __LINE__ . "<br>";
    $valid = $_GET['valid'];
    $sql = "SELECT products. *, category. * FROM products
  JOIN category ON products.category_id = category.category_id
  WHERE  products.valid=0 LIMIT 50";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// 預設情況
else {
    //    echo "Line: ", __LINE__ . "<br>";
    //    $sql = "SELECT * FROM products WHERE valid=1";
    $sql = "SELECT products. *,category. * FROM products
  JOIN category ON products.category_id = category.category_id LIMIT 50
  ";
    //WHERE products.valid=1
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $validAll = $stmt->rowCount();
        //                  echo "$validAll";
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
<?php include "../../template/body-aside.php";
?>

<!-- body 2 > main 1 : 右側主內容上方導覽列 -->
<?php include "../../template/body-main-header.php" ?>

<!-- body 2 > main 2 : 右側主內容頁 -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- card 1 : header -->
                <div class="card-header d-flex p-3 pt-2">
                    <div class="d-flex align-items-center align-content-center bg-gradient-success shadow-info text-center border-radius-xl mt-n4">
                        <p class="h3 text-white px-4 py-3">商品管理</p>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <!-- card 2 body -->
                <div class="card-body p-3">
                    <!-- <img src="../../assets/img/products/before/" alt=""> -->
                    <form action="product.php" method="get">
                        <div class="row mt-3 justify-content-evenly">
                            <div class="col-lg-3 d-flex align-items-center ">
                                <label class="my-0 me-3 form-label text-nowrap" id="search">商品名稱</label>
                                <input type="search" class="form-control border border-secondary " id="search" name="s" value="<?php if (isset($search)) echo $search; ?>" placeholder="請輸入...">
                            </div>

                            <div class="col-lg-3 d-flex align-items-center ">
                                <label class="my-0 me-3 form-label text-nowrap" id="cate">類別</label>
                                <select name="cate" id="cate" class="form-control border border-secondary">
                                    <option selected>請選擇類別</option>
                                    <!--                selected="--><?php //if (isset($value["category_id"])) echo "selected";
                                                                        ?>
                                    <?php foreach ($row as $value) : ?>
                                        <option value="<?= $value["category_id"] ?>" <?php if (isset($_GET["cate"]) && $_GET["cate"] == $value["category_id"]) echo "selected";
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
                                <a type="reset" class="btn btn-primary m-0 text-nowrap m-3" role="button" href="product.php">重設</a>
                            </div>
                        </div>
                    </form>

                    <div class="col-lg-4 d-flex justify-content-center">
                        <a class="btn btn-lg btn-success my-4" role="button" href="product-add.php">商品上架</a>
                    </div>

                    <div class="d-flex mt-2 justify-content-between">
                        <ul class="nav nav-pills category-list mb-2">
                            <li class="nav-item <?php if (isset($view)) echo "active"; ?>">
                                <a class="nav-link " aria-current="page" href="product.php?view">全部<span class="badge text-dark"><?php echo $rowAll[0]["COUNT(valid)"]; ?></span></a>
                            </li>
                            <li class="nav-item <?php if (isset($valid) && $valid === "1") echo "active"; ?>">
                                <a class="nav-link " href="product.php?valid=1">架上商品<span class="badge text-dark"><?php echo $row1[0]["COUNT(valid)"]; ?></span></span></a>
                            </li>
                            <li class="nav-item <?php if (isset($valid) && $valid === "2") echo "active"; ?>">
                                <a class="nav-link " href="product.php?valid=2">未上架<span class="badge text-dark"><?php echo $row2[0]["COUNT(valid)"];; ?></span></a>
                            </li>
                            <li class="nav-item <?php if (isset($valid) && $valid === "0") echo "active"; ?>">
                                <a class="nav-link " href="product.php?valid=0">已下架<span class="badge text-dark"><?php echo $row0[0]["COUNT(valid)"];; ?></span></a>
                            </li>
                        </ul>
                        <div class="py-2 d-flex justify-content-end order-block">
                            <div>排序
                                <a class="<?php if (isset($order) && $order === "nameDesc") echo "active" ?> font-weight-bold" href="product.php?order=nameDesc">名稱 ↓</a>
                                <a class="<?php if (isset($order) && $order === "nameAsc") echo "active" ?> font-weight-bold" href="product.php?order=nameAsc">名稱 ↑</a>
                                <a class="<?php if (isset($order) && $order === "priceDesc") echo "active" ?> font-weight-bold" href="product.php?order=priceDesc">價錢 ↓</a>
                                <a class="<?php if (isset($order) && $order === "priceAsc") echo "active" ?> font-weight-bold" href="product.php?order=priceAsc">價錢 ↑</a>
                            </div>
                        </div>
                    </div>

                    <div class="row product-list table-responsive">
                        <div class="col-lg-12 mb-3">
                            <table class="table table-hover table-lg align-items-center mt-3">
                                <thead>
                                    <tr class="table-secondary">
                                        <th class="active">
                                            <input type="checkbox" class="select-all checkbox" name="select-all" />
                                        </th>
                                        <th class="align-middle ps-1" scope="col">商品名稱</th>
                                        <th class="align-middle ps-1" scope="col">商品狀態</th>
                                        <th class="align-middle ps-1" scope="col">類別</th>
                                        <th class="align-middle ps-1" scope="col">價格</th>
                                        <th class="align-middle ps-1" style="max-width: 150px;" scope="col">描述</th>
                                        <th class="align-middle ps-1" style="max-width: 100px;" scope="col">修圖前</th>
                                        <th class="align-middle ps-1" style="max-width: 100px;" scope="col">修圖後</th>
                                        <th class="align-middle ps-1" scope="col">已售出</th>
                                        <th class="align-middle ps-1" style="max-width: 100px;" scope="col">檔案</th>
                                    </tr>
                                </thead>
                                <?php foreach ($rows as $value) : ?>
                                    <tbody>
                                        <tr>
                                            <td class="active p-3">
                                                <input type="checkbox" class="select-item checkbox" name="select-item" />
                                            </td>
                                            <td class="ps-1 p-3"><?= $value["name"] ?></td>
                                            <td class="ps-1 p-3"><?php switch ($value["valid"]):
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
                                            <td class="ps-1 p-3"><?= $value["category_name"] ?></td>
                                            <td class="ps-1p-3"><?= $value["price"] ?></td>
                                            <td class="ps-1 col-2 text-truncate p-3" style="max-width: 150px;"><?= $value["descriptions"] ?></td>
                                            <td class="ps-1 col-2 text-truncate p-3" style="max-width: 100px;"><?= $value["image_before"] ?></td>
                                            <td class="ps-1 col-2 text-truncate p-3" style="max-width: 100px;"><?= $value["image_after"] ?></td>
                                            <td class="ps-1 p-3"><?= $value["sold_total"] ?></td>
                                            <td class="ps-1 col-2 text-truncate p-3" style="max-width: 100px;"><?= $value["dng_pkg"] ?></td>
                                        </tr>
                                    </tbody>

                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>



                    <!-- Checkbox  -->
                    <button id="select-all" class="btn button-default">SelectAll/Cancel</button>
                    <button id="select-invert" class="btn button-default">Invert</button>
                    <button id="selected" class="btn button-default">GetSelected</button>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- body 2 > main 3 : 右側主內容下方頁尾 -->
<?php include "../../template/body-main-footer.php" ?>

<!-- body 3 : 右下頁面設定按鈕  -->
<?php include "../../template/body-corner.php" ?>

<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(function() {

        //button select all or cancel
        $("#select-all").click(function() {
            var all = $("input.select-all")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
        });

        //button select invert
        $("#select-invert").click(function() {
            $("input.select-item").each(function(index, item) {
                item.checked = !item.checked;
            });
            checkSelected();
        });

        //button get selected info
        $("#selected").click(function() {
            var items = [];
            $("input.select-item:checked:checked").each(function(index, item) {
                items[index] = item.value;
            });
            if (items.length < 1) {
                alert("no selected items!!!");
            } else {
                var values = items.join(',');
                console.log(values);
                var html = $("<div></div>");
                html.html("selected:" + values);
                html.appendTo("body");
            }
        });

        //column checkbox select all or cancel
        $("input.select-all").click(function() {
            var checked = this.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
        });

        //check selected items
        $("input.select-item").click(function() {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var all = $("input.select-all")[0];
            var total = $("input.select-item").length;
            var len = $("input.select-item:checked:checked").length;
            console.log("total:" + total);
            console.log("len:" + len);
            all.checked = len === total;
        }
    });
</script>