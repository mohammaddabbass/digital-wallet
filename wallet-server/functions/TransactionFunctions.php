<?php
class TransactionFunctions {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private function getDeltaByTransactionType($typeId, $amount) {
        $positiveTypes = [1];
        return in_array($typeId, $positiveTypes) ? $amount : -$amount;
    }

    public function createTransaction(Transaction $transaction) {
        $this->conn->autocommit(FALSE);
        try {
            $query = "INSERT INTO transactions (wallet_id, user_id, amount, currency, transaction_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $walletId = $transaction->getWalletId();
            $userId = $transaction->getUserId();
            $amount = $transaction->getAmount();
            $currency = $transaction->getCurrency();
            $typeId = $transaction->getTransactionTypeId();
            $createdAt = $transaction->getCreatedAt();
            $updatedAt = $transaction->getUpdatedAt();
            $stmt->bind_param("iidsiss", $walletId, $userId, $amount, $currency, $typeId, $createdAt, $updatedAt);
            if (!$stmt->execute()) {
                throw new Exception("Failed to insert transaction: " . $stmt->error);
            }
            $stmt->close();

            $delta = $this->getDeltaByTransactionType($typeId, $amount);
            $walletFunctions = new WalletFunctions($this->conn);
            if (!$walletFunctions->updateBalance($walletId, $delta, $userId)) {
                throw new Exception("Insufficient funds or wallet/user mismatch.");
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log($e->getMessage());
            return false;
        } finally {
            $this->conn->autocommit(TRUE);
        }
    }

    public function getTransactionsByWalletId($walletId) {
        $query = "SELECT * FROM transactions WHERE wallet_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $walletId);
        $stmt->execute();
        $result = $stmt->get_result();
        $transactions = [];
        while ($row = $result->fetch_assoc()) {
            $transaction = new Transaction(
                $row['transaction_id'],
                $row['wallet_id'],
                $row['user_id'],
                $row['amount'],
                $row['currency'],
                $row['transaction_type_id'],
                $row['created_at'],
                $row['updated_at']
            );
            $transactions[] = $transaction->toArray();
        }
        $stmt->close();
        return $transactions;
    }
}
 ?>