<?php
if(isset($_GET['status_id'])){
$sql_script = "DELETE FROM tb_ac_status WHERE status_id = '".$_GET["status_id"]."' ";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
mysqli_close($Connection);
	if($result){
		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>