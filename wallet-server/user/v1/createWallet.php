<?php 
header("Content-Type: application/json");
require '../../config/connection.php';
require '../../model/Wallet.php';
require '../../functions/WalletFunctions.php';

if(!isset($_POST["wallet-name"], $_POST["balance"], $_POST["user_id"])) {
    http_response_code(400);
    echo json_encode(["message" => "Please fill in all required fields"]);
    exit;
}

$name = trim($_POST['wallet-name']);
$balance = trim($_POST['balance']);
$user_id = trim($_POST['user_id']);
$currency = 'USD';

if ($balance === "" || !is_numeric($balance)) {
    echo json_encode(["message" => "Invalid balance", 'success' => -1]);
    http_response_code(400);
    exit;
}

if ($name === "") {
    http_response_code(400);
    echo json_encode(["message" => "Please provide a wallet name", "success" => -1]);
    exit;
}

$wallet = new Wallet(null, $user_id, $balance, $currency, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $name);
$wallet_functions = new WalletFunctions($conn);

if ($wallet_functions->createWallet($wallet)) {
    echo json_encode(["message" => "Wallet created successfully", 'success' => 1]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Failed to create wallet", 'success' => 0]);
}
exit;
