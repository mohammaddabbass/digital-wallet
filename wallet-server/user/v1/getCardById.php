<?php 
require '../../config/connection.php';
require '../../model/Card.php';
require '../../functions/CardFunctions.php';

if (isset($_POST['card_id'])) {
    $cardId = $_POST['card_id'];
    $cardFunctions = new CardFunctions($conn);
    $wallet = $cardFunctions->getCardById($cardId);

    if ($wallet) {
        echo json_encode(['card' => $card->toArray()]);
    } else {
        echo json_encode(['error' => 'Card not found']);
    }
    exit;
} else {
    echo json_encode(['error' => 'Card ID is required']);
    exit;
}
?>
