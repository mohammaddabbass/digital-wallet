<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_live_chats = "CREATE TABLE IF NOT EXISTS live_chats (
    chat_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (chat_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>