<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($active_title) && !empty($active_title)){echo $active_title;}?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/bootstrap.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/font-awesome.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/animate.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/font.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/li-scroller.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/slick.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/jquery.fancybox.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/theme.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('resources/frontend/css/style.css');?>">
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var BASE_URL = "<?php echo base_url();?>";
        </script>                
    </head>
    <body>
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
        <div class="container">
            <header id="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="header_bottom">
                            <div class="" >
                                <img src="<?php echo site_url('resources/frontend/images/heading.jpg');?>" alt=""></a>
                            </div>
                            <div class="" >
                                <label>
                                <?php 
                                    $day_n = date('N');
                                    $day = "";
                                    if($day_n == 1) $day = "सोमवार";
                                    elseif($day_n == 2) $day = "मंगलवार";
                                    elseif($day_n == 3) $day = "बुधवार";
                                    elseif($day_n == 4) $day = "गुरूवार";
                                    elseif($day_n == 5) $day = "शुक्रवार";
                                    elseif($day_n == 6) $day = "शनिवार";
                                    elseif($day_n == 7) $day = "रविवार";

                                    $month_n = date('m'); 
                                    $month = "";
                                    if($month_n == 01) $month = "जनवरी";
                                    elseif($month_n == 02) $month = "फरवरी";
                                    elseif($month_n == 03) $month = "मार्च";
                                    elseif($month_n == 04) $month = "अप्रैल";
                                    elseif($month_n == 05) $month = "मई";
                                    elseif($month_n == 06) $month = "जून";
                                    elseif($month_n == 07) $month = "जुलाई";
                                    elseif($month_n == 08) $month = "अगस्त";
                                    elseif($month_n == 09) $month = "सितंबर";
                                    elseif($month_n == 10) $month = "अक्टूबर";
                                    elseif($month_n == 11) $month = "नवंबर";
                                    elseif($month_n == 12) $month = "दिसंबर";

                                    echo $day.',' .date('d').' '.$month.' '.date('Y');
                                ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section id="navArea">
                <nav class="navbar navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav main_nav">
                            <li class="<?php if(isset($active_menu) && $active_menu == 'home'){echo 'active';}?>"><a href="<?php echo site_url('home');?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'शहर'){echo 'active';}?>"><a href="<?php echo site_url('bhilwara-news');?>">शहर</a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'प्रदेश'){echo 'active';}?>"><a href="<?php echo site_url('rajasthan-news');?>">प्रदेश</a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'देश'){echo 'active';}?>"><a href="<?php echo site_url('india-news');?>">देश</a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'विदेश'){echo 'active';}?>"><a href="<?php echo site_url('world-news');?>">विदेश</a></li>
                            <li class="dropdown <?php if(isset($active_menu) && $active_menu == 'बिज़नेस'){echo 'active';}?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">बिज़नेस</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'बिज़नेस'){echo 'active';}?>"><a href="<?php echo site_url('business-news');?>">बिज़नेस</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'टेक्सटाइल'){echo 'active';}?>"><a href="<?php echo site_url('business-textile-news');?>">टेक्सटाइल</a></li>
                                </ul>
                            </li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'खेल'){echo 'active';}?>"><a href="<?php echo site_url('sports-news');?>">खेल</a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'टेक्नोलॉजी'){echo 'active';}?>"><a href="<?php echo site_url('technology-news');?>">टेक्नोलॉजी</a></li>
                            <li class="<?php if(isset($active_menu) && $active_menu == 'मनोरंजन'){echo 'active';}?>"><a href="<?php echo site_url('entertainment-news');?>">मनोरंजन</a></li>
                            <li class="dropdown <?php if(isset($active_menu) && $active_menu == 'अन्य'){echo 'active';}?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">अन्य</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'एजुकेशन'){echo 'active';}?>"><a href="<?php echo site_url('education-news');?>">एजुकेशन</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'कृषि'){echo 'active';}?>"><a href="<?php echo site_url('krishi-news');?>">कृषि</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'रोजगार'){echo 'active';}?>"><a href="<?php echo site_url('rojgar-news');?>">रोजगार</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'स्वास्थ्य'){echo 'active';}?>"><a href="<?php echo site_url('health-news');?>">स्वास्थ्य</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'धर्म'){echo 'active';}?>"><a href="<?php echo site_url('dharm-news');?>">धर्म</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'राशिफल'){echo 'active';}?>"><a href="<?php echo site_url('horoscope-rashifal');?>">राशिफल</a></li>
                                    <li class="<?php if(isset($active_menu) && $active_submenu == 'विचार'){echo 'active';}?>"><a href="<?php echo site_url('editorial-vichar');?>">विचार</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </section>
            <section id="newsSection">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="latest_newsarea"> <span>हेड लाइन्स</span>
                            <ul id="ticker01" class="news_sticker">
                                <?php $headlines = get_all_headlines();
                                if(isset($headlines) && !empty($headlines)){
                                foreach($headlines as $headline){?>
                                <li class="news_headline"> &nbsp;&nbsp;<i class="fa fa-circle"></i>&nbsp;<?php echo $headline['news_headline'];?>&nbsp; </li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>