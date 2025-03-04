<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_wallets = "CREATE TABLE IF NOT EXISTS wallets (
    wallet_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    balance DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (wallet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>