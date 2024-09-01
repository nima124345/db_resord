<?php
$sql_script = "SELECT *  
FROM tb_booking  AS b
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
INNER JOIN tb_ac_admin AS a ON b.user_id=a.admin_id
#WHERE b.booking_status = 2
GROUP BY b.booking_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));

//count booking
$sqlcb ="SELECT COUNT(*) as totalBooking FROM tb_booking";
$rscb = mysqli_query($Connection, $sqlcb) or die (mysqli_error($Connection));
$rw = mysqli_fetch_assoc($rscb);
?>
<font face="TH Sarabun New" >ข้อมูลการจองทั้งหมด (<?=$rw['totalBooking'];?>)
<a href="report.php?act=bookingbyM" class="btnx btn-success btn-sm">+แยกตามเดือน</a> , 
<a href="report.php?act=bookingbyY" class="btnx btn-success btn-sm">+แยกตามปี</a>
</font>
<table class="table  table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" > ID </font></th>
      <th><font face="TH Sarabun New" > ห้อง</font></th>
      <th><font face="TH Sarabun New" > ลูกค้า </font></th>
      <th><font face="TH Sarabun New" >เช็คอิน - เช็คเอ้า</font></th>
      <th><font face="TH Sarabun New" ><center> รวม(คืน) </center></font></th>
      <th><center><font face="TH Sarabun New" ><center>รวม(บาท)</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($result as $row_result) { ?>
    <tr>
      <td scope="row"> <?php echo $row_result["booking_id"];?></td>
      <td><?php echo $row_result["room_number"];?></td>
       <td>
        <?php echo $row_result["admin_firstname"];?> <?php echo $row_result["admin_surname"];?><br>
       โทร.<?php echo $row_result["admin_phone"];?></td>
       <td><?php echo date('d/m/Y', strtotime($row_result["checkInDate"]));?>  - <?php echo date('d/m/Y', strtotime($row_result["checkOutDate"]));?></td>
       <td><font face="TH Sarabun New" > <center><?php echo $row_result["totalDate"];?>  </center></font></td>
       <td><font face="TH Sarabun New" > <center> <?php echo $row_result["booking_amount"];?> </center></font></td>
    </tr>
    <?php } ?>
  </tbody>
</table>