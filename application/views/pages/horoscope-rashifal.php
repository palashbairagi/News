<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><a href="<?php echo site_url('horoscope-rashifal');?>">राशिफल</a></li>    
                    </ol>
                    <div class="single_page_content"> 
              		<table class="table table-striped table-hover" id="sortable">
                            <thead>
    				<tr>
                                    <th></th>
                                    <th></th>
    				</tr>
                            </thead>
                            <tbody>
				<?php 
				if(isset($rashifal) && !empty($rashifal))
				{
				foreach($rashifal as $n){ ?>
			    		<tr>
					<td>
                                        <img class='rashi_img' src="<?php echo site_url('resources/img/template/rashifal/'.$n['picture']);?>">
                                        <label class="title">
                                            <?php echo $n['name']; ?>
                                        </label>
                                    	</td>
                                    	<td class="description">
                                            <?php echo $n['description']; ?>
                                    	</td> 
                                    	</tr> 		
                                    <?php }
                                    }?>						
                               </tbody>
			</table>
	             </div>   
	             </div>   
	             </div>   
	             </div>           
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
            </aside>
        </div>
    </div>
</section>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
