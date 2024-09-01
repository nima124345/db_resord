<?php 
$member_id = $_SESSION['admin_id'];
$sql_script = "SELECT *
FROM tb_booking  AS b
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE  b.user_id=$member_id
GROUP BY b.booking_id
ORDER BY b.booking_id DESC";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<div class="row">
<div class="col-sm-12">
<table class="table table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" size="5"> เลขการจอง </font></th>
      <th><font face="TH Sarabun New" size="5"> ห้อง</font></th>
      <th><font face="TH Sarabun New" size="5">เช็คอิน - เช็คเอ้า</font></th>
      <th><font face="TH Sarabun New" size="5"><center> รวม(คืน) </center></font></th>
      <th><center><font face="TH Sarabun New" size="5"><center>รวม(บาท)</center></font></center></th>
      <th><center><font face="TH Sarabun New" size="5"><center>สถานะ</center></font></center></th>
      <th><center><font face="TH Sarabun New" size="5"><center>จัดการ</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($result as $row_result) { 
      if($row_result["booking_status"] == 0){
        $txts = 'ยกเลิก';
      } else if($row_result["booking_status"] == 1){
        $txts = 'เช็คเอ้า';
      } else if($row_result["booking_status"] == 2){
        $txts = 'รอชำระเงิน';
      } else if($row_result["booking_status"] == 3){
        $txts = 'รอตรวจสอบชำระเงิน';
      } else if($row_result["booking_status"] == 4){
        $txts = 'รอเข้าพัก';
      } else if($row_result["booking_status"] == 5){
        $txts = 'เช็คอิน';
      }

      //0 ยกเลิก 1 เช็คเอ้า 2 รอชำระเงิน, 3 รอตรวจสอบชำระเงิน 4 รอเข้าพัก 5 เช็คอิน
     ?>
    <tr>
      <td scope="row"> <?php echo $row_result["booking_id"];?></td>
      <td><?php echo $row_result["room_number"];?></td>
       <td><?php echo date('d/m/Y', strtotime($row_result["checkInDate"]));?>  - <?php echo date('d/m/Y', strtotime($row_result["checkOutDate"]));?></td>
       <td><font face="TH Sarabun New" size="4"> <center><?php echo $row_result["totalDate"];?>  </center></font></td>
       <td align="right"><font face="TH Sarabun New" size="4">   <?php echo number_format($row_result["booking_amount"],2);?>  </font></td>
        <td><font face="TH Sarabun New" size="4">  <?php echo $txts;?> </font></td>

      <td>
        <?php if($row_result["booking_status"] == 2){ ?> 
        <center>
        <a href="member.php?page=payment&booking_id=<?php echo $row_result["booking_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" size="4"> ชำระเงิน !! </font></a>

        || 

         <a href="member.php?page=cancelBooking&booking_id=<?php echo $row_result["booking_id"];?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการยกเลิกการจอง');">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" size="4"> ยกเลิก !! </font></a>

        </center>
        <?php }else{ ?>

           <center>
        <a href="member.php?page=view&booking_id=<?php echo $row_result["booking_id"];?>&bs=<?php echo $row_result["booking_status"];?>&act=view" class="btn btn-info btn-sm" target="_blank">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" size="4"> รายละเอียด </font></a>
        </center>


        <?php } ?>


      </td>
       
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
 