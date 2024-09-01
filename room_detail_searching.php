<?php 

$room_id = $_GET['id'];
$queryRoom = "SELECT *
FROM tb_room  AS r 
LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE r.room_id=$room_id
GROUP BY r.room_id ";
$rsroom = mysqli_query($Connection, $queryRoom) or die (mysqli_error($Connection));
$rwr = mysqli_fetch_assoc($rsroom);


//room gallery

$sql_img = "SELECT * FROM tb_room_image  WHERE room_id=$room_id ";
$rsimg = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));
$rsimg1 = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));

 ?>

  <style type="text/css">
                input[type="date"]::-webkit-datetime-edit, 
                input[type="date"]::-webkit-inner-spin-button, 
                input[type="date"]::-webkit-clear-button {
                color: #fff;
                position: relative;
                }
                input[type="date"]::-webkit-datetime-edit-year-field{
                position: absolute !important;
                border-left:3px solid #000000;
                padding: 1px;
                color:#000000;
                left: 55px;
                }
                input[type="date"]::-webkit-datetime-edit-month-field{
                position: absolute !important;
                border-left:3px solid #000000;
                padding: 1px;
                color:#000000;
                left: 30px;
                }
                input[type="date"]::-webkit-datetime-edit-day-field{
                position: absolute !important;
                color:#000000;
                padding: 1px;
                left: 6px;
                }
        </style>
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

                                    <!-- <div class="carousel-item">
                                        <img src="img/bg-img/50.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/bg-img/51.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/bg-img/52.jpg" class="d-block w-100" alt="">
                                    </div> -->

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


                                   <!--  <li data-target="#room-thumbnail--slide" data-slide-to="2">
                                        <img src="img/bg-img/50.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="3">
                                        <img src="img/bg-img/51.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="4">
                                        <img src="img/bg-img/52.jpg" class="d-block w-100" alt="">
                                    </li> -->

                                </ol>


                            </div>
                        </div>

                        <!-- Room Features -->
                        <!-- <div class="room-features-area d-flex flex-wrap mb-50">
                            <h6>Size: <span>350-425sqf</span></h6>
                            <h6>Capacity: <span>Max persion 5</span></h6>
                            <h6>Bed: <span>King beds</span></h6>
                            <h6>Services: <span>Wifi, television ...</span></h6>
                        </div> -->

                        <p>
                        	<b>รายละเอียดห้องพัก</b> <br> 
                        	<?=$rwr['room_detail'];?>
                        	<br> 
                        	<b>สิ่งอำนวยความสะดวก </b> <br>
                        	<?=$rwr['room_service'];?>

                       </p>

                        <!-- <ul>
                            <li><i class="fa fa-check"></i> Mauris molestie lectus in irdiet auctor.</li>
                            <li><i class="fa fa-check"></i> Dictum purus at blandit molestie.</li>
                            <li><i class="fa fa-check"></i> Neque non fermentum suscipit.</li>
                            <li><i class="fa fa-check"></i> Donec id dui ac massa malesuada.</li>
                            <li><i class="fa fa-check"></i> In sit amet sapien quis orci maximus.</li>
                            <li><i class="fa fa-check"></i> Vestibulum rutrum diam vel eros tristique.</li>
                        </ul>
 -->
                       <!--  <p>Every time I hail a cab in New York City or wait for one at the airports, I hope I’ll be lucky enough to get one that’s halfway decent and that the driver actually speaks English. I have spent many anxious moments wondering if I ever get to my destination. Or whether I’d get ripped off. Even if all goes well, I can’t say I can remember many rides in New York cabs that were very pleasant. And given how much they cost by now, going with a limo makes ever more sense.</p> -->
                    </div>

                    <!-- Room Service -->
                    <div class="room-service mb-50">
                        <h4>Room Services</h4>

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
                                            <input type="date" class="input-small form-control" id="pick_date" name="checkinDate" placeholder="Check In" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$_GET['checkinDate'];?>">
                                        </div>
                                        <div class="col-6">
                                        	ถึงวันที่ 
                                            <input type="date" class="input-small form-control" id="drop_date" name="checkoutDate"   placeholder="Check Out" required onchange="cal()" min="<?=date('Y-m-d');?>" value="<?=$_GET['checkoutDate'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group mb-30">
                                <label for="guests">Guests</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="adults" id="guests" class="form-control">
                                            <option value="adults">Adults</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select name="children" id="children" class="form-control">
                                            <option value="children">Children</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                           <!--  <div class="form-group mb-50">
                                <div class="slider-range">
                                    <div class="range-price">Max Price: $0 - $3000</div>
                                    <div data-min="0" data-max="3000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="3000" data-label-result="Max Price: ">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                 <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                                <input type="hidden" name="numdays" id="numdays2" name="numdays"/>
                                
                                <button type="submit" name="act"  value="searching" class="btn roberto-btn w-100">ค้นหาห้องว่าง</button>
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

       <?php

