<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('home');?>">Home</a></li>
                        <li><a href="<?php echo site_url($news['category_url']);?>"><?php echo $news['category_name'];?></a></li>     
                    </ol>
                    <h1><?php echo $news['title'];?></h1>
                    <div class="post_commentbox">  
                        <span><i class="fa fa-calendar"></i>
                        <?php $date = new DateTime($news['added_on']);
			 echo $date->format('d M Y H:i'); ?></span> 
                        <a href="<?php echo site_url($news['category_url']);?>"><i class="fa fa-tags"></i><?php echo $news['category_name'];?></a> 
                        <div id="news-<?php echo $news["id"]; ?>" class="news_like_block">
                            <input type="hidden" id="likes-<?php echo $news["id"]; ?>" value="<?php echo $news["likes"]; ?>">
                            <input type="hidden" id="unlikes-<?php echo $news["id"]; ?>" value="<?php echo $news["unlikes"]; ?>">
                            <?php
                            $str_like = "fa fa-thumbs-o-up";
                            $str_unlike = "fa fa-thumbs-o-down";
                            if(isset($like_unlike_count) && !empty($like_unlike_count)) {
                                if($like_unlike_count['status'] == LIKE)
                                {
                                    $str_like = "fa fa-thumbs-up";
                                }
                                elseif($like_unlike_count['status'] == UNLIKE)
                                {
                                    $str_unlike = "fa fa-thumbs-down";
                                }
                            }
                            ?>
                            <div class="btn-likes">
                                <button type="button" title="<?php echo 'Like'; ?>" class="<?php echo $str_like;?> like" onClick="addLikes(<?php echo $news["id"]; ?>,'<?php echo 'like'; ?>')" />
                            </div>
                            <span class="label-likes"><?php if(!empty($news["likes"])) { echo $news["likes"] . " Like(s)"; } ?></span>

                            <div class="btn-unlikes">
                                <button type="button" title="<?php echo 'Unlike'; ?>" class="<?php echo $str_unlike;?> unlike" onClick="addUnlikes(<?php echo $news["id"]; ?>,'<?php echo 'unlike'; ?>')" /></div>
                            <span class="label-unlikes"><?php if(!empty($news["unlikes"])) { echo $news["unlikes"] . " Unlike(s)"; } ?></span>
                        </div>
                    </div>
                    <div class="single_page_content"> 
                        <?php if($news['category_id'] == VIDEO){?>
                            <video width="320" height="240" controls>
                                <source src="<?php echo site_url('resources/img/news_image/'.$news['id'].'/'.$news['image']);?>" type="video/mp4">
                            </video>
                        <?php }else{?>
                            <img class="img-center" src="<?php echo site_url('resources/img/news_image/'.$news['id'].'/'.$news['image']);?>" alt="">
                        <?php }?>
                        <?php echo $news['description'];?>
                    </div>
                    <div class="social_link">
                        <ul class="sociallink_nav">
                            <li><a href="javascript:void(0);" class="fb-share"><i class="fa fa-facebook"></i></a><span class="share-count">0</span></li>
                            <li><a href="javascript:void(0);" class="whatsapp" data-link="<?php echo site_url($news['category_url'].'/'.$news['url']);?>" data-link="<?php echo $news['title'];?>"><i class="fa fa-whatsapp"></i></a><span class="share-count">0</span></li>
                            <li><a href="https://plus.google.com/share?url=<?php echo site_url($news['category_url'].'/'.$news['url']);?>" target="_blank"><i class="fa fa-google-plus"></i></a><span class="share-count">0</span></li>
                        </ul>
                    </div>
                    <div class="related_post">
                        <h2>अन्य खबरे</h2>
                        <ul class="spost_nav wow fadeInDown animated">
                            <?php if(isset($related_news) && !empty($related_news)){
                            foreach($related_news as $related_n){?>
                            <li>
                                <div class="media"> 
                                	<a href="<?php echo site_url($related_n['category_url'].'/'.$related_n['url']);?>" class="media-left"> 
                                		<?php if($news['category_id'] == VIDEO){?>
                                        	<video style="width: 100%;">
                                            		<source src="<?php echo site_url('resources/img/news_image/'.$related_n['id'].'/'.$related_n['image']);?>" type="video/mp4">
                                        	</video>
                                    		<?php }else{?>
                                    		<img alt="" src="<?php echo site_url('resources/img/news_image/'.$related_n['id'].'/'.$related_n['image']);?>">
                                    		<?php } ?> 
                                	</a>
                                    <div class="media-body"> <a href="<?php echo site_url($related_n['category_url'].'/'.$related_n['url']);?>" class="catg_title"> <?php echo $related_n['title'];?></a> </div>
                                </div>
                            </li>
                            <?php }}?>
                        </ul>
                    </div>

                    <div class="related_post">
                        <h2>Comments</h2>
                        <div class="comment_block">
                            <div class="validation_errors"></div>
                            <form id="comment_form" action="javascript:void(0);" class="comment_form" data-validate="parsley">
                                <input type="hidden" name="news_id" class="news_id" value="<?php echo $news['id'];?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Name<span class="required">*</span></label><input type="text" name="name" class="name form-control  parsley-validated" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Email<span class="required">*</span></label><input type="text" name="email" class="email form-control  parsley-validated" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Mobile Number<span class="required">*</span></label><input type="text" name="mobile_number" class="mobile_number form-control  parsley-validated" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Comment<span class="required">*</span></label><textarea name="comment" class="comment form-control  parsley-validated" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="submit" class="add_comment" value="Send">
                                    </div>
                                </div>                            
                            </form>
                            <div class="success_msg"></div>
                            <div class="loader">
                                <img src="<?php echo site_url('resources/frontend/images/LoaderIcon.gif');?>">
                            </div>
                        </div>
                        <?php $this->load->view('pages/comments',$comments);?>
                    </div>

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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1818465341703746',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script>
$('.fb-share').click(function()
{
    FB.ui(
    {
        method: 'share',
        name: 'Facebook Dialogs',
        href: '<?php echo site_url($news['category_url'].'/'.$news['url']);?>',
        picture: '<?php echo site_url('resources/img/news_image/'.$news['id'].'/'.$news['image']);?>',
        caption: 'www.vikasmaan.com',
        description: 'विकास मान'
    },
    function(response) {
        if (response && !response.error_message) {
            alert('Post was shared.');
        } else {
                alert('Post was not shared.');
        }
    }
    );
});

$(document).ready(function() {

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },

    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },

    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },

    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },

    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },

    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

    $(document).on("click", '.whatsapp', function() {
        if( isMobile.any() ) {

            var text = '<?php echo site_url('resources/img/news_image/'.$news['id'].'/'.$news['image']);?>';//$(this).attr("data-text");

            var url = '<?php echo site_url($news['category_url'].'/'.$news['url']);?>'; /*$(this).attr("data-link");*/

            var message = encodeURIComponent(url);

            var whatsapp_url = "whatsapp://send?text=" + message;

            window.location.href = whatsapp_url;

        } else {

            alert("Please share this article in mobile device");

        }
    });
});
</script>