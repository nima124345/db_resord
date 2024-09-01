<?php
include 'header.php';
//count by booking status
//รอชำระเงิน
$st2 ="SELECT COUNT(*) AS totals2 FROM tb_booking WHERE booking_status = 2";
$rst2 = mysqli_query($Connection, $st2);
$rwst2 = mysqli_fetch_assoc($rst2);

//ชำระเงินแล้ว รอตรวจสอบ
$st3 ="SELECT COUNT(*) AS totals3 FROM tb_booking WHERE booking_status = 3";
$rst3 = mysqli_query($Connection, $st3);
$rwst3= mysqli_fetch_assoc($rst3);

//รอเข้าพัก
$st4 ="SELECT COUNT(*) AS totals4 FROM tb_booking WHERE booking_status = 4";
$rst4 = mysqli_query($Connection, $st4);
$rwst4= mysqli_fetch_assoc($rst4);

//อยู่ระหว่างเช็คอิน
$st5 ="SELECT COUNT(*) AS totals5 FROM tb_booking WHERE booking_status = 5";
$rst5 = mysqli_query($Connection, $st5);
$rwst5= mysqli_fetch_assoc($rst5);

//เช็คเอ้า สำเร็จ
$st1 ="SELECT COUNT(*) AS totals1 FROM tb_booking WHERE booking_status = 1";
$rst1 = mysqli_query($Connection, $st1);
$rwst1= mysqli_fetch_assoc($rst1);

//ยกเลิก
$st0 ="SELECT COUNT(*) AS totals0 FROM tb_booking WHERE booking_status = 0";
$rst0 = mysqli_query($Connection, $st0);
$rwst0= mysqli_fetch_assoc($rst0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- title -->
    <?php include 'web_struc/title.php';?>
    <!-- title -->
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <?php include 'web_struc/css.php'; ?>
    <!-- =======================================================
    * Template Name: Nicebooking
    * Updated: Mar 09 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/nice-booking-bootstrap-booking-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
<style type="text/css">
  @media print{
    #hid{
       display: none; /* ซ่อน  */
    }
  }
</style>
  </head>
  <body>
     <span id="hid">
    <!-- ======= Header ======= -->
    <?php include 'web_struc/header.php'; ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
   
    <?php include 'web_struc/menubar.php'; ?>
    </span>
    <!-- End Sidebar-->
    <!-- จุดเริ่มต้น -->
    <main id="main" class="main">
      <div class="pagetitle" id="hid">
        <h1>
          <font face="TH Sarabun New" size="7">
          ข้อมูลการจอง
          <a href="booking.php" class="btn btn-primary">รายการใหม่ (<?=$rwst2['totals2'];?>)</a> 
          <a href="booking.php?act=paid" class="btn btn-warning">ชำระเงินแล้ว (<?=$rwst3['totals3'];?>)</a>
          <a href="booking.php?act=wait" class="btn btn-success">รอเข้าพัก (<?=$rwst4['totals4'];?>)</a>
          <a href="booking.php?act=chkIN" class="btn btn-info">เช็คอิน (<?=$rwst5['totals5'];?>)</a>
          <a href="booking.php?act=chkOut" class="btn btn-success">เช็คเอ้า (<?=$rwst1['totals1'];?>)</a>
          <a href="booking.php?act=cancle" class="btn btn-danger">ยกเลิก (<?=$rwst0['totals0'];?>)</a>
        </font></h1>
        </div><!-- End Page Title -->
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                   <?php
                $act = (isset($_GET['act']) ? $_GET['act'] : '');
                 if(empty($act)){ ?>
                  <div class="card-title">
                    <!--   <a href="booking.php?act=add"  class="btn btn-primary btn-sm"> 
                      +เพิ่มข้อมูล</a> -->
                  </div>
                <?php } ?>
                  <!-- Table with stripped rows -->
                  <div class="col-lg-12">
                    <?php 
                      if ($act=='paid') {
                        include 'booking_list_paid.php';
                      }else if ($act=='wait') {
                        include 'booking_list_wait.php';
                      }else if ($act=='chkIN') {
                        include 'booking_list_checkIN.php';
                      }else if ($act=='chkOut') {
                        include 'booking_list_checkOut.php';
                      }else if ($act=='cancle') {
                        include 'booking_list_cancel.php';
                      }else if ($act=='view') {
                        include 'booking_view.php';
                      }else if ($act=='view2') {
                        include 'booking_view2.php';
                      }else if ($act=='viewPaid') {
                        include 'booking_view_check_payment.php';
                      }else if ($act=='checkIN') {
                        include 'booking_view_checkIN.php';
                      }else if ($act=='checkOUT') {
                        include 'booking_view_checkOUT.php';
                      }else if ($act=='view3') {
                        include 'booking_view3.php';
                      }else if ($act=='img') {
                        include 'booking_form_img.php';
                      }else if ($act=='delimg') {
                        include 'booking_delete_img.php';
                      }else{
                        include 'booking_list.php';
                      }


                    ?>
                </div>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
      </main><!-- End #main -->
        <!-- ======= Footer ======= -->
        <?php include 'web_struc/footer.php'; ?>
        <!-- End Footer -->
        <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->
        <!-- Vendor JS Files -->
        <?php include 'web_struc/script.php'; ?>
      </body>
    </html>