<div class="right_col" role="main">
  	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profile</h3>
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
                        <h2>Username</h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content">
                           <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <label class="col-sm-3 control-label">
                                     <?php echo $admin['username'];?>
                                </label>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Update Name</h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content">
                        <form method="post" action="<?php echo base_url();?>admin/updateProfile" class="update_form" enctype="multipart/form-data" data-validate="parsley">
                        <input type="hidden" name="action_name" value="updateAdminName">
                           <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-3">
                                    <input type="text" name="admin_name" value="<?php if($this->input->post('admin_name')!=''){ echo $this->input->post('admin_name');}else{echo $admin['name'];} ?>" class="form-control parsley-validated picture" data-required="true">
                                    <?php echo form_error('admin_name');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary Update">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              		<div class="x_title">
                		<h2>Update Profile Picture</h2>
                		<div class="clearfix"></div>
              		</div>
              		
                    <div class="x_content">
                        <form method="post" action="<?php echo base_url();?>admin/updateProfile" class="update_form" enctype="multipart/form-data" data-validate="parsley">
                        <input type="hidden" name="action_name" value="updateProfilePicture">
                           <div class="form-group">
                                <label class="col-sm-2 control-label">Select Picture</label>
                                <div class="col-sm-3">
                                    <input type="file" name="picture" value="<?php echo $this->input->post('picture'); ?>" class="form-control parsley-validated picture" data-required="true">
                                    <?php echo form_error('picture');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary Update">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Change Password</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="post" action="<?php echo base_url();?>admin/updateProfile" class="save_form" enctype="multipart/form-data" data-validate="parsley">
                        <input type="hidden" name="action_name" value="changePassword">
                           <div class="form-group">
                                <label class="col-md-4 control-label">New Password*</label>
                                <div class="col-md-6">
                                    <input type="password" placeholder="New Password" name="new_password" value="<?php echo $this->input->post('new_password'); ?>" class="form-control parsley-validated newPassword" data-required="true">
                                    <?php echo form_error('new_password');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Confirm Password*</label>
                                <div class="col-md-6">
                                    <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo $this->input->post('confirm_password'); ?>" class="form-control parsley-validated confirmPassword" data-required="true">
                                    <?php echo form_error('confirm_password');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary changePassword">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
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