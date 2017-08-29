<div class="header_bottom">
    <div class="container">
        <div class="row">
            <div class="navigation">
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav arrow">
                            <li><a href="#" class="active"><img src="<?php echo SiteAssetsURL; ?>img/home.png" alt=""></a></li>
                            <?php foreach ($menuDataArr AS $k):?>
                            <li>
                                <?php if($k->type==1){?>
                                <a href="<?php echo BASE_URL.'resort-listing/'.my_seo_freindly_url($k->categoryName)."-".($k->categoryId*102102);?>"><?php echo $k->categoryName;?></a>
                                <?php }else{?>
                                <a href="<?php echo BASE_URL.'tours-listing/'.my_seo_freindly_url($k->categoryName)."-".($k->categoryId*102102);?>"><?php echo $k->categoryName;?></a>
                                <?php }?>
                            </li>
                            <?php endforeach;?>
                            <?php /*<li><a href="#">Tours & Packages</a></li>
                            <?php /*<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cheap Holidays<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Tour Packages1</a></li>
                                    <li><a href="#">Tour Packages2</a></li>
                                    <li><a href="#">Tour Packages3</a></li>
                                    <li><a href="#">Tour Packages4</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Standard & Medium Resorts<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Tour Packages1</a></li>
                                    <li><a href="#">Tour Packages2</a></li>
                                    <li><a href="#">Tour Packages3</a></li>
                                    <li><a href="#">Tour Packages4</a></li>
                                </ul>
                            </li>*/?>		
                            <!--<li><a href="j#">Luxury & Super Luxury Resorts</a></li> -->
                            <li><a href="#">Travel Guide</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>