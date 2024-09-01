<?php 
session_start();

// echo '<pre>';
// print_r($_SESSION);
// exit();
if(empty($_SESSION['admin_id'])) {
	Header("Location: index.php");
}else{
//print_r($_SESSION);
$_SESSION["role"] = 'admin';
// echo '<pre>';
// print_r($_SESSION);
// exit();
Header("Location: admin/");
}
?>