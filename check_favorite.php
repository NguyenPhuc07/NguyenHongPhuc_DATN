<?php
include_once("./config/config.php");
session_start();

if (isset($_POST['khachhang_id']) && isset($_POST['sanpham_id'])) {
    $khachhang_id = $_POST['khachhang_id'];
    $sanpham_id = $_POST['sanpham_id'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }

    $query = "SELECT * FROM sanpham_yeuthich WHERE khachhang_id = ? AND sanpham_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $khachhang_id, $sanpham_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }

    $stmt->close();
    $mysqli->close();
}
