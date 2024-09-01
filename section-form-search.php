<?php
$sqlRoomType = "SELECT * FROM tb_room";
$rsty = mysqli_query($Connection, $sqlRoomType) or die (mysqli_error($Connection));
?>
<!-- About Us Area Start -->
<section class="roberto-about-area section-padding-100-0" id="booking0">
    <!-- Hotel Search Form Area -->
    <div class="hotel-search-form-area">
        <div class="container-fluid">
            <div class="hotel-search-form">
                <form action="room1.php" method="get"> <!-- เปลี่ยนเป็น room1.php -->
                    <div class="row justify-content-between align-items-end">
                        <div class="col-6 col-md-4 col-lg-4">
                            <label for="checkIn">Check In</label>
                            <input type="date" class="form-control" id="pick_date" name="checkinDate" required onchange="cal()" min="<?=date('Y-m-d');?>">
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <label for="checkOut">Check Out</label>
                            <input type="date" class="form-control" id="drop_date" name="checkoutDate" required onchange="cal()" min="<?=date('Y-m-d');?>">
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                            <input type="hidden" class="form-control" id="numdays2" name="numdays"/>
                            <button type="submit" name="act" class="form-control btn roberto-btn w-100" value="searching">ค้นหาห้องว่าง</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
function GetDays(){
    var dropdt = new Date(document.getElementById("drop_date").value);
    var pickdt = new Date(document.getElementById("pick_date").value);
    return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
}

function cal(){
    var checkinDate = document.getElementById("pick_date").value;
    var checkoutDate = document.getElementById("drop_date").value;

    if (checkinDate && checkoutDate) {
        if (new Date(checkinDate) >= new Date(checkoutDate)) {
            alert("วันที่ Check-in ต้องน้อยกว่าวันที่ Check-out");
            document.getElementById("drop_date").value = ""; // Clear checkout date
            document.getElementById("numdays2").value = ""; // Clear number of days
        } else {
            document.getElementById("numdays2").value = GetDays();
        }
    }
}
</script>
