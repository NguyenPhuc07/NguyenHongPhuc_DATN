<?php
include "header.php";
include "db.php"; // Chỉnh sửa file này để đưa vào thông tin kết nối MySQLi

// Thực hiện truy vấn để lấy danh sách sản phẩm
$query = "SELECT * FROM tbl_sanpham LIMIT 6";
$result = $db->query($query);

// Kiểm tra và lặp qua các sản phẩm để hiển thị
if ($result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC); // Lấy tất cả các dòng dữ liệu dưới dạng mảng liên hợp

    // Hiển thị sản phẩm
?>
    <div class="container">
        <?php include "slider.php"; ?>
    </div>
    <div class="container">
        <div class="gallery">
            <figure class="gallery__item gallery__item--1">
                <img src="image/grid/1.jpg" class="gallery__img" alt="Image 1">
            </figure>
            <figure class="gallery__item gallery__item--2">
                <img src="image/grid/2.jpg" class="gallery__img" alt="Image 2">
            </figure>
            <figure class="gallery__item gallery__item--4">
                <img src="image/grid/3.jpg" class="gallery__img" alt="Image 4">
            </figure>
            <figure class="gallery__item gallery__item--3">
                <img src="image/grid/5.jpg" class="gallery__img" alt="Image 5">
            </figure>
        </div>
    </div>
    <div class="container">
        <div class="section mt-5">
            <div class="title">
                <h2>SẢN PHẨM NỔI BẬT</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php foreach ($rows as $row) : ?>
                <div class="col">
                    <div class="card">
                        <img src="./admin/admin/uploads/<?php echo $row['sanpham_anh']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['sanpham_tieude']; ?></h5>
                        </div>
                        <div class="mb-5 d-flex justify-content-around">
                            <h3><?php echo $row['sanpham_gia']; ?>đ</h3>
                            <a href="product.php?sanpham_id=<?php echo $row['sanpham_id']; ?>" class="btn btn-primary">Mua Ngay</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
} else {
    echo "Không có sản phẩm nào được tìm thấy.";
}
include "call-to-action.php";
include "chatbot.php";
include "footer.php";
?>