<?php
$sql_top3c = "
SELECT  *
FROM tb_booking 
LIMIT 3";
$rstop3c = mysqli_query($Connection, $sql_top3c) or die (mysqli_error($Connection));

if(mysqli_num_rows($rstop3c) > 0) {
$sql_top3 = "
SELECT r.*, COUNT(b.booking_id) as totalBooking
FROM tb_booking as b
LEFT JOIN tb_room as r  ON b.room_id = r.room_id
GROUP BY r.room_id
ORDER BY totalBooking DESC
LIMIT 3";
$rstop3 = mysqli_query($Connection, $sql_top3) or die (mysqli_error($Connection));
}else{
$sql_top3 = "
SELECT * FROM tb_room
ORDER BY rand()
LIMIT 3";
$rstop3 = mysqli_query($Connection, $sql_top3) or die (mysqli_error($Connection));
}
?>
<!-- Blog Area Start -->
<section class="roberto-blog-area section-padding-50-0" id="top3">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                    <!--  <h6>ห้องพัก ( <a href="rooms.php"> ห้องพักทั้งหมดคลิก </a>) </h6> -->
                    <h2>ห้องพักยอดฮิต 3 อันดับ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            
            <?php foreach ($rstop3 as $rsn) {  ?>
            <!-- Single Post Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                    <a href="room.php?id=<?=$rsn['room_id'];?>&act=room-detail" class="post-thumbnail">
                    <img src="img/room/<?=$rsn['room_img'];?>" alt=""></a>
                    <!-- Post Meta -->
                    
                    <!-- Post Title -->
                    <a href="room.php?id=<?=$rsn['room_id'];?>&act=room-detail" class="post-title">
                        ห้อง <?=$rsn['room_number'];?>
                        ราคา :
                    <?=$rsn['room_price'];?> / คืน  </a>
                    <a href="room.php?id=<?=$rsn['room_id'];?>&act=room-detail" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>เพิ่มเติม...</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Blog Area End -->