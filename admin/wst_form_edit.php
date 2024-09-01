  <?php 
$wst_id = $_GET['wst_id'];
$queryUpdateDetail = "SELECT * FROM tb_setting  WHERE wst_id=$wst_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}


//status
if ($rowDetail['wst_show'] == 1) {
   $wst_show = 'แสดง';
}else{
   $wst_show = 'ซ่อน';
}




?>  
<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มแก้ไขตั้งค่า </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">

      <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สถานะ : </font></label>
      <div class="col-sm-3">
        <select name="wst_show" class="form-control" required>

          <option value="<?=$rowDetail['wst_show'];?>"><?=$wst_show;?></option>
          <option disabled>-ปรับสถานะ</option>
            <option value="1">แสดง</option>
            <option value="0">ซ่อน</option>
        </select>
      </div>
    </div>


   
     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อเว็บไซต์ : </font></label>
      <div class="col-sm-5">
        <input type="text" name="wst_name" placeholder="ชื่อเว็บไซต์" required class="form-control" value="<?=$rowDetail['wst_name'];?>">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">Title : </font></label>
      <div class="col-sm-5">
        <input type="text" name="wst_title" placeholder="Title" required class="form-control" value="<?=$rowDetail['wst_title'];?>">
      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">About : </font></label>
      <div class="col-sm-5">
        <textarea name="wst_about" class="form-control" required placeholder="About"><?=$rowDetail['wst_about'];?></textarea>
      </div>
    </div>


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">อีเมล : </font></label>
      <div class="col-sm-3">
        <input type="email" name="wst_email" placeholder="อีเมล" required class="form-control" value="<?=$rowDetail['wst_email'];?>">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
      <div class="col-sm-3">
        <input type="text" name="wst_phone" placeholder="เบอร์โทร" required class="form-control" value="<?=$rowDetail['wst_phone'];?>">
      </div>
    </div>

 

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">โลโก้ : </font></label>
      <div class="col-sm-2">
        ภาพเก่า <br> 
        <img src="../img/wst/<?php echo $rowDetail["wst_img"];?>" width="200px"> <br> <br> 
        เลือกใหม่ <br> 
       <input type="file"  name="wst_img"   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
      </div>
    </div>
     
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-3">
        <input type="hidden" name="wst_id" value="<?=$rowDetail['wst_id'];?>">
        <input type="hidden" name="wst_img2" value="<?=$rowDetail['wst_img'];?>">
       <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">บันทึกข้อมูล</font></button>
    
      </div>
    </div>
  </form>

  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["wst_name"]) && isset($_POST["wst_id"]) ) {

 
        $wst_name = $_POST["wst_name"];
        $wst_title = $_POST["wst_title"];
        $wst_email = $_POST["wst_email"];
        $wst_phone = $_POST["wst_phone"];
        $wst_id = $_POST["wst_id"];
        $wst_img2 = $_POST["wst_img2"];
        $wst_show = $_POST['wst_show'];
        $wst_about = $_POST['wst_about'];


         
         //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $wst_img = (isset($_POST['wst_img']) ? $_POST['wst_img'] : '');
    $upload=$_FILES['wst_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['wst_img']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/wst/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
 

          $sql = "UPDATE tb_setting SET 
      
          wst_name='$wst_name',
          wst_title='$wst_title',
          wst_email='$wst_email',
          wst_phone='$wst_phone',
          wst_img='$newname',
          wst_show='$wst_show',
          wst_about='$wst_about'

          WHERE wst_id=$wst_id
        ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          // echo $sql;

          // exit();

          
         if($result){
           move_uploaded_file($_FILES['wst_img']['tmp_name'],$path_copy); 
           //delete img
           unlink('../img/wst/'.$wst_img2);
           mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ปรับปรุงข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "wst.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "wst.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                  } //type file


                }else{ //update no img

                 
           $sql = "UPDATE tb_setting SET 
        
          wst_name='$wst_name',
          wst_title='$wst_title',
          wst_email='$wst_email',
          wst_phone='$wst_phone',
          wst_show='$wst_show',
          wst_about='$wst_about'

          WHERE wst_id=$wst_id
        ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
           
           mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ปรับปรุงข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "wst.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "wst.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                }
          }  //isset
?>