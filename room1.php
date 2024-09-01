<?php
include 'section-header.php';
include 'section-top-header.php';
include 'section-navbar.php';

// ดึงวันที่เข้าพักและวันที่ออกจากพักจากฟอร์มที่ส่งมา
$checkinDate = isset($_GET['checkinDate']) ? $_GET['checkinDate'] : '';
$checkoutDate = isset($_GET['checkoutDate']) ? $_GET['checkoutDate'] : '';

// Query ห้องพักทั้งหมด
$sqlRoomAll = "SELECT * FROM tb_room";
$resultAllRooms = mysqli_query($Connection, $sqlRoomAll) or die(mysqli_error($Connection));
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">ห้องพักทั้งหมด</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Rooms Area Start -->
<div class="roberto-rooms-area section-padding-100-0">
    <div class="container">
        <div class="row">

            <!-- Hotel Reservation Area -->
            <div class="col-12">
                <div class="hotel-reservation--area mb-100">
                    <form action="room1.php" method="get">
                        <div class="row justify-content-between align-items-end">
                            <div class="col-6 col-md-6 col-lg-6">
                                <label for="checkIn">Check In</label>
                                <input type="date" class="form-control" id="pick_date" name="checkinDate" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$checkinDate;?>">
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <label for="checkOut">Check Out</label>
                                <input type="date" class="form-control" id="drop_date" name="checkoutDate" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$checkoutDate;?>">
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>

            <script type="text/javascript">
            function GetDays(){
                var dropdt = new Date(document.getElementById("drop_date").value);
                var pickdt = new Date(document.getElementById("pick_date").value);
                return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
            }

            function cal(){
                if (document.getElementById("drop_date")) {
                    var days = GetDays();
                    if (days <= 0) {
                        alert("วัน Check-out ต้องมากกว่าวัน Check-in");
                        document.getElementById("drop_date").value = "";
                        document.getElementById("numdays2").value = "";
                    } else {
                        document.getElementById("numdays2").value = days;
                    }
                }
            }
            </script>

            <?php while ($room = mysqli_fetch_assoc($resultAllRooms)) { 
                // ตรวจสอบว่าห้องนี้ว่างหรือไม่ในวันที่เลือก
                $sqlRoomAvailable = "
                    SELECT COUNT(*) AS total 
                    FROM tb_booking 
                    WHERE room_id = {$room['room_id']} 
                    AND (
                        ('$checkinDate' BETWEEN checkInDate AND checkOutDate) 
                        OR ('$checkoutDate' BETWEEN checkInDate AND checkOutDate)
                    )
                ";
                $resultAvailable = mysqli_query($Connection, $sqlRoomAvailable);
                $availability = mysqli_fetch_assoc($resultAvailable);

                $isAvailable = ($availability['total'] == 0);
            ?>
            <div class="col-12 col-sm-10 col-lg-10">
                
                <!-- Single Room Area -->
                <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Room Thumbnail -->
                    <div class="room-thumbnail">
                        <img src="img/room/<?=$room['room_img'];?>" alt="">
                    </div>
                    <!-- Room Content -->
                    <div class="room-content">
                        <h2 class="mt-0">ห้อง <?=$room['room_number'];?></h2>
                        <h4><?=$room['room_price'];?> <span>/ วัน</span></h4>
                        <div class="room-feature">
                            <h6>ขนาดห้อง: <span><?=$room['room_size'];?> ตรม.</span></h6>
                            <h6>เข้าพักได้: <span><?=$room['room_capacity'];?> คน</span></h6>
                            <h6>เตียง: <span><?=$room['room_bed'];?> </span></h6>
                            <h6>บริการ: <span><?=$room['room_service'];?> </span></h6>
                        </div>
                        <?php if ($isAvailable) { ?>
                            <a href="booking.php?id=<?=$room['room_id'];?>&checkinDate=<?=$checkinDate;?>&checkoutDate=<?=$checkoutDate;?>&act=room-detail" class="btn view-detail-btn">จองห้องนี้ <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        <?php } else { ?>
                            <button class="btn btn-danger" disabled>ไม่ว่าง</button>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <?php } ?>

        </div>
    </div>
</div>
<!-- Rooms Area End -->

<?php 
include 'section-footer.php';
?>
