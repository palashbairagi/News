<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Comments</h3>
            </div>
        </div>

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
        </div>
            
            <div class="row">
              	<div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="x_panel">
                  		<div class="x_title">
                    		<h2>Listing</h2>
                    		<div class="clearfix"></div>
                  		</div>
                  		<div class="x_content">

              			<table class="table table-striped table-hover">
                            <thead>
    						    <tr>
    				    <th>Date</th>	    
    				    <th>Name</th>
    				    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>News</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Actions</th>
    						    </tr>
                            </thead>
                            <tbody>
								<?php 
								if(isset($comments) && !empty($comments))
								{
								foreach($comments as $comment){ ?>
							    <tr>
				    <?php $date = new DateTime($comment['added_on']);?>
				    <td><?php echo $date->format('d-M H:i'); ?></td>
				    <td><?php echo $comment['name']; ?></td>
				    <td><?php echo $comment['email']; ?></td>
                                    <td><?php echo $comment['mobile_number']; ?></td>
                                    <td><?php echo $comment['news'];?></td>
                                    <td><?php echo $comment['comment']; ?></td>
                                    
                                    <?php
                                    	$is_pending = $comment['is_pending'];
                                    	$status = "";
                                    	if($is_pending == '0')
                                    	{	
                                    		$is_approved = $comment['is_approved'];
                                    		if($is_approved == '1')
                                    		{
                                    			$status = "Approved";
                                    		}
                                    		else
                                    		{
                                    			$status = "Rejected";
                                    		}
                                    	}
                                    	else
                                    	{
                                    		$status = "Pending";
                                    	}
                                    ?>
                                    
                                    <td><?php echo $status; ?></td>
                                    <td width="30">
	                                    <?php if($status != 'Approved') { ?>
	                                        <a href="<?php echo base_url();?>admin/approved_comment/<?php echo $comment['id'];?>" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-ban text-success"></i></a>
	                                    <?php } if($status != 'Rejected') { ?>
	                                        <a href="<?php echo base_url();?>admin/reject_comment/<?php echo $comment['id'];?>" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-ban text-danger"></i></a>
	                                    <?php } ?>
	                              
	                                    <a href="<?php echo site_url('admin/delete_comment/'.$comment['id']);?>" class="delete_news"><i class="fa fa-times text-danger text" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
	                               </td>
						    	</tr>
								<?php } } else{?>
								<tr>
									<td colspan="6">No comments added yet!</td>
								</tr>
							<?php }?>
                            </tbody>
						</table>
	                </div>
                    <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<!-- /page content -->

<style>
#title{
    width: 400px;
}
</style>