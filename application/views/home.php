<?php echo $html_heading.$header; //pre($allResortToursDataArr);die;?>
<!-- // PRODUCTS CONT AREA START // -->
    <div class="product_area">
        <div class="container">
            <div class="product_inner">
                <h1>Resort & Tours</h1>                 
                <?php foreach($allResortToursDataArr AS $k): //pre($k);?>
                <div class="box_pro">
                    <div class="price_tag">
                        $ <?php echo ($k['item_type']=="resort")? $k['oneAdult'] : $k['chargesPerPerson'];?>
                    </div>
                    <?php if($k['item_type']=="resort"):
                                $imgExistsPath=ResortImagePath.'300X300/'.$k['image'];
                                $imgUrl=ResortModiumURL.$k['image'];
                                $detailsURL=BASE_URL.'resort/'.my_seo_freindly_url($k['categoryName']).'/'.my_seo_freindly_url($k['title'])."-".($k['resortId']*204204);
                            else:
                                $imgExistsPath=ToursImagePath.'300X300/'.$k['image'];
                                $imgUrl=ToursModiumURL.$k['image'];
                                $detailsURL=BASE_URL.'tour/'.my_seo_freindly_url($k['categoryName']).'/'.my_seo_freindly_url($k['title'])."-".($k['toursId']*204204);
                            endif;?> 
                    <a href="<?php echo $detailsURL;?>">
                       <?php if(file_exists($imgExistsPath)): ?> 
                        <img src="<?php echo $imgUrl;?>" alt="<?php echo $k['title'];?>" title="<?php echo $k['title'];?>" class="img-responsive img-thumbnail" />
                        <?php else:?>
                        <img src="<?php echo SiteImagesURL;?>no-image-300.png" alt="<?php echo $k['title'];?>" title="<?php echo $k['title'];?>" />
                        <?php endif;?>
                    </a>                               
                    <h1><?php echo $k['title'];?></h1>
                    <p><?php echo ($k['item_type']=="resort")? $k['overview'] : $k['description'];?></p>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <!-- // POPULAR AREA END // -->
<?php echo $footer;?>