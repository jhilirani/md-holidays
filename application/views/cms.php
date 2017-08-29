<?php echo $html_heading.$header; //pre($CmsData);die;?>
<div class="clearfix"></div>
<!-- // PRODUCTS CONT AREA START // -->
<div class="product_area">
  <div class="container">
    <div class="product_inner">
      <div class="col-md-12">
        <div class="col-md-8">
          <div id="left-box">
            <h2 class="list-head"><a href="#"><?php echo $CmsData[0]['metaTitle']?></a></h2>
            <p style="line-height: 1.5em !important;"></p>
            <div><?php echo $CmsData[0]['body'];?></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="location_nowinner2">
            <div class="colm4"> <span><img src="<?php echo SiteAssetsURL;?>img/award.jpg" alt=""></span>
              <p>Maldives Traveller work has won the prestigious 'National Award for Promoting Maldives Tourism'</p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // POPULAR AREA END // -->
<div class="clearfix"></div>
<?php echo $footer;?>