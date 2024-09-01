<?php 
// session_start();
// //print_r($_SESSION);
// require_once('connection.php');
//booking detail
$booking_id = $_GET['booking_id'];
$bookingDetail ="
SELECT * FROM 
tb_booking as b 
INNER JOIN tb_ac_admin as a ON b.user_id=a.admin_id
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
LEFT JOIN tb_bank as k ON b.bank_id=k.bank_id
WHERE b.booking_id=$booking_id 
GROUP BY b.booking_id";
$rsbD = mysqli_query($Connection, $bookingDetail) or die (mysqli_error($Connection));
$rwbD = mysqli_fetch_assoc($rsbD);

//echo $bookingDetail;
if(mysqli_num_rows($rsbD)==''){
	exit();
}

if($rwbD["booking_status"] == 0){
        $txts = 'ยกเลิก';
      } else if($rwbD["booking_status"] == 1){
        $txts = 'เช็คเอ้า';
      } else if($rwbD["booking_status"] == 2){
        $txts = 'รอชำระเงิน';
      } else if($rwbD["booking_status"] == 3){
        $txts = 'รอตรวจสอบชำระเงิน';
      } else if($rwbD["booking_status"] == 4){
        $txts = 'รอเข้าพัก';
      } else if($rwbD["booking_status"] == 5){
        $txts = 'เช็คอิน';
      }
?>
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
<div class="row">
  <div class="col-sm-1"></div>
	<div class="col-sm-9">
    <div class="container mb-5 mt-5">
  <div  class="row">
    <div class="col-sm-12">
        <div class="track">
          <?php if($_GET['bs'] == 4){ ?>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">จองสำเร็จ</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">รอชำระเงิน</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text"> รอตรวจสอบการชำระเงิน</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i></span> <span class="text">ชำระเงินสำเร็จ/รอเข้าพัก</span> </div>

          <?php }else if($_GET['bs'] == 1 || $_GET['bs'] == 5){ ?>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">จองสำเร็จ</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">รอชำระเงิน</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text"> รอตรวจสอบการชำระเงิน</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i></span> <span class="text">ชำระเงินสำเร็จ/รอเข้าพัก</span> </div>

          <?php }else if($_GET['bs'] == 3){ ?>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">จองสำเร็จ</span> </div>

          <div class="step active"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">รอชำระเงิน</span> </div>

          <div class="step"> <span class="icon"> <i class="fa fa-clock-o" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text"> รอตรวจสอบการชำระเงิน</span> </div>

          <div class="step"> <span class="icon"> <i class="fa fa-check" style="font-size:42px;color:white; margin-top: 5px;"></i></span> <span class="text">ชำระเงินสำเร็จ/รอเข้าพัก</span> </div>

 


          <?php }else{ ?>

          <div class="step"> <span class="icon"> <i class="fa fa-remove" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">จองสำเร็จ</span> </div>

          <div class="step"> <span class="icon"> <i class="fa fa-remove" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text">รอชำระเงิน</span> </div>

          <div class="step"> <span class="icon"> <i class="fa fa-remove" style="font-size:42px;color:white; margin-top: 5px;"></i> </span> <span class="text"> รอตรวจสอบการชำระเงิน</span> </div>

          <div class="step"> <span class="icon"> <i class="fa fa-remove" style="font-size:42px;color:white; margin-top: 5px;"></i></span> <span class="text">ชำระเงินสำเร็จ</span> </div>

          <?php } ?> 

          

        </div>
      </div>
  </div>
</div>
<br> <br> 

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
        <tr>
          <th width="40%">สถานะการจอง</th>
          <td width="60%"> <?=$txts;?> </td>
        </tr>
         <?php if ($rwbD["slip"]!='') { ?>
         <tr>
          <th width="40%">ธนาคารที่โอนเงิน</th>
          <td width="60%"><?=$rwbD['bank_name'];?> เลข บ/ช  <?=$rwbD['bank_number'];?>  ชื่อ บ/ช  <?=$rwbD['ac_name'];?></td>
        </tr>
        <tr>
          <th width="40%">สลิปโอนค่าห้องพัก</th>
          <td width="60%"> <img src="img/payment/<?=$rwbD["slip"];?>"  width="200px;"> </td>
        </tr>
        <tr>
          <th width="40%">วันที่ชำระเงิน</th>
          <td width="60%">  <?=date('d/m/Y', strtotime($rwbD['payDate']));?> </td>
        </tr>
      <?php } ?>
       
    
        <tr>
          <th width="40%">ข้อมูลลูกค้า</th>
          <td width="60%">
            ชื่อ-สกุล <?=$rwbD["admin_firstname"].' '.$rwbD["admin_surname"];?>
            <br> เบอร์โทร. <?=$rwbD['admin_phone'];?> <br>
            ที่อยู่. <?=$rwbD['admin_address'];?>
          </td>
        </tr>
        <tr>
          <th width="40%">ค่าเสียหาย</th>
          <td width="60%">
            <?php if($rwbD['damage_total'] > 0){ ?>
            <?=$rwbD['damage_total'];?>
            จาก.  <?=$rwbD['damage_detail'];?>
          <?php }else{ echo '-'; } ?>
          </td>
        </tr>
      </tbody>
    </table>
	</div>

</div> <!-- ./ row -->
  