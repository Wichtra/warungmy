<?php
define("DB", mysqli_connect("localhost", "will", "Db302131", "mystore"));

$check = mysqli_query(DB, "SELECT check_out 
FROM `order` 
WHERE no_meja = 1 and check_out > '12:05:00' and check_out < '12:15:00' or check_in > '12:05:00' and check_in < '12:15:00' ;")->fetch_all(MYSQLI_ASSOC);
if ($check) {
    echo "ada";
} else {
    echo "tidak";
}
