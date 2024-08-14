<!-- sửa lỗi giỏ hàng -->

<?php
include "header.php";

if (isset($_GET['cart_id']) && $_GET['cart_id'] != NULL) {
    $cart_id = $_GET['cart_id'];

    $delete_cart = $index->delete_cart($cart_id);

    $SL = 0;
    $TT = 0;

    foreach ($cart_items as $result) {
        $a = (int)$result['sanpham_gia'];
        $b = (int)$result['quantitys'];
        $TTA = $a * $b;

        $SL += $result['quantitys'];
        $TT += $TTA;
    }

    Session::set('SL', $SL);

    Session::set('TT', $TT);
}

header('Location: cart.php');
?>