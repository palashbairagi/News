<script type="text/javascript" src="<?php echo site_url('resources/ckeditor/ckeditor.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('resources/css/jquery-ui.css');?>">

<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-1.12.4.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/contact.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('resources/js/jquery-ui.js');?>"></script>

<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Contacts</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	                <div class="pull-right">
						<a data-toggle="modal" data-target="#add_news" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i>Add New Address</a> 
					</div>
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
                    		<h2>My Address</h2>
                    		<div class="clearfix"></div>
                  		</div>
                  		<div class="x_content">

              			<table class="table table-striped table-hover" id="sortable">
                            <thead>
    						    <tr>
    				    <th>Address</th>
                                    <th>City</th>
                                    <th>Pin Code</th>
                                    <th>State</th>
                                    <th>Phone Number</th>
                                    <th colspan="3">Actions</th>
    						    </tr>
                            </thead>
                            <tbody>
								<?php 
								if(isset($contact) && !empty($contact))
								{
								foreach($contact as $n){ ?>
							    <tr id="row_<?php echo $n['id'];?>">
									<td class="address"><?php echo $n['address']; ?></td>
                                    <td class="city"><?php echo $n['city']; ?></td>
                                    <td class="pin"><?php echo $n['pin_code']; ?></td>
                                    <td class="state"><?php echo $n['state']; ?></td>
                                    <td class="phone"><?php echo $n['phone']; ?></td>
                                    <td width="30">
                                        <a class="edit_news" role="button" data-toggle="modal" href="#edit_news" ng-click="focusInput=true"><i class="fa fa-pencil text-success text" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    </td>
	                                <!--td width="30">
	                                    <a href="<?php echo site_url('admin/delete_contact/'.$n['id']);?>" class="delete_news"><i class="fa fa-times text-danger text" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
	                                </td-->
	                                <td id="id" style="display:none"><?php echo $n['id'];?></td>
                                	<td id="image" style="display:none"><?php echo $n['image'];?></td>
						    	</tr>
								<?php } } else{?>
								<tr>
									<td colspan="6">No address added yet!</td>
								</tr>
							<?php }?>
                            </tbody>
						</table>
	                </div>
	            </div>
	        </div>
	    </div>
	    
	    <div class="row">
              	<div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="x_panel">
                  		<div class="x_title">
                    		<h2>Message</h2>
                    		<div class="clearfix"></div>
                  		</div>
                  		<div class="x_content">

              			<table class="table table-striped table-hover" id="sortable">
                            <thead>
    						    <tr>
    				    <th>From</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th></th>
                                    <th colspan='2'>Actions</th>
    						    </tr>
                            </thead>
                            <tbody>
								<?php 
								if(isset($message) && !empty($message))
								{
								foreach($message as $msg){ ?>
							    <tr id="row_<?php echo $msg['id'];?>">
									<td class="name"><?php echo $msg['name']; ?></td>
                                    <td class="email"><?php echo $msg['email']; ?></td>
                                    <td class="mobile"><?php echo $msg['contact_number']; ?></td>
                                    <td class="message"><?php echo $msg['message']; ?></td>
                                    <?php $date = new DateTime($msg['date_time']);?>
			            <td class="date"><?php echo $date->format('d-m-Y H:i'); ?></td>
                                    <td width="30">
                                    	<?php if($msg['is_read'] == 0){?>
                                        <a class="read_message" role="button" data-toggle="modal" href="<?php echo site_url('admin/update_message_status/'.$msg['id']);?>" ng-click="focusInput=true"><i class="fa fa-envelope text-success text" data-toggle="tooltip" data-placement="top" title="Mark As Read"></i></a>
                                        <?php }else{?>
                                        <i class="fa fa-envelope"></i>
                                        <?}?>
                                    </td>
                                    <td width="30">
                                        <a class="delete_message" role="button" data-toggle="modal" href="<?php echo site_url('admin/delete_message/'.$msg['id']);?>" ng-click="focusInput=true"><i class="fa fa-times text-danger text text-success text" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                    </td>
	                             </tr>
								<?php } } else{?>
								<tr>
									<td colspan="6">No address added yet!</td>
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
<div class="modal fade" id="add_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo base_url();?>admin/add_contact" class="save_form" enctype="multipart/form-data" data-validate="parsley">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Address</label>
                            <div class="col-sm-12">
                                <input type="text" name="address" class="form-control parsley-validated" data-maxlength="100" data-required="true" autocomplete="off">
                                <span><?php echo form_error('address');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">City</label>
                            <div class="col-sm-12">
                                <input type="text" name="city" class="form-control parsley-validated" data-maxlength="50" data-required="true" autocomplete="off">
                                <span><?php echo form_error('city');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Pin Code</label>
                            <div class="col-sm-12">
                                <input type="text" name="pin" class="form-control parsley-validated" data-maxlength="6" data-minlength="6" data-type="number" data-required="true" autocomplete="off">
                                <span><?php echo form_error('pin');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">State</label>
                            <div class="col-sm-12">
                                <input type="text" name="state" class="form-control parsley-validated" data-maxlength="20" data-required="true" autocomplete="off">
                                <span><?php echo form_error('state');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" name="phone" class="form-control parsley-validated" data-maxlength="50" data-required="true" autocomplete="off">
                                <span><?php echo form_error('phone');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
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
    <form method="post" action="<?php echo base_url();?>admin/edit_contact" class="update_form" enctype="multipart/form-data" data-validate="parsley">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <input type="hidden" name="id" class="edit_id">
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Address</label>
                            <div class="col-sm-12">
                                <input type="text" name="address" class="edit_address form-control parsley-validated" data-maxlength="100" data-required="true" autocomplete="off">
                                <span><?php echo form_error('address');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">City</label>
                            <div class="col-sm-12">
                                <input type="text" name="city" class="edit_city form-control parsley-validated" data-maxlength="50" data-required="true" autocomplete="off">
                                <span><?php echo form_error('city');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Pin Code</label>
                            <div class="col-sm-12">
                                <input type="text" name="pin" class="edit_pin form-control parsley-validated" data-maxlength="6" data-minlength="6" data-type="number" data-required="true" autocomplete="off">
                                <span><?php echo form_error('pin');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">State</label>
                            <div class="col-sm-12">
                                <input type="text" name="state" class="edit_state form-control parsley-validated" data-maxlength="20" data-required="true" autocomplete="off">
                                <span><?php echo form_error('state');?></span>
                                <ul>
                                    <li class="formError" style="font-size:12px;display:block;margin-left:-40px;margin-top:6px;margin-bottom:-10px;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" name="phone" class="edit_phone form-control parsley-validated" data-maxlength="50" data-required="true" autocomplete="off">
                                <span><?php echo form_error('phone');?></span>
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