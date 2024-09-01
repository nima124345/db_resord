<?php
$sql_script = "SELECT * FROM tb_news";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > No.</font></th>
      <th><font face="TH Sarabun New" > IMG</font></th>
      <th><font face="TH Sarabun New" > พาดหัวข่าว</font></th>
      <th><font face="TH Sarabun New" > รายละเอียด </font></th>
      <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td scope="row"><?php echo $i++;?></td>
      <td><img src="../img/news/<?php echo $row_result["news_img"];?>" width="70px"></td>
      <td> <?php echo $row_result["news_head"];?></td>
      <td><?php echo $row_result["news_detail"];?></td>
      
      <td><center>
        <a href="news.php?act=edit&news_id=<?php echo $row_result["news_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='news.php?news_id=<?php echo $row_result["news_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>