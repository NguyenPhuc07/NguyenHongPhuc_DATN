<?php
include "header2.php";
?>
<?php
if (isset($_GET['sanpham_id']) && $_GET['sanpham_id'] != NULL) {
    $sanpham_id = $_GET['sanpham_id'];
}
?>
<?php
$id_product = null;
?>
<!-- -----------------------PRODUCT---------------------------------------------- -->
<section class="product">
    <div class="container">
        <div class="product-top row">
            <?php
            if (isset($sanpham_id)) {
                $get_sanpham = $index->get_sanpham($sanpham_id);
                if ($get_sanpham) {
                    $resultE = $get_sanpham->fetch(PDO::FETCH_ASSOC);
                }
            }
            ?>
            <p><a href="index.php">Trang chủ</a></p> <span>&#8594;</span>
            <p><?php echo $resultE['danhmuc_ten'] ?></p><span>&#8594;</span>
            <p><?php echo $resultE['loaisanpham_ten'] ?></p><span>&#8594;</span>
            <p><?php echo $resultE['sanpham_tieude'] ?></p>
        </div>
        <div class="product-content row">
            <?php
            if (isset($sanpham_id)) {
                $get_sanpham = $index->get_sanpham($sanpham_id);
                // Kiểm tra nếu $get_sanpham là một đối tượng PDOStatement và có ít nhất một phần tử
                if ($get_sanpham) {
                    while ($result = $get_sanpham->fetch(PDO::FETCH_ASSOC)) {
            ?>
                        <div class="product-content-left row">
                            <div class="product-content-left-big-img">
                                <img class="sanpham_anh" src="./admin/admin/uploads/<?php echo $result['sanpham_anh'] ?>" alt="">
                            </div>
                            <div class="product-content-left-small-img">
                                <?php
                                $sanpham_id = $result['sanpham_id'];
                                $get_anh = $index->get_anh($sanpham_id);

                                // Kiểm tra nếu $get_anh là một đối tượng PDOStatement và có ít nhất một phần tử
                                if ($get_anh) {
                                    while ($resultA = $get_anh->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <img src="./admin/admin/uploads/<?php echo $resultA['sanpham_anh'] ?>" alt="">
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="product-content-right">
                            <div class="product-content-right-product-name">
                                <input class="session_id" type="hidden" value="<?php echo session_id() ?>">
                                <?php $id_product = $result['sanpham_id'] ?>
                                <input class="sanpham_id" type="hidden" value="<?php echo $result['sanpham_id'] ?>">
                                <h1 class="sanpham_tieude"><?php echo $result['sanpham_tieude'] ?></h1>
                                <p><?php echo $result['sanpham_ma'] ?></p>
                            </div>
                            <div class="product-content-right-product-price">
                                <p><span><?php $resultC = number_format($result['sanpham_gia']);
                                            echo $resultC ?></span><sup>đ</sup>
                                </p>
                                <input class="sanpham_gia" type="hidden" value="<?php echo $result['sanpham_gia'] ?>">
                            </div>
                            <div class="product-content-right-product-color">
                                <p><span style="font-weight: bold;">Màu sắc</span>:<?php echo $result['color_ten'] ?> <span style="color: red;">*</span></p>
                                <div class="product-content-right-product-color-IMG">
                                    <img class="color_anh" src="./admin/admin/uploads/<?php echo $result['color_anh'] ?>" alt="">
                                </div>
                            </div>

                            <div class="product-content-right-product-size">
                                <p style="font-weight: bold"> Size: </p>
                                <div class="size">
                                    <?php
                                    $sanpham_id = $result['sanpham_id'];
                                    $get_size = $index->get_size($sanpham_id);

                                    // Kiểm tra nếu $get_size là một đối tượng PDOStatement và có ít nhất một phần tử
                                    if ($get_size) {
                                        while ($resultV = $get_size->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <div class="size-item">
                                                <input class="size-item-input" value="<?php echo $resultV['sanpham_size'] ?>" name="size-item" type="radio">
                                                <span><?php echo $resultV['sanpham_size'] ?></span>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <div class="quantity">
                                    <p style="font-weight: bold"> Số lượng: </p>
                                    <input class="quantitys" type="number" min="1" value="1">
                                </div>
                                <button class="favorite-btn">
                                    <i class="fas fa-heart"></i> <!-- Font Awesome heart icon -->
                                    <p>Yêu thích</p>
                                </button>

                                <p class="size-alert" style="color: red;"></p>
                            </div>
                            <div class="product-content-right-product-button">
                                <button class="add-cart-btn"> <i class="fas fa-shopping-cart"></i>
                                    <p>THÊM VÀO GIỎ HÀNG</p>
                                </button>
                                <button>
                                    <p>TÌM TẠI CỬA HÀNG</p>
                                </button>
                            </div>
                            <div class="product-content-right-product-icon">
                                <div class="product-content-right-product-icon-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <p>Hotline</p>
                                </div>
                                <div class="product-content-right-product-icon-item">
                                    <i class="far fa-comments"></i>
                                    <p>Chat</p>
                                </div>
                                <div class="product-content-right-product-icon-item">
                                    <i class="far fa-envelope"></i>
                                    <p>Mail</p>
                                </div>
                            </div>
                            <div class="product-content-right-product-QR">
                                <img src="image/qrcode2.png" alt="">
                            </div>
                            <div class="product-content-right-bottom">
                                <div class="product-content-right-bottom-top">
                                    &#8744;
                                </div>
                                <div class="product-content-right-bottom-content-big">
                                    <div class="product-content-right-bottom-title">
                                        <div class="product-content-right-bottom-title-item chitiet">
                                            <p>Chi tiết</p>
                                        </div>
                                        <div class="product-content-right-bottom-title-item baoquan">
                                            <p>Bảo quản</p>
                                        </div>
                                        <div class="product-content-right-bottom-title-item">
                                            <p>Tham khảo size</p>
                                        </div>
                                    </div>
                                    <div class="product-content-right-bottom-content">
                                        <div class="product-content-right-bottom-content-chitiet">
                                            <?php echo $result['sanpham_chitiet'] ?>
                                        </div>
                                        <div class="product-content-right-bottom-content-baoquan">
                                            <?php echo $result['sanpham_baoquan'] ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
        <section class="product-reviews">
            <h2 style="margin-bottom: 30px">Đánh giá sản phẩm</h2>

            <form action="" method="GET" style="margin-bottom: 20px;">
                <input type="hidden" name="sanpham_id" value="<?php echo htmlspecialchars($sanpham_id); ?>">
                <label for="sort">Sắp xếp theo:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="default" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'selected' : ''; ?>>Mặc định</option>
                    <option value="1" <?php echo isset($_GET['sort']) && $_GET['sort'] == '1' ? 'selected' : ''; ?>>1 Sao</option>
                    <option value="2" <?php echo isset($_GET['sort']) && $_GET['sort'] == '2' ? 'selected' : ''; ?>>2 Sao</option>
                    <option value="3" <?php echo isset($_GET['sort']) && $_GET['sort'] == '3' ? 'selected' : ''; ?>>3 Sao</option>
                    <option value="4" <?php echo isset($_GET['sort']) && $_GET['sort'] == '4' ? 'selected' : ''; ?>>4 Sao</option>
                    <option value="5" <?php echo isset($_GET['sort']) && $_GET['sort'] == '5' ? 'selected' : ''; ?>>5 Sao</option>
                </select>
            </form>

            <?php
            $servername = DB_HOST;
            $username = DB_USER;
            $password = DB_PASS;
            $dbname = DB_NAME;
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
            $sanpham_id = isset($_GET['sanpham_id']) ? $_GET['sanpham_id'] : '';

            if ($sanpham_id) {
                $sql = "SELECT pr.rating, pr.review_text, kh.ten AS customer_name 
                FROM product_reviews pr
                JOIN khach_hang kh ON pr.customer_id = kh.id
                WHERE pr.product_id = ?";

                if ($sort !== 'default') {
                    $sql .= " AND pr.rating = ?";
                }

                $sql .= " ORDER BY pr.rating DESC";

                $stmt = $conn->prepare($sql);

                if ($sort !== 'default') {
                    $stmt->bind_param("ii", $sanpham_id, $sort);
                } else {
                    $stmt->bind_param("i", $sanpham_id);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                        <div class="review-item" style="margin-bottom: 10px">
                            <h3 style="margin-bottom: 3px"><?php echo htmlspecialchars($row['customer_name']); ?></h3>
                            <p>Rating: <?php echo htmlspecialchars($row['rating']); ?>/5</p>
                            <p><?php echo htmlspecialchars($row['review_text']); ?></p>
                        </div>
            <?php
                    }
                } else {
                    echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
                }

                $stmt->close();
            }
            $conn->close();
            ?>
        </section>


    </div>
</section>

<!-- -------------------------SẢN PHẨM LIÊN QUAN -->
<section class="product-related">
    <div class="container">
        <!-- <div class="product-related-title">
            <p>SẢN PHẨM LIÊN QUAN</p>
        </div> -->
        <div class="row justify-between">
            <?php
            if (isset($loaisanpham_id)) {
                /* $get_sanphamlienquan = $index->get_sanphamlienquan($loaisanpham_id, $sanpham_id);
                if ($get_sanphamlienquan) {
                    while ($resultZ = $get_sanphamlienquan->fetch(PDO::FETCH_ASSOC)) {

                        ?>
            <div class="product-related-item">
                <a href="product.php?sanpham_id=<?php echo $resultZ['sanpham_id'] ?>"><img
                        src="./admin/admin/uploads/<?php echo $resultZ['sanpham_anh'] ?>" alt=""></a>
                <a href="product.php?sanpham_id=<?php echo $resultZ['sanpham_id'] ?>">
                    <h1><?php echo $resultZ['sanpham_tieude'] ?></h1>
                </a>
                <p><?php $resultA = number_format($resultZ['sanpham_gia']);
                            echo $resultA ?><sup>đ</sup></p>
                <span>_new_</span>
            </div>
            <?php
                    }
                } */
            }
            ?>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        var s = '';

        $('.size-item-input').each(function(index) {
            $(this).change(function() {
                s = $(this).val();
            });
        });

        $('.add-cart-btn').click(function() {
            if (s == "") {
                $('.size-alert').text('Vui lòng chọn size*');
            } else {
                var x = $(this).parent().parent().find('.sanpham_tieude').text();
                var se = $(this).parent().parent().find('.session_id').val();
                var sp = $(this).parent().parent().find('.sanpham_id').val();
                var y = $(this).parent().parent().parent().find('.sanpham_anh').attr('src');
                var newY = y.replace('./admin/', '');
                var z = $(this).parent().parent().find('.sanpham_gia').val();
                var c = $(this).parent().parent().find('.color_anh').attr('src');
                var newC = c.replace('./admin/', '');
                var q = $(this).parent().parent().find('.quantitys').val();

                // Gửi yêu cầu kiểm tra số lượng
                $.ajax({
                    url: "./ajax/check_quantity.php",
                    method: "POST",
                    data: {
                        sanpham_id: sp,
                        quantitys: q
                    },
                    success: function(data) {
                        console.log(data);
                        if (data === "not_enough_quantity") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Số lượng không đủ',
                                text: 'Sản phẩm không đủ số lượng trong kho!',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            $.ajax({
                                url: "./ajax/cart_ajax.php",
                                method: "POST",
                                data: {
                                    session_id: se,
                                    sanpham_id: sp,
                                    sanpham_tieude: x,
                                    sanpham_anh: newY,
                                    sanpham_gia: z,
                                    color_anh: newC,
                                    quantitys: q,
                                    sanpham_size: s
                                },
                                success: function(data) {
                                    console.log(data);
                                    $(location).attr('href', './cart.php');
                                }
                            });
                        }
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var khachhang_id = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
        var sanpham_id = <?php echo $id_product ?>;

        function checkFavorite() {
            if (khachhang_id && sanpham_id) {
                $.ajax({
                    url: "check_favorite.php",
                    method: "POST",
                    data: {
                        khachhang_id: khachhang_id,
                        sanpham_id: sanpham_id
                    },
                    success: function(response) {
                        if (response === "exists") {
                            $('.favorite-btn').addClass('liked');
                        }
                    }
                });
            }
        }
        checkFavorite();


        $('.favorite-btn').click(function() {
            var khachhang_id = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
            var sanpham_id = <?php echo $id_product ?>;

            if (khachhang_id === null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Bạn chưa đăng nhập!',
                    text: 'Vui lòng đăng nhập để yêu thích sản phẩm.',
                    confirmButtonText: 'Đăng nhập'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            } else {
                var $this = $(this);
                $.ajax({
                    url: "favorite_ajax.php",
                    method: "POST",
                    data: {
                        khachhang_id: khachhang_id,
                        sanpham_id: sanpham_id
                    },
                    success: function(response) {
                        if (response == "added") {
                            $this.addClass('liked');
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!',
                                text: 'Sản phẩm đã được thêm vào danh sách yêu thích.',
                                confirmButtonText: 'OK'
                            });
                        } else if (response == "removed") {
                            $this.removeClass('liked');
                            Swal.fire({
                                icon: 'info',
                                title: 'Thành công!',
                                text: 'Sản phẩm đã bị xóa khỏi danh sách yêu thích.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<!-- -------------------------Footer -->
<?php
include "footer.php"
?>