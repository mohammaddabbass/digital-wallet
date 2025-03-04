<?php 
require '../../config/connection.php';

require '../../model/User.php';
require '../../model/UserFunctions.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'] ?? null; 
    $password = $_POST['password']; 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user = new User(null, $email, $phone ,$hashed_password, $first_name, $last_name, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), false);

    $userFunctions = new UserFunctions($conn);
    if ($userFunctions->insertUser($user)) {
        return json_encode(['message' => 'User registered successfully']);
    } else {
        return json_encode(['message' => 'Failed to register user']);
    }
}else {
    return json_encode(["message" => 'Invalid request!']);
}

?>