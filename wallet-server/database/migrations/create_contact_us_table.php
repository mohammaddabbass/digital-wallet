<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_contact_us = "CREATE TABLE IF NOT EXISTS contact_us (
    contact_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (contact_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>