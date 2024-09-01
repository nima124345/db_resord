<!--  <style type="text/css">
                input[type="date"]::-webkit-datetime-edit, 
                input[type="date"]::-webkit-inner-spin-button, 
                input[type="date"]::-webkit-clear-button {
                color: #fff;
                position: relative;
                }
                input[type="date"]::-webkit-datetime-edit-year-field{
                position: absolute !important;
                border-left:3px solid #000000;
                padding: 1px;
                color:#000000;
                left: 55px;
                }
                input[type="date"]::-webkit-datetime-edit-month-field{
                position: absolute !important;
                border-left:3px solid #000000;
                padding: 1px;
                color:#000000;
                left: 30px;
                }
                input[type="date"]::-webkit-datetime-edit-day-field{
                position: absolute !important;
                color:#000000;
                padding: 1px;
                left: 6px;
                }
        </style> -->

        <script type="text/javascript">
        function GetDays(){
        var dropdt = new Date(document.getElementById("drop_date").value);
        var pickdt = new Date(document.getElementById("pick_date").value);
        return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }
        function cal(){
        if(document.getElementById("drop_date")){
        document.getElementById("numdays2").value=GetDays();
        }
        }
        </script>


<?php
$sqlRoomType = "SELECT * FROM tb_room";
$rsty = mysqli_query($Connection, $sqlRoomType) or die (mysqli_error($Connection));


//type room detail
if(isset($_GET['type_id'])){
$type_id = $_GET['type_id'];
$queryUpdateDetail = "SELECT * FROM tb_room_type WHERE type_id=$type_id";
$rsDetail = mysqli_query($Connection, $queryUpdateDetail) or die (mysqli_error($Connection));
$rowTr = mysqli_fetch_assoc($rsDetail);
}
?> 
  <form action="" method="get">
     <div class="row mb-2 mt-3">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">ประเภทห้อง</font></label>
      <div class="col-sm-3">
        <select name="room_id" required class="form-control">
          <option value="">-เลือกห้องพัก</option>
          <?php foreach ($rsty as $rsty) { ?>
            <option value="<?=$rsty['room_id'];?>">-<?=$rsty['room_number'];?></option>
          <?php } ?> 
        </select>
      </div>
    </div>

    
    <div class="row mb-2">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">วันที่เข้าพัก </font></label>
      <div class="col-sm-3">
        <input type="date" id="pick_date" name="checkInDate" class="form-control" placeholder="วันที่เข้าพัก" required min="<?=date('Y-m-d');?>" onchange="cal()">
      </div>
   
      <label for="inputText" class="col-sm-1 col-form-label"><font face="TH Sarabun New" size="3"> เช็คเอ้า </font></label>
      <div class="col-sm-3">
        <input type="date" id="drop_date" name="checkOutDate" class="form-control" placeholder="วันที่เข้าพัก" required min="<?=date('Y-m-d');?>" onchange="cal()">
      </div>
   
      <div class="col-sm-2">
        <input type="hidden" class="form-control" readonly="readonly" id="numdays2" name="numdays"/>
       <button type="submit" name="act" value="q" class="btn btn-primary"><font face="TH Sarabun New" size="4">ค้นหาห้องว่าง</font></button>
    
      </div>
    </div>
  </form>


<?php 
if($_GET['act']=='q'){
//หาห้องว่าง
$ds = $_GET['checkInDate'];
$de = $_GET['checkOutDate'];
$room_id= $_GET['room_id'];
$sql_script = "
SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
 b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*
FROM tb_booking b 
#INNER JOIN tb_room_type t on b.type_id=t.type_id
INNER JOIN tb_room r on b.room_id=r.room_id
INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
WHERE b.room_id = $room_id
AND b.booking_status >=3
AND
(b.checkInDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkInDate <= CAST( '$de 12:00:00' AS DATETIME)) 
 OR (b.checkOutDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkOutDate <= CAST( '$de 12:00:00' AS DATETIME))
 AND b.booking_status >=4
 AND b.booking_status >=3
 GROUP BY r.room_id
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

$rowb = mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);
//echo $num;


