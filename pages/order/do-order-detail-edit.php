<?php
include_once("../var.php");
include_once("../signin/do-authorize.php");
require_once("../../components/pdo-connect.php");

echo $_POST['payment_id'] . "<br>";
echo $_POST['status_id'] . "<br>";
echo $_POST['order_id'] . "<br>";
echo $_POST['order_detail_id'] . "<br>";
echo $_POST['message'] . "<br>";
die();


function post($name)
{
    if (isset($name))
        return $_POST[$name];
    return '';
}

function redirect($url)
{
    header("Location: $url");
    die();
}

$result = true;
$sqls = [
    [
        // update payment_id / status_id on orders table
        "prepare" => "UPDATE orders
                        SET payment_id = :pid,
                            status_id = :sid
                      WHERE id = :oid",
        "execute" => [
            ':pid' => post('payment_id'),
            ':sid' => post('status_id'),
            ':oid' => post('order_id')
        ]
    ],
    [
        // update message on orders_detail table
        "prepare" => "UPDATE orders_detail
                        SET message = :msg
                      WHERE id = :did",
        "execute" => [
            ':msg' => post('message'),
            ':did' => post('order_detail_id')
        ]
    ]
];

foreach ($sqls as $s) {
    try {
        $pdo = $db_host->prepare($s['prepare']);
        $pdo->execute($s['execute']);

        if ($pdo->rowCount() <= 0)
            $result = false;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// if (!$result)
//     echo '...';

redirect($url_page_order_detail . "?id=" . post('order_id'));
