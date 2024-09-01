<?php 
session_start();
if(empty($_SESSION['admin_id'])) {
	Header("Location: index.php");
}else{
$_SESSION["role"] = 'staff';
// echo '<pre>';
// print_r($_SESSION);
// exit();
Header("Location: staff/booking.php");
}
?>