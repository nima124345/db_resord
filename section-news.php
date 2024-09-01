
    <!-- Blog Area Start -->
    <section class="roberto-blog-area section-padding-100-0" id="news">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <h6>ข่าวสาร ( <a href="news.php?act=all"> ทั้งหมดคลิก </a>) </h6>
                        <h2>ข่าวสารประชาสัมพันธ์</h2>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php
                    $sql_news = "SELECT * FROM tb_news  order by news_id desc limit 3";
                    $rsn = mysqli_query($Connection, $sql_news) or die (mysqli_error($Connection));
                    ?>

             <?php foreach ($rsn as $rsn) {  ?>
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="post-thumbnail"><img src="img/news/<?=$rsn['news_img'];?>" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date"><?=date('d/m/Y', strtotime($rsn['news_date']));?></a>
                            <a href="#" class="post-catagory">ข่าวประชาสัมพันธ์</a>
                        </div>
                        <!-- Post Title -->
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="post-title"><?=$rsn['news_head'];?></a>
                        <p><?=$rsn['news_detail'];?></p>
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>เพิ่มเติม...</a>
                    </div>
                </div>
                 <?php } ?>



            </div>
        </div>
    </section>
    <!-- Blog Area End -->