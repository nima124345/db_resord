<?php
//count by booking status
//รอชำระเงิน
$st2 ="SELECT COUNT(*) AS totals2 FROM tb_booking WHERE booking_status = 2";
$rst2 = mysqli_query($Connection, $st2);
$rwst2 = mysqli_fetch_assoc($rst2);

//ชำระเงินแล้ว รอตรวจสอบ
$st3 ="SELECT COUNT(*) AS totals3 FROM tb_booking WHERE booking_status = 3";
$rst3 = mysqli_query($Connection, $st3);
$rwst3= mysqli_fetch_assoc($rst3);

//รอเข้าพัก
$st4 ="SELECT COUNT(*) AS totals4 FROM tb_booking WHERE booking_status = 4";
$rst4 = mysqli_query($Connection, $st4);
$rwst4= mysqli_fetch_assoc($rst4);

//อยู่ระหว่างเช็คอิน
$st5 ="SELECT COUNT(*) AS totals5 FROM tb_booking WHERE booking_status = 5";
$rst5 = mysqli_query($Connection, $st5);
$rwst5= mysqli_fetch_assoc($rst5);

//เช็คเอ้า สำเร็จ
$st1 ="SELECT COUNT(*) AS totals1 FROM tb_booking WHERE booking_status = 1";
$rst1 = mysqli_query($Connection, $st1);
$rwst1= mysqli_fetch_assoc($rst1);

//ยกเลิก
$st0 ="SELECT COUNT(*) AS totals0 FROM tb_booking WHERE booking_status = 0";
$rst0 = mysqli_query($Connection, $st0);
$rwst0= mysqli_fetch_assoc($rst0);
?>
 
<font face="TH Sarabun New" size="5">จำนวนการจองแยกตามสถานะ</font>
<table class="table table-hover table-striped table-bordered table-sm">
	<thead>
		<tr class="table-info">
			<th width="5%" class="text-center">#</th>
			<th width="70%">สถานะ</th>
			<th width="15%" class="text-center">จำนวน (รายการ)</th>
			 
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center">1</td>
			<td>รอชำระเงิน</td>
			<td align="center"><?php echo $rwst2['totals2'];?></td>
			 
		</tr>
		<tr>
			<td align="center">2</td>
			<td>ชำระเงินแล้ว *รอตรวจสอบการชำระเงิน</td>
			<td align="center"><?php echo $rwst3['totals3'];?></td>
			 
		</tr>
		<tr>
			<td align="center">3</td>
			<td>*ตรวจสอบการชำระเงินสำเร็จ รอเข้าพัก</td>
			<td align="center"><?php echo $rwst4['totals4'];?></td>
			 
		</tr>
		<tr>
			<td align="center">4</td>
			<td>Check IN - เข้าพัก</td>
			<td align="center"><?php echo $rwst5['totals5'];?></td>
			 
		</tr>
		<tr>
			<td align="center">5</td>
			<td>Check OUT - สำเร็จ</td>
			<td align="center"><?php echo $rwst1['totals1'];?></td>
			 
		</tr>
		<tr>
			<td align="center">6</td>
			<td>รายการยกเลิก</td>
			<td align="center"><?php echo $rwst0['totals0'];?></td>
			 
		</tr>
	</tbody>
</table>