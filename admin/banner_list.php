<?php
$sql_script = "SELECT * FROM tb_banner";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > No.</font></th>
      <th><font face="TH Sarabun New" > IMG</font></th>
      <th><font face="TH Sarabun New" > ช้อความ</font></th>
      <th><font face="TH Sarabun New" > ลิ้งค์ </font></th>
      <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i++;?></td>
      <td><img src="../img/banner/<?php echo $row_result["banner_img"];?>" width="70px"></td>
      <td><?php echo $row_result["banner_title"];?></td>
      <td><?php echo $row_result["banner_link"];?></td>
      
      <td><center>
        <a href="banner.php?act=edit&banner_id=<?php echo $row_result["banner_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='banner.php?banner_id=<?php echo $row_result["banner_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>