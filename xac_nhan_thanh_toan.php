<!-- thêm xác nhận thanh toán -->

<?php
include "header.php";
?>

<?php

if (isset($_GET['message']) && $_GET['message'] === 'Successful.') {

    $session_idA = $_SESSION['session_idA'];
    $deliver_method = $_SESSION['deliver_method'];
    $method_payment = $_SESSION['method_payment'];
    $today = $_SESSION['today'];

    $insert_payment = $index->insert_payment($session_idA, $deliver_method, $method_payment, $today);
    
} else {
    echo 'Thanh toán thất bại';
}