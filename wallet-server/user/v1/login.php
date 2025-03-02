<?php
require '../../config/connection.php';

require '../../model/User.php';
require '../../model/UserFunctions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userFunctions = new UserFunctions($conn);
    $user = $userFunctions->getUserByEmail($email);

    if ($user && password_verify($password, $user->getPassword())) {
        echo json_encode(['message' => 'Login successful', 'user' => $user->toArray()]);
    } else {
        echo json_encode(['message' => 'Invalid email or password']);
    }

}

