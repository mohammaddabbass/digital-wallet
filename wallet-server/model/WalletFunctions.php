<?php
include_once '../../config/connection.php';
// include_once '../model/Wallet.php';

class WalletFunctions {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createWallet(Wallet $wallet) {
        $query = "INSERT INTO wallets (user_id, balance, currency, created_at, updated_at, wallet_name) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($query)) {
            $user_id = $wallet->getUserId();
            $balance = $wallet->getBalance();
            $currency = $wallet->getCurrency();
            $createdAt = $wallet->getCreatedAt();
            $updatedAt = $wallet->getUpdatedAt();
            $name = $wallet->getWalletName();
            $stmt->bind_param(
                'iissss', 
                $user_id,
                $balance,
                $currency,
                $createdAt,
                $updatedAt,
                $name
                
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
                    $wallets[] = new Wallet($row['wallet_id'], $row['user_id'], $row['balance'], $row['currency'], $row['created_at'], $row['updated_at'], $row['wallet_name']);
                }
            }
            return $wallets;
        }
        
        public function getWalletById($wallet_id) {
            $query = "SELECT * FROM wallets WHERE wallet_id = ?";
            $wallet = null;
        
            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("i", $wallet_id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($row = $result->fetch_assoc()) {
                    $wallet = new Wallet(
                        $row['wallet_id'],
                        $row['user_id'],
                        $row['balance'],
                        $row['currency'],
                        $row['created_at'],
                        $row['updated_at'],
                        $row['wallet_name']
                    );
                }
        
                $stmt->close();
            }
        
            return $wallet;
        }


        public function updateBalance($walletId, $delta, $userId) {
            $query = "UPDATE wallet SET balance = balance + ? WHERE wallet_id = ? AND user_id = ? AND balance + ? >= 0";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("diii", $delta, $walletId, $userId, $delta);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            return $affectedRows > 0;
        }
    // public function updateBalance(Wallet $wallet) {
    //     $query = "UPDATE wallets SET balance = ?, updated_at = ? WHERE wallet_id = ?";

    //     if ($stmt = $this->conn->prepare($query)) {
    //         $stmt->bind_param(
    //             'dsi', 
    //             $wallet->getBalance(),
    //             $wallet->getUpdatedAt(),
    //             $wallet->getWalletId()
    //         );

    //         if ($stmt->execute()) {
    //             $stmt->close();
    //             return true;
    //         } else {
    //             $stmt->close();
    //             return false;
    //         }
    //     }

    //     return false;
    // }
}
