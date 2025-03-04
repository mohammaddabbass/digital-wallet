<?php
include_once '../../config/connection.php';

class UserFunctions
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertUser(User $user)
    {
        $query = "INSERT INTO users (email, phone ,password, first_name, last_name, created_at, updated_at, is_verified) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($query)) {
            $email = $user->getEmail();
            $phone = $user->getPhone();
            $password = $user->getPassword();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $createdAt = $user->getCreatedAt();
            $updatedAt = $user->getUpdatedAt();
            $isVerified = $user->getIsVerified();

            $stmt->bind_param(
                'sssssssi',
                $email,
                $phone,
                $password,
                $firstName,
                $lastName,
                $createdAt,
                $updatedAt,
                $isVerified
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

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param('s', $email);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user = new User(
                    $row['user_id'],
                    $row['email'],
                    $row['phone'],
                    $row['password'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['created_at'],
                    $row['updated_at'],
                    $row['is_verified']
                );
                $stmt->close();
                return $user;
            }
        }
        return null;
    }
}
