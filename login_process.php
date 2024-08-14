<?php
session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM khach_hang WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['mat_khau'])) {
        $_SESSION['user_login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['ten'];
        header("Location: ./");
    } else {
        echo "Sai mật khẩu.";
    }
} else {
    echo "Email không tồn tại.";
}
?>