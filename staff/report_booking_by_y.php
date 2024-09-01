<?php
$sql_scriptY = "SELECT DATE_FORMAT(payDate, '%Y') as bookingM,
COUNT(*) totalbyM 
FROM tb_booking
WHERE payDate !=''
GROUP BY DATE_FORMAT(payDate, '%Y') DESC
";
$resulty = mysqli_query($Connection, $sql_scriptY) or die (mysqli_error($Connection));
?>
<font face="TH Sarabun New" size="5">
ข้อมูลการจองแยกตามปี
<a href="report.php?act=bookingbyM" class="btnx btn-success btn-sm">+แยกตามเดือน</a> , 
<a href="report.php?act=bookingbyY" class="btnx btn-success btn-sm">+แยกตามปี</a>
</font>

<table class="table  table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" size="5">ปี</font></th>
      <th><center><font face="TH Sarabun New" size="5"><center>รวมจำนวนการจอง(รายการ)</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resulty as $row_resulty) {?>
    <tr>
      <td scope="row"> <font face="TH Sarabun New" size="4"><?php echo $row_resulty["bookingM"];?></font></td>
      <td align="center"><font face="TH Sarabun New" size="4"><?php echo $row_resulty["totalbyM"];?></font></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
 