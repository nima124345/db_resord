<?php
include 'section-header.php';
include 'section-top-header.php';
include 'section-navbar.php';
?>
<!-- Rooms Area Start -->
<div class="roberto-rooms-area section-padding-50-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"> <hr> </div>
            
            <div class="col-lg-2"> </div>
            <div class="col-lg-10">
                <br>
                <h4><font face="TH Sarabun New"> สมัครสมาชิก <hr> </font></h4>
       
                <form action="" method="post">
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อผู้ใช้ : </font></label>
                        <div class="col-sm-4">
                            <input type="text" required name="admin_name" class="form-control" placeholder="Username">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รหัสผ่าน : </font></label>
                        <div class="col-sm-4">
                            <input type="password" required name="admin_password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="confirm_password" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ยืนยันรหัสผ่าน : </font></label>
                        <div class="col-sm-4">
                            <input type="password" required name="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อ : </font></label>
                        <div class="col-sm-5">
                            <input type="text" required name="admin_firstname" class="form-control" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">นามสกุล : </font></label>
                        <div class="col-sm-5">
                            <input type="text" required name="admin_surname" class="form-control" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
                        <div class="col-sm-5">
                            <input type="text" required name="admin_phone" class="form-control" placeholder="เบอร์โทร 10 หลัก" minlength="10" maxlength="10">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ที่อยู่ : </font></label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="admin_address" required placeholder="ที่อยู่"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputText" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary"><font face="TH Sarabun New" size="4">สมัครสมาชิก</font></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Rooms Area End -->
     
<?php
include 'section-footer.php';

if(isset($_POST["admin_password"]) && isset($_POST["confirm_password"]) && isset($_POST["admin_name"])) {
    $admin_password = $_POST["admin_password"];
    $confirm_password = $_POST["confirm_password"];
    
    if($admin_password !== $confirm_password) {
        echo '<script>
                setTimeout(function() {
                  swal({
                      title: "รหัสผ่านไม่ตรงกัน",
                      text: "กรุณายืนยันรหัสผ่านให้ตรงกัน",
                      type: "error"
                  }, function() {
                      window.location = "register.php";
                  });
                }, 1000);
              </script>';
    } else {
        // ดำเนินการตรวจสอบและบันทึกข้อมูลในฐานข้อมูล
        $admin_address = $_POST["admin_address"];
        $admin_name = $_POST["admin_name"];
        $admin_firstname = $_POST["admin_firstname"];
        $admin_surname = $_POST["admin_surname"];
        $admin_phone = $_POST["admin_phone"];
        
        $check = "
        SELECT admin_name 
        FROM tb_ac_admin  
        WHERE admin_name = '$admin_name' 
        ";
        $result1 = mysqli_query($Connection, $check) or die(mysqli_error($Connection));
        $num = mysqli_num_rows($result1);
        
        if($num > 0) {
            echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "มีผู้ใช้ Username นี้แล้ว",
                          text: "กรอกข้อมูลใหม่อีกครั้ง",
                          type: "error"
                      }, function() {
                          window.location = "register.php";
                      });
                    }, 1000);
                </script>';
        } else {
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
                            title: "สมัครสมาชิกสำเร็จ",
                            text: "คลิก Ok เพื่อไปหน้า Login",
                            type: "success"
                        }, function() {
                            window.location = "page-login.php";
                        });
                      }, 1000);
                    </script>';
            } else {
                echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            type: "error"
                        }, function() {
                            window.location = "register.php";
                        });
                      }, 1000);
                    </script>';
            } 
        }
    }
}
?>
