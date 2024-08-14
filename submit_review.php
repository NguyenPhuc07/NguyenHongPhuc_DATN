<?php
include "./config/config.php";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $query = "INSERT INTO product_reviews (customer_id, product_id, rating, review_text) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iiis', $customer_id, $product_id, $rating, $review);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: detail.php?success=1");
        exit();
    } else {
        header("Location: detail.php?error=1");
        exit();
    }
}
