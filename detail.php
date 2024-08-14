<?php
include "header.php";
$session_id = session_id();
?>

<!-- -----------------------DELIVERY---------------------------------------------- -->
<section class="detail">
    <div class="container">
        <div class="detail-top">
            <p>CHI TIẾT ĐƠN HÀNG</p>
        </div>
        <h1>Mã đơn hàng:<span style="font-size: 20px; color: #378000;">HPS<?php $ma = substr($session_id, 0, 8);
                                                                            echo $ma ?></span></h1>
        <div class="detail-text">
            <div class="detail-text-left-content">
                <p><span style="font-weight: bold; color:red">Thông tin giao hàng</span></p>
                <br>
                <?php
                $show_order = $index->show_order($session_id);
                if ($show_order) {
                    while ($result = $show_order->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <p><span style="font-weight: bold;">Họ và tên</span>: <?php echo $result['customer_name'] ?></p>
                        <p><span style="font-weight: bold;">Số ĐT</span>: <?php echo $result['customer_phone'] ?></p>
                        <p><span style="font-weight: bold;">Địa chỉ</span>: <?php echo $result['customer_diachi'] ?>,
                            <?php echo $result['phuong_xa'] ?>, <?php echo $result['quan_huyen'] ?>,
                            <?php echo $result['tinh_tp'] ?></p>
                <?php
                    }
                }
                ?>
                <?php
                $show_payment = $index->show_payment($session_id);
                if ($show_payment) {
                    while ($result = $show_payment->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <p><span style="font-weight: bold;">Phương thức giao hàng</span>: <?php echo $result['giaohang'] ?></p>
                        <p><span style="font-weight: bold;">Phương thức thanh toán</span>: <?php echo $result['thanhtoan'] ?></p>
                <?php
                    }
                }
                ?>
            </div>
            <div class="detail-text-right-content">
                <p><span style="font-weight: bold;color:red">Thông tin đơn hàng</span></p>
                <br>
                <div class="mb-3">
                    <?php
                    if (isset($_GET['success'])) {
                        echo "<div style='text-align: center; color: green; font-weight: bold;'>Cảm ơn bạn đã đánh giá sản phẩm!</div>";
                    } elseif (isset($_GET['error'])) {
                        echo "<div style='text-align: center; color: red; font-weight: bold;'>Đã xảy ra lỗi, vui lòng thử lại.</div>";
                    }
                    ?>
                </div>
                <div class="detail-text-right">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>SL</th>
                            <th>Giá</th>
                        </tr>
                        <?php
                        $SL = 0;
                        $TT = 0;
                        $show_carta = $index->show_carta($session_id);
                        if ($show_carta) {
                            while ($result = $show_carta->fetch(PDO::FETCH_ASSOC)) {
                                // Kiểm tra đánh giá sản phẩm
                                $product_id = $result['sanpham_id'];
                                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                                $has_reviewed = false;

                                if ($user_id) {
                                    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                    $query = "SELECT COUNT(*) FROM product_reviews WHERE customer_id = ? AND product_id = ?";
                                    $stmt = $db->prepare($query);
                                    $stmt->bind_param("ii", $user_id, $product_id);
                                    $stmt->execute();
                                    $stmt->bind_result($count);
                                    $stmt->fetch();
                                    $stmt->close();

                                    if ($count > 0) {
                                        $has_reviewed = true;
                                    }
                                }
                        ?>
                                <tr>
                                    <td><img src="admin/<?php echo $result['sanpham_anh'] ?>" alt=""></td>
                                    <td>
                                        <p><?php echo $result['sanpham_tieude'] ?></p>
                                    </td>
                                    <td><img src="admin/<?php echo $result['color_anh'] ?>" alt=""></td>
                                    <td>
                                        <p><?php echo $result['sanpham_size'] ?></p>
                                    </td>
                                    <td><span><?php echo $result['quantitys'] ?></span></td>
                                    <td>
                                        <p><?php $resultC = number_format($result['sanpham_gia']);
                                            echo $resultC ?><sup>đ</sup></p>
                                    </td>
                                    <?php
                                    $a = (int)$result['sanpham_gia'];
                                    $b = (int)$result['quantitys'];
                                    $TTA = $a * $b;
                                    $TT += $TTA;
                                    $SL += $result['quantitys'];
                                    ?>
                                </tr>
                                <!-- Form đánh giá sản phẩm -->
                                <?php if (isset($_SESSION['user_id']) && !$has_reviewed) { ?>
                                    <tr>
                                        <td colspan="6">
                                            <form action="submit_review.php" method="POST" class="review-form">
                                                <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">
                                                <input type="hidden" name="product_id" value="<?php echo $result['sanpham_id']; ?>">

                                                <div class="form-group">
                                                    <label for="rating-<?php echo $result['sanpham_id']; ?>">Đánh giá:</label>
                                                    <select name="rating" id="rating-<?php echo $result['sanpham_id']; ?>" class="form-control">
                                                        <option value="5">5 Sao</option>
                                                        <option value="4">4 Sao</option>
                                                        <option value="3">3 Sao</option>
                                                        <option value="2">2 Sao</option>
                                                        <option value="1">1 Sao</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="review-<?php echo $result['sanpham_id']; ?>">Nhận xét:</label>
                                                    <textarea name="review" id="review-<?php echo $result['sanpham_id']; ?>" rows="3" class="form-control"></textarea>
                                                </div>

                                                <button type="submit" class="submit-btn">Gửi đánh giá</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } elseif (isset($_SESSION['user_id']) && $has_reviewed) { ?>
                                    <tr>
                                        <td colspan="6">
                                            <p style="color: red; font-weight: bold;">Bạn đã đánh giá sản phẩm này rồi.</p>
                                        </td>
                                    </tr>
                                <?php } ?>
                        <?php }
                        } ?>
                    </table>
                </div>
                <div class="detail-content-right-bottom">
                    <table>
                        <?php
                        if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {
                            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            $query = "SELECT SUM(diem_tich_luy_su_dung) AS total_discount, SUM(tong_tien) AS total_amount FROM tbl_order_moi WHERE session_idA = ?";
                            $stmt = $db->prepare($query);
                            $stmt->bind_param("s", $session_id);
                            $stmt->execute();
                            $stmt->bind_result($total_discount, $total_amount);
                            $stmt->fetch();
                            $stmt->close();
                            $giam_gia = $total_discount;
                            $tong_tien = $TT - $giam_gia;

                            if ($tong_tien < 0) {
                                $tong_tien = 0;
                            }
                        } else {
                            $giam_gia = 0;
                            $tong_tien = $TT;
                        }
                        ?>
                        <tr>
                            <th colspan="2">
                                <p>TỔNG TIỀN GIỎ HÀNG</p>
                            </th>
                        </tr>
                        <tr>
                            <td>TỔNG SẢN PHẨM</td>
                            <td><?php echo number_format($SL); ?></td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td>
                                <p><?php echo number_format($TT); ?><sup>đ</sup></p>
                            </td>
                        </tr>
                        <?php if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) { ?>
                            <tr>
                                <td>GIẢM GIÁ</td>
                                <td>
                                    <p><?php echo number_format($giam_gia); ?><sup>đ</sup></p>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>THÀNH TIỀN</td>
                            <td>
                                <p><?php echo number_format($tong_tien); ?><sup>đ</sup></p>
                            </td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td>
                                <p style="font-weight: bold; color: black;"><?php echo number_format($tong_tien); ?><sup>đ</sup></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="success-button">
            <a href="index.php"><button>TIẾP TỤC MUA SẮM</button></a>
        </div>
        <br>
        <p style="text-align: center;">Mọi thắc mắc quý khách vui lòng liên hệ hotline <span style="font-size: 20px; color: red;">0906 751 524 </span> hoặc chat với kênh hỗ trợ trên website để được hỗ trợ nhanh nhất.</p>
    </div>
</section>

<!-- -------------------------Footer -->
<?php
include "footer.php";
?>