<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//CHEIN, LAST MODIFIED OCT 4 3:20 PM


require_once '../connection/inventory_connection.php';
require_once '../Class/InventoryClass.php';

$inventory = new InventoryClass($conn);

//POST API 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true); 
    if (
        isset($data['medicine_name']) && 
        isset($data['brand_name']) &&
        isset($data['stock_qty']) && 
        isset($data['unit_measurement']) && 
        isset($data['cost_per_unit'])
    ) {
        $result = $inventory->addNewItem(
            $data['medicine_name'], 
            $data['brand_name'], 
            $data['stock_qty'], 
            $data['unit_measurement'], 
            $data['cost_per_unit']
        );

        if ($result) {
            echo json_encode(['message' => 'Item added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to add item']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Incomplete data']);
    }
} 

//DELETE API
if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true); 
    
    if (isset($data['inventory_id'])) {
        $inventoryId = $data['inventory_id'];
        $result = $inventory->deleteItem($inventoryId);

        if ($result) {
            echo json_encode(['message' => 'Item deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to delete item']);
        }
    } 
} 

//EDIT API
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true); 
    
    if (isset($data['inventory_id'])) {
        $inventoryId = $data['inventory_id'];
        $result = $inventory->updateItem(
            $inventoryId,
            $data['medicine_name'], 
            $data['brand_name'], 
            $data['stock_qty'], 
            $data['unit_measurement'], 
            $data['cost_per_unit']
        );

        if ($result) {
            echo json_encode(['message' => 'Item updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to update item']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid item ID for updating']);
    }
}


//GET API
if($_SERVER['REQUEST_METHOD'] === 'GET') { 
    $items = $inventory->getInventoryItems();
    header('Content-Type: application/json');
    echo json_encode($items);
}

?>
