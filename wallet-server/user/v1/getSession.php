<?php

session_start(); 

if (isset($_SESSION['user_id'])) {
    return "User ID: " . $_SESSION['user_id'] . "<br>";
} else {
    return "No user is logged in.";
}

 ?>