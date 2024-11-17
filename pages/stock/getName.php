<?php
session_start();
include_once('../../include_commons.php');

if (!isset($_SESSION['userid'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

$error_u = false;
$error_p = false;

$str = $_GET['q'] ?? null;
$sd = $_GET['sd'] ?? null;

// Fetch product data if ID is provided
if ($str) {
    $product = scentityModel::getNames($str);
    if ($product) {
        header('Content-Type: application/json');
        echo json_encode($product);
        exit;
    } else {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
} else if($sd){
    $sdNames = sdentityModel::getNames($sd);
    if ($sdNames) {
        header('Content-Type: application/json');
        echo json_encode($sdNames);
        exit;
    } else {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    exit;
}
?>