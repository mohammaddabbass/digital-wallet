<?php 
 require '../../config/connection.php';
 require '../../model/Card.php';
 require '../../functions/CardFunctions.php';


 if (isset($_POST['wallet_id'])) {
    $walletId = $_POST['wallet_id'];
    $cardFunctions = new CardFunctions($conn);
    $card = $cardFunctions->getCardByWalletId($walletId);
    
    if ($card) {
        echo json_encode(['Card' => $card->toArray(), 'card_available' => true,]);
    } else {
        echo json_encode(['error' => 'Wallet do not have a card', 'card_available' => false]);
    }
    exit;
} else {
    echo json_encode(['error' => 'Walled ID is required']);
    exit;
}

?>