//sql ตรวจสอบห้องว่างในช่วงเวลาที่ค้นหา

$ds = $_GET['checkinDate'];
$de = $_GET['checkoutDate'];



if($ds==$de){
    echo "<script type='text/javascript'>";
    echo "alert('ห้ามเลือกวัน check-in และ check-out ตรงกัน !!');";
    echo "window.history.back();";
    echo "</script>";
    exit();
}
$room_id= $_GET['id'];

 
$sql_sRAvl = "
SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
             b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*, r.room_price
            FROM tb_booking b 
            INNER JOIN tb_room r on b.room_id=r.room_id
            INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
            WHERE b.room_id = $room_id
            AND b.booking_status >=3 
            AND
            (b.checkInDate >= CAST( '$ds 14:00:00' AS DATETIME) 
             AND b.checkInDate <= CAST( '$de 12:00:00' AS DATETIME)) 
             OR (b.checkOutDate >= CAST( '$ds 14:00:00' AS DATETIME) 
             AND b.checkOutDate <= CAST( '$de 12:00:00' AS DATETIME))
             AND  b.room_id = $room_id
             AND b.booking_status >=3 
             GROUP BY r.room_id
";
$resultrav = mysqli_query($Connection, $sql_sRAvl) or die (mysqli_error($Connection));

$rowb = mysqli_fetch_assoc($resultrav);
$num = mysqli_num_rows($resultrav);
//echo $num;

//echo $rowb['booking_status'];


       ?>

<?php
if($_GET['numdays'] <= 0){
    echo "<script type='text/javascript'>";
    echo "alert('ห้ามเลือกวัน check-in น้อยกว่า check-out  !!');";
    echo "window.location ='room.php?id=".$room_id."&act=room-detail'";
    echo "</script>";
    exit();
}
?>




        <hr> 
        <h5>สถานะการค้นหาห้องว่างในช่วงวันดังกล่าว</h5>
        วันที่เข้าพัก (Check-in) : <?=date('d/m/Y', strtotime($_GET['checkinDate']));?> <br> 
        วันที่คืนห้องพัก (Check-out) :  <?=date('d/m/Y', strtotime($_GET['checkoutDate']));?> <br> 
        เข้าพัก <?=$_GET['numdays'];?> วัน  รวม <?php echo ($_GET['numdays'] * $rwr['room_price']);?> บาท 

        <br>   
        สถานะ  : 
        <?php if($num == 0){
            echo '<font color="blue"> ว่าง </font>';
        ?>
        <a href="booking_save.php?page=saveBooking&room_id=<?=$_GET['id'];?>&checkInDate=<?=$_GET['checkinDate'];?>&checkOutDate=<?=$_GET['checkoutDate'];?>&totalDate=<?=$_GET['numdays'];?>&booking_amount=<?= ($_GET['numdays'] * $rwr['room_price']);?>&act=saveBooking" class="btn btn-primary">จองห้องพักในวันดังกล่าว คลิก.</a>
          <?php   }else{
                echo '<font color="red"> ไม่ว่าง </font>';
                }
            ?> 



 


        <hr>
        <h5>รายการจอง</h5>
        <?php 
        $dsx = date('Y').'-'.date('m').'-1';
        $dex = date('Y').'-'.date('m').'-30';
        $room_id = $_GET['id'];
        $sqlBooked ="SELECT  r.room_id, r.room_number, b.totalDate, b.booking_amount, 
             b.checkInDate, b.checkOutDate,b.booking_status, r.type_id, u.*, r.room_price
            FROM tb_booking b 
            INNER JOIN tb_room r on b.room_id=r.room_id
            INNER JOIN tb_ac_admin u on b.user_id=u.admin_id
            WHERE b.room_id = $room_id
            AND b.booking_status >=3 
            AND
            (b.checkInDate >= CAST( '$dsx 14:00:00' AS DATETIME) 
             AND b.checkInDate <= CAST( '$dex 12:00:00' AS DATETIME)) 
             OR (b.checkOutDate >= CAST( '$dsx 14:00:00' AS DATETIME) 
             AND b.checkOutDate <= CAST( '$dex 12:00:00' AS DATETIME))
             AND  b.room_id = $room_id
             AND b.booking_status >=3 
             GROUP BY r.room_id";
        $rsBooked = mysqli_query($Connection, $sqlBooked);
        //echo $sqlBooked;
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
                        <td><?=$i++;?></td>
                        <td>
                            เช็คอิน : <?=date('d/m/Y', strtotime($rsBooked['checkInDate']));?> 
                            เช็คเอ้า : <?=date('d/m/Y', strtotime($rsBooked['checkOutDate']));?> 
                        </td>
                </tr>
            <?php } ?>
           
            </tbody>
        </table>
        <?php  }else{  echo '-'; } 
 
        ?>

                    </div>
                </div>