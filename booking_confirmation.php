<?php 
    include 'section-header.php';
    include 'section-top-header.php';
    include 'section-navbar.php';

    $room_id = $_GET['room_id'];
    $checkinDate = $_GET['checkinDate'];
    $checkoutDate = $_GET['checkoutDate'];

    // Insert booking logic here (เช่น บันทึกข้อมูลการจองลงในฐานข้อมูล)
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="p-4 bg-light rounded shadow-sm">
                <h4 class="text-center">การจองสำเร็จ</h4>
                <p>คุณได้ทำการจองห้องพักหมายเลข <?= $room_id; ?> ตั้งแต่วันที่ <?= $checkinDate; ?> ถึง <?= $checkoutDate; ?></p>
                <a href="index.php" class="btn btn-primary btn-block">กลับไปยังหน้าหลัก</a>
            </div>
        </div>
    </div>
</div>

<?php 
include 'section-footer.php';
?>
