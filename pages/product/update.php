<?php
session_start();
include_once('../../include_commons.php');

if (!isset($_SESSION['userid'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

$error_u = false;
$error_p = false;

$id = $_GET['id'] ?? null;

// Fetch product data if ID is provided
if ($id) {
    $product = productModel::ReadSingle($id);
    

    if ($product) {
        header('Content-Type: application/json');
        echo json_encode($product);
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
