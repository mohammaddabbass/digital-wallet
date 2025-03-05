    <?php 
    class TransactionTypeFunctions {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }    
        public function getTransactionTypeIdByName($name) {
            $query = "SELECT transaction_type_id FROM transaction_types WHERE name = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['transaction_type_id'];
            }
            return null; 
        }
    }
    ?>