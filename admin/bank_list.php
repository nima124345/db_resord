<?php
$sql_script = "SELECT * FROM tb_bank";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > No.</font></th>
      <th><font face="TH Sarabun New" > Logo</font></th>
      <th><font face="TH Sarabun New" > ชื่อเจ้าของบัญชี</font></th>
      <th><font face="TH Sarabun New" > ธนาคาร</font></th>
      <th><font face="TH Sarabun New" > เลขบัญชี</font></th>
      <th><font face="TH Sarabun New" > สาขา</font></th>
      <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i++;?></td>
      <td><img src="../img/bank/<?php echo $row_result["bank_img"];?>" width="70px"></td>
      <td><?php echo $row_result["ac_name"];?></td>
      <td><?php echo $row_result["bank_name"];?></td>
      <td><?php echo $row_result["bank_number"];?></td>
      <td><?php echo $row_result["bank_branch"];?></td>
      
      <td><center>
        <a href="bank.php?act=edit&bank_id=<?php echo $row_result["bank_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='bank.php?bank_id=<?php echo $row_result["bank_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>