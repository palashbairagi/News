<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url('resources/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo site_url('resources/css/font-awesome.min.css');?>" rel="stylesheet">
    
    <link href="<?php echo site_url('resources/css/animate.min.css');?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo site_url('resources/css/custom.min.css');?>" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <div class="clearfix"></div>
		        <div class="bs-example" data-example-id="glyphicons-accessibility">
		            <?php if ($this->session->flashdata('successmsg')) { ?>
		            <div class="alert alert-success alert-dismissible fade in" role="alert">
		                <i><?php echo $this->session->flashdata('successmsg');?></i>
		            </div>
		            <?php } ?>
		            <?php if ($this->session->flashdata('errormsg')) { ?>
		            <div class="alert alert-danger alert-dismissible fade in" role="alert">
		                <i><?php echo $this->session->flashdata('errormsg');?></i>
		            </div>
		            <?php } ?>
		            <div class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
		                <i><?php echo $this->session->flashdata('successmsg');?></i>
		            </div>
		            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="display:none;">
		                <i><?php echo $this->session->flashdata('errormsg');?></i>
		            </div>
		        </div>
		        
                    <form action="<?php echo site_url('admin/login');?>" method="post">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" name="username" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                        </div>
                        <div>
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">Login</button>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>