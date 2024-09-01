<br> 
  <h4><font face="TH Sarabun New"> ฟอร์มเพิ่มธนาคาร </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
   

     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ธนาคาร : </font></label>
      <div class="col-sm-3">
        <input type="text" name="bank_name" placeholder="ธนาคาร" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ชื่อบัญชี : </font></label>
      <div class="col-sm-3">
        <input type="text" name="ac_name" placeholder="ชื่อบัญชี" required class="form-control">
      </div>
    </div>


    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เลขบัญชี : </font></label>
      <div class="col-sm-3">
        <input type="text" name="bank_number" placeholder="เลขบัญชี" required class="form-control">
      </div>
    </div>

    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">สาขา : </font></label>
      <div class="col-sm-3">
        <input type="text" name="bank_branch" placeholder="สาขา" required class="form-control">
      </div>
    </div>

 
     <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">โลโก้ : </font></label>
      <div class="col-sm-3">
       <input type="file"  name="bank_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> 
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

  if(isset($_POST["bank_name"]) && isset($_POST["ac_name"])) {

        $ac_name = $_POST["ac_name"];
        $bank_name = $_POST["bank_name"];
        $bank_number = $_POST["bank_number"];
        $bank_branch = $_POST["bank_branch"];


          $check = "
          SELECT  bank_number 
          FROM tb_bank  
          WHERE bank_number = '$bank_number' 
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
                          window.location = "bank.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{

      //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $bank_img = (isset($_POST['bank_img']) ? $_POST['bank_img'] : '');
    $upload=$_FILES['bank_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['bank_img']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/bank/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    

          $sql = "INSERT INTO tb_bank
          (
          ac_name,
          bank_name,
          bank_number,
          bank_branch,
          bank_img
          )
          VALUES
          (
          '$ac_name',
          '$bank_name',
          '$bank_number',
          '$bank_branch',
          '$newname'

        )";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
          //คัดลอกไฟล์ไปยังโฟลเดอร์
          move_uploaded_file($_FILES['bank_img']['tmp_name'],$path_copy); 
          mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "bank.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "bank.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result

            } //else
  
          } //file
        } //else

      }  //isset
?>