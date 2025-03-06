<?php
require '../../config/connection.php';
require '../../model/Wallet.php';
require '../../functions/WalletFunctions.php';

if (!isset($_POST['wallet_id'], $_POST['amount'], $_POST['user_id'])) {
    echo json_encode(["message" => "Missing required parameters."]);
    exit;
}

$wallet_id = intval($_POST['wallet_id']);
$user_id   = intval($_POST['user_id']);
$amount    = floatval($_POST['amount']);

if ($amount <= 0) {
    echo json_encode(["error" => "Invalid deposit amount."]);
    exit;
}

$walletFunctions = new WalletFunctions($conn);
$wallet = $walletFunctions->getWalletById($wallet_id);

if (!$wallet || $wallet->getUserId() !== $user_id) {
    echo json_encode(["error" => "Wallet not found or access denied."]);
    exit;
}

$newBalance = $wallet->getBalance() + $amount;
$updatedAt = date("Y-m-d H:i:s");

if ($walletFunctions->updateBalance($wallet_id, $user_id, $newBalance, $updatedAt)) {
    $updatedWallet = $walletFunctions->getWalletById($wallet_id);
    echo json_encode([
        "success" => true,
        "wallet"  => $updatedWallet->toArray()
    ]);
} else {
    echo json_encode(["error" => "Failed to update wallet balance."]);
}