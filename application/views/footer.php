<div class="clearfix"></div>
    <!-- // FOOTER AREA START  // -->
    <footer class="footer_area">        
        <div class="footer_top">
            <div class="container">
                <div class="row"> 
				<div class="col-md-12">
                        <div class="footer_widget_two">
                            <ul>
                                <li><a href="#">About Us</a></li>                                
                                <li><a href="#">Contact Us</a></li>
								<li><a href="#">Terms of Services</a></li>
								<li><a href="#">Privacy Policy</a></li>
								
                            </ul>
                        </div>
					   </div>	
                    </div> 
                    <div class="clearfix"></div>
                        <div class="copy_right">
                            <p><span>© 2017 TROPICAL PARADISE PVT LTD</span> ALL RIGHTS RESERVED. NO PART OF THIS WEBSITE MAY BE REPRODUCED WITHOUT OUR WRITTEN PERMISSION</p>
                        </div>
                </div>
            </div>
        </div>        
    </footer>
    <!-- // FOOTER AREA END  // -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo SiteJSURL;?>js/bootstrap.min.js"></script>
    <script src="<?php echo SiteJSURL;?>js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(function() {
            SyntaxHighlighter.all();
        });
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            SyntaxHighlighter.all();
        });
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 210,
                itemMargin: 5,
                pausePlay: true,
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo SiteJSURL;?>js/jquery.cslider.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.slider2').bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 2,
                slideMargin: 10
            });
        });
    </script>
</body>
</html>