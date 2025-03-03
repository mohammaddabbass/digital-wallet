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
        echo json_encode(['message' => "wallet created succefully"]);
    } else{
        echo json_encode(['message' => "failed to create the wallet"]);
    }

    if(empty($balance)) {
        echo json_encode(["message" => "please fill the amount"]);
    } elseif(empty($name)) {
        echo json_encode(["message" => "please add the name of the wallet"]);
    }else {
        echo json_encode(["message" => "{$name}'s wallet create"]);
    }
 } 

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(["error" => "User not authenticated"]);
            return;
        }
        $user_id = $_SESSION['user_id'];
        $wallet_functions = new WalletFunctions($conn);

        $wallets = $wallet_functions->getUserWallets($user_id);

        if (!empty($wallets)) {
            // Convert Wallet objects to arrays
            $walletsArray = array_map(function($wallet) {
                return $wallet->toArray();
            }, $wallets);
            
            echo json_encode([
                'success' => true,
                'wallets' => $walletsArray
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No wallets found'
            ]);
        }
    }


?>