<?php 
include ("../lib/database.php");
?>
<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $sanpham_tieude = $_POST['sanpham_tieude'];
    $session_idA =  $_POST['session_id'];
    $sanpham_id = $_POST['sanpham_id'];
    $sanpham_anh = $_POST['sanpham_anh'];
    $sanpham_gia = $_POST['sanpham_gia'];
    $color_anh = $_POST['color_anh'];
    $quantitys = $_POST['quantitys'];
    $sanpham_size = $_POST['sanpham_size'];
    echo $sanpham_anh,$session_idA,$sanpham_id,$sanpham_tieude,$sanpham_gia,$color_anh,$quantitys,$sanpham_size;
    $connection = mysqli_connect("localhost", "root", "", "website_bandothethao");
    /* $insert_cart = $index -> insert_cart($sanpham_anh,$session_idA,$sanpham_id,$sanpham_tieude,$sanpham_gia,$color_anh,$quantitys,$sanpham_size); */
    $query = "INSERT INTO tbl_cart (sanpham_anh,session_idA,sanpham_id,sanpham_tieude,sanpham_gia,color_anh,quantitys,sanpham_size) VALUES 
        ('$sanpham_anh','$session_idA','$sanpham_id','$sanpham_tieude','$sanpham_gia','$color_anh','$quantitys','$sanpham_size')";
    if (mysqli_query($connection, $query)) {
        echo "Thêm dữ liệu thành công";
    } else {
        echo "Lỗi khi thêm dữ liệu: " . mysqli_error($connection);
    }
    mysqli_close($connection);
    return  $query;
}
else {
    echo "không get được chế ơi";
}
?>