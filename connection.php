<?php
//exit;
// Turn off error reporting
error_reporting(0);
// เชื่อมต่อฐานข้อมูล
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_resort";
$Connection = mysqli_connect($hostname, $username, $password, $database) or die ("Error: " . mysqli_error($Connection));
// if (!$Connection) {
//   exit('ไม่สามารถเชื่อมต่อกับฐานข้อมูล');
// }

// ตั้งค่าชุดอักขระไคลเอนต์เริ่มต้น
mysqli_set_charset($Connection, "utf8");

// ตั้งค่าเขตเวลา
date_default_timezone_set("Asia/Bangkok");

?>