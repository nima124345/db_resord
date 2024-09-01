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
    * Template Name: Nicestatus
    * Updated: Mar 09 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/nice-status-bootstrap-status-html-template/
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
        <h1><font face="TH Sarabun New" size="7">จัดการสถานะ-สิทธิ์ผู้ใช้งาน</font></h1>
        </div><!-- End Page Title -->
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <?php
                $act = (isset($_GET['act']) ? $_GET['act'] : '');
                 if(empty($act)){ ?>
                  <div class="card-title"><font face="TH Sarabun New" size="5">ตารางข้อมูลสถานะ</font>
                      <a href="status.php?act=add"  class="btn btn-primary btn-sm"> 
                      +เพิ่มข้อมูล</a>
                  </div>
                <?php } ?>
                  <!-- Table with stripped rows -->
                  <div class="col-lg-7">
                    <?php 
                      if ($act=='add') {
                        include 'status_form_add.php';
                      }else if ($act=='edit') {
                        include 'status_form_edit.php';
                      }else if ($act=='del') {
                        include 'status_delete.php';
                      }else{
                        include 'status_list.php';
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