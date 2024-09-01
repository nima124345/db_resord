<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มตั้งค่า </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อเว็บไซต์ : </font></label>
      <div class="col-sm-5">
        <input type="text" name="wst_name" placeholder="ชื่อเว็บไซต์" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">Title : </font></label>
      <div class="col-sm-5">
        <input type="text" name="wst_title" placeholder="Title" required class="form-control">
      </div>
    </div>


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">About : </font></label>
      <div class="col-sm-5">
        <textarea name="wst_about" class="form-control" required placeholder="About"></textarea>
      </div>
    </div>


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">อีเมล : </font></label>
      <div class="col-sm-3">
        <input type="email" name="wst_email" placeholder="อีเมล" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เบอร์โทร : </font></label>
      <div class="col-sm-3">
        <input type="text" name="wst_phone" placeholder="เบอร์โทร" required class="form-control">
      </div>
    </div>

 
     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">โลโก้ : </font></label>
      <div class="col-sm-2">
       <input type="file"  name="wst_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
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

  if(isset($_POST["wst_title"]) && isset($_POST["wst_name"])) {

        $wst_name = $_POST["wst_name"];
        $wst_title = $_POST["wst_title"];
        $wst_email = $_POST["wst_email"];
        $wst_phone = $_POST["wst_phone"];
        $wst_about = $_POST["wst_about"];

 
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
    

          $sql = "INSERT INTO tb_setting
          (
          wst_name,
          wst_title,
          wst_email,
          wst_phone,
          wst_img,
          wst_about
          )
          VALUES
          (
          '$wst_name',
          '$wst_title',
          '$wst_email',
          '$wst_phone',
          '$newname',
          '$wst_about'

        )";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          //คัดลอกไฟล์ไปยังโฟลเดอร์
          move_uploaded_file($_FILES['wst_img']['tmp_name'],$path_copy); 
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
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
  
          } //file
        } //else

      }  //isset
?>