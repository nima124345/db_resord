<?php
$sql_script = "SELECT * FROM tb_setting";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > No.</font></th>
      <th><font face="TH Sarabun New" > Logo</font></th>
      <th><font face="TH Sarabun New" > รายละเอียด</font></th>
      <th><font face="TH Sarabun New" > การติดต่อ </font></th>
      <th><font face="TH Sarabun New" > สถานะ</font></th>
      <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i++;?></td>
      <td><img src="../img/wst/<?php echo $row_result["wst_img"];?>" width="70px"></td>
       
      <td>
         ชื่อเว็บไซต์.<?php echo $row_result["wst_name"];?> <br> 
       Title.<?php echo $row_result["wst_title"];?> <br> 
        About.<?php echo $row_result["wst_about"];?>
        
       

      </td>
      <td>
       เบอร์โทร. <?php echo $row_result["wst_phone"];?> <br> 
       อีเมล. <?php echo $row_result["wst_email"];?>
     </td>
      <td><?php if($row_result["wst_show"] ==1){ echo 'แสดง';  }else{ echo 'ซ่อน'; }?></td>
      
      <td><center>
        <a href="wst.php?act=edit&wst_id=<?php echo $row_result["wst_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='wst.php?wst_id=<?php echo $row_result["wst_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>