<?php
include_once '../../config/connection.php';
include_once '../../model/Card.php';

class CardFunctions {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createCard(Card $card) {
        $query = "INSERT INTO cards (wallet_id, card_number, expiry_date, ccv, status, created_at, updated_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param(
                'issssss', 
                $card->getWalletId(),
                $card->getCardNumber(),
                $card->getExpiryDate(),
                $card->getCcv(),
                $card->getStatus(),
                $card->getCreatedAt(),
                $card->getUpdatedAt()
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

    public function getCardById($card_id) {
        $query = "SELECT * FROM cards WHERE card_id = ?";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param('i', $card_id);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $card = new Card(
                    $row['card_id'],
                    $row['wallet_id'],
                    $row['card_number'],
                    $row['expiry_date'],
                    $row['ccv'],
                    $row['status'],
                    $row['created_at'],
                    $row['updated_at']
                );
                $stmt->close();
                return $card;
            }
        }
        return null;
    }

    public function getCardByWalletId($wallet_id) {
        $query = "SELECT * FROM cards WHERE wallet_id = ?";
    
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param('i', $wallet_id);
    
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $card = new Card(
                    $row['card_id'],
                    $row['wallet_id'],
                    $row['card_number'],
                    $row['expiry_date'],
                    $row['ccv'],
                    $row['status'],
                    $row['created_at'],
                    $row['updated_at']
                );
                $stmt->close();
                return $card; 
            }
        }
        return null;
    }
    

    public function updateCardStatus($card_id, $status) {
        $query = "UPDATE cards SET status = ?, updated_at = ? WHERE card_id = ?";

        if ($stmt = $this->conn->prepare($query)) {
            $updated_at = date('Y-m-d H:i:s'); 
            $stmt->bind_param('ssi', $status, $updated_at, $card_id);

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
