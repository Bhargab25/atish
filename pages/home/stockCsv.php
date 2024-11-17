<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once('../../include_commons.php'); 
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="ReportOn'.date("Y-m-d H:i:s").'.csv"');


// $dat = $_GET['dat'];
// $startdate = substr($dat, 0, 10);
// $enddate = substr($dat,13);
$stock = Stock::ReadAll();/**/
$csvdata []='Category,Name,Qty,Unit';

foreach($stock as $s){

  $csvdata []= $s->main.','.$s->name.','.$s->qty.','.$s->unit."\n";         
    
}
//print_r($csvdata);
$fp = fopen('php://output', 'wb');
foreach ( $csvdata as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);
?>