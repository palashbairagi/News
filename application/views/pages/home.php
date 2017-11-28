<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                <?php if(isset($popular_news) && !empty($popular_news)){
                    foreach($popular_news as $popular){?>
                <div class="single_iteam"> <a href="<?php echo site_url($popular['category_url'].'/'.$popular['url']);?>"> <img src="<?php echo site_url('resources/img/news_image/'.$popular['id'].'/'.$popular['image']);?>" alt=""></a>
                    <div class="slider_article">
                        <h2><a class="slider_tittle" href="<?php echo site_url($popular['category_url'].'/'.$popular['url']);?>"><?php echo $popular['title'];?></a></h2>
                    </div>
                </div>
                <?php }}?>
                
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
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
            </div>
        </div>
    </div>
</section>
<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                
                <div class="fashion_technology_area">
                    <div class="fashion">
                        <div class="single_post_content">
                            <h2><span>प्रदेश</span></h2>
                            <ul class="business_catgnav wow fadeInDown">
                            	<?php if(isset($news[STATE]) && !empty($news[STATE])){
                                foreach($news[STATE] as $state){
                                if($state['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig"> <a href="<?php echo site_url('rajasthan-news/'.$state['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$state['id'].'/'.$state['image']);?>"> <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('rajasthan-news/'.$state['url']);?>"><?php echo $state['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}}?>
                            </ul>
                            <ul class="spost_nav">
                                <?php if(isset($news[STATE]) && !empty($news[STATE])){
                                foreach($news[STATE] as $state){
                                if($state['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('rajasthan-news/'.$state['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$state['id'].'/'.$state['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('rajasthan-news/'.$state['url']);?>" class="catg_title"> <?php echo $state['title'];?></a> </div>
                                    </div>
                                </li>
                                <?php }}}?>
                            </ul>
                        </div>
                    </div>
                    <div class="technology">
                        <div class="single_post_content">
                            <h2><span>देश</span></h2>
                            <ul class="business_catgnav">
                                <?php if(isset($news[COUNTRY]) && !empty($news[COUNTRY])){
                                foreach($news[COUNTRY] as $country){
                                if($country['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig wow fadeInDown"> <a href="<?php echo site_url('india-news/'.$country['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$country['id'].'/'.$country['image']);?>"> <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('india-news/'.$country['url']);?>">
                                        <?php echo $country['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}} ?>
                            </ul>
                            <ul class="spost_nav"> 
                                <?php if(isset($news[COUNTRY]) && !empty($news[COUNTRY])){
                                foreach($news[COUNTRY] as $country){
                                if($country['is_other_news'])
                                {
                                ?>
                                    <li>
                                        <div class="media wow fadeInDown"> <a href="<?php echo site_url('india-news/'.$country['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$country['id'].'/'.$country['image']);?>"> </a>
                                            <div class="media-body"> <a href="<?php echo site_url('india-news/'.$country['url']);?>" class="catg_title"> <?php echo $country['title'];?></a> </div>
                                        </div>
                                    </li>
                                <?php }}} ?>
                            </ul>
                        </div>
                    </div>
                </div>
                    
                <div class="single_post_content">
                <h2><span>विदेश</span></h2>
                    <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                        <?php if(isset($news[WORLD]) && !empty($news[WORLD])){
                                foreach($news[WORLD] as $world){
                                if($world['is_main_news'])
                                {
                                ?>
                            <li>
                                <figure class="bsbig_fig"> <a href="<?php echo site_url('world-news/'.$world['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$world['id'].'/'.$world['image']);?>"> <span class="overlay"></span> </a>
                                    <figcaption> <a href="<?php echo site_url('world-news/'.$world['url']);?>">
                                    <?php echo $world['title'];?></a> </figcaption>
                                </figure>
                            </li>
                        <?php }}}?>
                        </ul>
                    </div>
                    <div class="single_post_content_right">
                        <ul class="spost_nav">
                         <?php if(isset($news[WORLD]) && !empty($news[WORLD])){
                                foreach($news[WORLD] as $world){
                                if($world['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('world-news/'.$world['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$world['id'].'/'.$world['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('world-news/'.$world['url']);?>" class="catg_title"> <?php echo $world['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}}?> 
                        </ul>
                    </div>
                </div>
                
                <div class="fashion_technology_area">
                    <div class="fashion">
                        <div class="single_post_content">
                            <h2><span>शहर</span></h2>
                            <ul class="business_catgnav wow fadeInDown">
                                <?php if(isset($news[CITY]) && !empty($news[CITY])){
                                foreach($news[CITY] as $city){
                                if($city['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig"> <a href="<?php echo site_url('bhilwara-news/'.$city['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$city['id'].'/'.$city['image']);?>"> 
                                        <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('bhilwara-news/'.$city['url']);?>">
                                        <?php echo $city['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}} ?>
                            </ul>
                            <ul class="spost_nav">    
                                <?php if(isset($news[CITY]) && !empty($news[CITY])){
                                foreach($news[CITY] as $city){
                                if($city['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('bhilwara-news/'.$city['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$city['id'].'/'.$city['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('bhilwara-news/'.$city['url']);?>" class="catg_title"> <?php echo $city['title'];?></a> </div>
                                    </div>
                                </li>
                                <?php }}} ?>
                            </ul>
                        </div>
                    </div>
                    <div class="technology">
                        <div class="single_post_content">
                            <h2><span>बिज़नेस</span></h2>
                            <ul class="business_catgnav">
                                <?php if(isset($news[BUSINESS]) && !empty($news[BUSINESS])){
                                foreach($news[BUSINESS] as $business){
                                if($business['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig wow fadeInDown"> <a href="<?php echo site_url('business-news/'.$business['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$business['id'].'/'.$business['image']);?>"> <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('business-news/'.$business['url']);?>"> <?php echo $business['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}} ?>
                            </ul>
                            <ul class="spost_nav">
                                <?php if(isset($news[BUSINESS]) && !empty($news[BUSINESS])){
                                foreach($news[BUSINESS] as $business){
                                if($business['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('business-news/'.$business['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$business['id'].'/'.$business['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('business-news/'.$business['url']);?>" class="catg_title"> <?php echo $business['title'];?></a> </div>
                                    </div>
                                </li>
                                <?php }}} ?>
                            </ul>
                        </div>
                    </div>
                </div>
                    
                <div class="single_post_content">
                <h2><span>टेक्सटाइल</span></h2>
                    <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                            <?php if(isset($news[TEXTILE]) && !empty($news[TEXTILE])){
                                foreach($news[TEXTILE] as $textile){
                                if($textile['is_main_news'])
                                {
                                ?>
                             <li>
                                <figure class="bsbig_fig"> <a href="<?php echo site_url('business-textile-news/'.$textile['url']);?>" class="featured_img"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$textile['id'].'/'.$textile['image']);?>"> 
                                    <span class="overlay"></span> </a>
                                    <figcaption> <a href="<?php echo site_url('business-textile-news/'.$textile['url']);?>"> <?php echo $textile['title'];?> </a> </figcaption>
                                </figure>
                            </li>
                            <?php }}} ?>
                        </ul>
                    </div>
                    <div class="single_post_content_right">
                        <ul class="spost_nav">
                            <?php if(isset($news[TEXTILE]) && !empty($news[TEXTILE])){
                                foreach($news[TEXTILE] as $textile){
                                if($textile['is_other_news'])
                                {
                                ?>
                            <li>
                                <div class="media wow fadeInDown"> <a href="<?php echo site_url('business-textile-news/'.$textile['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$textile['id'].'/'.$textile['image']);?>"> </a>
                                    <div class="media-body"> <a href="<?php echo site_url('business-textile-news/'.$textile['url']);?>" class="catg_title"> <?php echo $textile['title'];?></a> </div>
                                </div>
                            </li>
                            <?php }}} ?>
                        </ul>
                    </div>
                </div>
                
                <div class="fashion_technology_area">
                    <div class="fashion">
                        <div class="single_post_content">
                            <h2><span>मनोरंजन</span></h2>
                            <ul class="business_catgnav wow fadeInDown">
                                <?php if(isset($news[ENTERTAINMENT]) && !empty($news[ENTERTAINMENT])){
                                foreach($news[ENTERTAINMENT] as $entertainment){
                                if($entertainment['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig"> <a href="<?php echo site_url('entertainment-news/'.$entertainment['url']);?>" class="featured_img"> 
                                        <img alt="" src="<?php echo site_url('resources/img/news_image/'.$entertainment['id'].'/'.$entertainment['image']);?>"> 
                                        <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('entertainment-news/'.$entertainment['url']);?>"> <?php echo $entertainment['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}}?>
                            </ul>
                            <ul class="spost_nav">
                                <?php if(isset($news[ENTERTAINMENT]) && !empty($news[ENTERTAINMENT])){
                                foreach($news[ENTERTAINMENT] as $entertainment){
                                if($entertainment['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('entertainment-news/'.$entertainment['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$entertainment['id'].'/'.$entertainment['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('entertainment-news/'.$entertainment['url']);?>" class="catg_title"> <?php echo $entertainment['title'];?></a> </div>
                                    </div>
                                </li>
                                <?php }}}?>
                            </ul>
                        </div>
                    </div>
                    <div class="technology">
                        <div class="single_post_content">
                            <h2><span>टेक्नोलॉजी</span></h2>
                            <ul class="business_catgnav">
                                <?php if(isset($news[TECHNOLOGY]) && !empty($news[TECHNOLOGY])){
                                foreach($news[TECHNOLOGY] as $technology){
                                if($technology['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig wow fadeInDown"> <a href="<?php echo site_url('technology-news/'.$technology['url']);?>" class="featured_img"> <img alt="" src=""<?php echo site_url('resources/img/news_image/'.$technology['id'].'/'.$technology['image']);?>""> <span class="overlay"></span> </a>
                                        <figcaption> <a href="<?php echo site_url('technology-news/'.$technology['url']);?>"><?php echo $technology['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                                <?php }}} ?>
                            </ul>
                            <ul class="spost_nav">
                                <?php if(isset($news[TECHNOLOGY]) && !empty($news[TECHNOLOGY])){
                                foreach($news[TECHNOLOGY] as $technology){
                                if($technology['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('technology-news/'.$technology['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$technology['id'].'/'.$technology['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('technology-news/'.$technology['url']);?>" class="catg_title"> <?php echo $technology['title'];?></a> </div>
                                    </div>
                                </li>
                                <?php }}} ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="single_post_content">
                    <h2><span>विडियो</span></h2>
                    <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                           <?php if(isset($news[VIDEO]) && !empty($news[VIDEO])){
                                foreach($news[VIDEO] as $video){
                                if($video['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig wow fadeInDown"> 
                                    <video controls style="width:100%;">
                                    	<source src="<?php echo site_url('resources/img/news_image/'.$video['id'].'/'.$video['image']);?>" type="video/mp4">
                                    </video>
                                    <figcaption> <a href="<?php echo site_url('video-news/'.$video['url']);?>"><?php echo $video['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                        <?php }}} ?>
                    </ul>
                    </div>
                    <div class="single_post_content_right">
                        <ul class="spost_nav">
                          <?php if(isset($news[VIDEO]) && !empty($news[VIDEO])){
                                foreach($news[VIDEO] as $video){
                                if($video['is_main_news'])
                                {
                                ?>
                                <li>
                                    <figure class="bsbig_fig wow fadeInDown"> 
                                    <video controls style="width:100%;">
                                    	<source src="<?php echo site_url('resources/img/news_image/'.$video['id'].'/'.$video['image']);?>" type="video/mp4">
                                    </video>
                                    <figcaption> <a href="<?php echo site_url('video-news/'.$video['url']);?>"><?php echo $video['title'];?></a> </figcaption>
                                    </figure>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <aside class="right_content">
                <div class="single_sidebar">
                    <h2><span>खेल</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[SPORTS]) && !empty($news[SPORTS])){
                                foreach($news[SPORTS] as $sports){
                                if($sports['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('sports-news/'.$sports['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$sports['id'].'/'.$sports['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('sports-news/'.$sports['url']);?>" class="catg_title"> <?php echo $sports['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>

                <div class="single_sidebar">
                    <h2><span>धर्म</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[DHARM]) && !empty($news[DHARM])){
                                foreach($news[DHARM] as $dharm){
                                if($dharm['is_other_news'])
                                {
                                ?><li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('dharm-news/'.$dharm['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$dharm['id'].'/'.$dharm['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('dharm-news/'.$dharm['url']);?>" class="catg_title"> <?php echo $dharm['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                
                <div class="single_sidebar">
                    <h2><span>एजुकेशन</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[EDUCATION]) && !empty($news[EDUCATION])){
                                foreach($news[EDUCATION] as $education){
                                if($education['is_other_news'])
                                {
                                ?><li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('education-news/'.$education['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$education['id'].'/'.$education['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('education-news/'.$education['url']);?>" class="catg_title"> <?php echo $education['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                 <div class="single_sidebar">
                    <h2><span>कृषि</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[KRISHI]) && !empty($news[KRISHI])){
                                foreach($news[KRISHI] as $krishi){
                                if($krishi['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('krishi-news/'.$krishi['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$krishi['id'].'/'.$krishi['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('krishi-news/'.$krishi['url']);?>" class="catg_title"> <?php echo $krishi['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                <div class="single_sidebar">
                    <h2><span>रोजगार</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[ROJGAR]) && !empty($news[ROJGAR])){
                                foreach($news[ROJGAR] as $rojgar){
                                if($rojgar['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('rojgar-news/'.$rojgar['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$rojgar['id'].'/'.$rojgar['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('rojgar-news/'.$rojgar['url']);?>" class="catg_title"> <?php echo $rojgar['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                 <div class="single_sidebar">
                    <h2><span>स्वास्थ्य</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[HEALTH]) && !empty($news[HEALTH])){
                                foreach($news[HEALTH] as $health){
                                if($health['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('health-news/'.$health['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$health['id'].'/'.$health['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('health-news/'.$health['url']);?>" class="catg_title"> <?php echo $health['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                <div class="single_sidebar">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">News</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="category">
                            <ul>
                                <li class="cat-item"><a href="<?php echo site_url('world-news');?>">International</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('india-news');?>">National</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('rajasthan-news');?>">Rajasthan</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('bhilwara-news');?>">Bhilwara</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('business-news');?>">Business</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('business-textile-news');?>">Textile</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('editorial-vichar');?>">Editorial</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('technology-news');?>">Technology</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('sports-news');?>">Sports</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('entertainment-news');?>">Entertainment</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('rojgar-news');?>">Rojgar</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('krishi-news');?>">Krishi</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('education-news');?>">Education</a></li>
                                <li class="cat-item"><a href="<?php echo site_url('health-news');?>">Health</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>

                <div class="single_sidebar wow fadeInDown">
                    <h2><span>राशिफल</span></h2>
                    <a class="sideAdd" href="<?php echo site_url('horoscope-rashifal');?>"><img src="<?php echo site_url('resources/frontend/images/zodiac-signs.jpg');?>" alt=""></a> 
                </div>

                <div class="single_sidebar">
                    <h2><span>विचार</span></h2>
                    <ul class="spost_nav">
                        <?php if(isset($news[VICHAR]) && !empty($news[VICHAR])){
                                foreach($news[VICHAR] as $vichar){
                                if($technology['is_other_news'])
                                {
                                ?>
                                <li>
                                    <div class="media wow fadeInDown"> <a href="<?php echo site_url('editorial-vichar/'.$vichar['url']);?>" class="media-left"> <img alt="" src="<?php echo site_url('resources/img/news_image/'.$vichar['id'].'/'.$vichar['image']);?>"> </a>
                                        <div class="media-body"> <a href="<?php echo site_url('editorial-vichar/'.$vichar['url']);?>" class="catg_title"> <?php echo $vichar['title'];?></a> </div>
                                    </div>
                                </li>
                        <?php }}} ?>
                    </ul>
                </div>
                
            </aside>
        </div>
    </div>
</section>
  