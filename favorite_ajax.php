<?php
include_once("./config/config.php");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if (isset($_POST['khachhang_id']) && isset($_POST['sanpham_id'])) {
    $khachhang_id = $mysqli->real_escape_string($_POST['khachhang_id']);
    $sanpham_id = $mysqli->real_escape_string($_POST['sanpham_id']);

    $query = "SELECT * FROM sanpham_yeuthich WHERE khachhang_id = ? AND sanpham_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $khachhang_id, $sanpham_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $query = "DELETE FROM sanpham_yeuthich WHERE khachhang_id = ? AND sanpham_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ii', $khachhang_id, $sanpham_id);
        $stmt->execute();
        echo "removed";
    } else {
        $query = "INSERT INTO sanpham_yeuthich (khachhang_id, sanpham_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ii', $khachhang_id, $sanpham_id);
        $stmt->execute();
        echo "added";
    }
    $stmt->close();
}

$mysqli->close();
