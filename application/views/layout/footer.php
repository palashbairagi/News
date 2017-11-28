            <footer id="footer">
                <div class="footer_top">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="footer_widget wow fadeInLeftBig">
                                <h2>Visitors</h2>
                                <div>Total Visits - 12342</div>
                                <div>Online Visitors - 128</div>
                                <div>Unique Visitors - 5402</div>
                                <div>This Week - 145</div>
                                <div>This Month - 1348</div>
                                <div>(This is Static Data. Visitors can be count once the website will be deployed on main server.)</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="footer_widget wow fadeInRightBig">
                                <h2>Contact Us</h2>
                                <?php $contact = get_contact();?>
                                <h4>Address</h4>
                                <div><?php echo $contact['address'];?></div>
                                <div><?php echo $contact['city'];?></div>
                                <div>Pin - <?php echo $contact['pin_code'];?></div>
                                <div><?php echo $contact['state'];?></div>
                                <h4>Phone</h4>
                                <div><?php echo $contact['phone'];?></div>
                                <div class="contact_us_block"><a class="contact_us_btn" href="<?php echo site_url('contact');?>">Contact Us</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_bottom">
                    <p class="copyright">Copyright &copy; <a href="<?php echo site_url('home');?>">विकास मान</a></p>
                    <p class="developer"><a href="<?php echo site_url('admin');?>" target="_blank" class="admin_login">Admin Login</a></p>
                </div>
            </footer>
        </div>
        <script src="<?php echo site_url('resources/frontend/js/jquery.min.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/wow.min.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/bootstrap.min.js');?>"></script> 
        <script src="<?php echo site_url('resources/js/parsley.extend.js');?>"></script>
        <script src="<?php echo site_url('resources/js/parsley.min.js');?>"></script>
        <script src="<?php echo site_url('resources/frontend/js/slick.min.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/jquery.li-scroller.1.0.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/jquery.newsTicker.min.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/jquery.fancybox.pack.js');?>"></script> 
        <script src="<?php echo site_url('resources/frontend/js/custom.js');?>"></script>
    </body>
</html>
