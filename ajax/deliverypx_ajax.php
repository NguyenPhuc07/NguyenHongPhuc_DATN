<?php
include "../lib/database.php";
if(isset($_GET['quan_huyen_id']))
{
    $quan_huyen_id = $_GET['quan_huyen_id'];
  
}
?>

<option value="#">Chọn Phường/Xã</option>
<?php
 $query = "SELECT DISTINCT tinh_tp,ma_tinh,quan_huyen,ma_qh,phuong_xa,ma_px FROM tbl_diachi WHERE ma_qh = '$quan_huyen_id' ORDER BY ma_px";
 $db = new Database();
 $result = $db ->selectdc($query);
 $show_diachi_px = $result;
if($show_diachi_px){while($result = $show_diachi_px->fetch_assoc()){
 ?>
<option value="<?php echo $result['ma_px'] ?>"><?php echo $result['phuong_xa'] ?></option>
<?php
}}
?>