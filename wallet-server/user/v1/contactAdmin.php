<?php 

require '../../model/Contact.php';
require '../../functions/ContactFunctions.php';

if(!isset($_POST['email']) || !isset($_POST['message'])){
    http_response_code(400);
    echo json_encode(['message' => 'please fill all the fields']);
    exit;
}

$email = $_POST['email'];
$message = $_POST['message'];

$contact = new Contact(null, $email, $message, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'),);

$contactFunctions = new ContactFunctions($conn);

if($contactFunctions->insertMessage($contact)) {
    http_response_code(201);
    echo json_encode(["message" => "message sent successfully!", "success" => true,]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "failed to send message", "success" => false,]);
}
exit;

?>