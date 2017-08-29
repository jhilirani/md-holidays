<?php echo $html_heading . $header . $bread_crumb; //pre($toursDataArr);//die; ?>
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
</style>
<div class="clearfix"></div>
<div class="slider">
    <div class="flexslider">
        <ul class="slides">
            <?php
            foreach ($rsToursImageArr AS $idx => $idxVal):
                //pre($idxVal);die;
                $imagePath = AssetsPath . 'tours_images/';
                $imageUrl = SiteAssetsURL . 'tours_images/';
                if (file_exists($imagePath . $idxVal['image'])) {
                    ?>
                    <li>
                        <img src="<?php echo $imageUrl . $idxVal['image'] ?>" alt="<?php //echo $idxVal['caption'] ?>" title="<?php //echo $idxVal['caption'] ?>"/>
                    <?php if ($idxVal['caption'] != "") { ?><p class="flex-caption"><?php echo $idxVal['caption'] ?></p><?php } ?>
                    </li>        
    <?php }
endforeach;
?>
        </ul>
    </div>
</div>
<!-- // BANNER AREA END // -->

<!-- // PRODUCTS CONT AREA START // -->
<div class="rating_area">
    <div class="container">
        <div class="row">
            <div class="rating_inner">
                <div class="col-md-12">
                    <div class="col-md-8">                            
                        <h1>Maldives Tours: <?php echo $toursDataArr[0]['title'];?></h1>
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
                            <div class="book_nowinner">
                                <!--<div class="book_nowinner1">
                                    <ul>
                                        <li>Tour Date: <input type="text" placeholder="29 May, 2017"><li>                                                
                                        <li>Adults:
                                            <select id="mt-rooms-selectbox" name="rooms">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </li>
                                        <li>                                               
                                            Child:
                                            <select id="mt-rooms-selectbox" name="rooms">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </li>
                                        <li><input value="BOOK NOW" id="mt-book-update-btn" type="submit"></li>                                            
                                    </ul>
                                </div>-->                                       
                                <div class="book_nowinner1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="colm2">
                                                <h3><strong>Description</strong></h3><br>
                                                <h3><strong><?php echo $toursDataArr[0]['description'];?></strong></h3>
                                                <br><br>
                                                <p><b>Price : <i class="fa fa-usd"></i> <?php echo $toursDataArr[0]['chargesPerPerson']; ?>per person</b><br>
                                                    <br/>Payment can be made in USD, EURO or Credit Card</p>
                                                <br><br>
                                                <h3><strong>Whats Included?</strong></h3>
                                                <ul>
                                                    <?php foreach($servicesDataArr AS $sK=>$sV):?>
                                                    <li><span class="bullets"></span><?php echo $sV['services'];?></li>
                                                    <?php endforeach;?>
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
    </div>
</div>
<!-- // PRODUCTS AREA END // -->

<?php echo $footer; ?>