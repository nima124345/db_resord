<?php 
$member_id = $_SESSION['admin_id'];

//type room detail
if(isset($_GET['type_id'])){
$type_id = $_GET['type_id'];

    $queryUpdateDetail = "SELECT * FROM tb_room_type WHERE type_id=$type_id";
    $rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
    $rowTr = mysqli_fetch_assoc($rsDetail);
}

?>
<div class="row">
<div class="col-sm-12">
<!--   แสดงรายการห้องว่าง -->
<?php 
if($_GET['page']=='searching'){
//หาห้องว่าง
$ds = $_GET['checkinDate'];
$de = $_GET['checkoutDate'];
$type_id= $_GET['type_id'];

 
$sql_script = "
SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
 b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*
FROM tb_booking b 
#INNER JOIN tb_room_type t on b.type_id=t.type_id
INNER JOIN tb_room r on b.room_id=r.room_id
INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
WHERE b.type_id = $type_id
AND b.booking_status >=4
AND
(b.checkInDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkInDate <= CAST( '$de 12:00:00' AS DATETIME)) 
 OR (b.checkOutDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkOutDate <= CAST( '$de 12:00:00' AS DATETIME))
 GROUP BY r.room_id
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

$rowb = mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);
//echo $num;

?>
  <font face="TH Sarabun New" size="5"; color="blue">ตารางแสดงจำนวนห้องว่าง 
    ประเภทห้อง <?=$rowTr['type_name'];?>
    วันที่ <?=date('d/m/Y',strtotime($_GET['checkinDate']));?>  
    ถึง <?=date('d/m/Y',strtotime($_GET['checkoutDate']));?> 
    รวม <?=$_GET['numdays'];?>  คืน
     </font>
    

<?php 
    if($num > 0 && $rowb['type_id']==$type_id){

     $roomNotIN = array();
     foreach ($result as $row) {
      $booking_status = $row['booking_status'];
      if($booking_status == 4){
        $sName= 'รอเข้าพัก';
      }else if ($booking_status == 5) {
        $sName= 'เข้าพัก';
      }
      if($booking_status >=4){

        if($row['type_id']==$type_id){
       //เอาไอดีห้องที่โดนจองไปใช้ใน sql ห้องที่ว่าง 
        $roomNotIN[]=$row['room_id'];
      } //room type
      } //status
     } //for

           //ตัด , ตัวสุดท้ายออก
      $roomNotIN = implode(",", $roomNotIN);

      //echo 'id ห้องที่ถูกจอง '. $roomNotIN;
  } //numb row 

  if(!empty($roomNotIN)){
    //หาจำนวนห้องว่างแบบมีการจอง
  $sql_roomAva = "
  SELECT COUNT(*) AS CRA #นับจำนวนห้องว่าง
  FROM tb_room 
  WHERE type_id=$type_id 
  AND  room_id NOT IN($roomNotIN)
  ";
  $rsrav = mysqli_query($Connection, $sql_roomAva) or die (mysqli_error($Connection));
  $rowrsrav = mysqli_fetch_assoc($rsrav);
  //echo $sql_roomAva;



  //แสดงรายละเอียดห้องว่าง
  $roomAva = "
  SELECT *
  FROM tb_room 
  WHERE type_id=$type_id 
  ORDER BY room_id   DESC
  LIMIT 1
  ";
  $rsra = mysqli_query($Connection, $roomAva) or die (mysqli_error($Connection));
  $rwra = mysqli_fetch_assoc($rsra);
  $r_id = $rwra['room_id'];


//room gallery

$sql_img = "SELECT * FROM tb_room_image  WHERE room_id=$r_id ";
$rsimg = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));
$rsimg1 = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));

//ราคารวม
$total = ($_GET['numdays'] * $rwra['room_price']);
?>

<div class="row">
  <div class="col-sm-12">
      <h4>จำนวนห้องว่าง <?=$rowrsrav['CRA'];?> ห้อง </h4>
  </div>

  <div class="col-sm-4 ml-2">
    <!-- <img src="img/room/<?=$rwra['room_img'];?>" width="100%"> -->
                            <!-- Room Thumbnail Slides -->
                        <div class="room-thumbnail-slides">
                            <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img src="img/room/<?=$rwra['room_img'];?>" class="d-block w-100" alt="">
                                    </div>

                                    <?php foreach ($rsimg as $rsimg) { ?>
                                    <div class="carousel-item">
                                        <img src="img/roomGallery/<?=$rsimg['image_url'];?>" class="d-block w-100" alt="">
                                    </div>
                                  <?php } ?>
                                </div>
                                <ol class="carousel-indicators" style="margin-left: 0px; margin-top: 5px;">
                                    <li data-target="#room-thumbnail--slide" data-slide-to="0" class="active">
                                        <img src="img/room/<?=$rwra['room_img'];?>" class="d-block w-200" alt="">
                                    </li>
                                <?php $i=1; foreach ($rsimg1 as $rsimg1) { ?>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="<?=$i++;?>" class="active">
                                        <img src="img/roomGallery/<?=$rsimg1['image_url'];?>" class="d-block w-200" alt="">
                                    </li>
                                <?php } ?> 
                                </ol>
                            </div>
                        </div>

    
  </div>
  <div class="col-sm-5">
    <b>รายละเอียดห้อง.</b> <br>  <?=$rwra['room_detail'];?> <br>
    <b>สิ่งอำนวยความสะดวก</b> <br> <?=$rwra['room_service'];?>  
   
  </div>
  <div class="col-sm-2">
     
     <b>ราคา </b>  <?=$rwra['room_price'];?> บาท/คืน 
 
    </form>
    <?php if($rowrsrav['CRA'] > 0){ ?>
     <a href="member.php?ref=<?=sha1('dev');?>&type_id=<?=$_GET['type_id'];?>&checkinDate=<?=$_GET['checkinDate'];?>&checkoutDate=<?=$_GET['checkoutDate'];?>&numdays=<?=$_GET['numdays'];?>&rmid=<?=$_SESSION['admin_id'];?>&total=<?=$total;?>&page=saveBooking&ref2=<?=sha1('dev2');?>"  class="btn btn-primary" style="width: 100%" onclick="return confirm('ยืนยันการจอง');">จอง</a>
   <?php }else{ echo 'ห้องพักเต็ม'; } ?>
  </div>
  