?>


  <hr>
  <font face="TH Sarabun New" size="4"; color="blue">ตารางแสดงจำนวนห้องว่าง 
    ประเภทห้อง <?=$rowTr['type_name'];?>
    วันที่ <?=date('d/m/Y',strtotime($_GET['checkInDate']));?>  
    ถึง <?=date('d/m/Y',strtotime($_GET['checkOutDate']));?> 
    รวม <?=$_GET['numdays'];?>  คืน
     </font>
    

<?php 
    if($num > 0 && $rowb['type_id']==$type_id){

      echo '<hr> <h4>ห้องที่ถูกจองในช่วงวันดังกล่าว (ชำระเงินแล้ว)</h4>';
      echo '  <table class="table table-striped table-bordered table-sm">
        <thead>
          <tr class="table-danger">
            <th><font face="TH Sarabun New" size="5"> ห้อง</font></th>
            <th><font face="TH Sarabun New" size="5"> ลูกค้า </font></th>
            <th><font face="TH Sarabun New" size="5">เช็คอิน - เช็คเอ้า</font></th>
            <th><font face="TH Sarabun New" size="5"><center> รวม(คืน) </center></font></th>
            <th><center><font face="TH Sarabun New" size="5"><center>รวม(บาท)</center></font></center></th>
          </tr>
        </thead>
        <tbody>';
     
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

      ?>
          <tr>
            <td scope="row"> <?php echo $row["room_number"];?></td>
             <td>
              <?php echo $row["admin_firstname"];?> <?php echo $row["admin_surname"];?><br>
              โทร.<?php echo $row["admin_phone"];?></td>
             <td><?php echo date('d/m/Y', strtotime($row["checkInDate"]));?>  - <?php echo date('d/m/Y', strtotime($row["checkOutDate"]));?></td>
             <td><font face="TH Sarabun New" size="4"> <center><?php echo $row["totalDate"];?>  </center></font></td>
             <td><font face="TH Sarabun New" size="4"> <center> <?php echo $row["booking_amount"];?> </center></font></td>
          </tr>
       
    <?php 
       //เอาไอดีห้องที่โดนจองไปใช้ใน sql ห้องที่ว่าง 
        $roomNotIN[]=$row['room_id'];
      } //room type
      } //status
     } //for
  echo ' </tbody>
      </table>';


           //ตัด , ตัวสุดท้ายออก
      $roomNotIN = implode(",", $roomNotIN);

      //echo 'id ห้องที่ถูกจอง '. $roomNotIN;
  } //numb row 
     ?>
  <h4>ห้องที่ว่างในวันดังกล่าว </h4>

<?php 
  if(!empty($roomNotIN)){
  $sql_roomAva = "SELECT *FROM tb_room WHERE type_id=$type_id AND  room_id NOT IN($roomNotIN)";
  $rsrav = mysqli_query($Connection, $sql_roomAva) or die (mysqli_error($Connection));
  //echo $sql_roomAva;
    ?>
  <div class="col-sm-4">
  <table class="table table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" size="5"> เลขห้อง</font></th>
      <th><font face="TH Sarabun New" size="5"> ราคา/คืน</font></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($rsrav as $row_result) { ?>
    <tr>
        <td><?php echo $row_result["room_number"];?></td>
        <td><?php echo $row_result["room_price"];?></td>
     </tr>
<?php   }  //foreach ?>
  </tbody>
  </table>
</div>


<?php 
} //if($roomNotIN !=''){
  else{

$sql_room = "SELECT *FROM tb_room WHERE type_id=$type_id  ORDER BY room_id ASC";
$rsr= mysqli_query($Connection, $sql_room) or die (mysqli_error($Connection));
//echo $sql_room;
?>
<div class="col-sm-4">
 <table class="table table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" size="5"> เลขห้อง</font></th>
      <th><font face="TH Sarabun New" size="5"> ราคา/คืน</font></th>
    </tr>
  </thead>
  <tbody>
<?php 
    foreach ($rsr as $row2) { ?>
      <tr>
        <td><?php echo $row2["room_number"];?></td>
        <td><?php echo $row2["room_price"];?></td>
     </tr>
  <?php 
  } //foreach
  ?>
</tbody>
</table>
</div>

  <?php 
  } //else 

} //isset act == q
  ?>

