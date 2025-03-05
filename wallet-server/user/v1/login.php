<?php

require '../../config/connection.php';
require '../../model/User.php';
require '../../functions/UserFunctions.php';


if (!isset($_POST['email']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Email and Password are required']);
    exit;
}

$email = trim($_POST['email']); 
$password = $_POST['password'];

$userFunctions = new UserFunctions($conn);
$user = $userFunctions->getUserByEmail($email);

if (!$user) {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid email']);
    exit;
}

if (!password_verify($password, $user->getPassword())) {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid password']);
    exit;
}

http_response_code(200);
echo json_encode([
    'message' => 'Login successful',
    'user' => [
        'id' => $user->getId(),
        'email' => $user->getEmail(),
        'first_name' => $user->getFirstName(),
        'last_name' => $user->getLastName(),
        'is_verified' => $user->getIsVerified()
    ]
]);
exit;
