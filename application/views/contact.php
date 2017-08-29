<?php echo $html_heading.$header;?>
<div class="product_area">
  <div class="container">
    <div class="product_inner">
      <div class="col-md-12">
        <div class="col-md-8">
          <div id="left-box">
            <h2 class="list-head"><a href="#">Contact Us</a></h2>
            <div><?php echo $CmsData[0]['body'];?></div>
          </div>
		  <div class="book_now">                
                <div class="book_nowinner" style="overflow: hidden;">
                  <div class="book_nowinner1">
                      <div id="sendmessage" style="padding: 20px;" class="text-center"><i class="fa fa-check-square-o fa-2x" style="color: green;"></i> &nbsp; &nbsp; Your message has been sent. Thank you!</div>
                      <form action="" method="post" role="form" class="contactForm">
                    <ul> 
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>Name:</b> <br>
                           <input placeholder="Enter your name" name="fullName" id="fullName" style="width: 100%; margin-bottom: 4px;" type="text" required="required">
                      </li>
                    <li style="width:30%; text-align: left; color:#009CFF;"><b>Email:</b> <br>
                        <input placeholder="Enter your email" name="email" style="width: 100%; margin-bottom: 4px;" type="email" required="required">
                      </li>
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>Contact No::</b> <br>
                           <input placeholder="Enter your contact number" id="phone" name="phone" style="width: 100%; margin-bottom: 4px;" type="phone" required="required">
                      </li>                                                           

                       <li style="width:100%; text-align: left; color:#009CFF;"><b>Message:</b> <br>
                           <textarea name="message" id="message" cols="15" rows="5" style="width: 100%; margin-bottom: 4px; border: 1px solid #ccc; height: 130px" required="required"></textarea>
                      </li>
					  <li style="clear:both;"></li>
                      <li style="width:30%; text-align: left; color:#009CFF;">
                        <input value="BOOK NOW" id="mt-book-update-btn" type="submit">
                      </li>
                    </ul>
                          </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-4">
          <div class="location_nowinner2">
            <div class="colm4"> <span><img src="img/award.jpg" alt=""></span>
              <p>Maldives Traveller work has won the prestigious 'National Award for Promoting Maldives Tourism'</p>
            </div>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer;?>
<script src="<?php echo SiteJSURL;?>contactform.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#sendmessage").addClass("hide");	
    });
</script>