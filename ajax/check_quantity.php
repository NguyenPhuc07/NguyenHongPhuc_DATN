<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sanpham_id = $_POST['sanpham_id'];
    $quantitys = $_POST['quantitys'];

    $connection = mysqli_connect("localhost", "root", "", "website_bandothethao");
    $query = "SELECT so_luong FROM tbl_sanpham WHERE sanpham_id = '$sanpham_id'";
    $result = $connection->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['so_luong'];
        if ($availableQuantity < $quantitys) {
            echo "not_enough_quantity";
        } else {
            echo "enough_quantity";
        }
    } else {
        echo "error";
    }
}
?>