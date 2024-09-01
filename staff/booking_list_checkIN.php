<?php
$sql_script = "SELECT *
FROM tb_booking  AS b
INNER JOIN tb_ac_admin AS a ON b.user_id=a.admin_id
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE b.booking_status = 5
GROUP BY b.booking_id
ORDER BY b.booking_id DESC";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<br>
<font face="TH Sarabun New" >Check IN - เข้าพัก </font>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > ID </font></th>
      <th><font face="TH Sarabun New" > ห้อง</font></th>
      <th><font face="TH Sarabun New" > ลูกค้า </font></th>
      <th><font face="TH Sarabun New" >เช็คอิน - เช็คเอ้า</font></th>
      <th><font face="TH Sarabun New" ><center> รวม(คืน) </center></font></th>
      <th><center><font face="TH Sarabun New" ><center>รวม(บาท)</center></font></center></th>
      <th><center><font face="TH Sarabun New" ><center>จัดการ</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"> <?php echo $row_result["booking_id"];?></td>
      <td><?php echo $row_result["room_number"];?></td>
       <td>
        <?php echo $row_result["admin_firstname"];?> <?php echo $row_result["admin_surname"];?><br>
       โทร.<?php echo $row_result["admin_phone"];?></td>
       <td><?php echo date('d/m/Y', strtotime($row_result["checkInDate"]));?>  - <?php echo date('d/m/Y', strtotime($row_result["checkOutDate"]));?>
         <br>
        <font color="red">
         ห้อง. <?php echo $row_result["room_number"];?>
       </font>
       
       </td>
       <td><font face="TH Sarabun New" > <center><?php echo $row_result["totalDate"];?>  </center></font></td>
       <td><font face="TH Sarabun New" > <center> <?php echo $row_result["booking_amount"];?> </center></font></td>
      <td><center>
        <a href="booking.php?act=checkOUT&booking_id=<?php echo $row_result["booking_id"];?>" class="btn btn-info btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > รายละเอียด/ Check-OUT </font></a>
        </center>
      </td>
       
    </tr>
    <?php } ?>
  </tbody>
</table>