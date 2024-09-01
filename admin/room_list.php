<?php
$sql_script = "SELECT *
FROM tb_room  AS r 
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
GROUP BY r.room_id";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
?>
<table class="table datatable table-striped table-bordered table-sm">
  <thead>
    <tr>
      <th><font face="TH Sarabun New" > เลขห้อง </font></th>
      <th><font face="TH Sarabun New" > ภาพ</font></th>
      <th><font face="TH Sarabun New" > รายละเอียดห้อง</font></th>
      <th><font face="TH Sarabun New" > ราคา/คืน</font></th>
      <th><center><font face="TH Sarabun New" >+ภาพ</font></center></th>
      <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
      <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($result as $row_result) {  ?>
    <tr>
      <td align="center"><?php echo $row_result['room_number'];?></td>
      <td><img src="../img/room/<?php echo $row_result["room_img"];?>" width="70px"></td>
      <td>
        <b> ประเภท. </b> <?php echo $row_result["type_name"];?>  <br>   
 
         <!--  <b>  รายละเอียด </b> <?php echo $row_result["room_detail"];?> <br> -->
         <b>ขนาด </b>  <?php echo $row_result["room_size"];?> ตรม.,
         <b>พักได้  </b> <?php echo $row_result["room_capacity"];?>  คน ,
         <b>ประเภทเตียง </b> <?php echo $row_result["room_bed"];?>
         <br>

          <b> สิ่งอำนวยความสะดวก </b> <?php echo $row_result["room_service"];?>  
 
        
      </td>
      <td><center><?php echo number_format($row_result["room_price"],2);?></center></td>

      <td><center>
        <a href="room.php?act=img&room_id=<?php echo $row_result["room_id"];?>" class="btn btn-info btn-sm">
          <i class="ri-add-box-fill"> </i>
        <font face="TH Sarabun New" > +ภาพ </font></a>
        </center>
      </td>


      <td><center>
        <a href="room.php?act=edit&room_id=<?php echo $row_result["room_id"];?>" class="btn btn-warning btn-sm">
          <i class="ri-edit-box-fill"> </i>
        <font face="TH Sarabun New" > แก้ไข </font></a>
        </center>
      </td>
      <td><center>
        <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='room.php?room_id=<?php echo $row_result["room_id"];?>&act=del';}">
          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
        </a>
        </center>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>