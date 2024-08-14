<?php
$danhmuc_id = $_GET['danhmuc_id']
?>
<option value="">--Chọn--</option>
<?php
$db = new mysqli('localhost', 'root', '', 'website_bandothethao');
$query = "SELECT * FROM tbl_loaisanpham WHERE danhmuc_id = '$danhmuc_id'";
$result = $db->query($query);
if ($result) {
  while ($row = $result->fetch_assoc()) {
?>
<option value="<?php echo $row['loaisanpham_id']  ?>"><?php echo $row['loaisanpham_ten']  ?></option>
<?php
  }
}
?>