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
                            <?php //echo  '='.$this->uri->segment(1).'***'.$this->uri->segment(2).'=';
                            if($this->uri->segment(1)=="" && $this->uri->segment(1)==""):?>
                            <li><a href="<?php echo BASE_URL;?>" class="active"><img src="<?php echo SiteAssetsURL; ?>img/home.png" alt=""></a></li>
                            <?php 
                            else:?>
                            <li><a href="<?php echo BASE_URL;?>"><img src="<?php echo SiteAssetsURL; ?>img/home.png" alt=""></a></li>    
                        <?php endif;
                            $haystack =$this->uri->segment(2);
                            $activeClass='';
                            foreach ($menuDataArr AS $k):
                                $needle=my_seo_freindly_url($k->categoryName);
                                if( strpos( $haystack, $needle ) !== false ) {
                                    $activeClass='class="active"';
                                }
                                ?>
                            <li>
                                <?php if($k->type==1){?>
                                <a href="<?php echo BASE_URL.'resort-listing/'.my_seo_freindly_url($k->categoryName)."-".($k->categoryId*102102);?>" <?php echo $activeClass;?>><?php echo $k->categoryName;?></a>
                                <?php }else{?>
                                <a href="<?php echo BASE_URL.'tours-listing/'.my_seo_freindly_url($k->categoryName)."-".($k->categoryId*102102);?>" <?php echo $activeClass;?>><?php echo $k->categoryName;?></a>
                                <?php }?>
                            </li>
                            <?php 
                                if($activeClass!=""){
                                    $activeClass="";
                                }
                                endforeach;?>
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
                            <?php if($this->uri->segment(1)=='travel-guide'){$activeClass='class="active"';}?>
                            <li><a href="<?php echo BASE_URL.'travel-guide';?>" <?php echo $activeClass;?>>Travel Guide</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>