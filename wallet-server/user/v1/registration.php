<?php

require '../../config/connection.php';
require '../../model/User.php';
require '../../functions/UserFunctions.php';

if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['first_name']) || !isset($_POST['last_name'])) {
    http_response_code(400);
    echo json_encode(["message" => "Email, Password, First Name, and Last Name are required"]);
    exit;
}

$email = $_POST['email'];
$phone = $_POST['phone'] ?? null; 
$password = $_POST['password']; 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$user = new User(null, $email, $phone, $hashed_password, $first_name, $last_name, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), false);

$userFunctions = new UserFunctions($conn);

if ($userFunctions->insertUser($user)) {
    http_response_code(201);
    echo json_encode(["message" => "User registered successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Failed to register user"]);
}
exit;
?>
