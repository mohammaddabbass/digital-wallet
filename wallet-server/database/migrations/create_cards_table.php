<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_cards = "CREATE TABLE IF NOT EXISTS cards (
    card_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    card_number VARCHAR(255) NOT NULL,
    expiry_date DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (card_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>