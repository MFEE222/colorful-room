<?php
require_once('../../components/pdo-connect.php');

// ecbo('time' . $time_end);
// ecbo(date('Y-m-d', random_int($time_start, $time_end)));
// ecbo(':orders_id: ' . $i + 1);
// ecbo(':member_id: ' . random_int(1, 1000));
// ecbo(':products_id: ' . random_int(1, 1000));
// ecbo(':subscribe_id: ' . random_int(1, 4));
// ecbo(':discount_id: ' . random_int(1, 3));
// ecbo(':created_at: ' . date('Y-m-d', random_int($time_start, $time_end)));
// ecbo(':modified_at: ' . date('Y-m-d', random_int($time_start, $time_end)));

$sql = "INSERT INTO orders_detail(orders_id,
                                  member_id,
                                  products_id,
                                  subscribe_id,
                                  discount_id,
                                  price,
                                  created_at,
                                  modified_at,
                                  message)
        VALUES (:orders_id,
                :member_id,
                :products_id,
                :subscribe_id,
                :discount_id,
                NULL,
                :created_at,
                :modified_at,
                NULL)";

// random_int
$time_start = time() - (365 * 24 * 60 * 60 * 2);
$time_end   = time();

$pdo = $db_host->prepare($sql);

// try {
//     $pdo->execute(
//         [
//             ':orders_id' => 1000 + 1,
//             ':member_id' => random_int(1, 1000),
//             ':products_id' => random_int(1, 1000),
//             ':subscribe_id' => random_int(1, 4),
//             ':discount_id' => random_int(1, 3),
//             ':created_at' => date('Y-m-d', random_int($time_start, $time_end)),
//             ':modified_at' => date('Y-m-d', random_int($time_start, $time_end))
//         ]
//     );
//     var_dump($pdo->rowCount());
// } catch (PDOException $e) {
//     ecbo($e->getMessage());
// }

for ($i = 0; $i < 1000; $i++) {
    try {
        $pdo->execute(
            [
                ':orders_id' => $i + 1,
                ':member_id' => random_int(1, 1000),
                ':products_id' => random_int(1, 1000),
                ':subscribe_id' => random_int(1, 4),
                ':discount_id' => random_int(1, 3),
                ':created_at' => date('Y-m-d', random_int($time_start, $time_end)),
                ':modified_at' => date('Y-m-d', random_int($time_start, $time_end))
            ]
        );
        if ($pdo->rowCount() > 0)
            usleep(250000);
    } catch (PDOException $e) {
    }
}


function ecbo($t)
{
    echo $t . '<br>';
}
