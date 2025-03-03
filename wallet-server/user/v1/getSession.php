<?php

session_start(); 

if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'] . "<br>";
} else {
    echo "No user is logged in.";
}

 ?>