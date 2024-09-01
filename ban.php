<?php
session_start();
session_destroy();

echo '
<meta charset="utf-8">
  <!-- sweet alert  -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 

  echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "คุณถูกระงับการใช้งาน !!",
                                text: "กรุณาติดต่อผู้ดูแลระบบเพื่อทำการปลดล็อค",
                                type: "warning"
                            }, function() {
                                window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
?>