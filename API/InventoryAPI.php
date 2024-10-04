<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../connection/inventory_connection.php';
require_once '../Class/InventoryClass.php';

$inventory = new InventoryClass($conn);
$items = $inventory->getInventoryItems();

//JSON Encoding
header('Content-Type: application/json');
echo json_encode($items);
?>
