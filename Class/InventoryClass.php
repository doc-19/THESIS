<?php
//CHEIN, LAST MODIFIED OCT 4 3:20 PM
class InventoryClass {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

  
   //Getting All the items
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

    //Getting the count of quantity
    public function getTotalQuantity() {
        $query = "SELECT SUM(beginning_quantity) AS total_quantity FROM inventory";
        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        return $row['total_quantity'];
    }

    //Adding Item query
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
    

    //Deleting all the items
    public function deleteItem($inventoryId) {
        $query = "DELETE FROM inventory WHERE inventory_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $inventoryId); 
        return $stmt->execute();
    }

    //Updating the item
    public function updateItem($inventoryId, $medicineName, $brand_name, $stockQty, $unitMeasurement, $costPerUnit, $issuance) {
        $endingBalance = (float)$stockQty - (float)$issuance;
        $totalCost = (float)$costPerUnit * (float)$issuance;
    
        $query = "UPDATE inventory SET item_description = ?, brand_name = ?, beginning_quantity = ?, unit_measurement = ?, unit_cost = ?, issuance = ?, ending_balance = ?, total_cost = ? WHERE inventory_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisdidii", 
            $medicineName, 
            $brand_name, 
            $stockQty, 
            $unitMeasurement, 
            $costPerUnit,
            $issuance,
            $endingBalance,
            $totalCost,
            $inventoryId
        );
        return $stmt->execute();
    }
    
    
}
