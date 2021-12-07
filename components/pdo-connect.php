<?php

session_start();
$colorful_servername = "localhost";
$colorful_username = "mfee222";
$colorful_password = "222eefm";
$colorful_dbname = "colorful";

try {
    $db_host = new PDO(
        "mysql:host={$colorful_servername};dbname={$colorful_dbname};charset=utf8",
        $colorful_username,
        $colorful_password
    );
    // echo "資料庫連線成功";
} catch (PDOException $e) {
    echo "資料庫連線失敗";
    echo "error: " . $e->getMessage();
}
