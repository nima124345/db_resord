<?php
session_start();
//print_r($_SESSION);
//member detail
// Turn off error reporting
error_reporting(0);
$admin_id = $_SESSION['admin_id'];
 if($admin_id == ''){
                echo "<script type='text/javascript'>";
                echo "alert('กรุณา สมัครสมาชิกก่อนทำการจองห้องพัก !!');";
                echo "window.location = 'register.php'; ";
                echo "</script>";
                exit();
                }

require_once('connection.php');

echo ' <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

// echo '<pre>';
// print_r($_GET);
// exit();

if (isset($_GET['page']) && $_GET['page']=='saveBooking' && isset($_GET['room_id']) && $_SESSION['admin_id']!='') {
	# code...

$room_id = $_GET['room_id'];
$checkInDate = $_GET['checkInDate']. ' 14:00:00';
$checkOutDate = $_GET['checkOutDate']. ' 12:00:00';
$totalDate = $_GET['totalDate'];
$booking_amount = $_GET['booking_amount'];
$user_id = $_SESSION['admin_id'];

//sql insert booking

 $sql = "INSERT INTO tb_booking
          (
          user_id,
          room_id,
          checkInDate,
          checkOutDate,
          totalDate,
          booking_amount,
          booking_status
          )
          VALUES
          (
          '$user_id',
          '$room_id',
          '$checkInDate',
          '$checkOutDate',
          '$totalDate',
          '$booking_amount',
          '2'
      		)";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
          $booking_id=mysqli_insert_id($Connection);
          mysqli_close($Connection);
         if($result){
          
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "บันทึกข้อมูลสำเร็จ",
                                text: "ขั้นตอนต่อไป กรุณาชำระเงินให้ถูกต้อง",
                                type: "success"
                            }, function() {
                                window.location = "member.php?page=payment&booking_id='.$booking_id.'&act=show-payment-form"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  }else{
                     echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เกิดข้อผิดพลาด",
                                type: "error"
                            }, function() {
                                window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

} //isset
?>