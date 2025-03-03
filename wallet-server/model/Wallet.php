<?php

class Wallet {
    private $wallet_id;
    private $user_id;
    private $balance;
    private $currency;
    private $created_at;
    private $updated_at;
    private $wallet_name;

    public function __construct($wallet_id = null, $user_id = null, $balance = 0, $currency = 'USD', $created_at = null, $updated_at = null, $wallet_name = null) {
        $this->wallet_id = $wallet_id;
        $this->user_id = $user_id;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->wallet_name = $wallet_name;
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

    public function getWalletName() {
        return $this->wallet_name;
    }

    public function toArray() {
        return [
            'wallet_id' => $this->wallet_id,
            'user_id' => $this->user_id,
            'balance' => $this->balance,
            'currency' => $this->currency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'wallet_name' => $this->wallet_name
        ];
    }
}
