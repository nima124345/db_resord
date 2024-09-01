<br>   <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มสถานะ/สิทธิ์ผู้ใช้งาน </font></h4>
  <hr>
  <form action="" method="post">
   
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อสถานะ : </font></label>
      <div class="col-sm-5">
        <input type="text" required name="status_name" class="form-control" placeholder="ชื่อสถานะ">
      </div>
    </div>
     
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-3">
       <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">เพิ่มข้อมูล</font></button>
    
      </div>
    </div>
  </form>

  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["status_name"])) {
        $status_name = $_POST["status_name"];

          $check = "
          SELECT  status_name 
          FROM tb_ac_status  
          WHERE status_name = '$status_name' 
          ";
            $result1 = mysqli_query($Connection, $check) or die(mysqli_error($Connection));
            $num=mysqli_num_rows($result1);

            // echo $num;
            // exit();

            if($num > 0)
            {
              echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "ข้อมูลซ้ำ !!",
                          text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                          type: "error"
                      }, function() {
                          window.location = "status.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{
          
          $sql = "INSERT INTO tb_ac_status
          (status_name)
          VALUES
          ('$status_name')";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
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

            } //else
  

          }  //isset
?>