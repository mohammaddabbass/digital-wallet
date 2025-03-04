<?php 
require_once __DIR__ . '../../../config/connection.php';

$sql_transaction_types = "CREATE TABLE IF NOT EXISTS transaction_types (
    type_id INT(11) NOT NULL AUTO_INCREMENT,
    type_name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (type_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


?>