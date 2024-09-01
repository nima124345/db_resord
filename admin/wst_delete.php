<?php
if(isset($_GET['wst_id'])){
$wst_id = $_GET['wst_id'];

$queryUpdateDetail = "SELECT * FROM tb_setting WHERE wst_id=$wst_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['wst_img'];


$sql_script = "DELETE FROM tb_setting WHERE wst_id = $wst_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/wst/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "wst.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>