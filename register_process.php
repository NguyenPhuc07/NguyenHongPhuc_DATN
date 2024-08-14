<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$query = "SELECT * FROM khach_hang WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: register.php?error=1");
} else {
    $query = "INSERT INTO khach_hang (ten, email, mat_khau) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Đăng ký thất bại: " . $stmt->error;
    }
}
?>
