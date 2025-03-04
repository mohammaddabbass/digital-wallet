<?php 
require '../../config/connection.php';
require '../../model/Wallet.php';
require '../../model/WalletFunctions.php';

if (isset($_POST['wallet_id'])) {
    $walletId = $_POST['wallet_id'];
    $walletFunctions = new WalletFunctions($conn);
    $wallet = $walletFunctions->getWalletById($walletId);

    if ($wallet) {
        echo json_encode(['wallet' => $wallet->toArray()]);
    } else {
        echo json_encode(['error' => 'Wallet not found']);
    }
    exit;
} else {
    echo json_encode(['error' => 'Wallet ID is required']);
    exit;
}
?>
