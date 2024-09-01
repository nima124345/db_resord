<?php 
    include 'section-header.php';
    include 'section-top-header.php';
    include 'section-navbar.php';
 
 //query all room
$queryRtall="SELECT * FROM tb_room";
$rsRtall = mysqli_query($Connection, $queryRtall);

?>

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">ห้องพักทั้งหมด</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                     <!--            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room</li> -->
                            </ol>
                        </nav>
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

                <?php foreach ($rsRtall as $rsRtall){ ?>
                <div class="col-12 col-sm-10 col-lg-10">

                    
                    <!-- Single Room Area -->
                    <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Room Thumbnail -->
                        <div class="room-thumbnail">
                            <img src="img/room/<?=$rsRtall['room_img'];?>" alt="">
                        </div>
                        <!-- Room Content -->
                        <div class="room-content">
                            <h2 class="mt-0">ห้อง <?=$rsRtall['room_number'];?></h2>
                            <h4> <?=$rsRtall['room_price'];?> <span>/ วัน</span></h4>
                            <div class="room-feature">
                                <h6>ขนาดห้อง: <span> <?=$rsRtall['room_size'];?> ตรม.</span></h6>
                                <h6>เข้าพักได้: <span> <?=$rsRtall['room_capacity'];?> คน</span></h6>
                                <h6>เตียง: <span> <?=$rsRtall['room_bed'];?> </span></h6>
                                <h6>บริการ: <span>  <?=$rsRtall['room_service'];?> </span></h6>
                            </div>
                            <a href="room.php?id=<?=$rsRtall['room_id'];?>&act=room-detail" class="btn view-detail-btn">รายละเอียดเพิ่มเติม <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
            


                </div>
                    <?php } ?>
            <?php /*
                <div class="col-12 col-lg-4">
                    <!-- Hotel Reservation Area -->
                    <div class="hotel-reservation--area mb-100">
                        <form action="#" method="post">
                            <div class="form-group mb-30">
                                <label for="checkInDate">เลือกห้อง/บ้าน</label>
                                
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            select/optin
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group mb-30">
                                <label for="checkInDate">Date</label>
                                <div class="input-daterange" id="datepicker">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <input type="text" class="input-small form-control" id="checkInDate" name="checkInDate" placeholder="Check In">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="input-small form-control" name="checkOutDate" placeholder="Check Out">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" class="btn roberto-btn w-100">ตรวจสอบห้องว่าง</button>
                            </div>
                        </form>
                    </div>
                </div>
                */ ?>
            </div>
        </div>
    </div>
    <!-- Rooms Area End -->
    <?php 
    //include 'section-news.php';
    include 'section-footer.php';
 ?>



