<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('home');?>">Home</a></li>
                        <li class="active"><?php if(isset($category) && !empty($category)){ echo $category['category_name'];}?></li>
                    </ol>
                    <ul class="spost_nav">
                        <?php if(isset($news) && !empty($news)){
                            foreach($news as $n){?>
                        <li>

                            <div class="media wow fadeInDown"> 
                            	<a href="<?php echo site_url($n['category_url'].'/'.$n['url']);?>" class="media-left"> 
                            		<?php if($n['category_id'] == VIDEO){?>
		                                <video style="width:100%">
		                                    <source src="<?php echo site_url('resources/img/news_image/'.$n['id'].'/'.$n['image']);?>" type="video/mp4">
		                                </video>
		                        <?php }else{?>
                            			<img alt="" src="<?php echo site_url('resources/img/news_image/'.$n['id'].'/'.$n['image']);?>"> 
                            		<?php }?>
                            	</a>
                                <div class="media-body"> <a href="<?php echo site_url($n['category_url'].'/'.$n['url']);?>" class="catg_title"> <?php echo $n['title'];?></a> </div>
                            </div>
                        </li>
                        <?php }}?>
                    </ul>
                    <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
                </div>
            </div>
        </div>
        <!--nav class="nav-slit"> 
            <a class="prev" href="#"> <span class="icon-wrap"><i class="fa fa-angle-left"></i></span>
                <div>
                    <h3>City Lights</h3>
                    <img src="../images/post_img1.jpg" alt=""/> 
                </div>
            </a> 
            <a class="next" href="#"> <span class="icon-wrap"><i class="fa fa-angle-right"></i></span>
                <div>
                    <h3>Street Hills</h3>
                    <img src="../images/post_img1.jpg" alt=""/> 
                </div>
            </a> 
        </nav-->
        <div class="col-lg-4 col-md-4 col-sm-4">
            <aside class="right_content">
                <div class="latest_post">
                <h2><span>बड़ी खबरें</span></h2>
                <div class="latest_post_container">
                    <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                    <ul class="latest_postnav">
                        <?php if(isset($popular_news) && !empty($popular_news)){
                        foreach($popular_news as $popular){?>
                        <li>
                            <div class="media"> <a href="<?php echo site_url($popular['category_url'].'/'.$popular['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$popular['id'].'/'.$popular['image']);?>"> </a>
                                <div class="media-body"> <a href="<?php echo site_url($popular['category_url'].'/'.$popular['url']);?>" class="catg_title"> <?php echo $popular['title'];?></a> </div>
                            </div>
                        </li>
                        <?php }}?>
                    </ul>
                    <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                </div>
                <div class="single_sidebar wow fadeInDown">
                    <h2><span>राशिफल</span></h2>
                    <a class="sideAdd" href="<?php echo site_url('horoscope-rashifal');?>"><img src="<?php echo site_url('resources/frontend/images/zodiac-signs.jpg');?>" alt=""></a> 
      		</div>
            </aside>
        </div>
    </div>
</section>