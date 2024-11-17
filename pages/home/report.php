<?php 

// Include PHPSpreadsheet classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once('../../include_commons.php'); 
require_once '../../vendor/autoload.php';

// Set the headers for Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="AllReport' . date("Y-m-d_H-i-s") . '.xlsx"');
header('Cache-Control: max-age=0');  // Prevent caching issues

// Fetch stock data (assuming Stock::ReadAll() fetches your data as before)
$stock = Stock::RecentSell();

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// ---- First Sheet ----
// Set the first sheet as active
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Sale Report');

// Set headers for sheet 1
$sheet1->setCellValue('A1', 'Name')
       ->setCellValue('B1', 'Qty')
       ->setCellValue('C1', 'Unit');

// Add stock data to the first sheet
$row = 2;  // Start from row 2 since row 1 is for headers
foreach ($stock as $s) {
    $sheet1->setCellValue('A' . $row, $s->name ?? '')
           ->setCellValue('B' . $row, $s->qty ?? '')
           ->setCellValue('C' . $row, $s->unit ?? '');
    $row++;
}

// ---- Second Sheet ----
// Create a second sheet and set it as active
$sheet2 = $spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(1);  // Set the second sheet as the active sheet
$sheet2->setTitle('Supplier Due');

$scDue = scentityModel::ReadAll();

// Set headers for sheet 2 (example of a different report)
$sheet2->setCellValue('A1', 'Name')
       ->setCellValue('B1', 'Amount');

// Example data for the second sheet
$row = 2;

foreach ($scDue as $sc) {
    $sheet2->setCellValue('A' . $row, $sc->merchant_name ?? '')
           ->setCellValue('B' . $row, $sc->due_ammount ?? '');
    $row++;
}

// ---- Third Sheet (Optional) ----
// Create another sheet if needed
// $sheet3 = $spreadsheet->createSheet();
// $spreadsheet->setActiveSheetIndex(2);  // Set the third sheet as active
// $sheet3->setTitle('Summary');

// // Set summary headers
// $sheet3->setCellValue('A1', 'Summary Data')
//        ->setCellValue('A2', 'Total Stock')
//        ->setCellValue('B2', count($stock)); // Example summary (count of stock)

// Add more data as needed in the third sheet
// ...

// ---- Save and Output the File ----
// Write the Excel file to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Ensure no further output is sent
exit;
?>
