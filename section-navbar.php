<?php 
$queryRt="SELECT * FROM tb_room_type";
$rsRt = mysqli_query($Connection, $queryRt);

?>
<!--Main Header Start -->
<div class="main-header-area">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Classy Menu -->
            <nav class="classy-navbar justify-content-between" id="robertoNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.html"><img src="./img/core-img/logo.png" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- Menu Close Button -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul id="nav">
                            <li class="active"><a href="index.php">หน้าหลัก</a></li>
                            <li><a href="index.php#about">เกี่ยวกับ</a></li>
                            <li><a href="index.php#rooms">ห้องพัก</a></li>
                          <!--   <li><a href="./about.html">About Us</a></li> -->

                            <li><a href="#">ประเภทห้อง</a>
                            <ul class="dropdown">
                                 <li><a href="rooms.php">- ห้องพักทั้งหมด</a></li>
                                <?php foreach ($rsRt as $rsRt) { ?>
                                <li><a href="type.php?tid=<?=$rsRt['type_id'];?>&act=list-room-by-type&name=<?=$rsRt['type_name'];?>">- <?=$rsRt['type_name'];?></a></li>
                            <?php } ?>

                               <!--  <li><a href="./room.html">- Rooms</a></li>
                                <li><a href="./single-room.html">- Single Rooms</a></li>
                                <li><a href="./about.html">- About Us</a></li>
                                <li><a href="./blog.html">- Blog</a></li>
                                <li><a href="./single-blog.html">- Single Blog</a></li>
                                <li><a href="./contact.html">- Contact</a></li> -->
                               <!--  <li><a href="#">- Dropdown</a>
                                <ul class="dropdown">
                                    <li><a href="#">- Dropdown Item</a></li>
                                    <li><a href="#">- Dropdown Item</a></li>
                                    <li><a href="#">- Dropdown Item</a></li>
                                    <li><a href="#">- Dropdown Item</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <li><a href="index.php#news">ข่าวสาร</a></li>
                    <?php if(!empty($_SESSION['admin_id'])){ ?>
                        <!--  <li><a href="member.php">สวัสดีคุณ <?//=$_SESSION['admin_firstname'];?></a></li> -->

                         <li><a href="#">สวัสดีคุณ <?=$_SESSION['admin_firstname'];?></a>  

                           <ul class="dropdown">
                                <li><a href="member.php?page=allBooking">-ประวัติการจอง</a></li>
                                <li><a href="member.php?page=profile">-แก้ไขโปรไฟล์</a></li>
                                <li><a href="logout.php">-ออกจากระบบ</a></li>
                            </li>
                        </ul>  
                    <?php }else{ ?>
                        <li><a href="register.php">สมัครสมาชิก</a></li>
                        <li><a href="page-login.php">เข้าสู่ระบบ</a></li>
                    <?php } ?>
                </ul>
                <!-- Search -->
             <!--    <div class="search-btn ml-4">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div> -->
                <!-- Book Now -->
                <div class="book-now-btn ml-3 ml-lg-5">
                    <a href="index.php#booking">Book Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- Nav End -->
        </div>
    </nav>
</div>
</div>
</div>
</header>
<!-- Header Area End