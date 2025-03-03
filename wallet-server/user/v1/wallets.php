<?php 
 require '../../config/connection.php';
 require '../../model/Wallet.php';
 require '../../model/WalletFunctions.php';

 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
    $name = $_POST['wallet-name'];
    $balance = $_POST['amount'];

    $wallet = new Wallet();

    if(empty($balance)) {
        echo json_encode(["message" => "please fill the amount"]);
    } elseif(empty($name)) {
        echo json_encode(["message" => "please add the name of the wallet"]);
    }else {
        echo json_encode(["message" => "{$name}'s wallet create"]);
    }
 }


?>