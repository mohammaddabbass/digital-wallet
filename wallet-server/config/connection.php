<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "swiftsafe";

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        echo "hello from the connection file";
    } catch (Exception) {
        echo "failed to connect";
    }

?>