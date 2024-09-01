    <!-- Our Room Area Start -->

    <section class="roberto-rooms-area" id="rooms">
        <div class="rooms-slides owl-carousel">
<?php
$sqlroom = "SELECT *
FROM tb_room  AS r 
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
GROUP BY r.room_id";
$rsr = mysqli_query($Connection, $sqlroom) or die (mysqli_error($Connection));
?>


  <?php  foreach ($rsr as $rsr) {  ?>
            <!-- Single Room Slide -->
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url(img/room/<?=$rsr['room_img'];?>);"></div>

                <!-- Content -->
                <div class="room-content">
                    <h2 data-animation="fadeInUp" data-delay="100ms"><?=$rsr['type_name'];?></h2>
                    <h3 data-animation="fadeInUp" data-delay="300ms"><?=$rsr['room_price'];?> บาท/คืน <span></span></h3>
                    <ul class="room-feature" data-animation="fadeInUp" data-delay="500ms">
                        
                        <li><span><i class="fa fa-check"></i> รายละเอียด </span> <span>:  <?=$rsr['room_detail'];?> </span></li>
                       <li><span><i class="fa fa-check"></i> สิ่งอำนวยความสะดวก </span> <span>:  <?=$rsr['room_service'];?> </span></li>
                       <!--  <li><span><i class="fa fa-check"></i> Size</span> <span>: 30 ft</span></li>
                        <li><span><i class="fa fa-check"></i> Capacity</span> <span>: Max persion 5</span></li>
                        <li><span><i class="fa fa-check"></i> Bed</span> <span>: King Beds</span></li>
                        <li><span><i class="fa fa-check"></i> Services</span> <span>: Wifi, Television, Bathroom</span></li> -->

                    </ul>
                    <a href="room.php?id=<?=$rsr['room_id'];?>&act=room-detail" class="btn roberto-btn mt-30" data-animation="fadeInUp" data-delay="700ms">รายละเอียด</a>
                </div>
            </div>
    <?php } ?>

            

        </div>
    </section>
    <!-- Our Room Area End -->
    <br> 