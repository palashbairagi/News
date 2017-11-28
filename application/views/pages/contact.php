<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
            <div class="clearfix"></div>
        <div class="bs-example" data-example-id="glyphicons-accessibility">
            <?php if ($this->session->flashdata('successmsg')) { ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <i><?php echo $this->session->flashdata('successmsg');?></i>
            </div>
            <?php } ?>
            <?php if ($this->session->flashdata('errormsg')) { ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <i><?php echo $this->session->flashdata('errormsg');?></i>
            </div>
            <?php } ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <i><?php echo $this->session->flashdata('successmsg');?></i>
            </div>
            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <i><?php echo $this->session->flashdata('errormsg');?></i>
            </div>
        </div>
        
            	<div class="contact_area">
		            <h2>Contact Us</h2>
		            <?php $contact = get_contact();?>
	                        <h4>Address</h4>
	                        <div><?php echo $contact['address'];?></div>
	                        <div><?php echo $contact['city'];?></div>
	                        <div>Pin - <?php echo $contact['pin_code'];?></div>
	                        <div><?php echo $contact['state'];?></div>
	                        <h4>Phone</h4>
	                        <div><?php echo $contact['phone'];?></div>
	                        
	                      <form form method="post" action="<?php echo base_url();?>contact" enctype="multipart/form-data" class="contact_form" data-validate="parsley">
		              <input type="text" name="name" placeholder="Name*" class="form-control parsley-validated" data-maxlength="50" data-required="true" autocomplete = "off">
		              <span><?php echo form_error('name');?></span>
  
		              <input name="email" class="form-control parsley-validated" type="email" placeholder="Email*" data-maxlength="100" data-type="email" data-required="true" autocomplete = "off">
		              <span><?php echo form_error('email');?></span>
		              <input name="contact_number" class="form-control parsley-validated" type="text" placeholder="Contact Number" data-type="number" data-maxlength="10" data-minlength="10" data-required="true" autocomplete = "off">
		              <span><?php echo form_error('contact_number');?></span>
		              <textarea name="comment" class="form-control parsley-validated" cols="30" rows="10" placeholder="Message*" data-required="true" data-maxlength="480" autocomplete = "off"></textarea>
		              <span><?php echo form_error('comment');?></span>
		              <input type="submit" value="Send Message">
		            </form>
          		</div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4">
            <aside class="right_content">
	        <div class="latest_post">
			<div id="googleMap" style="height:280px;">The Internet connection has been lost.</div>
		</div>
		
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
                
            </aside>
        </div>
    </div>
</section>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCFf-istuK0hZq4kWCP-5nnsfBbGTbLi9U"></script>
<script>var myCenter=new google.maps.LatLng(24.5258683,74.1078027);</script>
<script>

	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:13,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);

</script>


