<?php

include "connection.php";

$uid = $_POST["u"];
//echo ($uid);

if (empty($uid)) {
    echo ("Please Enter User ID");
} else {
    //echo ("Success");
    $rs = Database::search("SELECT * FROM `users` WHERE `id` = '" . $uid . "' AND `id` != '1'");
    $num = $rs->num_rows;
    //echo($num);

    if ($num == 1) {
        $d = $rs->fetch_assoc();

        if ($d["status"] == 1) {
            Database::iud(("UPDATE `users` SET `status` = '2' WHERE `id` = '" . $uid . "' "));
            echo ("Deactive");
            
        }
        if ($d["status"] == 2) {
            Database::iud(("UPDATE `users` SET `status` = '1' WHERE `id` = '" . $uid . "' "));
            echo ("Active");
        }
    } else {
        echo ("Invalid User ID");
    }
}
