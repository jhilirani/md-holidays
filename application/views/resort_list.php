<?php echo $html_heading.$header.$bread_crumb; //pre($allResortToursDataArr);die;?>
<!-- // PRODUCTS CONT AREA START // -->
    <div class="product_area">
        <div class="container">
            <div class="product_inner">
                <h1>Resort </h1>                 
                <?php foreach($allResortList AS $k): ?>
                <div class="box_pro">
                    <div class="price_tag">
                        $ <?php echo $k['oneAdult'];?>
                    </div>
                    <a href="<?php echo BASE_URL.'resort/'.my_seo_freindly_url($k['categoryName'])."/".my_seo_freindly_url($k['title'])."-".($k['resortId']*204204);?>">
                        <?php $imgExistsPath=ResortImagePath.'300X300/'.$k['image'];
                                $imgUrl=ResortModiumURL.$k['image'];
                                ?> 
                       <?php if(file_exists($imgExistsPath)): ?> 
                        <img src="<?php echo $imgUrl;?>" alt="<?php echo $k['title'];?>" title="<?php echo $k['title'];?>" class="img-responsive img-thumbnail" />
                        <?php else:?>
                        <img src="<?php echo SiteImagesURL;?>no-image-300.png" alt="<?php echo $k['title'];?>" title="<?php echo $k['title'];?>" />
                        <?php endif;?>
                    </a>                               
                    <h1><?php echo $k['title'];?></h1>
                    <p><?php echo $k['overview'] ?></p>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <!-- // POPULAR AREA END // -->
<?php echo $footer;?>