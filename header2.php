<?php
@ob_start();
session_start();
$session_id = session_id();
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "class/index_class.php";
Session::init();
$index = new index;
?>

<?php
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $connection = new mysqli("localhost", "root", "", "website_bandothethao");
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $stmt = $connection->prepare("SELECT loaisanpham_id FROM tbl_sanpham WHERE sanpham_tieude LIKE ?");
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $stmt->bind_result($loaisanpham_id);

    if ($stmt->fetch()) {
        header("Location: cartegory.php?loaisanpham_id=" . urlencode($loaisanpham_id));
        exit();
    } else {
        header("Location: cartegory.php?loaisanpham_id=0");
        exit();
    }
    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/mainstyle.css">
    <title>Trang chủ | HongPhucSport</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="top">
        <div class="container">
            <div class="row">
                <div class="menu-bar">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="top-logo">
                    <a href="index.php"><img src="./image/hps.png" alt=""></a>
                </div>
                <div class="top-menu-items">
                    <ul>
                        <?php
                        $show_danhmuc = $index->show_danhmuc();
                        if ($show_danhmuc) {
                            foreach ($show_danhmuc as $result) {
                                $danhmuc_id = $result['danhmuc_id'];
                                $show_loaisanpham = $index->show_loaisanpham($danhmuc_id);

                                if ($danhmuc_id == 1 || $danhmuc_id == 2 || $danhmuc_id == 3) {
                                    if (!$show_loaisanpham || empty($show_loaisanpham)) {
                                        $danhmuc_ten = $result['danhmuc_ten'];
                                        echo '<li><a href="danhmuc.php?id=' . $danhmuc_id . '">' . $danhmuc_ten . '</a></li>';
                                    } else {
                                        echo '<li>' . $result['danhmuc_ten'] . '
                                             <ul class="top-menu-item">';
                                        foreach ($show_loaisanpham as $row) {
                                            echo '<li><a href="cartegory.php?loaisanpham_id=' . $row['loaisanpham_id'] . '">' . $row['loaisanpham_ten'] . '</a></li>';
                                        }
                                        echo '</ul><i class="fas fa-chevron-down"></i></li>';
                                    }
                                } else {
                                    $danhmuc_ten = $result['danhmuc_ten'];
                                    $danhmuc_ten_formatted = mb_strtolower($danhmuc_ten, 'UTF-8');
                                    $danhmuc_ten_formatted = preg_replace('/\s+/u', '-', $danhmuc_ten_formatted);
                                    $danhmuc_ten_formatted = preg_replace('/(\p{M})/u', '', $danhmuc_ten_formatted);
                                    echo '<li><a href="' . $danhmuc_ten_formatted . '.php">' . $danhmuc_ten . '</a></li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="top-menu-icons">
                    <ul>
                        <li>
                            <form method="GET" action="./?sanpham">
                                <input type="text" name="search" placeholder="Tìm kiếm...">
                                <i class="fas fa-search"></i>
                            </form>
                        </li>
                        <!-- <li>
                            <a href="./admin/admin"><i class="fas fa-user-secret"></i></a>
                        </li> -->
                        <li>
                            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?php if (Session::get('SL')) {
                                                                                                echo Session::get('SL');
                                                                                            } ?></span></a>
                            <div class="cart-content-mini">
                                <div class="cart-content-mini-top">
                                    <p>Giỏ hàng</p>
                                </div>
                                <?php
                                $session_id = session_id();
                                $show_cartF = $index->show_cartF($session_id);

                                // Kiểm tra xem $show_cartF có phải là đối tượng PDOStatement không
                                if ($show_cartF instanceof PDOStatement) {
                                    while ($result = $show_cartF->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <div class="cart-content-mini-item">
                                            <img style="width:50px" src="./admin/<?php echo $result['sanpham_anh'] ?>" alt="">
                                            <div class="cart-content-item-text">
                                                <h1><?php echo $result['sanpham_tieude'] ?></h1>
                                                <p>Màu: </p>
                                                <p>Size: <?php echo $result['sanpham_size'] ?></p>
                                                <p>SL: <?php echo $result['quantitys'] ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="cart-content-mini-bottom">
                                    <p><a href="cart.php">...Xem chi tiết</a></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
                                if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
                                    echo '<a href="#" class="text-decoration-none me-2 d-flex gap-2 align-items-center"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['user_name']) . '</a>';
                                } else {
                                    echo '<a href="#" class="text-decoration-none me-2 d-flex gap-2 align-items-center"><i class="fas fa-user"></i></a>';
                                }
                                echo '<a href="logout.php" class="text-decoration-none me-2">Đăng xuất</a>';
                            } else {
                                echo '<a href="login.php" class="text-decoration-none me-2">Đăng nhập</a>';
                                echo '<a href="register.php" class="text-decoration-none">Đăng ký</a>';
                            }
                            ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>