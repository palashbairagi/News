<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>विकास मान | Admin Panel</title>

        <!-- Bootstrap -->
        <link href="<?php echo site_url('resources/css/bootstrap.min.css');?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo site_url('resources/css/font-awesome.min.css');?>" rel="stylesheet">
        
        <link href="<?php echo site_url('resources/css/daterangepicker.css');?>" rel="stylesheet">

        <!-- iCheck -->
        <link href="<?php //echo site_url('resources/css/green.css');?>" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo site_url('resources/css/custom.min.css');?>" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="<?php echo site_url('resources/css/waitMe.css');?>">
        <!-- jQuery -->
        <script src="<?php echo site_url('resources/js/jquery.min.js');?>"></script>
        <script type="text/javascript">
            var BASE_URL = "<?php echo base_url();?>";
        </script>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="" class="site_title"><i class="fa fa-newspaper-o"></i> <span>विकास मान</span></a>
                        </div>

                        <div class="clearfix"></div>
			<?php $admin = get_admin_detail();?>
                           
                        <!-- menu profile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <img src="<?php echo site_url('resources/dp/'.$admin['picture']);?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php echo $admin['name'];?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>&nbsp;</h3>
                                <ul class="nav side-menu">
                                    
                                    <li class="<?php if(isset($active_menu) && $active_menu == 'dashboard'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard </a>
                                    </li>
                                    <li class="<?php if(isset($active_menu) && $active_menu == 'comments'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('admin/comments');?>"><i class="fa fa-comments-o"></i> Comments  
                                    		<span class="comment_count"><?php $comment_count = get_new_comments();echo $comment_count;?></span>
                                    	</a>
                                    </li>
                                    <li class="<?php if(isset($active_menu) && $active_menu == 'headlines'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('headlines');?>"><i class="fa fa-header"></i> Headlines </a>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i>News <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo site_url('admin/news');?>">सभी खबरें</a></li>
                                            <?php 
                                            $categories = get_all_categories();
                                            foreach($categories as $category){?>
                                            <li><a href="<?php echo site_url('admin/news/'.$category['id']);?>"><?php echo $category['category_name'];?></a></li>
                                            <?php }?>
                                        </ul>
                                    </li>

                                    <li class="<?php if(isset($active_menu) && $active_menu == 'rashifal'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('rashifal');?>"><i class="fa fa-paste"></i> राशिफल  </a>
                                    </li>
                                    <li class="<?php if(isset($active_menu) && $active_menu == 'video'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('admin/news/'.VIDEO);?>"><i class="fa fa-caret-square-o-right"></i> Video  </a>
                                    </li>
                                    <li class="<?php if(isset($active_menu) && $active_menu == 'contact'){echo 'active';}?>">
                                    	<a href="<?php echo site_url('admin/contact');?>"><i class="fa fa-envelope"></i> Contacts
                                    	<span class="comment_count"><?php $message_count = get_message_count();echo $message_count;?></span>
                                    	 </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons -->
                        <!--div class="sidebar-footer hidden-small">
                        <a></a>
              		<a></a>
              		
              		<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
                		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              		</a>     
              		<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout">
                		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              		</a>
            		</div-->
            		<!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo site_url('resources/dp/'.$admin['picture']);?>" alt=""><?php echo $admin['name'];?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="<?php echo site_url('admin/updateProfile');?>"><i class="fa fa-user"></i> My Profile </a></li>
                                        <li><a href="<?php echo site_url('admin/logout');?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> 
                <!-- /top navigation -->