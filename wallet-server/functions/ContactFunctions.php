<?php 
include_once '../../config/connection.php';
include_once '../../+model/Contact.php';

class ContactFunctions {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertMessage(Contact $contact) {
        $query = "INSERT INTO contact_us (email, message, created_at, updated_at) VALUES (?,?,?,?)";

        if($stmt = $this->conn->prepare($query)) {
            $email = $contact->getEmail();
            $message = $contact->getMessage();
            $created_at = $contact->getCreatedAt();
            $updated_at = $contact->getUpdatedAt();

            $stmt->bind_param(
                'ssss',
                $email,
                $message,
                $created_at,
                $updated_at,
            );

            if($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }


    public function getMessages() {
        $query = "SELECT * FROM contact_us";
        $messages = [];

        if($stmt = $this->conn->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                $messages[] = new Contact($row['email'], $row['message'], $row['created_at'], $row['updated_at']);
            }
        }

        return $messages;
    }

}

?>