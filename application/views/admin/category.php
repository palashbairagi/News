<script type="text/javascript" src="<?php echo site_url('resources/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/category.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('resources/css/jquery-ui.css');?>">

<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-1.12.4.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-ui.js');?>"></script>

<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>News</h3>
            </div>
            <?php if(isset($category_id) && !empty($category_id)){?>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	                <div class="pull-right">
						<a data-toggle="modal" data-target="#add_news" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i>Add News</a> 
					</div>
                </div>
            </div>
            <?php }?>
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
    				    <th>Title</th>
                                    <?php $show_main_news=1; 
                                    if(!(isset($category_id) && !empty($category_id))){?>
                                    <th>Category</th>
                                    <?php }
                                    elseif($category_id == HEALTH || $category_id == ROJGAR || $category_id == KRISHI || $category_id == EDUCATION || $category_id == VICHAR || $category_id == DHARM || $category_id == SPORTS){
                                    	$show_main_news=0;
                                    }
                                    if($show_main_news){
                                    ?>
                                    <th>Main News</th>
                                    <?php }?>
                                    <th>Secondary News</th>
                                    <th>Popular News</th>
                                    <th colspan="3">Actions</th>
    						    </tr>
                            </thead>
                            <tbody>
								<?php 
								if(isset($news) && !empty($news))
								{
								foreach($news as $n){
								if($n['category_id'] != VIDEO){ ?>
							    <tr id="row_<?php echo $n['id'];?>">
							    <input type="hidden" name="detail_title" class="detail_title" value="<?php echo($n['title']);?>" />
							    <td id="detail_description" name="detail_description" class="detail_description" style="display:none"><?php echo($n['description']);?></td>
							    <input type="hidden" name="detail_url" class="detail_url" value="<?php echo($n['url']);?>"/>
							    <input type="hidden" name="picture" class="picture" value="<?php echo($n['image']);?>"/>
								
										<td id="title"><?php echo mb_trim($n['title'],150); ?></td>
				    <?php if(isset($category_id) && !empty($category_id)){
				    if($show_main_news)
				    {?>
                                    <td id="main_news"><input type="radio" name="main_news" value="<?php echo $n['id'];?>" data-category-id="<?php echo $n['category_id'];?>" class="main_news" <?php if($n['is_main_news'] == 1){echo 'checked';}?>></td>
                                    <?php }?>
                                    <td id="other_news"><input type="checkbox" name="other_news" value="<?php echo $n['id'];?>" data-category-id="<?php echo $n['category_id'];?>" class="other_news" <?php if($n['is_other_news'] == 1){echo 'checked';}?>></td>
                                    <td><?php if($n['is_popular_news'] == 1){ ?><i class="glyphicon glyphicon-ok-sign"></i><?php }?></td>
                                    <?php }else{?>
                                    <td><?php echo $n['category_name'];?></td>
                                    <td><?php if($n['is_main_news'] == 1){ ?><i class="glyphicon glyphicon-ok-sign"></i><?php }?></td>
                                    <td><?php if($n['is_other_news'] == 1){ ?><i class="glyphicon glyphicon-ok-sign"></i><?php }?></td>
                                    <td id="popular_news"><input type="checkbox" name="popular_news" value="<?php echo $n['id'];?>" data-category-id="<?php echo $n['category_id'];?>" class="popular_news" <?php if($n['is_popular_news'] == 1){echo 'checked';}?>></td>
                                    <?php }?>
                                    <td width="30">
	                                    <?php if($n['is_active'] == 0) { ?>
	                                        <a href="<?php echo base_url();?>admin/activate/<?php echo $n['id'];?>" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-ban text-success"></i></a>
	                                    <?php } else { ?>
	                                        <a href="<?php echo base_url();?>admin/deactivate/<?php echo $n['id'];?>" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-ban text-danger"></i></a>
	                                    <?php } ?>
	                                </td>
                                    <td width="30">
                                        <a class="view_news" role="button" data-toggle="modal" href="#view_news" ng-click="focusInput=true"><i class="fa fa-eye text-success text" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                                    </td>
                                    <td width="30">
                                        <a class="edit_news" role="button" data-toggle="modal" href="#edit_news" ng-click="focusInput=true"><i class="fa fa-pencil text-success text" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    </td>
	                                <td width="30">
	                                    <a href="<?php echo site_url('admin/delete_news/'.$n['id']);?>" class="delete_news"><i class="fa fa-times text-danger text" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
	                                </td>
	                                <td id="id" style="display:none"><?php echo $n['id'];?></td>
                                	<td id="image" style="display:none"><?php echo $n['image'];?></td>
						    	</tr>
								<?php } }} else{?>
								<tr>
									<td colspan="6">No news added yet!</td>
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

<!-- Modals -->
<div class="modal fade" id="add_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo base_url();?>admin/add_news" class="save_form" enctype="multipart/form-data" data-validate="parsley">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add News</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="form-group">
                        	<input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                            <label class="col-sm-12 control-label">Title*</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" class="form-control parsley-validated" data-maxlength="250" data-required="true" autocomplete="off">
                                <span><?php echo form_error('title');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Url*</label>
                            <div class="col-sm-12">
                                <input type="text" name="url" class="form-control parsley-validated" data-type="urlstrict" data-maxlength="250" data-required="true" autocomplete="off">
                                <span><?php echo form_error('url');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea  name="description" class="ckeditor" autocomplete="off" onkeydown="return ignoreEnter(event);"/></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" value="<?php echo set_value('image'); ?>" class="save_image filestyle" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline input-s" id="filestyle-0"><div class="bootstrap-filestyle" style="display: inline;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save_news">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="edit_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo base_url();?>admin/edit_news" class="update_form" enctype="multipart/form-data" data-validate="parsley">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit News</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <input type="hidden" name="id" class="edit_id">
                        <div class="form-group">
                            <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                            <label class="col-sm-12 control-label">Title*</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" class="edit_title form-control parsley-validated" autocomplete="off" data-maxlength="250" data-required="true">
                                <span><?php echo form_error('title');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Url*</label>
                            <div class="col-sm-12">
                                <input type="text" name="url" class="edit_url form-control parsley-validated" autocomplete="off" data-type="urlstrict" data-maxlength="250" data-required="true">
                                <span><?php echo form_error('url');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea  name="description" id="description" class="edit_description ckeditor" autocomplete="off" onkeydown="return ignoreEnter(event);" /></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" class="image update_image filestyle" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline input-s" id="filestyle-0">
                                <div class="edit_image bootstrap-filestyle" style="display: inline;"></div>
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
        

<div class="modal fade" id="view_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">View News</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <input type="hidden" name="id" class="view_id">
                        <div class="form-group">
                            <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                            <div class="col-sm-12">
                                <label class="view_title"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="view_url"></div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div style="text-align:center">
                            	<div class="col-sm-12">
                                	<div class="view_image bootstrap-filestyle" style="display: inline;"></div>
                            	</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="view_description"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- End Modals -->
<style>
#title{
    width: 400px;
}
</style>