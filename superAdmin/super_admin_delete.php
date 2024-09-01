<?php
if(isset($_GET['admin_id'])){
  //1
$sqla = "DELETE FROM tb_ac_admin WHERE admin_id = '".$_GET["admin_id"]."' ";
$rsa = mysqli_query($Connection, $sqla) or die (mysqli_error($Connection));
 

	if($rsa){
		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "super_admin.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>