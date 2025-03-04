<?php 
 require '../../config/connection.php';
 require '../../model/Wallet.php';
 require '../../model/WalletFunctions.php';


 if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $walletFunctions = new WalletFunctions($conn);
    $wallets = $walletFunctions->getUserWallets($userId);
    
    $walletsArray = array_map(function($wallet) {
        return $wallet->toArray();
    }, $wallets);
    
    echo json_encode(['wallets' => $walletsArray]);
    exit;
} else {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

?>