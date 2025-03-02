<?php

class Wallet {
    private $wallet_id;
    private $user_id;
    private $balance;
    private $currency;
    private $created_at;
    private $updated_at;

    public function __construct($wallet_id = null, $user_id = null, $balance = 0, $currency = 'USD', $created_at = null, $updated_at = null) {
        $this->wallet_id = $wallet_id;
        $this->user_id = $user_id;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getWalletId() {
        return $this->wallet_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
