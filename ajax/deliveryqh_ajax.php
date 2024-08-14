<?php
include "../lib/database.php";
if(isset($_GET['tinh_id']))
{
    $tinh = $_GET['tinh_id'];
  
}
?>

<option value="#">Chọn Quận/Huyện</option>
<?php
 $query = "SELECT DISTINCT tinh_tp,ma_tinh,quan_huyen,ma_qh FROM tbl_diachi WHERE ma_tinh = '$tinh' ORDER BY ma_qh";
 $db = new Database();
 $result = $db ->selectdc($query);
 $show_diachi_qh = $result;
if($show_diachi_qh){while($result = $show_diachi_qh->fetch_assoc()){
 ?>
<option value="<?php echo $result['ma_qh'] ?>"><?php echo $result['quan_huyen'] ?></option>
<?php
}}
?>