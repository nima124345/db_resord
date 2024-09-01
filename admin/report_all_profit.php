<?php
$sql_script = "SELECT *
FROM tb_booking  AS b
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
INNER JOIN tb_ac_admin AS a ON b.user_id=a.admin_id
WHERE b.booking_status > 1
GROUP BY b.booking_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<font face="TH Sarabun New" >
ข้อมูลรายได้ (รวมเฉพาะการจองที่ชำระเงินแล้วเท่านั้น) 
<a href="report.php?act=profitbyM" class="btnx btn-success btn-sm">+แยกตามเดือน</a> , 
<a href="report.php?act=profitbyY" class="btnx btn-success btn-sm">+แยกตามปี</a>
</font>
<table class="table  table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" > ID </font></th>
      <th><font face="TH Sarabun New" > ประเภท</font></th>
      <th><font face="TH Sarabun New" > ลูกค้า </font></th>
      <th><font face="TH Sarabun New" >เช็คอิน - เช็คเอ้า</font></th>
      <th><font face="TH Sarabun New" ><center> รวม(คืน) </center></font></th>
      <th><center><font face="TH Sarabun New" ><center>รวม(บาท)</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $total=0; foreach ($result as $row_result) {
    $total += $row_result["booking_amount"];  ?>
    <tr>
      <td scope="row"> <?php echo $row_result["booking_id"];?></td>
      <td><?php echo $row_result["type_name"];?></td>
       <td>
        <?php echo $row_result["admin_firstname"];?> <?php echo $row_result["admin_surname"];?><br>
       โทร.<?php echo $row_result["admin_phone"];?></td>
       <td><?php echo date('d/m/Y', strtotime($row_result["checkInDate"]));?>  - <?php echo date('d/m/Y', strtotime($row_result["checkOutDate"]));?></td>
       <td><font face="TH Sarabun New" > <center><?php echo $row_result["totalDate"];?>  </center></font></td>
       <td align="right"><font face="TH Sarabun New" >   <?php echo number_format($row_result["booking_amount"],2);?> </font></td>
    </tr>
    <?php } ?>
    <tr class="table-danger">
      <td colspan="5" align="center"><font face="TH Sarabun New" > รวมรายได้ทั้งหมด </font></td>
      <td align="right"><font face="TH Sarabun New" > <?=number_format($total,2);?> บาท </font></td>
    </tr>
  </tbody>
</table>
 