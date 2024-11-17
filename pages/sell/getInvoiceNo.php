<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once('../../include_commons.php');

if (!isset($_SESSION['userid'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

if (isset($_GET['pid']) && !empty($_GET['pid'])) {
    $code = $_GET['pid'];
    $result = subproductModel::ReadWithUnit($code);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
    exit; 
}


$seq = secuenceModel::ReadSingle('invoice');
$getNumber = str_pad((int)$seq->sno + 1, 4, '0', STR_PAD_LEFT);


$id = $seq->head . $getNumber;

if ($id) {
    header('Content-Type: application/json');
    echo json_encode($id);
    exit;
} else {
    header('HTTP/1.1 404 Not Found');
    exit;
}


?>