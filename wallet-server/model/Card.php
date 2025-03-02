<?php

class Card {
    private $card_id;
    private $wallet_id;
    private $card_number;
    private $expiry_date;
    private $ccv;
    private $status;
    private $created_at;
    private $updated_at;

    public function __construct($card_id = null, $wallet_id = null, $card_number = null, $expiry_date = null, $ccv = null, $status = 'active', $created_at = null, $updated_at = null) {
        $this->card_id = $card_id;
        $this->wallet_id = $wallet_id;
        $this->card_number = $card_number;
        $this->expiry_date = $expiry_date;
        $this->ccv = $ccv;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getCardId() {
        return $this->card_id;
    }

    public function getWalletId() {
        return $this->wallet_id;
    }

    public function getCardNumber() {
        return $this->card_number;
    }

    public function getExpiryDate() {
        return $this->expiry_date;
    }

    public function getCcv() {
        return $this->ccv;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
