<?php 
session_start();
// echo '<pre>';
// print_r($_SESSION);
// exit();


if($_SESSION['role'] !='admin'){
	Header("Location: ../page-login.php");
	exit();
}
require_once('../connection.php');



//admin detail
$admin_id = $_SESSION['admin_id'];
$queryAdmin = "SELECT * FROM tb_ac_admin WHERE admin_id=$admin_id";
$rsAdmin = mysqli_query($Connection, $queryAdmin) or die (mysqli_connect_error($Connection));
$rowAdmin = mysqli_fetch_assoc($rsAdmin);
//print_r($rowAdmin);
//exit();

//เช็คการถูกระงับ
echo '
  <!-- sweet alert  -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

// if($rowAdmin['admin_show'] == 0){
// 		echo '<script>
// 			setTimeout(function() {
// 				swal({
// 					title: "คุณถูกระงับการใช้งาน !!",
// 					text: "กรุณาติดต่อผู้ดูแลระบบเพื่อปลดล็อค",
// 					type: "warning"
// 				}, function() {
// 			window.location = "../logout.php"; //หน้าที่ต้องการให้กระโดดไป
// 			});
// 			}, 1000);
// 		</script>';

// }



?>

