<?php 

class Contact {
    private $message_id;
    private $email;
    private $message;
    private $created_at;
    private $updated_at;

    public function __construct($message_id = null, $email = null, $message = null, $created_at = null, $updated_at = null) {
        $this->message_id = $message_id;
        $this->email = $email;
        $this->message = $message;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getMessageId() {
        return $this->message_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function toArray() {
        return [
            'message_id' => $this->message_id,
            'email' => $this->email,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

?>
