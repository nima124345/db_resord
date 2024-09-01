<?php
$sql_script = "SELECT *FROM tb_ac_admin WHERE status_id=3";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
//$row_result = mysqli_fetch_assoc($result);
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th width="5%"><font face="TH Sarabun New" > id</font></th>
      <th width="15%"><font face="TH Sarabun New" > ชื่อผู้ใช้</font></th>
      <th width="15%"><font face="TH Sarabun New" > รหัสผ่าน</font></th>
      <th width="40%"><font face="TH Sarabun New" > ชื่อ - นามสกุล</font></th>
      <th width="10%"><font face="TH Sarabun New" > เบอร์โทร</font></th>
      <th width="5%"><font face="TH Sarabun New" > สถานะ</font></th>
      <th width="5%"><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th width="5%"><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i++;?></td>
      <td><?php echo $row_result["admin_name"];?></td>
      <td><?php echo $row_result["admin_password"];?></td>
      <td><?php echo $row_result["admin_firstname"];?>  <?php echo $row_result["admin_surname"];?> <br>
      ที่อยู่. <?php echo $row_result["admin_address"];?></td>
      <td><?php echo $row_result["admin_phone"];?></td>
      <td><?php if($row_result["admin_show"] == 1){ echo 'Online'; }else{ echo 'ระงับ'; } ?></td>
      <td><center>
        <a href="member.php?act=edit&admin_id=<?php echo $row_result["admin_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='member.php?admin_id=<?php echo $row_result["admin_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>