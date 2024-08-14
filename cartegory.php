<?php
include "header.php";
echo "<div style='padding-top: 100px'></div>";
include "leftside.php";
?>

<?php
if (isset($_GET['loaisanpham_id']) && $_GET['loaisanpham_id'] != NULL) {
    $loaisanpham_id = $_GET['loaisanpham_id'];
}
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Điều chỉnh truy vấn dựa trên tùy chọn sắp xếp
switch ($sort_option) {
    case 'price_asc':
        $order_by = 'sanpham_gia ASC';
        break;
    case 'price_desc':
        $order_by = 'sanpham_gia DESC';
        break;
    case 'name_asc':
        $order_by = 'sanpham_tieude ASC';
        break;
    case 'name_desc':
        $order_by = 'sanpham_tieude DESC';
        break;
    default:
        $order_by = 'sanpham_id ASC';
        break;
}

$get_loaisanphamA = $index->get_loaisanpham($loaisanpham_id, $order_by);
$loaisanphamArray = $get_loaisanphamA->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="cartegory-right">
    <div class="row">
        <div class="col-4">
            <div class="cartegory-right-top row">
                <div class="cartegory-right-top-item pt-5">
                    <h3>LỰU CHỌN SẢN PHẨM PHÙ HỢP NHẤT DÀNH CHO BẠN</h3>
                    <p>Miễn phí vận chuyển toàn cầu cho tất cả đơn hàng trên 500.000đ – Hoàn trả và đổi hàng trong vòng 100 ngày</p>
                </div>
            </div>
        </div>
        <div class="col-8">
            <!-- Thêm lựa chọn sắp xếp -->
            <div class="d-flex justify-content-end mb-3 mt-5">
                <form method="GET" action="">
                    <input type="hidden" name="loaisanpham_id" value="<?php echo $loaisanpham_id; ?>">
                    <select name="sort" onchange="this.form.submit()">
                        <option value="default" <?php echo ($sort_option == 'default') ? 'selected' : ''; ?>>Mặc định</option>
                        <option value="price_asc" <?php echo ($sort_option == 'price_asc') ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
                        <option value="price_desc" <?php echo ($sort_option == 'price_desc') ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
                        <option value="name_asc" <?php echo ($sort_option == 'name_asc') ? 'selected' : ''; ?>>Tên từ A đến Z</option>
                        <option value="name_desc" <?php echo ($sort_option == 'name_desc') ? 'selected' : ''; ?>>Tên từ Z đến A</option>
                    </select>
                </form>
            </div>

            <div class="cartegory-right-content row">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    if ($loaisanphamArray && count($loaisanphamArray) > 0) {
                        foreach ($loaisanphamArray as $resultB) {
                            $sanpham_id = $resultB['sanpham_id'];
                            $ten_sanpham = $resultB['sanpham_tieude'];
                            $so_luong = $resultB['so_luong'];
                            $gia = number_format($resultB['sanpham_gia']);
                            $anh_sanpham = $resultB['sanpham_anh'];

                            if ($so_luong > 0) {
                    ?>
                                <div class="col">
                                    <div class="card">
                                        <img src="./admin/admin/uploads/<?php echo $anh_sanpham; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($ten_sanpham); ?>">
                                        <div class="card-body">
                                            <a href="product.php?sanpham_id=<?php echo $sanpham_id ?>">
                                                <h5 class="card-title"><?php echo htmlspecialchars($ten_sanpham); ?></h5>
                                            </a>
                                        </div>
                                        <div class="mb-2 p-3 d-flex flex-column justify-content-around">
                                            <h3><?php echo $gia; ?>đ</h3>
                                            <a href="product.php?sanpham_id=<?php echo $sanpham_id ?>" class="btn btn-primary">Mua Ngay</a>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } else {
                        echo "<div class='col-12'><p>Không có sản phẩm nào để hiển thị.</p></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>

<!-- -------------------------Footer -->
<?php
include "footer.php";
?>