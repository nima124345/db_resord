<?php
$sqlRoomType = "SELECT * FROM tb_room_type ";
$rsty = mysqli_query($Connection, $sqlRoomType) or die (mysqli_error($Connection));
?> 
<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มห้องพัก </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ประเภทห้อง : </font></label>
      <div class="col-sm-4">

        <select name="type_id" required class="form-control">
          <option disabled>-เลือกประเภทห้องพัก</option>
          <?php foreach ($rsty as $rsty) { ?>
            <option value="<?=$rsty['type_id'];?>">-<?=$rsty['type_name'];?></option>
          <?php } ?> 
          
        </select>
        
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ประเภทเตียง : </font></label>
      <div class="col-sm-4">

        <select name="room_bed" required class="form-control">
          <option disabled>-เลือกประเภทเตียง</option>
           
            <option value="เตียงขนาดใหญ่"> : เตียงขนาดใหญ่ </option>
            <option value="เตียงใหญ่"> : เตียงใหญ่</option>
            <option value="เตียงคู่"> :  เตียงคู่</option>
            <option value="2 เตียงใหญ่"> : 2 เตียงใหญ่</option>
            <option value="1 เตียงใหญ่ + 1 เตียงเล็ก"> : 1 เตียงใหญ่ + 1 เตียงเล็ก</option>
        </select>
      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เลขห้อง : </font></label>
      <div class="col-sm-3">
        <input type="text" name="room_number" placeholder="เลขห้อง" required class="form-control">
      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รายละเอียด : </font></label>
      <div class="col-sm-5">
        <textarea name="room_detail" required  class="form-control" placeholder="รายละเอียด"></textarea>

      </div>
    </div>

      <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สิ่งอำนวยความสะดวก : </font></label>
      <div class="col-sm-5">
        <textarea name="room_service" required  class="form-control" placeholder="สิ่งอำนวยความสะดวก"></textarea>

      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ราคา/คืน (บาท) : </font></label>
      <div class="col-sm-3">
        <input type="number" name="room_price"  required class="form-control" min="0" maxlength="99999" placeholder="กรอกเฉพาะตัวเลข">
      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ขนาดห้อง(ตรม.) : </font></label>
      <div class="col-sm-3">
        <input type="number" name="room_size" placeholder="กรอกเฉพาะตัวเลข" required class="form-control" min="0">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">พักได้ (คน) : </font></label>
      <div class="col-sm-3">
        <input type="number" name="room_capacity" placeholder="จำนวนคนที่พักได้สูงสุด" required class="form-control" min="0">
      </div>
    </div>

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">รูปภาพห้องพัก : </font></label>
      <div class="col-sm-3">
       <input type="file"  name="room_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
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

  if(isset($_POST["room_number"]) && isset($_POST["type_id"])) {

        $type_id = $_POST["type_id"];
        $room_number = $_POST["room_number"];
        $room_detail = $_POST["room_detail"];
        $room_service = $_POST["room_service"];
        $room_price = $_POST["room_price"];
        $room_bed = $_POST["room_bed"];
        $room_size = $_POST["room_size"];
        $room_capacity = $_POST["room_capacity"];

          $check = "
          SELECT  room_number 
          FROM tb_room  
          WHERE room_number = '$room_number' 
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
                          window.location = "room.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{

      //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $room_img = (isset($_POST['room_img']) ? $_POST['room_img'] : '');
    $upload=$_FILES['room_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['room_img']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/room/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    

          $sql = "INSERT INTO tb_room
          (
          type_id,
          room_number,
          room_detail,
          room_service,
          room_price,
          room_img,
          room_bed,
          room_size,
          room_capacity
          )
          VALUES
          (
          '$type_id',
          '$room_number',
          '$room_detail',
          '$room_service',
          '$room_price',
          '$newname',
          '$room_bed',
          '$room_size',
          '$room_capacity'

        )";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          //คัดลอกไฟล์ไปยังโฟลเดอร์
          move_uploaded_file($_FILES['room_img']['tmp_name'],$path_copy); 
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "room.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "room.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

            } //else
  
          } //file
        } //else

      }  //isset
?>