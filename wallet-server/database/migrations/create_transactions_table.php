<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_transactions = "CREATE TABLE IF NOT EXISTS transactions (
    transaction_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    transaction_type_id INT(11) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (transaction_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (transaction_type_id) REFERENCES transaction_types(type_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>