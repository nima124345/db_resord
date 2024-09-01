<?php
if(isset($_GET['bank_id'])){
$bank_id = $_GET['bank_id'];

$queryUpdateDetail = "SELECT * FROM tb_bank WHERE bank_id=$bank_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['bank_img'];


$sql_script = "DELETE FROM tb_bank WHERE bank_id = $bank_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/bank/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "bank.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>