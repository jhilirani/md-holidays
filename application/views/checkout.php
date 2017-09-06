<?php echo $html_heading.$header.$bread_crumb; //pre($allResortToursDataArr);die;?>
<div class="clearfix"></div>
<!-- // BREADCUM AREA END // -->
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
                            <?php $roomImagePath=AssetsPath.'resort_room_image/200X200/';
                            $roomImageURL=SiteAssetsURL.'resort_room_image/200X200/';
                            //echo $roomImageURL.$dataArr[0]['image'].'<br>';
                            $noImageURL=SiteImagesURL.'no-image-200.png';
                            if(!file_exists($roomImagePath.$dataArr[0]['roomImage'])){?>
                                <img src="<?php echo $noImageURL;?>" alt="<?php echo $dataArr[0]['resortRoomtitle'];?>" title="<?php echo $dataArr[0]['resortRoomtitle'];?>" />
                            <?php }else{?>
                                <img src="<?php echo $roomImageURL.$dataArr[0]['roomImage']?>" alt="<?php echo $dataArr[0]['resortRoomtitle'];?>" title="<?php echo $dataArr[0]['resortRoomtitle'];?>"/>
                            <?php }?>                
                        </div>
                        <div class="col-md-8">
                          <table width="100%" cellpadding="4" cellspacing="4" border="0">
                            <tbody>
                              <tr>
                                <th style="padding:2px;"><b>Resort Name :</b>
                                  </th>
                                <th><?php echo $dataArr[0]['resortTitle'];?></th>
                              </tr>
                              <tr>
                                <th style="padding:2px;"><b>Resort Room Title :</b>
                                  </th>
                                <th><?php echo $dataArr[0]['resortRoomtitle'];?></th>
                              </tr>
                              <tr>
                                <th style="padding:4px;"><b>Services:</b>
                                  </td>
                                <th style="padding:4px;">1 nights, 2 adults stay in 1 Room</th>
                              </tr>
                              <tr>
                                <th style="padding:4px;"><b>Rate:</b></th>
                               <th style="padding:4px;">US $ 108 Per Unit</th>
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
                <h1 style="background: #009CFF; display: inline-block; width: 100%; font-size: 18px; border-radius: 4px 4px 0 0; padding: 0 0 0 14px; color: #FFFFFF;">Yours Details <span style=" padding:0 10px 0 0; margin:0;text-align: right; float:right;"><a href="#" style="color: #FFFFFF; font-size: 12px; background: #00408B;  padding: 6px; border-radius: 4px;">Book fasteer by signing in</a></span></h1>
                <div class="book_nowinner">
                  <div class="book_nowinner1">
                    <ul>                      
                      <li style="width:30%; text-align: left; color:#009CFF;"><b>Title:</b> <br/>
                        <select id="mt-rooms-selectbox" name="rooms" style="width: 100%;">
                          <option value="1">Mr.</option>
                          <option value="2">Ms.</option>
                          <option value="2">Mrs.</option>
                        </select>
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>First name:</b> <br/>
                        <input type="text" placeholder="" style="width: 100%; margin-bottom: 4px;">
                      </li>
					    <li style="width:30%; text-align: left; color:#009CFF;"><b>Last name:</b> <br/>
                        <input type="text" placeholder="" style="width: 100%; margin-bottom: 4px;">
                      </li>
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>Email Address:</b> <br/>
                        <input type="text" placeholder="" style="width: 100%; margin-bottom: 4px;">
                      </li>
                      <li style="width:30%; text-align: left; color:#009CFF;"><b>Phone Number:</b> <br/>
                        <input type="text" placeholder="" style="width: 100%; margin-bottom: 4px;">
                      </li>
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>Country of residence:</b> <br/>
                        <input type="text" placeholder="" style="width: 100%; margin-bottom: 4px;">
                      </li>
                       <li style="width:30%; text-align: left; color:#009CFF;"><b>Payment Options:</b> <br/>
                        <select id="mt-rooms-selectbox" name="rooms" style="width: 100%;">
                          <option value="1">* Pay 50% now</option>
                          <option value="2">* Pay 50% now</option>
                          <option value="2">* Pay 50% now</option>
                        </select>
                      </li>

                       <li style="width:100%; text-align: left; color:#009CFF;"><b>Special Request:</b> <br/>
                        <textarea name="" cols="" rows="" style="width: 100%; margin-bottom: 4px; border: 1px solid #ccc; height: 130px"></textarea>
                      </li>
					  <li style="clear:both;"></li>
                      <li style="width:30%; text-align: left; color:#009CFF;">
                        <input value="BOOK NOW" id="mt-book-update-btn" type="submit">
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="location_now">
              <div class="location_nowinner2">
                <div class="colm4"> <span><img src="img/award.jpg" alt=""></span>
                  <p>Maldives Traveller work has won the prestigious 'National Award for Promoting Maldives Tourism'</p>
                </div>
              </div>
              <div class="location_nowinner" style="border:0;">
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
              </div>
            </div>
            <div class="location_now">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- // PRODUCTS AREA END // -->
<div class="clearfix"></div>
<?php echo $footer;?>