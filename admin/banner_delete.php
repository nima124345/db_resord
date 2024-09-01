<?php
if(isset($_GET['banner_id'])){
$banner_id = $_GET['banner_id'];

$queryUpdateDetail = "SELECT * FROM tb_banner WHERE banner_id=$banner_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['banner_img'];


$sql_script = "DELETE FROM tb_banner WHERE banner_id=$banner_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/banner/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "banner.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>