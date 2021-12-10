<?php
include_once("../var.php");
include_once("../signin/do-authorize.php");
if(!isset($_GET["id"])){
    echo "您不是從正常程序進入此頁";
    exit();
}
require_once ("../../components/pdo-connect.php");
$id=$_GET["id"];
$sql="UPDATE customer SET valid=0 WHERE id=?";
$stmt=$db_host->prepare($sql);
try {
    if ($stmt->execute([$id]) === TRUE) {
//      echo "刪除資料完成" ;
        header("location:user-list.php?table=customer");
    }
}catch(PDOException $e){
    echo  $e->getMessage();

}

