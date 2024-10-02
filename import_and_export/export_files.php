<?php
require '../vendor/autoload.php'; // Load PHPSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once '../connection/inventory_connection.php';

if(isset($_POST['export'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'Item Description');
    $sheet->setCellValue('B1', 'Unit Measurement');
    $sheet->setCellValue('C1', 'Beginning Quantity');
    $sheet->setCellValue('D1', 'Unit Cost');
    $sheet->setCellValue('E1', 'Issuance');
    $sheet->setCellValue('F1', 'Ending Balance');
    $sheet->setCellValue('G1', 'Total Cost');

    // Retrieve data from the database
    $sql = "SELECT item_description, unit_measurement, beginning_quantity, unit_cost, issuance, ending_balance, total_cost FROM inventory";
    $result = $conn->query($sql);

    $rowNum = 2; // Start on the second row
    while($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $row['item_description']);
        $sheet->setCellValue('B' . $rowNum, $row['unit_measurement']);
        $sheet->setCellValue('C' . $rowNum, $row['beginning_quantity']);
        $sheet->setCellValue('D' . $rowNum, $row['unit_cost']);
        $sheet->setCellValue('E' . $rowNum, $row['issuance']);
        $sheet->setCellValue('F' . $rowNum, $row['ending_balance']);
        $sheet->setCellValue('G' . $rowNum, $row['total_cost']);
        $rowNum++;
    }

    $writer = new Xlsx($spreadsheet);

    // Set the name of the exported file
    $filename = 'inventory_export_' . date('Y-m-d') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
    exit;
}
?>

<form action="" method="post">
    <button type="submit" name="export">Export Data</button>
</form>

