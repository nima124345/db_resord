    <?php
// echo '<pre>';
// print_r($_GET);

if (isset($_GET['page']) && $_GET['page']=='cancelBooking' && isset($_GET['booking_id'])) {
	# code...

$booking_id = $_GET['booking_id'];
 

//sql insert booking

 $sql = "UPDATE  tb_booking SET 
          booking_status=0,
          remark='ลูกค้ายกเลิก'
          WHERE booking_id=$booking_id
          ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
          mysqli_close($Connection);
         if($result){
          
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ยกเลิกการจองสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
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