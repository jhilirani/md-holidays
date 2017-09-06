<?php echo $html_heading.$header.$bread_crumb; //pre($allResortToursDataArr);die;?>
<style type="text/css">
.flex-caption {
  width: 100%;
  padding: 1%;
  left: 0;
  bottom: 0;
  background: rgba(0,0,0,.5);
  color: #fff;
  text-shadow: 0 -1px 0 rgba(0,0,0,.3);
  font-size: 14px;
  line-height: 15px;
}
#map {
 height: 360px;
 width: 100%;
}
</style>
<link rel="stylesheet" href="<?php echo SiteAssetsURL ?>plugins/datepicker/datepicker3.css">
<div class="clearfix"></div>
    <!-- // BANNER AREA START // -->
    <div class="slider">
        <div class="flexslider">
            <ul class="slides">
                <?php foreach($rsResortImageArr AS $idx=>$idxVal):
                    //pre($idxVal);die;
                    $imagePath=AssetsPath . 'resort_images/';
                    $imageUrl=SiteAssetsURL.'resort_images/';
                    if(file_exists($imagePath.$idxVal['image'])){?>
                        <li>
                            <img src="<?php echo $imageUrl.$idxVal['image']?>" alt="<?php //echo $idxVal['caption']?>" title="<?php //echo $idxVal['caption']?>"/>
                            <?php if($idxVal['caption']!=""){?><p class="flex-caption"><?php echo $idxVal['caption']?></p><?php }?>
                        </li>        
                    <?php }        
                     endforeach;?>
            </ul>
        </div>
    </div>
    <!-- // BANNER AREA END // -->
    <div class="clearfix"></div>
    <!-- // PRODUCTS CONT AREA START // -->
    <div class="rating_area">
        <div class="container">
            <div class="row">
                <div class="rating_inner">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div><img src="<?php echo SiteAssetsURL;?>img/star.png" alt=""> <img src="<?php echo SiteAssetsURL;?>img/star.png" alt=""> <img src="<?php echo SiteAssetsURL;?>img/star.png" alt=""> <img src="<?php echo SiteAssetsURL;?>img/star.png" alt=""> <img src="<?php echo SiteAssetsURL;?>img/star.png" alt=""></div>
                            <h1><?php echo $resortRoomDetailsDataArr[0]['ResortTitle'];?></h1>
                            <ul>
                                <?php foreach ($enjayTypeDataArr AS $kET=>$vET):
                                    $enjayTypeImagePath=AssetsPath.'resort_enjay_type/';
                                    $enjayTypeImageURL=SiteAssetsURL.'resort_enjay_type/';
                                    if(!file_exists($enjayTypeImagePath.$vET['image']))
                                        continue;
                                    ?>
                                <li>
                                    <img src="<?php echo $enjayTypeImageURL.$vET['image'];?>" alt="<?php echo $vET['name']?>">
                                    <p><a href="#"><?php echo $vET['name']?></a></p>
                                    <label><input readonly="" name="" type="text" placeholder="+2"></label>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <div class="over_rating">
                                Overall Rating
                                <span class="bars mrg-buttom-1">								
								<span class="bar s1"></span>
                                <span class="bar s2"></span>
                                <span class="bar s3"></span>
                                <span class="bar s4"></span>
                                <span class="bar s5"></span>
                                </span>
                                <span class="mrg-buttom-1">Excellent</span>
                            </div>
                            <div class="book_now">
                                <h1>Book now, Pay later: <?php echo $resortRoomDetailsDataArr[0]['ResortTitle'];?></h1>
                                <div class="book_nowinner">
                                    <!--<div class="book_nowinner1">
                                        <ul>
                                            <li>
                                                <label>Check-in</label>
                                                <div><input type="text" placeholder="29 May, 2017"></div>
                                            </li>
                                            <li>
                                                <label>Check-out</label>
                                                <div><input type="text" placeholder="29 May, 2017"></div>
                                            </li>
                                            <li>
                                                <label>Rooms</label>
                                                <div>
                                                    <select id="mt-rooms-selectbox" name="rooms">
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Adults</label>
                                                <div>
                                                    <select id="mt-rooms-selectbox" name="rooms">
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Child</label>
                                                <div>
                                                    <select id="mt-rooms-selectbox" name="rooms">
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Infant</label>
                                                <div>
                                                    <select id="mt-rooms-selectbox" name="rooms">
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
                                                </div>
                                            </li>
                                        </ul>
                                        <div style="text-align: center;"><input value="Update" id="mt-book-update-btn" style="" type="submit"></div>
                                    </div> -->
                                    <?php foreach($resortRoomDetailsDataArr AS $roomKey=>$roomVal):
                                        //pre($roomVal); //die;?>
                                    <div class="book_nowinner1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div>
                                                        <?php $roomImagePath=AssetsPath.'resort_room_image/200X200/';
                                                        $roomImageURL=SiteAssetsURL.'resort_room_image/200X200/';
                                                        //echo $roomImageURL.$roomVal['image'].'<br>';
                                                        $noImageURL=SiteImagesURL.'no-image-200.png';
                                                        if(!file_exists($roomImagePath.$roomVal['image'])){?>
                                                            <img src="<?php echo $noImageURL;?>" alt="<?php echo $roomVal['title'];?>" title="<?php echo $roomVal['title'];?>" />
                                                        <?php }else{?>
                                                            <img src="<?php echo $roomImageURL.$roomVal['image']?>" alt="<?php echo $roomVal['title'];?>" title="<?php echo $roomVal['title'];?>"/>
                                                        <?php }?>                
                                                    </div>
                                                    <div class="book_nowinner2" style="border: 0;">
                                                        <h1><?php echo $roomVal['title'];?></h1>
                                                        <h2><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $roomVal['resortRoomCharges'];?> Per Night</h2>
                                                        <h3><?php echo date('d M, Y',strtotime($roomVal['resortRoomBookingStartDate']));?> to <?php echo date('d M, Y',strtotime($roomVal['resortRoomBookingEndDate']));?></h3>
                                                        <h4>For <?php echo $roomVal['maxAdultPerRoom'];?> Adults stay in 1 Room</h4>
                                                        <p><?php echo $roomVal['roomDescription'];?> More details click Book Now</p>
                                                    </div>
                                                    <div class="col-md-12 text-left">
                                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                                            <button class="btn btn-primary btn-sm viewRoomDetails" data-roomid="<?php echo $roomVal['resortRoomId'];?>" data-strurl="<?php echo my_seo_freindly_url($resortRoomDetailsDataArr[0]['ResortTitle']).'/'.my_seo_freindly_url($roomVal['title']);?>">View Details</button>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-2"> &nbsp;</div>
                                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                                            <button class="btn btn-primary btn-sm bookNow" data-roomid="<?php echo $roomVal['resortRoomId'];?>" data-strurl="<?php echo my_seo_freindly_url($resortRoomDetailsDataArr[0]['ResortTitle']).'/'.my_seo_freindly_url($roomVal['title']);?>">Book Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12"><h3><strong>Room Details</strong></h3></div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">&nbsp;</div>
                                                    </div>
                                                    <div class="row">
                                                        <?php $roomDetails=$roomVal['roomDetails'];
                                                        foreach ($roomDetails AS $rK=>$rV):?>
                                                        <div class="col-md-6 col-sm-6 col-xs-12" style=" font-size: 13px;padding:3px 15px;"> 
                                                            <i class="fa fa-arrow-right" aria-hidden="true" style="color:#0066cc;"></i> 
                                                                <?php echo $rV['title'];?>
                                                        </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <h2>Overview</h2>
                            <p><?php echo $resortRoomDetailsDataArr[0]['overview'];?> </p>
                            <!--<div><a style="float: right;" href="/login" rel="modal" class="button">WRITE A REVIEW</a></div>-->
                        </div>

                        <div class="col-md-4">
                            <div class="mrg-buttom">
                                <div class="location_now">
                                    <h1> <i class="fa fa-map-marker fa-2x" style="color:white;" aria-hidden="true"></i> Location</h1>
                                    <div id="map" class="location_nowinner"></div>
                                    <!--<div class="location_nowinner">
                                        <img src="img/map.jpg" alt="">
                                    </div>-->
                                </div>
                            </div>
                            <div class="location_now">
                                <h1> <i class="fa fa-circle-o fa-2x" style="color:white;"></i> Factfile</h1>
                                <div class="location_nowinner">
                                    <p>
                                        <?php echo $factfileStr;?>
                                    </p>
                                </div>
                            </div>
                            <div class="location_now">
                                <h1> <i class="fa fa-building fa-2x" style="color:white;"></i> Facilities</h1>
                                <div class="location_nowinner">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 10px;">
                                            <?php //pre($facilityDataArr);die;
                                            foreach ($facilityDataArr AS $rK=>$rV):?>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style=" font-size: 13px;padding:3px 15px;"> 
                                                <i class="fa fa-arrow-right" aria-hidden="true" style="color:#0066cc;"></i> 
                                                    <?php echo $rV['facility'];?>
                                            </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="location_now">
                                <h1> <i class="fa fa-futbol-o" aria-hidden="true"></i><i class="fa fa-gamepad fa-2x" style="color:white;"></i> Sports and Recreation</h1>
                                <div class="location_nowinner">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 10px;">
                                            <?php //pre($sportsAndRecreationDataArr);die;
                                            foreach ($sportsAndRecreationDataArr AS $rK=>$rV):?>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style=" font-size: 13px;padding:3px 15px;"> 
                                                <i class="fa fa-arrow-right" aria-hidden="true" style="color:#0066cc;"></i> 
                                                    <?php echo $rV['sportsRecreation'];?>
                                            </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="location_now">
                                <h1> <i class="fa fa-language fa-2x" style="color:white;" aria-hidden="true"></i> Language Spoken</h1>
                                <div class="location_nowinner">
                                    <div class="colm2">
                                        <ul>
                                            <li><span class="bullets"></span>English</li>
                                            <li><span class="bullets"></span>French</li>
                                            <li><span class="bullets"></span>German</li>
                                        </ul>
                                    </div>
                                    <div class="colm3">
                                        <ul>
                                            <li><span class="bullets"></span>Chinese</li>
                                            <li><span class="bullets"></span>Hindi</li>
                                            <li><span class="bullets"></span>Malay</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="location_nowinner2">
                                <div class="colm4">
                                    <span><img src="<?php echo SiteAssetsURL;?>img/award.jpg" alt=""></span>
                                    <p>Maldives Traveller work has won the prestigious 'National Award for Promoting Maldives Tourism'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- // PRODUCTS AREA END // -->
    <!-- // PRODUCTS AREA END // -->
<?php echo $footer;?>
    <script type="text/javascript" src="<?php echo SiteAssetsURL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo SiteJSURL; ?>resort_tour_operation.js"></script>
    <script type="text/javascript">
        function initMap() {
        var uluru = {lat: <?php echo $resortRoomDetailsDataArr[0]['latitude'];?>, lng: <?php echo $resortRoomDetailsDataArr[0]['longitude'];?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: <?php echo $resortRoomDetailsDataArr[0]['mapZoomLevel'];?>,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
      myJsMain.show_room_charges_details();
      myJsMain.go_book_now();
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAksaNvL8irkMxMnQOitgjSrhkR7aiFw1s&callback=initMap"> </script>