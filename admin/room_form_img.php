  <?php 
$room_id = $_GET['room_id'];
$queryUpdateDetail = "SELECT *
FROM tb_room  AS r 
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE r.room_id=$room_id
GROUP BY r.room_id ";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowDetail = mysqli_fetch_assoc($rsDetail);
//print_r($rowDetail);
if (mysqli_num_rows($rsDetail) == '') {
  exit();
}

//count im
$coImg ="SELECT COUNT(*) as totalImg FROM tb_room_image WHERE room_id =$room_id";
$rsImg = mysqli_query($Connection, $coImg);
$rowImg = mysqli_fetch_assoc($rsImg);
?>  
<br> 
  <h4><font face="TH Sarabun New"> 
    ::เพิ่มภาพแกลเลอรี่ห้อง:: 
    ห้อง <?=$rowDetail['type_name'];?>  
    <?=$rowDetail['room_number'];?> 
    ราคา/คืน <?=$rowDetail['room_price'];?> บาท 
  </font></h4>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
  
     <div class="row mb-2">
      <label for="inputText" class="col-sm-1 col-form-label"><font face="TH Sarabun New" size="3">ภาพ : </font></label>
      <div class="col-sm-2">
       <input type="file"  name="image_url[]" multiple  class="form-control" accept="image/jpeg, image/png, image/jpg"> 
      </div>
      <div class="col-sm-2">
        <input type="hidden" name="room_id" value="<?=$rowDetail['room_id'];?>">
         <button type="submit"  class="btn btn-primary"><font face="TH Sarabun New" size="4">อัพโหลดภาพ</font></button>
      </div>
    </div>
  </form>
  <hr>

<div class="row">
  <div class="col-sm-3">
    

<?php
$sql_img = "SELECT * FROM tb_room_image  WHERE room_id=$room_id ";
$rsimg = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));
?>
<b> ภาพทั้งหมด <?=$rowImg['totalImg'];?> ภาพ </b> <br> 
<table class="table table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th width="10%"><font face="TH Sarabun New" size="5"> No.</font></th>
      <th width="50%"><font face="TH Sarabun New" size="5"> ภาพ</font></th>
      <th width="40%"><center><font face="TH Sarabun New" size="5">ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0; foreach ($rsimg as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i+=1?></td>
      <td><img src="../img/roomGallery/<?php echo $row_result["image_url"];?>" width="70px"></td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='room.php?room_id=<?php echo $row_result["room_id"];?>&image_id=<?php echo $row_result["image_id"];?>&act=delimg';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" size="4"> ลบ</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
  </div>
  
</div>
  <?php 

// upload multiple file
  if(isset($_POST["room_id"])) {

$img = $_FILES['image_url'];
$room_id = $_POST["room_id"];

if(!empty($img))
{
    $img_desc = reArrayFiles($img);
    //print file detail
   // print_r($img_desc);
    
    foreach($img_desc as $val)
    {
    $newname = date('YmdHis',time()).mt_rand().'.jpg';
    move_uploaded_file($val['tmp_name'],'../img/roomGallery/'.$newname);

        //sql
      $sql = "INSERT INTO  tb_room_image
          (room_id, image_url)
          VALUES 
          ('$room_id', '$newname')
          ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));
    }

    if($result){
        echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "อัพโหลดภาพสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "room.php?act=img&room_id='.$room_id.'"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
    }
    
} //if
} //isset

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

  exit();
  // ------------------------------------- //
  // Upload single file 
  // echo '<pre>';
  // print_r($_POST);
  // print_r($_FILES);
  // exit();
  if(isset($_POST["room_id"])) {

        $room_id = $_POST["room_id"];
         //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $image_url = (isset($_POST['image_url']) ? $_POST['image_url'] : '');
    $upload=$_FILES['image_url']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['image_url']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="../img/roomGallery/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
 
          $sql = "INSERT INTO  tb_room_image
          (room_id, image_url)
          VALUES 
          ('$room_id', '$newname')
          ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
           move_uploaded_file($_FILES['image_url']['tmp_name'],$path_copy); 
           mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "อัพโหลดภาพสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "room.php?act=img&room_id='.$room_id.'"; //หน้าที่ต้องการให้กระโดดไป
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
                                window.location = "room.php?act=img&room_id='.$room_id.'"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                  } //type file
                } //if upload
          }  //isset
?>