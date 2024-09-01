<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มสไลด์ </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ข้อความ </font></label>
      <div class="col-sm-5">
        <input type="text" name="banner_title" placeholder="ข้อความ" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ลิ้งค์ : </font></label>
      <div class="col-sm-7">
        <input type="text" name="banner_link" placeholder="ลิ้งค์ " class="form-control">
      </div>
    </div>


   
     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ภาพ : </font></label>
      <div class="col-sm-3">
       <input type="file"  name="banner_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
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
  // print_r($_FILES);
  // exit();

  if(isset($_POST["banner_title"])) {

       
        $banner_title = $_POST["banner_title"];
        $banner_link = $_POST["banner_link"];
      

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
    

          $sql = "INSERT INTO tb_banner
          (
          banner_title,
          banner_link,
          banner_img
          )
          VALUES
          (
          '$banner_title',
          '$banner_link',
          '$newname'
        )";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          //คัดลอกไฟล์ไปยังโฟลเดอร์
          move_uploaded_file($_FILES['banner_img']['tmp_name'],$path_copy); 
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
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

            } //else
  
          } //file


      }  //isset
?>