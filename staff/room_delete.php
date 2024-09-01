<?php
if(isset($_GET['room_id'])){
$room_id = $_GET['room_id'];

$queryUpdateDetail = "SELECT * FROM tb_room WHERE room_id=$room_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['room_img'];


$sql_script = "DELETE FROM tb_room WHERE room_id = $room_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/room/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "room.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>