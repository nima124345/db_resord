<?php
include 'section-header.php';
include 'section-top-header.php';
include 'section-navbar.php';

//member detail
$admin_id = $_SESSION['admin_id'];
$queryM = "SELECT *  FROM tb_ac_admin  WHERE admin_id=$admin_id";
$rsM = mysqli_query($Connection, $queryM); // or die (mysqli_error($Connection));
$rowM = mysqli_fetch_assoc($rsM);
$numrow = mysqli_num_rows($rsM);

//echo $numrow;

//act for show leble 
 $page = (isset($_GET['page']) ? $_GET['page'] : '');
  if ($page == 'profile') {
    $txt = 'ฟอร์มแก้ไขโปรไฟล์';
  }else  if ($page == 'allBooking') {
    $txt = 'ประวัติการจอง';
  }else  if ($page == 'searching') {
    $txt = 'ค้นหาห้องว่าง';
  }else  if ($page == 'saveBooking') {
    $txt = 'บันทึกการจอง';
  }else  if ($page == 'payment') {
    $txt = 'ฟอร์มชำระเงิน';
  }else if($page == 'view'){
    $txt = 'รายละเอียดการจอง';
  }else{
    $txt = 'สวัสดี';
  }
?>


<!-- Rooms Area Start -->
<div class="roberto-rooms-area section-padding-50-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <h4><font face="TH Sarabun New"> <?=$txt;?> คุณ<?=$rowM['admin_firstname']. ' '. $rowM['admin_surname'];?> </font> <hr></h4>
            
            <?php 
            
            if($admin_id == ''){
                echo "<script type='text/javascript'>";
                echo "alert('กรุณา สมัครสมาชิกก่อนทำการจองห้องพัก !!');";
                echo "window.location = 'register.php'; ";
                echo "</script>";
                }
 
                      if($page=='profile') {
                        include 'member_form_edit.php';
                      }else if ($page=='searching') {
                        include 'booking_search.php';
                      }else if($page=='saveBooking'){
                        include 'booking_save.php';
                      }else if($page=='payment'){
                        include 'booking_payment_form.php';
                      }else if($page=='cancelBooking'){
                        include 'booking_cancel.php';
                      }else if($page=='view'){
                        include 'booking_view.php';
                      }else{
                        include 'booking_list.php';
                      }
            ?>
            
            </div>
            
        </div>
    </div>
</div>
<!-- Rooms Area End -->

<?php

include 'section-footer.php';
?>