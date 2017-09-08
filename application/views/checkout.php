<?php echo $html_heading . $header . $bread_crumb; //pre($allResortToursDataArr);die; ?>
<link rel="stylesheet" href="<?php echo SiteAssetsURL ?>plugins/datepicker/datepicker3.css">
<div class="clearfix"></div>
<!-- // BREADCUM AREA END // -->
<style>
    .book_nowinner1 label{font-size: 13px !important;}
    .btn-primary{background-color:#009CFF !important;}
    .btn-primary:hover{background-color: #286090 !important;}
    .input-group-addon{background-color: #009CFF;}
</style>
<div class="rating_area">
    <div class="container">
        <div class="row">
            <div class="rating_inner">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="book_now">
                            <div class="book_nowinner" style="border: 0;">
                                <div class="book_nowinner1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="book_nowinner2">
                                                <div class="col-md-4"> 
                                                    <?php
                                                    if ($checkout_type == 'resort') {
                                                        $checkoutImagePath = AssetsPath . 'resort_room_image/200X200/';
                                                        $checkoutImageURL = SiteAssetsURL . 'resort_room_image/200X200/';
                                                        $fileName = $dataArr[0]['roomImage'];
                                                        $imgTitle = $dataArr[0]['resortRoomtitle'];
                                                    } else {
                                                        $checkoutImagePath = AssetsPath . 'resort_room_image/200X200/';
                                                        $checkoutImageURL = SiteAssetsURL . 'resort_room_image/200X200/';
                                                        $fileName = $dataArr[0]['roomImage'];
                                                        $imgTitle = $dataArr[0]['resortRoomtitle'];
                                                    }
                                                    //echo $roomImageURL.$dataArr[0]['image'].'<br>';
                                                    $noImageURL = SiteImagesURL . 'no-image-200.png';
                                                    if (!file_exists($checkoutImagePath . $fileName)) {
                                                        ?>
                                                        <img src="<?php echo $noImageURL; ?>" alt="<?php echo $imgTitle; ?>" title="<?php echo $imgTitle; ?>" width="150" />
                                                    <?php } else { ?>
                                                        <img src="<?php echo $checkoutImageURL . $fileName; ?>" alt="<?php echo $imgTitle; ?>" title="<?php echo $imgTitle; ?>" width="150"/>
<?php } ?>                
                                                </div>
                                                <div class="col-md-8">
                                                    <table width="100%" cellpadding="4" cellspacing="4" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <th style="padding:2px;"><b>Resort Name :</b>
                                                                </th>
                                                                <th><?php echo $dataArr[0]['resortTitle']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th style="padding:2px;"><b>Resort Room Title :</b>
                                                                </th>
                                                                <th><?php echo $dataArr[0]['resortRoomtitle']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th style="padding:4px;"><b>Services:</b>
                                                                    </td>
                                                                <th style="padding:4px;">1 nights, 2 adults stay in 1 Room</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="book_now">
                                <h1 style="background: #009CFF; display: inline-block; width: 100%; font-size: 18px; border-radius: 4px 4px 0 0; padding: 0 0 0 14px; color: #FFFFFF;">Yours Details </h1>
                                <div class="book_nowinner">
                                    <div class="book_nowinner1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="email">Your Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></div> 
                                                            <select name="title" id="title" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1">Mr.</option>
                                                                <option value="2">Ms.</option>
                                                                <option value="2">Mrs.</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="email">Your Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></div>
                                                            <input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="first_name">Your First name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="Enter your first name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="last_name">Your Last name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></div> 
                                                            <input type="text" class="form-control" name="last_name" id="last_name"  placeholder="Enter your last name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($checkout_type == 'resort') {?>
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="check_in">Check In</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control datepicker-dropdown" name="check_in" id="check_in"  placeholder="select your check in time" readonly=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="check_out">Check out</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control datepicker-dropdown" name="check_out" id="check_out"  placeholder="Select your checkout time" readonly=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }else{?>
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="tours_date">Tours Date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control datepicker-dropdown" name="tours_date" id="tours_date"  placeholder="select your tours date"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="no_of_adult">No of Adult</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-transgender-alt fa" aria-hidden="true"></i></div> 
                                                            <input type="text" class="form-control" name="no_of_adult" id="no_of_adult"  placeholder="Enter no of adult"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="no_of_child">No of child</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-child fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control" name="no_of_child" id="no_of_child"  placeholder="Enter no of child"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="no_of_infant">No of Infant</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-child fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control" name="no_of_infant" id="no_of_infant"  placeholder="Enter no of infant"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="country">Your country name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-location-arrow fa" aria-hidden="true"></i></div> 
                                                            <input type="text" class="form-control" name="country" id="country"  placeholder="Enter your country name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="city">Your city name</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-circle-thin fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control" name="city" id="city"  placeholder="Enter your city name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label for="address">Your address</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-address-card fa" aria-hidden="true"></i></div>
                                                            <input type="text" class="form-control" name="address" id="address"  placeholder="Enter your address"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message">Your special message</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-envelope-open fa" aria-hidden="true"></i></div>
                                                            <textarea class="form-control" name="message" id="message"  placeholder="Enter your message"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-5 col-sm-5 col-xs-12">
                                                    <button type="button" class="btn btn-primary btn-lg btn-sm login-button">Book Now</button><!--btn-block -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="location_now">
                            <div class="location_nowinner2">
                                <div class="colm4"> <span><img src="<?php echo SiteImagesURL;?>award.jpg" alt=""></span>
                                    <p>Maldives Traveller work has won the prestigious 'National Award for Promoting Maldives Tourism'</p>
                                </div>
                            </div>
                            <?php /*<div class="location_nowinner" style="border:0;">
                                <table width="100%" cellpadding="4" cellspacing="4" border="0">
                                    <tbody>
                                        <tr>
                                            <th style="padding:4px;"><b>1 Visit x 2 Adults</b></th>
                                            <th style="padding:4px;">USD 216
                                                </td>
                                        </tr>
                                        <tr>
                                            <th style="padding:4px;"><b>1 Visit x 1 Child </b></th>
                                            <th style="padding:4px;">USD 60</th>
                                        </tr>
                                        <tr>
                                            <th style="padding:4px;"><b>Total Price (all guests, including tax)</b></th>
                                            <th style="padding:4px;">USD 309.12</th>
                                        </tr>
                                        <tr>
                                            <th style="padding:4px;"><b>You Pay Now</b></th>
                                            <th style="padding:4px;">USD 154.56</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> */?>
                        </div>
                        <?php /*<div class="location_now">
                            <div class="location_nowinner" style="border: 0;">
                                <h1 style="background: none; color: #66B162;">Your booking includes</h1>
                                <div class="colm2">
                                    <ul>
                                        <li>Government Tax 12%</li>
                                        <li>Pick up service from Male' Hulhumale</li>
                                        <li>Buffet Breakfast</li>
                                        <li>Buffet Dinner</li>
                                        <li>Meet and assist on arrival at the airport</li>
                                        <li>Tropical Fruit Basket (if honeymoon)</li>
                                        <li>Bottle of Wine (if honeymoon)</li>
                                        <li>Birthday Cake (if birthday celebration)</li>
                                        <li>Free to roam around the beach</li>
                                        <li>Free to roam in the island</li>
                                        <li>Free to swim around the island</li>
                                        <li>Free to snorkel around the island</li>
                                        <li>Free to enjoy the exotic beauty of the island</li>
                                    </ul>
                                </div>
                            </div>
                        </div> */?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // PRODUCTS AREA END // -->
<div class="clearfix"></div>
<?php echo $footer; ?>
<!--<script type="text/javascript" src="<?php //echo SiteAssetsURL; ?>plugins/datepicker/bootstrap-datepicker.js"></script> -->
<script type="text/javascript" src="<?php echo SiteJSURL; ?>custom-bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    <?php if ($checkout_type == 'resort') {?>
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('#check_in').datepicker({
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  $('#check_out')[0].focus();
}).data('datepicker');
var checkout = $('#check_out').datepicker({
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');
    <?php }else{?>
    jQuery('#check_in').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true,startDate:'+0d' });    
    <?php }?>    
});
</script>    