</div>
<?php 
} //if($roomNotIN !=''){
  else{
  //หาจำนวนห้องว่างแบบไม่มีการจอง
$sql_room = "
  SELECT COUNT(*) AS CRAB #นับจำนวนห้องว่าง
  FROM tb_room 
  WHERE type_id=$type_id  ORDER BY room_id ASC";
$rsr= mysqli_query($Connection, $sql_room) or die (mysqli_error($Connection));
$rowrsr = mysqli_fetch_assoc($rsr);



  //แสดงรายละเอียดห้องว่าง
  $roomAva = "
  SELECT *
  FROM tb_room 
  WHERE type_id=$type_id 
  ORDER BY room_id   DESC
  LIMIT 1
  ";
  $rsra = mysqli_query($Connection, $roomAva) or die (mysqli_error($Connection));
  $rwra = mysqli_fetch_assoc($rsra);
  $r_id = $rwra['room_id'];


//room gallery

$sql_img = "SELECT * FROM tb_room_image  WHERE room_id=$r_id ";
$rsimg = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));
$rsimg1 = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));

//ราคารวม
$total = ($_GET['numdays'] * $rwra['room_price']);

 
  ?>
 
  <div class="row">
  <div class="col-sm-12">
      <h4>จำนวนห้องว่าง <?=$rowrsr['CRAB'];?> ห้อง </h4>
  </div>

  <div class="col-sm-4 ml-2">
    <!-- <img src="img/room/<?=$rwra['room_img'];?>" width="100%"> -->
                            <!-- Room Thumbnail Slides -->
                        <div class="room-thumbnail-slides">
                            <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img src="img/room/<?=$rwra['room_img'];?>" class="d-block w-100" alt="">
                                    </div>

                                    <?php foreach ($rsimg as $rsimg) { ?>
                                    <div class="carousel-item">
                                        <img src="img/roomGallery/<?=$rsimg['image_url'];?>" class="d-block w-100" alt="">
                                    </div>
                                  <?php } ?>
                                </div>
                                <ol class="carousel-indicators" style="margin-left: 0px; margin-top: 5px;">
                                    <li data-target="#room-thumbnail--slide" data-slide-to="0" class="active">
                                        <img src="img/room/<?=$rwra['room_img'];?>" class="d-block w-200" alt="">
                                    </li>
                                <?php $i=1; foreach ($rsimg1 as $rsimg1) { ?>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="<?=$i++;?>" class="active">
                                        <img src="img/roomGallery/<?=$rsimg1['image_url'];?>" class="d-block w-200" alt="">
                                    </li>
                                <?php } ?> 
                                </ol>
                            </div>
                        </div>

    
  </div>
  <div class="col-sm-5">
    <b>รายละเอียดห้อง.</b> <br>  <?=$rwra['room_detail'];?> <br>
    <b>สิ่งอำนวยความสะดวก</b> <br> <?=$rwra['room_service'];?>  
   
  </div>
  <div class="col-sm-2">
     <b>ราคา </b>  <?=$rwra['room_price'];?> บาท/คืน
     <br>
      <?php if($rowrsr['CRAB'] > 0){ ?>
     <a href="member.php?ref=<?=sha1('dev');?>&type_id=<?=$_GET['type_id'];?>&checkinDate=<?=$_GET['checkinDate'];?>&checkoutDate=<?=$_GET['checkoutDate'];?>&numdays=<?=$_GET['numdays'];?>&rmid=<?=$_SESSION['admin_id'];?>&total=<?=$total;?>&page=saveBooking&ref2=<?=sha1('dev2');?>"  class="btn btn-primary" style="width: 100%" onclick="return confirm('ยืนยันการจอง');">จอง</a>
   <?php } ?>
  </div>
  
</div>


  <?php 
  } //else 

} //isset act == q
?>


</div>
</div>
 