<?php
$sql_scriptm = "SELECT DATE_FORMAT(payDate, '%M-%Y') as bookingM,
COUNT(*) totalbyM
FROM tb_booking
WHERE payDate !=''
GROUP BY DATE_FORMAT(payDate, '%Y-%m') DESC";
$resultm = mysqli_query($Connection, $sql_scriptm) or die (mysqli_error($Connection));

// echo $sql_scriptm;
// echo '<hr>';
// foreach ($resultm as $resultm) {
//   echo $resultm['bookingMm']. ' '. $resultm['totalbyMm'] .'<br>';
// }
// exit();
?>
<font face="TH Sarabun New" >
ข้อมูลการจองแยกตามเดือน
<a href="report.php?act=bookingbyM" class="btnx btn-success btn-sm">+แยกตามเดือน</a> , 
<a href="report.php?act=bookingbyY" class="btnx btn-success btn-sm">+แยกตามปี</a>
</font>

<table class="table   table-bordered table-sm">
  <thead>
    <tr class="table-info">
      <th><font face="TH Sarabun New" >เดือน</font></th>
      <th><center><font face="TH Sarabun New" ><center>รวมจำนวนการจอง(รายการ)</center></font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($resultm as $row_resultm) {?>
    <tr>
      <td> <font face="TH Sarabun New" > <?php echo $row_resultm["bookingM"];?> </font> </td>
      <td align="center"><font face="TH Sarabun New" ><?php echo $row_resultm["totalbyM"];?></font></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php mysqli_close($Connection); ?>
 