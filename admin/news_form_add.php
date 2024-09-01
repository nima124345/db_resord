<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มข่าวสาร </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">พาดข้อข่าว </font></label>
      <div class="col-sm-5">
        <input type="text" name="news_head" placeholder="พาดข้อข่าว" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รายละเอียด : </font></label>
      <div class="col-sm-5">
        <textarea name="news_detail" class="form-control" required placeholder="รายละเอียดข่าว"></textarea>
      </div>
    </div>


   
     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ภาพ : </font></label>
      <div class="col-sm-3">
       <input type="file"  name="news_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
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

  if(isset($_POST["news_head"])) {

       
        $news_head = $_POST["news_head"];
        $news_detail = $_POST["news_detail"];
      

    //up file
    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $news_img = (isset($_POST['news_img']) ? $_POST['news_img'] : '');
    $upload=$_FILES['news_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['news_img']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/news/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    

          $sql = "INSERT INTO tb_news
          (
          news_head,
          news_detail,
          news_img
          )
          VALUES
          (
          '$news_head',
          '$news_detail',
          '$newname'
        )";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          //คัดลอกไฟล์ไปยังโฟลเดอร์
          move_uploaded_file($_FILES['news_img']['tmp_name'],$path_copy); 
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "news.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "news.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

            } //else
  
          } //file


      }  //isset
?>