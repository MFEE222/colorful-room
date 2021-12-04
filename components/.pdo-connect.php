<?php
$my_dbname = 'colorful';
$my_host = 'localhost';
$my_username = 'mfee222';
$my_password = '222eefm';

try {
    $mysql = new PDO('mysql:dbname={colorful};host={localhost};charset-utf8', $my_username, $my_password);
} catch (PDOException $e) {
    echo "PDO connect failed. error: $e->getMessage()";
}
