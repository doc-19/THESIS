<?php
class InventoryClass {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

  
   
    public function getInventoryItems() {
        $query = "SELECT * FROM inventory";
        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        $inventory = array(); 
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $inventory[] = $row; 
            }
        }
        return $inventory;
    }

    
}
