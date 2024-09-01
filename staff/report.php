<?php
include 'header.php';

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
    * Template Name: NiceAdmin
    * Updated: Mar 09 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
  </head>
  <body>
    <!-- ======= Header ======= -->
    <?php include 'web_struc/header.php'; ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include 'web_struc/menubar.php'; ?>
    <!-- End Sidebar-->
    <!-- จุดเริ่มต้น -->
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>
          <font face="TH Sarabun New" size="6">รายงาน</font>
          <a href="report.php" class="btn btn-success btn-sm">ข้อมูลการจองแยกตามสถานะ</a>
          <a href="report.php?act=booking" class="btn btn-info btn-sm">รายงานการจอง</a>
          <a href="report.php?act=allProfit" class="btn btn-primary btn-sm">รายงานรายได้ทั้งหมด</a>
        </h1>
        </div><!-- End Page Title -->
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                  </div>
                  <!-- Table with stripped rows -->
                  <div class="col-lg-12">
                    <?php 
                     $act = (isset($_GET['act']) ? $_GET['act'] : '');
                     if($act=='booking'){
                         include 'report_all_booking.php';
                    }else if($act=='allProfit'){
                         include 'report_all_profit.php';
                    }else if($act=='profitbyM'){
                         include 'report_all_profit_by_m.php';
                    }else if($act=='profitbyY'){
                         include 'report_all_profit_by_y.php';  
                    }else if($act=='bookingbyM'){
                         include 'report_booking_by_m.php';  
                    }else if($act=='bookingbyY'){
                         include 'report_booking_by_y.php';  
                    }else if($act=='searchByDate'){
                         include 'report_all_profit_by_day.php';
                     }else{
                        include 'report_count_by_status.php';
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