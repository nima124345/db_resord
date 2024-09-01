<?php
$booking_id = $_GET['booking_id'];
$sql_script = "SELECT *
FROM tb_booking AS b
INNER JOIN tb_ac_admin AS a ON b.user_id=a.admin_id
INNER JOIN tb_bank as k ON b.bank_id=k.bank_id
LEFT JOIN tb_room as r ON b.room_id = r.room_id
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE b.booking_id = $booking_id
GROUP BY b.booking_id
ORDER BY b.checkInDate DESC";

$result = mysqli_query($Connection, $sql_script) or die(mysqli_error($Connection));
$rwbD = mysqli_fetch_assoc($result);

$booking_status = [
    0 => 'ยกเลิก',
    1 => 'เช็คเอ้า',
    2 => 'รอชำระเงิน',
    3 => 'รอตรวจสอบชำระเงิน',
    4 => 'รอเข้าพัก',
    5 => 'เช็คอิน'
];
$txts = $booking_status[$rwbD["booking_status"]];
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="receipt-container" style="padding: 20px; margin-top: 20px;">
            <h2 style="text-align: center; margin-bottom: 20px;">ใบเสร็จรับเงิน</h2>
            <p><strong>รหัสการจอง:</strong> <?=$rwbD['booking_id'];?></p>
            <p><strong>ชื่อ-สกุล:</strong> <?=$rwbD["admin_firstname"].' '.$rwbD["admin_surname"];?></p>
            <p><strong>เบอร์โทร:</strong> <?=$rwbD['admin_phone'];?></p>
            <p><strong>ที่อยู่:</strong> <?=$rwbD['admin_address'];?></p>
            <hr>
            <h4>รายละเอียดการจองห้องพัก</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="40%">ห้องที่เข้าพัก</th>
                        <td width="60%"><?=$rwbD['room_number'];?></td>
                    </tr>
                    <tr>
                        <th width="40%">ประเภทห้องที่จอง</th>
                        <td width="60%"><?=$rwbD['type_name'];?></td>
                    </tr>
                    <tr>
                        <th width="40%">วันที่เช็คอิน</th>
                        <td width="60%">
                            <?=date('d/m/Y', strtotime($rwbD['checkInDate']));?> หลังเวลา <?=date('H:i', strtotime($rwbD['checkInDate']));?> น.
                        </td>
                    </tr>
                    <tr>
                        <th width="40%">วันที่เช็คเอ้าท์</th>
                        <td width="60%">
                            <?=date('d/m/Y', strtotime($rwbD['checkOutDate']));?> ก่อนเวลา <?=date('H:i', strtotime($rwbD['checkOutDate']));?> น.
                        </td>
                    </tr>
                    <tr>
                        <th width="40%">ระยะเวลาที่เข้าพัก</th>
                        <td width="60%"><?=$rwbD['totalDate'];?> คืน</td>
                    </tr>
                    <tr>
                        <th width="40%">ค่าใช้จ่ายต่อคืน</th>
                        <td width="60%"><?=number_format($rwbD['booking_amount'] / $rwbD['totalDate']);?> บาท</td>
                    </tr>
                    <tr>
                        <th width="40%">รวมค่าใช้จ่ายทั้งหมด</th>
                        <td width="60%"><?=number_format($rwbD['booking_amount']);?> บาท</td>
                    </tr>
                    <tr>
                        <th width="40%">สถานะการจอง</th>
                        <td width="60%"><?=$txts;?></td>
                    </tr>
                    <tr>
                        <th width="40%">ธนาคารที่โอนเงิน</th>
                        <td width="60%"><?=$rwbD['bank_name'];?> เลข บ/ช <?=$rwbD['bank_number'];?> ชื่อ บ/ช <?=$rwbD['ac_name'];?></td>
                    </tr>
                    <tr>
                        <th width="40%">วันที่ชำระเงิน</th>
                        <td width="60%"><?=date('d/m/Y', strtotime($rwbD['payDate']));?></td>
                    </tr>
                    <tr>
                        <th width="40%">ค่าเสียหาย</th>
                        <td width="60%">
                            <?php if ($rwbD['damage_total'] > 0) { ?>
                                <?=number_format($rwbD['damage_total']);?> บาท จาก <?=$rwbD['damage_detail'];?>
                            <?php } else { echo '-'; } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <p style="text-align: center; margin-top: 20px;">ขอบคุณที่ใช้บริการกับเรา</p>
            <div class="text-center mt-4">
                <button onclick="window.print();" class="btn btn-primary">พิมพ์ใบเสร็จ</button>
            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>

<style>
    .receipt-container {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: auto;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h2 {
        font-family: 'TH Sarabun New', sans-serif;
        font-size: 24px;
    }
    table th, table td {
        font-family: 'TH Sarabun New', sans-serif;
        font-size: 18px;
    }
    hr {
        border-top: 1px solid #ddd;
    }
    @media print {
        .receipt-container {
            width: 100%;
            height: auto;
            padding: 0;
            box-shadow: none;
            page-break-inside: avoid;
        }
        .btn {
            display: none;
        }
    }
</style>
