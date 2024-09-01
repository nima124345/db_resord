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
 
?> 
  <form action="" method="get">
     <div class="row mb-2 mt-3">
      <label for="inputText" class="col-sm-2 col-form-label"><font face="TH Sarabun New" size="3">เลือกห้องพัก</font></label>
      <div class="col-sm-4">
        <select name="room_id" required class="form-control">
          <option value="">-เลือกห้องพักที่ต้องการค้นหาช่วงว่าง</option>
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

 
$queryRoom = "SELECT *
FROM tb_room  AS r 
WHERE r.room_id=$room_id
GROUP BY r.room_id ";
$rsroom = mysqli_query($Connection, $queryRoom) or die (mysqli_error($Connection));
$rwr = mysqli_fetch_assoc($rsroom);



$sql_script = "
SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
 b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*,t.type_name
FROM tb_booking b 
INNER JOIN tb_room r on b.room_id=r.room_id
INNER JOIN tb_room_type t on r.type_id=t.type_id
INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
WHERE b.room_id = $room_id
AND b.booking_status >=3
AND
(b.checkInDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkInDate <= CAST( '$de 12:00:00' AS DATETIME)) 
 OR (b.checkOutDate >= CAST( '$ds 14:00:00' AS DATETIME) 
 AND b.checkOutDate <= CAST( '$de 12:00:00' AS DATETIME))
 AND b.booking_status >=3
 AND b.room_id = $room_id
 GROUP BY r.room_id
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

$rowb = mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);
//echo $num;
?>

  <hr> 
        <h5>สถานะการค้นหาห้องว่างในช่วงวันดังกล่าว</h5>
       <b> ห้องพัก <?=$rwr['room_number'];?> </b> <br>
        วันที่เข้าพัก (Check-in) : <?=date('d/m/Y', strtotime($_GET['checkInDate']));?> <br> 
        วันที่คืนห้องพัก (Check-out) :  <?=date('d/m/Y', strtotime($_GET['checkOutDate']));?> <br> 
        เข้าพัก <?=$_GET['numdays'];?> วัน  รวม <?php echo ($_GET['numdays'] * $rwr['room_price']);?> บาท 

        <br>   
        สถานะ  : 
        <?php if($num == 0){
            echo '<font color="blue"> ว่าง </font>';
        ?>
       
          <?php   }else{
                echo '<font color="red"> ไม่ว่าง </font>';
                }
            ?> 

  <?php 
 

} //isset act == q
  ?>

<hr> 
   <h5>รายการจองล่าสุด</h5>
        <?php 
        $dsx = date('Y').'-'.date('m').'-1';
        $dex = date('Y').'-'.date('m').'-30';
       // $room_id = $_GET['id'];
        $sqlBooked ="SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
             b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*, r.room_price , b.booking_id
            FROM tb_booking b 
            INNER JOIN tb_room r on b.room_id=r.room_id
            INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
            WHERE   b.booking_status >=3 
            AND
            (b.checkInDate >= CAST( '$dsx 14:00:00' AS DATETIME) 
             AND b.checkInDate <= CAST( '$dex 12:00:00' AS DATETIME)) 
             OR (b.checkOutDate >= CAST( '$dsx 14:00:00' AS DATETIME) 
             AND b.checkOutDate <= CAST( '$dex 12:00:00' AS DATETIME))
             #AND b.booking_status >=3 
             GROUP BY r.room_id
             ORDER BY b.checkInDate ASC
             ";
        $rsBooked = mysqli_query($Connection, $sqlBooked);
        if(mysqli_num_rows($rsBooked) >0 ){
        ?>
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead>
                <tr class="table-info">
                    <th width="10%">รหัสการจอง</th>
                     <th width="20%">ห้อง</th>
                    <th width="40%">ว/ด/ป</th>
                    <th width="30%">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                $i = 1;
                foreach ($rsBooked as $rsBooked) {
                 if($rsBooked["booking_status"] == 0){
        $txts = 'ยกเลิก';
      } else if($rsBooked["booking_status"] == 1){
        $txts = 'เช็คเอ้า';
      } else if($rsBooked["booking_status"] == 2){
        $txts = 'รอชำระเงิน';
      } else if($rsBooked["booking_status"] == 3){
        $txts = 'รอตรวจสอบชำระเงิน';
      } else if($rsBooked["booking_status"] == 4){
        $txts = 'รอเข้าพัก';
      } else if($rsBooked["booking_status"] == 5){
        $txts = 'เช็คอิน';
      }
       ?>
                <tr>
                        <td align="center"><?=$rsBooked['booking_id'];?></td>
                        <td><?=$rsBooked['room_number'];?></td>
                        <td>
                            เช็คอิน : <?=date('d/m/Y', strtotime($rsBooked['checkInDate']));?> 
                            เช็คเอ้า : <?=date('d/m/Y', strtotime($rsBooked['checkOutDate']));?> 
                        </td>
                        <td><?=$txts;?></td>
                </tr>
            <?php } ?>
           
            </tbody>
        </table>
        <?php  }else{  echo '-'; } 
 
        ?>

