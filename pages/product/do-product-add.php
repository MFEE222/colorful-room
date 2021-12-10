<?php

require_once("../../components/pdo-connect.php");
//新增
include_once("../var.php");
include_once("../signin/do-authorize.php");

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$descriptions = $_POST['descriptions'];
$category_id = $_POST['category_id'];
$image_before = $_POST['image_before'];
$image_after = $_POST['image_after'];
$dng_pkg = $_POST['dng_pkg'];
$auto_create_date = $_POST['auto_create_date'];
$auto_delete_date = $_POST['auto_delete_date'];

// 把 商品的資料存入資料庫
// INSERT 

// 用 header () 把檔案上傳 assets/product/

$now = date("Y-m-d H:i:s");
$sql = "INSERT INTO products (name,price,descriptions,image_before,image_after,dng_pkg,category_id,valid,create_date,auto_create_date,auto_delete_date) VALUES (?,?,?,?,?,?,?,1,?,?,?)";
$stmt = $db_host->prepare($sql);
try {
    $result = $stmt->execute([$product_name, $product_price, $descriptions, $image_before, $image_after, $dng_pkg , $category_id , $now , $auto_create_date , $auto_delete_date]);
    header("location:product-add.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
