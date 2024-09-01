<?php
if(isset($_GET['news_id'])){
$news_id = $_GET['news_id'];

$queryUpdateDetail = "SELECT * FROM tb_news WHERE news_id=$news_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
$oldImg = $rowDetail['news_img'];


$sql_script = "DELETE FROM tb_news WHERE news_id=$news_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

	if($result){
    //delete img
           unlink('../img/news/'.$oldImg);
           mysqli_close($Connection);

		 echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "news.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
	}
} //isset
?>