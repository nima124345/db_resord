<?php
$sql_script = "SELECT DATE_FORMAT(payDate, '%Y') as bookingY,
SUM(booking_amount) totalbyY
FROM tb_booking
WHERE booking_status >= 3
GROUP BY DATE_FORMAT(payDate, '%Y') DESC
";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<font face="TH Sarabun New" size="5">
ข้อมูลรายได้ (รวมเฉพาะการจองที่ชำระเงินแล้วเท่านั้น) 
<a href="report.php?act=profitbyM" class="btnx btn-success btn-sm">+แยกตามเดือน</a> , 
<a href="report.php?act=profitbyY" class="btnx btn-success btn-sm">+แยกตามปี</a>
</font>
<table class="table  table-striped table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" size="5">ปี</font></th>
      <th><center><font face="TH Sarabun New" size="5"><center>รวม(บาท)</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $total=0; foreach ($result as $row_result) {
    $total += $row_result["totalbyY"];  ?>
    <tr>
      <td scope="row"> <font face="TH Sarabun New" size="4"><?php echo $row_result["bookingY"];?></font></td>
      <td align="right"><font face="TH Sarabun New" size="4"><?php echo number_format($row_result["totalbyY"],2);?></font></td>
       
    </tr>
    <?php } ?>
    <tr class="table-danger">
      <td align="center"><font face="TH Sarabun New" size="4"> รวมรายได้ทั้งหมด </font></td>
      <td align="right"><font face="TH Sarabun New" size="4"> <?=number_format($total,2);?> บาท </font></td>
    </tr>
  </tbody>
</table>
 