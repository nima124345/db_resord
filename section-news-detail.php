
    <!-- Blog Area Start -->
    <section class="roberto-blog-area section-padding-50-0">
        <div class="container">

        <?php if($_GET['act']=='news-detail'){ ?>
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center   wow fadeInUp" data-wow-delay="100ms">
                   
                        <h2>รายละเอียดข่าว</h2>
 
                    </div>
                </div>
            </div>

            <div class="row">

                <?php
                    $news_id = $_GET['id'];
                    $qnews = "SELECT * FROM tb_news  WHERE news_id=$news_id";
                    $rsn = mysqli_query($Connection, $qnews) or die (mysqli_error($Connection));
                    $rown = mysqli_fetch_assoc($rsn);
                    
                    ?>

                    <div class="col-sm-6">
                        <img src="img/news/<?=$rown['news_img'];?>" width="90%">
                    </div>
                    <div class="col-sm-6">
                       <?=$rown['news_detail'];?>
                       <br> 
                       ว/ด/ป <?=date('d/m/Y', strtotime($rown['news_date']));?>
                </div>
            </div>


            <div class="row" style="margin-top: 100px;">
                    <div class="col-sm-12">
                        <h3>ข่าวประชาสัมพันธ์ทั้งหมด</h3>
                    </div>
            

                <?php
                    $sql_news = "SELECT * FROM tb_news  order by news_id desc";
                    $rsn = mysqli_query($Connection, $sql_news) or die (mysqli_error($Connection));
                    ?>
                    
             <?php   foreach ($rsn as $rsn) {  ?>
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="post-thumbnail">
                        <img src="img/news/<?=$rsn['news_img'];?>" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date"><?=date('d/m/Y', strtotime($rsn['news_date']));?></a>
                            <a href="#" class="post-catagory">ข่าวประชาสัมพันธ์</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title"><?=$rsn['news_head'];?></a>
                        <p><?=$rsn['news_detail'];?></p>
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="btn continue-btn"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>เพิ่มเติม...</a>
                    </div>
                </div>
                <?php }   ?>

            </div>
        <?php  }else{  ?>

            <div class="row mb-3" style="margin-top: 100px;">
                    <div class="col-sm-12">
                        <h3>ข่าวประชาสัมพันธ์ทั้งหมด</h3>
                    </div>


             <?php
                    $sql_news = "SELECT * FROM tb_news  order by news_id desc";
                    $rsn = mysqli_query($Connection, $sql_news) or die (mysqli_error($Connection));
                    ?>
                    
             <?php   foreach ($rsn as $rsn) {  ?>
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="news.php?id=<?=$rsn['news_id'];?>&act=news-detail" class="post-thumbnail">
                        <img src="img/news/<?=$rsn['news_img'];?>" alt=""></a>
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

        <?php }  } ?> 



        </div>
    </section>
    <!-- Blog Area End -->