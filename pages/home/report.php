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
$sheet2->setTitle('Supplier Ledger');

$scDue = scledgerModel::ReadToday();

// Set headers for sheet 2 (example of a different report)
$sheet2->setCellValue('A1', 'Name')
       ->setCellValue('B1', 'Date')
       ->setCellValue('C1', 'Type')
       ->setCellValue('D1', 'Current Ammount')
       ->setCellValue('E1', 'Truns Ammount')
       ->setCellValue('F1', 'Mode')
       ->setCellValue('G1', 'Ref. No');

// Example data for the second sheet
$row = 2;

foreach ($scDue as $sc) {
    $sheet2->setCellValue('A' . $row, $sc->scid ?? '')
           ->setCellValue('B' . $row, $sc->date ?? '')
           ->setCellValue('C' . $row, $sc->type ?? '')
           ->setCellValue('D' . $row, $sc->current_amomount ?? '')
           ->setCellValue('E' . $row, $sc->truns_ammount ?? '')
           ->setCellValue('F' . $row, $sc->mode ?? '')
           ->setCellValue('G' . $row, $sc->refno ?? '');
    $row++;
}

// ---- 3rd Sheet ----
// Create a 3rd sheet and set it as active
$sheet3 = $spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(2);  // Set the second sheet as the active sheet
$sheet3->setTitle('Customer Ledger');

$sdDue = sdledgerModel::ReadToday();

// Set headers for sheet 2 (example of a different report)
$sheet3->setCellValue('A1', 'Name')
       ->setCellValue('B1', 'Date')
       ->setCellValue('C1', 'Type')
       ->setCellValue('D1', 'Current Ammount')
       ->setCellValue('E1', 'Truns Ammount')
       ->setCellValue('F1', 'Mode')
       ->setCellValue('G1', 'Ref. No');

// Example data for the second sheet
$row = 2;

foreach ($sdDue as $sc) {
    $sheet3->setCellValue('A' . $row, $sc->sdid ?? '')
           ->setCellValue('B' . $row, $sc->date ?? '')
           ->setCellValue('C' . $row, $sc->type ?? '')
           ->setCellValue('D' . $row, $sc->current_amomount ?? '')
           ->setCellValue('E' . $row, $sc->truns_ammount ?? '')
           ->setCellValue('F' . $row, $sc->mode ?? '')
           ->setCellValue('G' . $row, $sc->refno ?? '');
    $row++;
}

// ---- 4th Sheet ----
// Create a 4th sheet and set it as active
$sheet4 = $spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(3);  // Set the second sheet as the active sheet
$sheet4->setTitle('Expenses');

$exp = expmodel::ReadToday();

// Set headers for sheet 2 (example of a different report)
$sheet4->setCellValue('A1', 'Name')
       ->setCellValue('B1', 'Amount')
       ->setCellValue('C1', 'Date')
       ->setCellValue('D1', 'Remarks');

// Example data for the second sheet
$row = 2;

foreach ($exp as $sc) {
    $sheet4->setCellValue('A' . $row, $sc->name ?? '')
           ->setCellValue('B' . $row, $sc->amount ?? '')
           ->setCellValue('C' . $row, $sc->date ?? '')
           ->setCellValue('D' . $row, $sc->remarks ?? '');
    $row++;
}

// ---- Save and Output the File ----
// Write the Excel file to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Ensure no further output is sent
exit;
?>
