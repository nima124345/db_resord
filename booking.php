<?php 
    include 'section-header.php';
    include 'section-top-header.php';
    include 'section-navbar.php';
    //include 'section-slide.php';
    //include 'section-form-search.php';
    //include 'section-about.php';
    //include 'section-room-area.php';
   echo $checkinDate = isset($_GET['checkinDate']) ? $_GET['checkinDate'] : '';
  echo  $checkoutDate = isset($_GET['checkoutDate']) ? $_GET['checkoutDate'] : '';

 $act = (isset($_GET['act']) ? $_GET['act'] : '');

if($act=='room-detail'){

$room_id = $_GET['id'];
$queryRoom = "SELECT *
FROM tb_room  AS r 
#LEFT JOIN tb_room_type AS t ON r.type_id=t.type_id
WHERE r.room_id=$room_id
GROUP BY r.room_id ";
$rsroom = mysqli_query($Connection, $queryRoom) or die (mysqli_error($Connection));
$rwr = mysqli_fetch_assoc($rsroom);


//room gallery

$sql_img = "SELECT * FROM tb_room_image  WHERE room_id=$room_id ";
$rsimg = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));
$rsimg1 = mysqli_query($Connection, $sql_img) or die (mysqli_error($Connection));



   if(mysqli_num_rows($rsroom)==0){
   echo "<script>window.location = 'index.php';</script>";
}

                               
?>


<!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcrumb-content d-flex align-items-center justify-content-between pb-5">
                        <h2 class="room-title"><?=$rwr['room_number'];?></h2>
                        <h2 class="room-price"> <?=$rwr['room_price'];?> <span>/ต่อคืน<?php echo $checkinDate ?></span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


       <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <?php 
               

                if($act=='searching'){
                    include 'room_detail_searching.php';
                }else if($act=='room-detail'){
                     include 'room_detail.php';
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Rooms Area End -->
    <!-- Breadcrumb Area End -->
    <?php 
    include 'section-news.php';
    include 'section-footer.php';
 ?>



