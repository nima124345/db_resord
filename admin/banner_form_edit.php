  <?php 
$banner_id = $_GET['banner_id'];
$queryUpdateDetail = "SELECT * FROM tb_banner  WHERE banner_id=$banner_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}

?>  
<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มแก้ไขสไลด์ </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ข้อความ : </font></label>
      <div class="col-sm-5">
        <input type="text" name="banner_title" placeholder="ข้อความ" required class="form-control" value="<?=$rowDetail['banner_title'];?>">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ลิ้งค์ : </font></label>
      <div class="col-sm-7">
        <input type="text" name="banner_link" placeholder="ลิ้งค์" required class="form-control" value="<?=$rowDetail['banner_link'];?>">
      </div>
    </div>

     

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ภาพ : </font></label>
      <div class="col-sm-3">
        ภาพเก่า <br> 
        <img src="../img/banner/<?php echo $rowDetail["banner_img"];?>" width="200px"> <br> <br> 
        เลือกใหม่ <br> 
       <input type="file"  name="banner_img"   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
      </div>
    </div>
     
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-3">
        <input type="hidden" name="banner_id" value="<?=$rowDetail['banner_id'];?>">
        <input type="hidden" name="banner_img2" value="<?=$rowDetail['banner_img'];?>">
       <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">บันทึกข้อมูล</font></button>
    
      </div>
    </div>
  </form>

  <?php 
  // echo '<pre>';
  // print_r($_POST);
  // exit();

  if(isset($_POST["banner_title"]) && isset($_POST["banner_id"]) ) {

        
        $banner_title = $_POST["banner_title"];
        $banner_link = $_POST["banner_link"];
        $banner_id = $_POST["banner_id"];
        $banner_img2 = $_POST["banner_img2"];


         
         //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $banner_img = (isset($_POST['banner_img']) ? $_POST['banner_img'] : '');
    $upload=$_FILES['banner_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['banner_img']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/banner/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
 

          $sql = "UPDATE tb_banner SET 
      
          banner_link='$banner_link',
          banner_title='$banner_title',
          banner_img='$newname'

          WHERE banner_id=$banner_id
        ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
           move_uploaded_file($_FILES['banner_img']['tmp_name'],$path_copy); 
           //delete img
           unlink('../img/banner/'.$banner_img2);
           mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "ปรับปรุงข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "banner.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "banner.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                  } //type file


                }else{ //update no img

                 
           $sql = "UPDATE tb_banner SET 
        
          banner_link='$banner_link',
          banner_title='$banner_title'

          WHERE banner_id=$banner_id
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
                                window.location = "banner.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "banner.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                }
          }  //isset
?>