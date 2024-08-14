<?php
if (isset($_GET['admin_id'])) {
    Session::destroyAdmin();
}
?>

<section class="admin-content row space-between">
    <div class="admin-content-left">
        <section id="sidebar">
            <a href="index.php" class="brand">HONGPHUCSPORT</a>
            <ul class="side-menu">
                <li><a href="#"><i class='bx bxs-user-detail icon'></i> Xin Chào: <span
                            style="color:blue; font-size:16px; margin-left: 3px">
                            <?php echo Session::get('admin_name') ?></span></a>
                </li>
                <li class="divider" data-text="Main">Main</li>
                <li>
                    <a href="#"><i class='bx bxs-shopping-bag icon'></i> Đơn hàng <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="orderlist.php">Chưa hoàn thành</a></li>
                        <li><a href="orderlistdone.php">Đã hoàn thành</a></li>
                        <li><a href="orderlistall.php">Tất cả Đơn hàng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-category icon'></i> Danh Mục <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="cartegorylist.php">Danh sách</a></li>
                        <li><a href="cartegoryadd.php">Thêm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-box icon'></i> Loại Sản Phẩm <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="brandlist.php">Danh sách</a></li>
                        <li><a href="brandadd.php">Thêm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-palette icon'></i> Màu sắc <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="colorlist.php">Danh sách</a></li>
                        <li><a href="coloradd.php">Thêm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-cube icon'></i> Sản phẩm <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="productlist.php">Danh sách</a></li>
                        <li><a href="productadd.php">Thêm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-image-alt icon'></i> Ảnh Sản phẩm <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="anhsanphamlists.php">Danh sách</a></li>
                        <li><a href="anhsanphamadds.php">Thêm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class='bx bxs-ruler icon'></i> Size Sản phẩm <i
                            class='bx bx-chevron-right icon-right'></i></a>
                    <ul class="side-dropdown">
                        <li><a href="sizesanphamlists.php">Danh sách</a></li>
                        <li><a href="sizesanphamadds.php">Thêm</a></li>
                    </ul>
                </li>
                <li><a href="?admin_id=<?php echo Session::get('admin_id') ?>"><i class='bx bx-log-out icon'></i> Đăng
                        Xuất</a></li>
            </ul>
        </section>
    </div>

    <script src="js/sidebar.js"></script>