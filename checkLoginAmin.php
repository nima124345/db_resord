<?php 
session_start();
// echo '<pre>';
// print_r($_POST);
// exit();
//   echo '
// <script src="js/sweetalert2.min.js"></script>
//  <script src="js/sweetalert2-.min.js"></script>
// ';
echo '<style>
body {
  background-image: url("img/bg-img/17.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>';
echo '<body>';
 if(isset($_POST['admin_name']) && isset($_POST['admin_password'])){







        //connection
                  require_once('connection.php');
        //รับค่า user & admin_password
                  $admin_name = $_POST['admin_name'];
                  $admin_password = $_POST['admin_password'];
        //query 
                  $sql="SELECT * FROM tb_ac_admin WHERE admin_name='".$admin_name."' AND admin_password='".$admin_password."' ";
 
                  $result = mysqli_query($Connection,$sql);

                  // echo $sql;
                  // exit();
        
                  if(mysqli_num_rows($result)==1){
 
                      $row = mysqli_fetch_array($result);
 
                      $_SESSION["admin_id"] = $row["admin_id"];
                      $_SESSION["admin_firstname"] = $row["admin_firstname"];
                      $_SESSION["status_id"] = $row["status_id"]; 


                     //print_r($_SESSION);
                     //exit();

                      if($_SESSION["status_id"]=='1'){
                      //query admin role
                            $qrole = "
                              SELECT *
                              FROM tb_ac_admin_role 
                              WHERE admin_id=$row[admin_id]";
                             $rrole = mysqli_query($Connection, $qrole);
                              //$rwrol = mysqli_fetch_assoc($rrole); 
                              $adminRole= array();
                              foreach ($rrole as $rrole) {
                                 //echo $rrole['admin_role']. ' : '.$rrole['admin_status'] . '<hr>';
                                 $adminRole[] = $rrole['admin_role'].':'.$rrole['admin_status'].',';
                                }  
                               //ตัด , ตัวสุดท้ายออก
                              $adminRole = implode(',' ,$adminRole);

                              $result_explode = explode(',', $adminRole);  

                              //print_r($result_explode);

                              @$role0 = $result_explode[0];
                              //$role1 = $result_explode[1];
                              @$role2 = $result_explode[2];

                               $_SESSION["role0"] = $role0; 
                               $_SESSION["role2"] = $role2;


                              //echo $role0;
                              //echo '<hr>';
                             // echo $role1;
                              //echo ',';
                              //echo $role2;

                             //exit();


                              if(isset($role0) && $role0=='1:1' && isset($role2) && $role2=='2:1') {
                                 //echo '...';
                                $_SESSION['admin-member'] = 1;
                                 //echo 'Admin & Staff เลือกเข้าอย่างใด อย่างหนึ่ง';
                                //echo '.';
                                ?>
                            <!-- <script>
                             Swal.fire({
                                    icon: 'sucess',
                                    title: 'สวัสดีคุณ <?=$_SESSION["admin_firstname"];?> ',
                                    text: 'กรุณาเลือกสิทธิ์ที่ต้องการเข้าใช้งานระบบ',
                                    showCancelButton: true,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#FF8C00',
                                    cancelButtonColor: '#00FA9A',
                                    confirmButtonText: '<a href="admin.php">ผู้ดูแลระบบ</a>',
                                    cancelButtonText: '<a href="staff.php">พนักงาน</a>',
                                    allowOutsideClick: false
                                  });
                          </script> -->

                             <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
                              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                              <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
                              <style>
                                .modal-dialog-center {
                                      margin-top: 15%;
                                  }
                              </style>

                              <div class="container">
                                <!-- Modal -->
                                <div class="modal show" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog modal-md modal-dialog-center">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title">สวัสดีคุณ <?=$_SESSION["admin_firstname"];?></h3>
                                      </div>
                                      <div class="modal-body">
                                        <p style="font-size: 20px">กรุณาเลือกสิทธิ์ที่ต้องการเข้าใช้งานระบบ !!</p>
                                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location='admin.php';">ผู้ดูแลระบบ</button>
                                        <button type="button" class="btn btn-success btn-lg btn-block" onclick="window.location='staff.php';">พนักงาน</button>
                                      </div>
                                      <!-- <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-primary" onclick="window.location='admin.php';">ผู้ดูแลระบบ</button>
                                        <button type="button" class="btn btn-success" onclick="window.location='staff.php';">พนักงาน</button>
                                      </div> -->
                                    </div>
                                    
                                  </div>
                                </div>
                                
                              </div>

                           <?php

                    
                                }else if(isset($role0) && $role0=='1:1'){
                                  //echo 'Admin Only';
                                  $_SESSION["role"] = 'admin';
                                  Header("Location: admin/");
                                }else if(isset($role0) && $role0=='1:0' && isset($role2) && $role2=='2:1'){
                                  //echo 'Staff Only';
                                  $_SESSION["role"] = 'staff';
                                  Header("Location: staff/booking.php");
                                }else if(isset($role0) && $role0=='1:1' && isset($role2) && $role2=='2:0'){
                                   //echo 'Admin Only';
                                    $_SESSION["role"] = 'admin';
                                    Header("Location: admin/");
                                }else if(isset($role0) && $role0 == '2:1'){
                                   //echo 'Staff Only 1'; 
                                  $_SESSION["role"] = 'staff';
                                   Header("Location: staff/booking.php");
                                }else if(isset($role0) && $role0 == '1:0'){
                                    //echo 'แอดมิน ถูกระงับ 1'; 
                                   Header("Location: ban.php");
                                }else if(isset($role2) && $role2 == '1:0'){
                                   // echo 'แอดมิน ถูกระงับ 2'; 
                                  Header("Location: ban.php");
                                }else if(isset($role0) && $role0 == '2:0'){
                                    //echo 'พนง. ถูกระงับ'; 
                                  Header("Location: ban.php");
                                }else if(isset($role0) && $role0 == '2:0'){
                                    //echo 'พนง. ถูกระงับ'; 
                                   Header("Location: ban.php");
                                }else{
                                   Header("Location: ban.php");
                                }

                            } //if status 3
                             else if($_SESSION["status_id"]==3){

                              //echo 'go to page member ';
                              $_SESSION["role"] = 'member';
                              Header("Location: member.php");
								 
                             }else if($_SESSION["status_id"]==4){
                              $_SESSION["role"] = 'superAdmin';
                              Header("Location: superAdmin/admin.php");
                             }




                     // exit();

                     //  print_r($_SESSION);    
                     //  // exit();              
 
                     //  if($_SESSION["status_id"]=='1'){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
 
                     //    Header("Location: admin/");
 
                     //  } else if ($_SESSION["status_id"]==2){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                     //     Header("Location: staff/");
 
                     //  }else{
                     //    echo "<script>";
                     //        echo "alert(\" Username หรือ  Password ไม่ถูกต้อง !!  \");"; 
                     //        echo "window.history.back()";
                     //    echo "</script>";
                     //  }
 
                  }else{
                    echo "<script>";
                        echo "alert(\" Username หรือ  Password ไม่ถูกต้อง !! \");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
 
        }

 echo '</body>';
?>