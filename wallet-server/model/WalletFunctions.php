<?php
include_once 'config/connection.php';
include_once 'models/Wallet.php';

class WalletFunctions {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createWallet(Wallet $wallet) {
        $query = "INSERT INTO wallets (user_id, balance, currency, created_at, updated_at) 
                  VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param(
                'iisss', 
                $wallet->getUserId(),
                $wallet->getBalance(),
                $wallet->getCurrency(),
                $wallet->getCreatedAt(),
                $wallet->getUpdatedAt()
            );

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        return false;
    }

    public function getUserWallets($user_id) {
        $query = "SELECT * FROM wallets WHERE user_id = ?";
        $wallets = [];
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $wallets[] = new Wallet($row['wallet_id'], $row['user_id'], $row['balance'], $row['currency'], $row['card_id'], $row['created_at'], $row['updated_at']);
            }
        }
        return $wallets;
    }

    public function updateBalance(Wallet $wallet) {
        $query = "UPDATE wallets SET balance = ?, updated_at = ? WHERE wallet_id = ?";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param(
                'dsi', 
                $wallet->getBalance(),
                $wallet->getUpdatedAt(),
                $wallet->getWalletId()
            );

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        return false;
    }
}
