<?php 

// Include the PHPSpreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once('../../include_commons.php'); 
require_once '../../vendor/autoload.php';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Stock' . date("Y-m-d_H-i-s") . '.xlsx"');
header('Cache-Control: max-age=0');  


$stock = Stock::ReadAll();


$spreadsheet = new Spreadsheet();

// Set the active sheet and write the header row
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Category')
      ->setCellValue('B1', 'Name')
      ->setCellValue('C1', 'Qty')
      ->setCellValue('D1', 'Unit');

// Add data from the stock to the Excel sheet
$row = 2; // Start from row 2 since row 1 is for headers
foreach($stock as $s) {
    // Ensure that all properties exist and are properly written
    $sheet->setCellValue('A' . $row, $s->main ?? '')
          ->setCellValue('B' . $row, $s->name ?? '')
          ->setCellValue('C' . $row, $s->qty ?? '')
          ->setCellValue('D' . $row, $s->unit ?? '');
    $row++;
}

// Create an Excel writer instance and save to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Ensure no further output is sent
exit;
?>
