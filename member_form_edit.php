<?php 
$admin_id = $_SESSION['admin_id'];
$queryUpdateDetail = "SELECT * 
FROM tb_ac_admin  as a 
INNER JOIN tb_ac_status as s ON a.status_id=s.status_id
WHERE admin_id=$admin_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}

//status
if ($rowDetail['admin_show'] == 1) {
   $admin_show = 'Online';
}else{
   $admin_show = 'ระงับ';
}


?> 
<div class="row">
<div class="col-sm-3"></div> 
<div class="col-sm-7">
 
  <form action="" method="post">

     <!-- <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สถานะ : </font></label>
      <div class="col-sm-5">
        <select name="admin_show" class="form-control" required>

          <option value="<?=$rowDetail['admin_show'];?>"><?=$admin_show;?></option>
          <option disabled>-ปรับสถานะ</option>
            <option value="1">Online</option>
            <option value="0">ระงับ</option>
        </select>
      </div>
    </div> -->

    


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อผู้ใช้ : </font></label>
      <div class="col-sm-5">
        <input type="text" name="admin_name" class="form-control" placeholder="adminname" value="<?=$rowDetail['admin_name'];?>" disabled>
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รหัสผ่าน : </font></label>
      <div class="col-sm-5">
        <input type="password" required name="admin_password" class="form-control" placeholder="Password" value="<?=$rowDetail['admin_password'];?>">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อ : </font></label>
      <div class="col-sm-5">
        <input type="text" required name="admin_firstname" class="form-control" placeholder="ชื่อ" value="<?=$rowDetail['admin_firstname'];?>">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">นามสกุล : </font></label>
      <div class="col-sm-5">
        <input type="text" required name="admin_surname" class="form-control" placeholder="นามสกุล" value="<?=$rowDetail['admin_surname'];?>">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
      <div class="col-sm-5">
        <input type="text" required name="admin_phone" class="form-control" placeholder="เบอร์โทร 10 หลัก" minlength="10" maxlength="10" value="<?=$rowDetail['admin_phone'];?>">
      </div>
    </div>

    

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ที่อยู่ : </font></label>
      <div class="col-sm-6">
        <textarea class="form-control"  name="admin_address" required placeholder="ที่อยู่"><?=$rowDetail['admin_address'];?></textarea>
      </div>
    </div>




    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-3">
        <input type="hidden" name="admin_id" value="<?=$rowDetail['admin_id'];?>">
       <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">ปรับปรุงข้อมูล</font></button>
    
      </div>
    </div>
  </form>
</div>
</div>
  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["admin_password"])  && isset($_POST["admin_id"])) {

        $admin_id = $_POST["admin_id"];
        $admin_password = $_POST["admin_password"];
        $admin_firstname = $_POST["admin_firstname"];
        $admin_surname = $_POST["admin_surname"];
        $admin_phone = $_POST["admin_phone"];
        //$admin_show = $_POST["admin_show"];
        $admin_address = $_POST["admin_address"];

           
          
          $sql = "UPDATE tb_ac_admin SET

          #admin_show='$admin_show',
          admin_password='$admin_password',
          admin_firstname='$admin_firstname',
          admin_surname='$admin_surname',
          admin_phone='$admin_phone',
          admin_address='$admin_address'
          
          WHERE admin_id=$admin_id";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "บันทึกข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "member.php?page=profile"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "member.php?page=profile"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

          }  //isset
?>