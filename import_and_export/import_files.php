<?php
require '../vendor/autoload.php'; // Load PHPSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
include_once '../connection/inventory_connection.php';

if(isset($_POST['import'])){
    $file_mimes = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if('csv' == $extension) {
            $reader = IOFactory::createReader('Csv');
        } else {
            $reader = IOFactory::createReader('Xlsx');
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Loop through the rows in Excel file
        foreach ($sheetData as $key => $row) {
            if($key == 0) continue; // Skip header row

            $inventory_id = $row[0];
            $item_description = $row[1];
            $unit_measurement = $row[2];
            $beginning_quantity = (int)$row[3]; // Ensure this is an integer
            $unit_cost = (float)$row[4]; // Ensure this is a float or integer
            $issuance = (int)$row[5]; // Ensure this is an integer
            $ending_balance = (int)$row[6]; // Ensure this is an integer
            $total_cost = (float)$row[7]; // Ensure this is a float or integer

            // Insert data into database
            $sql = "INSERT INTO inventory (inventory_id, item_description, unit_measurement, beginning_quantity, unit_cost, issuance, ending_balance, total_cost)
                    VALUES ('$inventory_id', '$item_description', '$unit_measurement', $beginning_quantity, $unit_cost, $issuance, $ending_balance, $total_cost)";
            
            $conn->query($sql);
        }

        echo "Data Imported Successfully";
    } else {
        echo "Invalid file format. Please upload Excel (.xlsx or .csv) file.";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" />
    <button type="submit" name="import">Import Data</button>
</form>
