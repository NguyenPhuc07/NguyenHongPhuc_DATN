<?php
// define('__ROOT__', dirname(dirname(__FILE__))); 
/* require_once(__ROOT__.'\admin/admin/lib/database.php');
require_once(__ROOT__.'\admin/admin/lib/session.php'); */
// include "../lib/database.php";
// include "../lib/session.php";
include ("./lib/database.php");
include ("./lib/session.php");
?>

<?php
class admin
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();

    }
    public function check_admin($username, $userpassword)
    {
        $query = "SELECT * FROM tbl_admin WHERE admin_name = ? AND admin_password = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $params = [$username, $userpassword];

        $result = $this->db->execute($stmt, $params);

        if ($result && $result->rowCount() > 0) {
            $value = $result->fetch(PDO::FETCH_ASSOC);
            Session::set('user_login', true);
            Session::set('admin_name', $value['admin_name']);
            Session::set('admin_id', $value['admin_id']);

            header('Location:index.php');
        } else {
            $alert = "Tên đăng nhập hoặc mật khẩu không đúng";
            return $alert;
        }
    }




    // public function show_member(){
//     $query = "SELECT * FROM tbl_user ORDER BY userA_id DESC";
//     $result = $this -> db ->select($query);
//     return $result;
// }
// public function delete_comment($comment_id){
//     $query = "DELETE  FROM tbl_comment WHERE comment_id = '$comment_id'";
//     $result = $this -> db ->delete($query);
//     return $result;
//     // if($result) {$alert = "<span class = 'alert-style'> Delete Thành công</span> "; return $alert;}
//     // else {$alert = "<span class = 'alert-style'> Delete Thất bại</span>"; return $alert;}



    // }

    // public function insert_member($user_ten,$user_password){
//             $query = "INSERT INTO tbl_user (user_ten,user_password) VALUES ('$user_ten','$user_password')";
//             $result = $this ->db ->insert($query);
//             header('Location:memberlist.php');
//             return $result;


    //         }

    //     public function delete_member($userA_id){
//             $query = "DELETE  FROM tbl_user WHERE userA_id = '$userA_id'";
//             $result = $this -> db ->delete($query);
//             return $result;
//             // if($result) {$alert = "<span class = 'alert-style'> Delete Thành công</span> "; return $alert;}
//             // else {$alert = "<span class = 'alert-style'> Delete Thất bại</span>"; return $alert;}



    //         }



}


?>