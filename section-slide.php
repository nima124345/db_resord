    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">

            <?php
                $sql_script = "SELECT * FROM tb_banner";
                $rssl = mysqli_query($Connection, $sql_script) or die (mysqli_error($Connection));
                ?>

            <?php  foreach ($rssl as $rssl) {  ?>
            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/banner/<?=$rssl['banner_img'];?>);" data-img-url="img/bg-img/16.jpg">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12" id="booking">
                                <div class="welcome-text text-center">
                                    <h6 data-animation="fadeInLeft" data-delay="200ms">Hotel &amp; Resort</h6>
                                    <h2 data-animation="fadeInLeft" data-delay="500ms"><?=$rssl['banner_title'];?></h2>
                                    <?php if($rssl['banner_link'] !=''){ ?>
                                    <a href="<?=$rssl['banner_link'];?>" class="btn roberto-btn btn-2" data-animation="fadeInLeft" data-delay="800ms">เพิ่มเติมคลิก </a>
                                <?php } ?> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <?php } ?>


           
        </div>
    </section>
    <!-- Welcome Area End -->