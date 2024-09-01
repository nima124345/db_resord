<?php 
    include 'section-header.php';
    include 'section-top-header.php';
    include 'section-navbar.php';
 
 //query room by type
$id = $_GET['tid'];
$queryRtall="SELECT * FROM tb_room WHERE type_id=$id";
$rsRtall = mysqli_query($Connection, $queryRtall);

 
$sqlRoom = "SELECT * FROM tb_room";
$rsroom = mysqli_query($Connection, $sqlRoom) or die (mysqli_error($Connection));
?>

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">ห้องพักประเภท <?=$_GET['name'];?></h2>
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
 
<?php if(mysqli_num_rows($rsRtall)==0){
   echo "<script>window.location = 'index.php';</script>";
}?>
     <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">

                    <?php foreach ($rsRtall as $rsRtall){ ?>
                    <!-- Single Room Area -->
                    <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Room Thumbnail -->
                        <div class="room-thumbnail">
                            <img src="img/room/<?=$rsRtall['room_img'];?>" alt="">
                        </div>
                        <!-- Room Content -->
                        <div class="room-content">
                            <h2>ห้อง <?=$rsRtall['room_number'];?></h2>
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
                <?php } ?>


                </div>

                <div class="col-12 col-lg-4">
                    <!-- Hotel Reservation Area -->
                    <div class="hotel-reservation--area mb-100">
                        <form action="room.php" method="get">
                            <div class="form-group mb-30">
                                <label for="checkInDate">เลือกห้อง/บ้าน</label>
                                
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <select name="id"  class="form-control" required>
                                                <option value="">-เลือกห้องพัก</option>
                                             <?php foreach ($rsroom as $rsty) { ?>
                                                    <option value="<?=$rsty['room_id'];?>">-<?=$rsty['room_number'];?></option>
                                                  <?php } ?> 
                                                </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group mb-20">
                                <div>
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                           <label for="checkIn">Check In</label>
                                <input type="date" class="form-control" id="pick_date" name="checkinDate" required onchange="cal()" min="<?=date('Y-m-d');?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="checkOut">Check Out</label>
                                <input type="date" class="form-control" id="drop_date" name="checkoutDate" required onchange="cal()" min="<?=date('Y-m-d');?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                 <input type="hidden" class="form-control"  id="numdays2" name="numdays"/>
                                <button type="submit" name="act" value="searching" class="btn roberto-btn w-100">ตรวจสอบห้องว่าง</button>
                            </div>
                        </form>

                         <script type="text/javascript">
        function GetDays(){
        var dropdt = new Date(document.getElementById("drop_date").value);
        var pickdt = new Date(document.getElementById("pick_date").value);
        return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }
        function cal(){
        if(document.getElementById("drop_date")){
        document.getElementById("numdays2").value=GetDays();
        }
        }
        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rooms Area End -->
    <?php 
    //include 'section-news.php';
    include 'section-footer.php';
 ?>



