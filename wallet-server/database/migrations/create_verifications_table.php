<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_verifications = "CREATE TABLE IF NOT EXISTS verifications (
    verification_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    code VARCHAR(10) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (verification_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>