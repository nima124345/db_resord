<?php
if(isset($_GET['room_id']) && isset($_GET['image_id'])){
$room_id = $_GET['room_id'];
$image_id = $_GET['image_id'];

$queryDetail = "SELECT * FROM tb_room_image WHERE image_id=$image_id ";
$rsDetail = mysqli_query($Connection, $queryDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['image_url'];


$sql_script = "DELETE FROM tb_room_image WHERE image_id = $image_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/roomGallery/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบภาพสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "room.php?act=img&room_id='.$room_id.'"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>