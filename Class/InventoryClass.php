<?php
//CHEIN, LAST MODIFIED OCT 4 3:20 PM
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

    public function addNewItem($medicineName, $brand_name, $stockQty, $unitMeasurement, $costPerUnit, $issuance, $totalCost) { 
        $endingBalance = (float)$stockQty - $issuance;
    
        
        $query = "INSERT INTO inventory 
              (item_description, brand_name, unit_measurement, beginning_quantity, unit_cost, issuance, ending_balance, total_cost)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssidiid", 
            $medicineName,        
            $brand_name,          
            $unitMeasurement,     
            $stockQty,            
            $costPerUnit,         
            $issuance,            
            $endingBalance,
            $totalCost            
        );
        return $stmt->execute();
    }
    

    public function deleteItem($inventoryId) {
        $query = "DELETE FROM inventory WHERE inventory_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $inventoryId); 
        return $stmt->execute();
    }

    public function updateItem($inventoryId, $medicineName, $brand_name, $stockQty, $unitMeasurement, $costPerUnit) {
        $query = "UPDATE inventory SET item_description = ?, brand_name = ?, beginning_quantity = ?, unit_measurement = ?, unit_cost = ? WHERE inventory_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssidsi", 
            $medicineName, 
            $brand_name, 
            $stockQty, 
            $unitMeasurement, 
            $costPerUnit, 
            $inventoryId
        );
        return $stmt->execute();
    }
    
}
