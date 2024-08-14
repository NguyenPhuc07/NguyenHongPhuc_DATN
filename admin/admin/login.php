<?php
// include "class/cartegory_class.php";
include ('./class/admin_class.php');
session::init();
$admin = new admin();

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $userpassword = md5($_POST['password']);
    /* $userpassword = $_POST['password']; */
    // $userpassword = $_POST['password'];
    // var_dump($_POST);
    $check_admin = $admin->check_admin($username, $userpassword);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <title>HongPhucSport-Login</title>
</head>

<body>
    <div class="login wrapper">
        <div class="login-form">
            <span style="color:red; font-family: 'Bona Nova', serif;"><?php
            if (isset($check_admin)) {
                echo $check_admin;
            }
            ?></span>
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" id="loginButton" class="btn">Đăng Nhập</button>
            </form>
        </div>
    </div>
</body>

</html>