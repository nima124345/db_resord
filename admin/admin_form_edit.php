<?php 
$admin_id = $_GET['admin_id'];
$queryUpdateDetail = "SELECT * 
FROM tb_ac_admin  as a 
#INNER JOIN tb_ac_status as s ON a.status_id=s.status_id
WHERE admin_id=$admin_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}

 //query admin role
  $qrole = "
    SELECT *,
    CASE
    WHEN r.admin_status = 1 THEN 'Active'
    ELSE 'ระงับ'
    END AS adminStatus
    FROM tb_ac_admin_role  as r
    INNER JOIN tb_ac_status as s ON r.admin_role=s.status_id
    WHERE admin_id=$admin_id";
  $rrole = mysqli_query($Connection, $qrole);
  //$rwrol = mysqli_fetch_assoc($rrole);
?>  
<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มแก้ไขสิทธิ์ผู้ใช้งาน </font></h4>
  <hr>
  <form action="" method="post">

    <!--  <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สถานะ : </font></label>
      <div class="col-sm-3">
        <select name="admin_show" class="form-control" required>

          <option value="<?=$rowDetail['admin_show'];?>"><?=$admin_show;?></option>
          <option disabled>-ปรับสถานะ</option>
            <option value="1">Online</option>
            <option value="0">ระงับ</option>
        </select>
      </div>
    </div> -->

    

    <div class="row mb-2">
      <label class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สิทธิ์ผู้ใช้งาน :</font></label>
      <div class="col-sm-4">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>สิทธิการใช้งาน</th>
              <th>สถานะ</th>
              <th>แก้ไข</th>
            </tr>
          </thead>
          <tbody>
            <?php $k=1; foreach ($rrole as $rrole) { ?>
            <tr>
              <td><?=$k++;?></td>
              <td><?=$rrole['status_name'];?></td>
              <td><?=$rrole['adminStatus'];?></td>
              <td>
              <select name="admin_status[<?=$rrole['no'];?>]" class="form-control" required>
                <option value="<?=$rrole['admin_role'];?>"><?=$rrole['adminStatus'];?></option>
                <option disabled>-ปรับสถานะ</option>
                <option value="1">Active</option>
                <option value="0">ระงับ</option>
              </select>
              </td>
            </tr>
           <?php } ?>
          </tbody>
        </table>




       <!--  <select name="status_id" class="form-control" required>
           <option value="<?=$rowDetail['status_id'];?>"><?=$rowDetail['status_name'];?></option>
          
          <option disabled>-เลือกใหม่-</option>
          <?php
          $sql_script = "SELECT * FROM tb_ac_status";
          $result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
          $row_result = mysqli_fetch_assoc($result);
          ?>
          <?php
          do {
          ?>
          <option value="<?= $row_result['status_id'];?>"><?= $row_result['status_name'];?></option>
          <?php
          } while ($row_result = mysqli_fetch_assoc($result));
          ?>
        </select> -->
      </div>
    </div>


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อผู้ใช้ : </font></label>
      <div class="col-sm-3">
        <input type="text" name="admin_name" class="form-control" placeholder="Username" value="<?=$rowDetail['admin_name'];?>" disabled>
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รหัสผ่าน : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_password" class="form-control" placeholder="Password" value="<?=$rowDetail['admin_password'];?>">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อ : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_firstname" class="form-control" placeholder="ชื่อ" value="<?=$rowDetail['admin_firstname'];?>">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">นามสกุล : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_surname" class="form-control" placeholder="นามสกุล" value="<?=$rowDetail['admin_surname'];?>">
      </div>
    </div>
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
      <div class="col-sm-3">
        <input type="text" required name="admin_phone" class="form-control" placeholder="เบอร์โทร 10 หลัก" minlength="10" maxlength="10" value="<?=$rowDetail['admin_phone'];?>">
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

  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["admin_password"])  && isset($_POST["admin_id"])) {

       // $status_id = $_POST["status_id"];
        $admin_id = $_POST["admin_id"];
        $admin_password = $_POST["admin_password"];
        $admin_firstname = $_POST["admin_firstname"];
        $admin_surname = $_POST["admin_surname"];
        $admin_phone = $_POST["admin_phone"];
       

           
          
          $sql = "UPDATE tb_ac_admin SET
          
          admin_password='$admin_password',
          admin_firstname='$admin_firstname',
          admin_surname='$admin_surname',
          admin_phone='$admin_phone'
          
          WHERE admin_id=$admin_id";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));


          //update role 

          foreach ($_POST['admin_status'] as $no => $admin_status) {

          $sql2 = "UPDATE tb_ac_admin_role SET
          admin_status='$admin_status'
          
          WHERE no=$no";
          
          $result2 = mysqli_query($Connection, $sql2) or die ("Error in query: $sql2 " . mysqli_error($Connection));
          }
          

         

          
         if($result && $result2){
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "บันทึกข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

          }  //isset
?>