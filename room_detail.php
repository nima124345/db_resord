<?php 
 $checkinDate = isset($_GET['checkinDate']) ? $_GET['checkinDate'] : '';
 $checkoutDate = isset($_GET['checkoutDate']) ? $_GET['checkoutDate'] : '';
?>

<div class="col-12 col-lg-6">
    <!-- Single Room Details Area -->
    <div class="single-room-details-area mb-50">
        <!-- Room Thumbnail Slides -->
        <div class="room-thumbnail-slides mb-50">
            <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/room/<?=$rwr['room_img'];?>" class="d-block w-100" alt="">
                    </div>
                    <?php foreach ($rsimg as $rsimg) { ?>
                    <div class="carousel-item">
                        <img src="img/roomGallery/<?=$rsimg['image_url'];?>" class="d-block w-100" alt="">
                    </div>
                    <?php } ?>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#room-thumbnail--slide" data-slide-to="0" class="active">
                        <img src="img/room/<?=$rwr['room_img'];?>" class="d-block w-100" alt="">
                    </li>
                    <?php $i=1; foreach ($rsimg1 as $rsimg1) { ?>
                    <li data-target="#room-thumbnail--slide" data-slide-to="<?=$i++;?>" class="active">
                        <img src="img/roomGallery/<?=$rsimg1['image_url'];?>" class="d-block w-100" alt="">
                    </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
        <p>
            <b>รายละเอียดห้องพัก</b> <br>
            <?=$rwr['room_detail'];?>
            <br>
            <b>สิ่งอำนวยความสะดวก </b> <br>
            <?=$rwr['room_service'];?>
        </p>
    </div>

    <!-- Room Service -->
    <div class="room-service mb-50">
        <h4></h4>
        <ul>
            <li><img src="img/core-img/icon1.png" alt=""> Air Conditioning</li>
            <li><img src="img/core-img/icon2.png" alt=""> Free drinks</li>
            <li><img src="img/core-img/icon3.png" alt=""> Restaurant quality</li>
            <li><img src="img/core-img/icon4.png" alt=""> Cable TV</li>
            <li><img src="img/core-img/icon5.png" alt=""> Unlimited Wifi</li>
            <li><img src="img/core-img/icon6.png" alt=""> Service 24/24</li>
        </ul>
    </div>
</div>

<div class="col-12 col-lg-6">
    <!-- Hotel Reservation Area -->
    <div class="hotel-reservation--area mb-100">
        <form action="room.php" method="get">
            <div class="form-group mb-30">
                <label for="checkInDate">เลือกวันที่ต้องการเข้าพัก</label>
                <div class="input-daterangex" id="datepickerx">
                    <div class="row no-gutters">
                        <div class="col-6">
                            วันที่เข้าพัก
                            <input type="date" class="input-small form-control" id="pick_date" name="checkinDate" placeholder="Check In" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$checkinDate;?>">
                        </div>
                        <div class="col-6">
                            ถึงวันที่
                            <input type="date" class="input-small form-control" id="drop_date" name="checkoutDate" placeholder="Check Out" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$checkoutDate;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                <input type="hidden" name="numdays" id="numdays2" name="numdays"/>
                <button type="submit" name="act" value="searching" class="btn roberto-btn w-100">จองห้องพักในวันดังกล่าว</button>
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

        <hr>
        <h5>รายการจอง</h5>
        <?php 
        $ds = date('Y').'-'.date('m').'-1';
        $de = date('Y').'-'.date('m').'-30';
        $room_id = $_GET['id'];
        $sqlBooked ="SELECT r.room_id, r.room_number, b.totalDate, b.booking_amount, 
            b.checkInDate, b.checkOutDate, b.booking_status, r.type_id, u.*, r.room_price
            FROM tb_booking b 
            INNER JOIN tb_room r on b.room_id=r.room_id
            INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
            WHERE b.room_id = $room_id
            AND b.booking_status >=3 
            AND
            (b.checkInDate >= CAST('$ds 14:00:00' AS DATETIME) 
            AND b.checkInDate <= CAST('$de 12:00:00' AS DATETIME)) 
            OR (b.checkOutDate >= CAST('$ds 14:00:00' AS DATETIME) 
            AND b.checkOutDate <= CAST('$de 12:00:00' AS DATETIME))
            AND b.room_id = $room_id
            GROUP BY r.room_id";
        $rsBooked = mysqli_query($Connection, $sqlBooked);
        if(mysqli_num_rows($rsBooked) >0 ){
        ?>
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead>
                <tr class="table-info">
                    <th width="10%">ลำดับ</th>
                    <th width="90%">ว/ด/ป</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach ($rsBooked as $rsBooked) { ?>
                <tr>
                    <td align="center"><?=$i++;?></td>
                    <td>
                        เช็คอิน : <?=date('d/m/Y', strtotime($rsBooked['checkInDate']));?> 
                        เช็คเอ้า : <?=date('d/m/Y', strtotime($rsBooked['checkOutDate']));?> 
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php  } else { echo '-'; } ?>
    </div>
</div>
