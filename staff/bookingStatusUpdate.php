<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_POST['booking_id']) && isset($_POST['act'])) {
	$admin_id=$_SESSION['admin_id'];
	require_once('../connection.php');

	echo '
  		<!-- sweet alert  -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

	// echo '<pre>';
	// print_r($_POST);
	// 	exit();

		if ($_POST['act']=='cancel') {  //ยกเลิกการจอง
			   $booking_id = $_POST['booking_id'];
			   $remark = $_POST['remark'];

			  $sql = "UPDATE tb_booking SET 
	          booking_status=0,
	          remark='$remark',
	          staff_id='$admin_id'
	          WHERE booking_id=$booking_id
	        ";
	          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
	         if($result){
	           mysqli_close($Connection);
	                      echo '<script>
	                           setTimeout(function() {
	                            swal({
	                                title: "ยกเลิกการจองสำเร็จ",
	                                type: "success"
	                            }, function() {
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
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
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
	                            });
	                          }, 1000);
	                      </script>';
	                  } //else ของ if result
		}else if($_POST['act']=='payment'){ //ตรวจสอบการชำระเงิน

			   $booking_status = $_POST['booking_status'];
			   $booking_id = $_POST['booking_id'];
			   //$room_id = $_POST['room_id'];

			  $sql = "UPDATE tb_booking SET 
	          booking_status='$booking_status',
	          staff_id='$admin_id'
	          WHERE booking_id=$booking_id
	        ";
	          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
	         if($result){
	           mysqli_close($Connection);
	                      echo '<script>
	                           setTimeout(function() {
	                            swal({
	                                title: "ปรับสถานะการชำระเงินสำเร็จ",
	                                type: "success"
	                            }, function() {
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
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
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
	                            });
	                          }, 1000);
	                      </script>';
	                  } //else ของ if result

		}else if($_POST['act']=='ChkIN'){ //เช็คอิน

			   $car_no = $_POST['car_no'];
			   $booking_id = $_POST['booking_id'];

			  $sql = "UPDATE tb_booking SET 
			  car_no='$car_no',
	          booking_status=5,
	          staff_id='$admin_id'
	          WHERE booking_id=$booking_id
	        ";
	          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
	         if($result){
	           mysqli_close($Connection);
	                      echo '<script>
	                           setTimeout(function() {
	                            swal({
	                                title: "บันทึกการเข้าพัก (Check-IN)สำเร็จ",
	                                type: "success"
	                            }, function() {
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
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
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
	                            });
	                          }, 1000);
	                      </script>';
	                  } //else ของ if result


	        }else if($_POST['act']=='ChkOUTs'){ //เช็คเอ้า

			   $damage_detail = $_POST['damage_detail'];
			   $damage_total = $_POST['damage_total'];
			   $booking_id = $_POST['booking_id'];

			  $sql = "UPDATE tb_booking SET 
			  damage_detail='$damage_detail',
			  damage_total='$damage_total',
	          booking_status=1,
	          staff_id='$admin_id'
	          WHERE booking_id=$booking_id
	        ";
	          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
	         if($result){
	           mysqli_close($Connection);
	                      echo '<script>
	                           setTimeout(function() {
	                            swal({
	                                title: "บันทึกการคืนห้องพักสำเร็จ",
	                                type: "success"
	                            }, function() {
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
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
	                                window.location = "booking.php"; //หน้าที่ต้องการให้กระโดดไป
	                            });
	                          }, 1000);
	                      </script>';
	                  } //else ของ if result


	                } 


}else{
	exit();
} //isset



?>