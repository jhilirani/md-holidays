<div class="clearfix"></div>
    <!-- // FOOTER AREA START  // -->
    <footer class="footer_area">        
        <div class="footer_top">
            <div class="container">
                <div class="row"> 
				<div class="col-md-12">
                        <div class="footer_widget_two">
                            <ul>
                                <li><a href="<?php echo BASE_URL.'about-us';?>">About Us</a></li>                                
                                <li><a href="<?php echo BASE_URL.'contact-us';?>">Contact Us</a></li>
								<li><a href="<?php echo BASE_URL.'terms-of-services';?>">Terms of Services</a></li>
								<li><a href="<?php echo BASE_URL.'privacy-policy';?>">Privacy Policy</a></li>
								
                            </ul>
                        </div>
					   </div>	
                    </div> 
                    <div class="clearfix"></div>
                        <div class="copy_right">
                            <p><span>&COPY; <?php echo date('Y');?> TROPICAL PARADISE PVT LTD</span> ALL RIGHTS RESERVED. NO PART OF THIS WEBSITE MAY BE REPRODUCED WITHOUT OUR WRITTEN PERMISSION</p>
                        </div>
                </div>
            </div>
        </div>        
    </footer>
    <!-- // FOOTER AREA END  // -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo SiteJSURL;?>bootstrap.min.js"></script>
    <script src="<?php echo SiteJSURL;?>jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                easing: "swing",
                animationLoop: true,
                reverse:true,
                slideshowSpeed: 4000,
                animationSpeed: 900,
                //thumbCaptions:true,
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(window).load(function() {
            /*$('.flexslider').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 210,
                itemMargin: 5,
                pausePlay: true,
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });*/
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            /*$('.slider2').bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 2,
                slideMargin: 10
            });*/
        });
    </script>
</body>
</html>