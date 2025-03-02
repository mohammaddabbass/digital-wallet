<?php

class User {
    private $id;
    private $email;
    private $phone;
    private $password;
    private $first_name;
    private $last_name;
    private $created_at;
    private $updated_at;
    private $is_verified;

    public function __construct($id = null, $email = null, $phone = null, $password = null, $first_name = null, $last_name = null, $created_at = null, $updated_at = null, $is_verified = "unverified") {
        $this->id = $id;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->is_verified = $is_verified;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function getIsVerified() {
        return $this->is_verified;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function setIsVerified($is_verified) {
        $this->is_verified = $is_verified;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_verified' => $this->is_verified
        ];
    }
}


?>