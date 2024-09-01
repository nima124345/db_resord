<?php
$sql_script = "SELECT * FROM tb_room_type ";
$result = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
//$row_result = mysqli_fetch_assoc($result);
?>                <table class="table datatable table-striped table-bordered table-sm">
                      <thead>
                        <tr>
                          <th><font face="TH Sarabun New" > id</font></th>
                          <th><font face="TH Sarabun New" > ชื่อสถานะ</font></th>
                          <th><center><font face="TH Sarabun New" >แก้ไข</font></center></th>
                          <th><center><font face="TH Sarabun New" >ลบ</font></center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($result as $row_result) {  ?>
                        <tr>
                          <td scope="row"><?php echo $i++;?></td>
                          <td><?php echo $row_result["type_name"];?></td>
                           <td><center>
                            <a href="roomtype.php?act=edit&type_id=<?php echo $row_result["type_id"];?>" class="btn btn-warning btn-sm">
                          <i class="ri-edit-box-fill"> </i>
                            <font face="TH Sarabun New" > แก้ไข </font></a> 
                          </center>
                        </td>
                          <td><center>
                            <a type="button" class="btn btn-danger btn-sm" href="JavaScript:if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?') == true){window.location='roomtype.php?type_id=<?php echo $row_result["type_id"];?>&act=del';}">
                          <i class="ri-delete-bin-5-line"><font face="TH Sarabun New" > ลบข้อมูล</font></i>
                        </a>
                      </center>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>