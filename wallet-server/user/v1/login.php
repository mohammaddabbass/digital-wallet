<?php
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Credentials: true");
require '../../config/connection.php';

require '../../model/User.php';
require '../../model/UserFunctions.php';

session_start();
    
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userFunctions = new UserFunctions($conn);
    $user = $userFunctions->getUserByEmail($email);
    if(!$user) {
        return json_encode(['message' => 'Invalid email']);
        
    }elseif (!password_verify($password, $user->getPassword())) {
        return json_encode(['message' => 'Invalid password']);
    }
    else {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getFirstName() . " " .$user->getLastName();
        return json_encode(['message' => 'Login successful', 'user' => $user->toArray(), 'session_id' => $_SESSION['user_id'] , 'session_name' => $_SESSION['user_name']]);
    }

}else {
    return json_encode(["message" => 'Invalid request!']);
}

    