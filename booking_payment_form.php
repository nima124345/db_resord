<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
body{background-color: #ffffff;font-family: 'Open Sans',serif}
/*.container{margin-top:50px;margin-bottom: 50px}
.card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}
.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}
.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}*/
.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}
.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}
.track .step.active:before{background: #FF5722}
.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}
.track .step.active 
  .icon{background: #ee5435;color: #fff;}
.track .icon{display: inline-block;width: 50px;height: 50px;line-height: 50px;position: relative;border-radius: 100%;background: #ddd}
.track .step.active .text{font-weight: 400;color: #000}
.track .text{display: block;margin-top: 10px}
/*.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 50%}
.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}
.img-sm{width: 80px;height: 80px;padding: 7px}ul
.row, ul.row-sm{list-style: none;padding: 0}
.itemside .info{padding-left: 15px;padding-right: 7px}
.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}
.btn-warning{color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px}
.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}*/
.track{
  margin: auto;
  width: 100%;
}
</style>

<?php 
//booking detail
$booking_id = $_GET['booking_id'];
$bookingDetail ="
SELECT * FROM 
tb_booking as b 
INNER JOIN tb_ac_admin as a ON b.user_id=a.admin_id
INNER JOIN tb_room as r ON b.room_id=r.room_id
INNER JOIN tb_room_type as t ON r.type_id=t.type_id
WHERE b.booking_id=$booking_id 
GROUP BY b.booking_id";
$rsbD = mysqli_query($Connection, $bookingDetail) or die (mysqli_error($Connection));
$rwbD = mysqli_fetch_assoc($rsbD);
if(mysqli_num_rows($rsbD)!=1){
	exit();
}
?>

<div class="container mb-5 mt-5">
  <div  class="row">
    <div class="col-sm-12">
        <div class="track">
           <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">จองสำเร็จ</span> </div>
          <div class="step"> <span class="icon"> <i class="fa fa-money" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">รอชำระเงิน</span> </div>
          <div class="step"> <span class="icon"> <i class="fa fa-clock-o" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text"> รอตรวจสอบการชำระเงิน</span> </div>
          <div class="step"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i></span> <span class="text">ชำระเงินสำเร็จ</span> </div>
        <!--  <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">Ready for pickup</span> </div>
          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">Ready for pickup</span> </div> -->
        </div>
      </div>
  </div>
</div>
<br> <br> 
<form action="" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-sm-5">
		<h4>รายละเอียดการจอง</h4>
		<table class="table table-bordered table-hover">
			<tbody>
				<tr class="table-info">
					<th width="40%">รหัสการจอง</th>
					<th width="60%"><?=$rwbD['booking_id'];?></th>
				</tr>
				<tr>
					<th width="40%">ประเภทห้องที่จอง</th>
					<td width="60%"><?=$rwbD['type_name'];?></td>
				</tr>
        <tr>
          <th width="40%">ห้อง</th>
          <td width="60%"><?=$rwbD['room_number'];?></td>
        </tr>
				<tr>
					<th width="40%">วันที่เช็คอิน</th>
					<td width="60%">
						<?=date('d/m/Y', strtotime($rwbD['checkInDate']));?>
						หลังเวลา <?=date('H:i', strtotime($rwbD['checkInDate']));?> น.
							
						</td>
				</tr>
				<tr>
					<th width="40%">วันที่เช็คเอ้าท์</th>
					<td width="60%">
						<?=date('d/m/Y', strtotime($rwbD['checkOutDate']));?>
						ก่อนเวลา. <?=date('H:i', strtotime($rwbD['checkOutDate']));?> น.
							
						</td>
				</tr>
				<tr>
					<th width="40%">เข้าพัก</th>
					<td width="60%"><?=$rwbD['totalDate'];?> คืน </td>
				</tr>
				<tr>
					<th width="40%">ค่าใช้จายคืนละ</th>
					<td width="60%"><?php echo $rwbD['booking_amount'] / $rwbD['totalDate'];?> บาท </td>
				</tr>
				<tr>
					<th width="40%">รวมที่ต้องชำระ</th>
					<td width="60%"><?=$rwbD['booking_amount'];?> บาท </td>
				</tr>
				<tr>
					<th width="40%">วันที่ทำรายการ</th>
					<td width="60%"><?=date('d/m/Y H:i:s', strtotime($rwbD['dateCreate']));?> น. </td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-7">
		<h4>ฟอร์มแจ้งชำระเงิน (เลือกธนาคารที่ท่านทำรายการโอนเงิน)</h4>
<?php
$sqlb= "SELECT * FROM tb_bank";
$result = mysqli_query($Connection, $sqlb) or die (mysqli_error($Connection));
?>
<table class="table table-striped table-bordered table-sm">
  <thead>
    <tr class="table-success">
      <th><font face="TH Sarabun New" size="5"> เลือก </font></th>
      <th><font face="TH Sarabun New" size="5"> ชื่อเจ้าของบัญชี</font></th>
      <th><font face="TH Sarabun New" size="5"> ธนาคาร</font></th>
      <th><font face="TH Sarabun New" size="5"> เลขบัญชี</font></th>
      <th><font face="TH Sarabun New" size="5"> สาขา</font></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($result as $row_result) {  ?>
    <tr>
      <td align="center"> <input type="radio" name="bank_id" required value="<?php echo $row_result["bank_id"];?>"></td>
      <td><?php echo $row_result["ac_name"];?></td>
      <td><?php echo $row_result["bank_name"];?></td>
      <td><?php echo $row_result["bank_number"];?></td>
      <td><?php echo $row_result["bank_branch"];?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<hr> <br> 
วันที่โอนเงิน <br>
<input type="date" name="payDate" required class="form-control">
<br> 
อัพโหลดสลิป (ไฟล์นามสกุล .jpg, .jpeg เท่านั้น)<br>
<input type="file" name="slip" required accept="image/*" class="form-control">
<br>
<input type="hidden" name="booking_id" value="<?=$rwbD['booking_id'];?>">
<button type="submit"  class="btn btn-primary" style="width: 100%">แจ้งชำระเงิน</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['bank_id']) && isset($_POST['booking_id'])){
	
    $bank_id = $_POST['bank_id'];
    $payDate = $_POST['payDate'];
    $booking_id = $_POST['booking_id'];

     //up file

    //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $slip = (isset($_POST['slip']) ? $_POST['slip'] : '');
    $upload=$_FILES['slip']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['slip']['name'],".");
 
    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
   if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
 
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="img/payment/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'img_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
 

          $sql = "UPDATE tb_booking SET 
      
          bank_id='$bank_id',
          payDate='$payDate',
          slip='$newname',
          booking_status=3

          WHERE booking_id=$booking_id 
        ";
          $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error($Connection));

          
         if($result){
           move_uploaded_file($_FILES['slip']['tmp_name'],$path_copy); 
           mysqli_close($Connection);
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "แจ้งชำระเงินสำเร็จ",
                                text: "ขั้นตอนต่อไป รอเจ้าที่ตรวจสอบ",
                                type: "success"
                            }, function() {
                                window.location = "member.php?page=allBooking"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  }else{
                     echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เกิดข้อผิดพลาด",
                                type: "error"
                            }, function() {
                                window.location = "member.php?page=allBooking"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else ของ if result
                  } //type file
                  else
                  {
                  	 echo 'คุณอัพโหลดไฟล์ไม่ถูกต้อง ';
                  } //type file
                }else{
                	echo 'กรุณาเลือกไฟล์ภาพสลิป';
                }
          }  //isset

?>