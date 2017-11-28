<script type="text/javascript" src="<?php echo site_url('resources/ckeditor/ckeditor.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('resources/css/jquery-ui.css');?>">

<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-1.12.4.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/rashifal.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-ui.js');?>"></script>

<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>राशिफल</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	                
                </div>
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
            
            <div class="row">
              	<div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="x_panel">
                  		<div class="x_title">
                    		<h2>Listing</h2>
                    		<div class="clearfix"></div>
                  		</div>
                  		<div class="x_content">

              			<table class="table table-striped table-hover" id="sortable">
                            <thead>
    						    <tr>
                                    <th>Name</th>
                                    <th>Description</th>
    								<th>Edit</th>
    						    </tr>
                            </thead>
                            <tbody>
								<?php 
								if(isset($rashifal) && !empty($rashifal))
								{
								foreach($rashifal as $n){ ?>
							    <tr id="row_<?php echo $n['id'];?>">
									<td>
                                        <img class='rashi_img' src="<?php echo site_url('resources/img/template/rashifal/'.$n['picture']);?>">
                                        <label class="title">
                                            <?php echo $n['name']; ?>
                                        </label>
                                    </td>
                                    <td class="description">
                                        <?php echo $n['description']; ?>
                                    </td>    
									<td width="30">
                                        <a class="edit_news" role="button" data-toggle="modal" href="#edit_news" ng-click="focusInput=true"><i class="fa fa-pencil text-success text" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    </td>
	                                <td id="id" style="display:none"><?php echo $n['id'];?></td>
                                	<td id="image" style="display:none"><?php echo $n['image'];?></td>
						    	</tr>
								<?php } } else{?>
								<tr>
									<td colspan="6">No rashi added yet!</td>
								</tr>
							<?php }?>
                            </tbody>
						</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<!-- /page content -->

<!-- Modals -->

<div class="modal fade" id="edit_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo base_url();?>admin/edit_rashifal" class="update_form" enctype="multipart/form-data" data-validate="parsley">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <input type="hidden" name="id" class="edit_id">
                        <div class="form-group">
                            <img class="edit_rashi_img" src="">
                            <label name="title" class="edit_title col-sm-12 control-label"></label>
                        </div>
                         <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="description" class="edit_description form-control parsley-validated" data-maxlength="480" data-required="true" autocomplete="off">
                                <span><?php echo form_error('description');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update_news">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
        
<!-- End Modals -->
<style>
#title{
    width: 400px;
}
</style>