<?php
$booking_id=$_GET['booking_id'];
$sql_script = "SELECT *
FROM tb_booking  AS b
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
INNER JOIN tb_ac_admin AS a ON b.user_id=a.admin_id
WHERE b.booking_id = $booking_id
GROUP BY b.booking_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
$rwbD = mysqli_fetch_assoc($result);
if($rwbD["booking_status"] == 0){
$txts = 'ยกเลิก';
} else if($rwbD["booking_status"] == 1){
$txts = 'เช็คเอ้า';
} else if($rwbD["booking_status"] == 2){
$txts = 'รอชำระเงิน';
} else if($rwbD["booking_status"] == 3){
$txts = 'รอตรวจสอบชำระเงิน';
} else if($rwbD["booking_status"] == 4){
$txts = 'รอเข้าพัก';
} else if($rwbD["booking_status"] == 5){
$txts = 'เช็คอิน';
}
?>
<div class="row">
  <div class="col-sm-10">
    <br>
    <font face="TH Sarabun New" size="5">รายละเอียดการจองห้องพัก
    <button class="btn btn-success btn-sm" onclick="window.print();" id="hid">พิมพ์หน้านี้</button>
    </font>
    <hr> 
    <table class="table table-bordered table-hover">
      <tbody>
        <tr class="table-info">
          <th width="40%">รหัสการจอง</th>
          <th width="60%"><?=$rwbD['booking_id'];?></th>
        </tr>
        <tr>
          <th width="40%">ประเภทห้องที่จอง</th>
          <td width="60%"><?=$rwbD['type_name'];?></td>
        </tr>
         <tr>
          <th width="40%">ห้อง</th>
          <td width="60%"><?=$rwbD['room_number'];?></td>
        </tr>
        <tr>
          <th width="40%">วันที่เช็คอิน</th>
          <td width="60%">
            <?=date('d/m/Y', strtotime($rwbD['checkInDate']));?>
            หลังเวลา <?=date('H:i', strtotime($rwbD['checkInDate']));?> น.
            
          </td>
        </tr>
        <tr>
          <th width="40%">วันที่เช็คเอ้าท์</th>
          <td width="60%">
            <?=date('d/m/Y', strtotime($rwbD['checkOutDate']));?>
            ก่อนเวลา. <?=date('H:i', strtotime($rwbD['checkOutDate']));?> น.
            
          </td>
        </tr>
        <tr>
          <th width="40%">เข้าพัก</th>
          <td width="60%"><?=$rwbD['totalDate'];?> คืน </td>
        </tr>
        <tr>
          <th width="40%">ค่าใช้จายคืนละ</th>
          <td width="60%"><?php echo $rwbD['booking_amount'] / $rwbD['totalDate'];?> บาท </td>
        </tr>
        <tr>
          <th width="40%">รวมที่ต้องชำระ</th>
          <td width="60%"><?=$rwbD['booking_amount'];?> บาท </td>
        </tr>
        <tr>
          <th width="40%">วันที่ทำรายการ</th>
          <td width="60%"><?=date('d/m/Y H:i:s', strtotime($rwbD['dateCreate']));?> น. </td>
        </tr>
        <tr>
          <th width="40%">สถานะการจอง</th>
          <td width="60%"> <?=$txts;?> เหตุผล. <?=$rwbD['remark'];?></td>
        </tr>
        <?php if($rwbD["booking_status"] >2){ ?>
        <tr>
          <th width="40%">สลิปโอนค่าห้องพัก</th>
          <td width="60%"> <img src="img/payment/<?=$rwbD["slip"];?>"  width="200px;"> </td>
        </tr>
        <?php } ?>
        <tr>
          <th width="40%">ข้อมูลลูกค้า</th>
          <td width="60%">
            ชื่อ-สกุล <?=$rwbD["admin_firstname"].' '.$rwbD["admin_surname"];?>
            <br> เบอร์โทร. <?=$rwbD['admin_phone'];?> <br>
            ที่อยู่. <?=$rwbD['admin_address'];?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>