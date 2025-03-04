<?php 
 require '../../config/connection.php';
 require '../../model/Wallet.php';
 require '../../model/WalletFunctions.php';

 session_start(); 

 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
    $name = $_POST['wallet-name'];
    $balance = $_POST['balance'];
    $currency = 'USD';

    $user_id = $_SESSION['user_id'] ?? 0; 

    $wallet = new Wallet(null, $user_id, $balance, $currency, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $name);

    $wallet_functions = new  WalletFunctions($conn);

    if($wallet_functions->createWallet($wallet)){
        return json_encode(['message' => "wallet created succefully"]);
    } else{
        return json_encode(['message' => "failed to create the wallet"]);
    }

    if(empty($balance)) {
        return json_encode(["message" => "please fill the amount"]);
    } elseif(empty($name)) {
        return json_encode(["message" => "please add the name of the wallet"]);
    }else {
        return json_encode(["message" => "{$name}'s wallet create"]);
    }
 } 

 if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $walletFunctions = new WalletFunctions($conn);
    $wallets = $walletFunctions->getUserWallets($userId);
    
    // Return wallets to the frontend (e.g., for dropdown selection)
    return json_encode(['wallets' => $wallets]);
} else {
    return json_encode(['error' => 'User not logged in']);
}


?>