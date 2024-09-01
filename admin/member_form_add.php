<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มข้อมูลสมาชิก </font></h4>
  <hr>
  <form action="" method="post">
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อผู้ใช้ : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_name" class="form-control" placeholder="Username">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รหัสผ่าน : </font></label>
      <div class="col-sm-3">
        <input type="password" required name="admin_password" class="form-control" placeholder="Password">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อ : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_firstname" class="form-control" placeholder="ชื่อ">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">นามสกุล : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_surname" class="form-control" placeholder="นามสกุล">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_phone" class="form-control" placeholder="เบอร์โทร 10 หลัก" minlength="10" maxlength="10">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ที่อยู่ : </font></label>
      <div class="col-sm-3">
        <textarea class="form-control"  name="admin_address" required placeholder="ที่อยู่"></textarea>
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

  if(isset($_POST["admin_password"])  && isset($_POST["admin_name"])) {
        $admin_address = $_POST["admin_address"];
        $admin_name = $_POST["admin_name"];
        $admin_password = $_POST["admin_password"];
        $admin_firstname = $_POST["admin_firstname"];
        $admin_surname = $_POST["admin_surname"];
        $admin_phone = $_POST["admin_phone"];

          $check = "
          SELECT  admin_name 
          FROM tb_ac_admin  
          WHERE admin_name = '$admin_name' 
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
                          title: "มีผู้ใช้ Username นี้แล้ว",
                          text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                          type: "error"
                      }, function() {
                          window.location = "member.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{
          
          $sql = "INSERT INTO tb_ac_admin
          (admin_address,admin_name,admin_password,admin_firstname,admin_surname,admin_phone, status_id)
          VALUES
          ('$admin_address','$admin_name','$admin_password','$admin_firstname','$admin_surname','$admin_phone', 3)";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

            } //else
  

          }  //isset
?>