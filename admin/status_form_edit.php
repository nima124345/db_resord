  <?php 
$status_id = $_GET['status_id'];
$queryUpdateDetail = "SELECT * FROM tb_ac_status WHERE status_id=$status_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}

?>  
<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มแก้ไขสถานะ/สิทธิ์ผู้ใช้งาน </font></h4>
  <hr>
  <form action="" method="post">
   
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อสถานะ : </font></label>
      <div class="col-sm-5">
        <input type="text" required name="status_name" class="form-control" placeholder="ชื่อสถานะ" value="<?=$rowDetail['status_name'];?>">
      </div>
    </div>
     
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-3">
        <input type="hidden" name="status_id" value="<?=$rowDetail['status_id'];?>">
       <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">บันทึกข้อมูล</font></button>
    
      </div>
    </div>
  </form>

  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["status_name"]) && isset($_POST["status_id"]) ) {
        $status_name = $_POST["status_name"];
        $status_id = $_POST["status_id"];

         
          $sql = "UPDATE tb_ac_status SET status_name='$status_name'  WHERE status_id=$status_id ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ปรับปรุงข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result


          }  //isset
?>