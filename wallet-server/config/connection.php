<?php

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json"); 
header("Access-Control-Allow-Origin:*");


    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "swiftsafe";

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    } catch (Exception) {
        echo "failed to connect";
    }

?>