<?php
if(isset($_GET['admin_id'])){
  //1
$sqla = "DELETE FROM tb_ac_admin WHERE admin_id = '".$_GET["admin_id"]."' ";
$rsa = mysqli_query($Connection, $sqla) or die (mysqli_error($Connection));
 //2
$sqlr = "DELETE FROM tb_ac_admin_role WHERE admin_id = '".$_GET["admin_id"]."' ";
$rsr= mysqli_query($Connection, $sqlr) or die (mysqli_error($Connection));
mysqli_close($Connection);


	if($rsa && $rsr){
		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>