<?php 
 require '../../config/connection.php';
include_once '../../model/Contact.php';
include_once '../../functions/ContactFunctions.php';

$contactFunctions = new ContactFunctions($conn);
$messages = $contactFunctions->getMessages();


if (!empty($messages)) {
    $response = [];
    foreach ($messages as $message) {
        $response[] = $message->toArray();
    }
    
    echo json_encode([
        "success" => true,
        "messages" => $response
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No messages found."
    ]);
}


?>