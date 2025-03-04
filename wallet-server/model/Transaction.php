<?php

class Transaction {
    private $transaction_id;
    private $wallet_id;
    private $user_id;
    private $amount;
    private $currency;
    private $transaction_type_id;
    private $created_at;
    private $updated_at;

    public function __construct($transaction_id = null, $wallet_id = null, $user_id = null, $amount = 0, $currency = null, $transaction_type_id = null, $created_at = null, $updated_at = null) {
        $this->transaction_id = $transaction_id;
        $this->wallet_id = $wallet_id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->transaction_type_id = $transaction_type_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getTransactionId() { 
        return $this->transaction_id; 
    }
    public function getWalletId() { 
        return $this->wallet_id; 
    }
    public function getUserId() { 
        return $this->user_id; 
    }
    public function getAmount() { 
        return $this->amount; 
    }
    public function getCurrency() { 
        return $this->currency; 
    }
    public function getTransactionTypeId() { 
        return $this->transaction_type_id; 
    }
    public function getCreatedAt() { 
        return $this->created_at; 
    }
    public function getUpdatedAt() { 
        
        return $this->updated_at; 
    }

    public function setTransactionId($transaction_id) { 
        $this->transaction_id = $transaction_id; 
    }
    public function setWalletId($wallet_id) { 
        $this->wallet_id = $wallet_id; 
    }
    public function setUserId($user_id) { 
        $this->user_id = $user_id; 
    }
    public function setAmount($amount) { 
        $this->amount = $amount; 
    }
    public function setCurrency($currency) { 
        $this->currency = $currency; 
    }
    public function setTransactionTypeId($transaction_type_id) { 
        $this->transaction_type_id = $transaction_type_id; 
    }
    public function setCreatedAt($created_at) { 
        $this->created_at = $created_at; 
    }
    public function setUpdatedAt($updated_at) { 
        $this->updated_at = $updated_at; 
    }

    public function toArray() {
        return [
            'transaction_id' => $this->transaction_id,
            'wallet_id' => $this->wallet_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'transaction_type_id' => $this->transaction_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

?>
