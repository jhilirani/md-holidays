<?php echo $html_heading.$header; //pre($allResortToursDataArr);die;?>
<link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo SiteAssetsURL; ?>dist/css/skins/_all-skins.min.css">
<!-- Pace style -->
<div class="clearfix"></div>
<div class="content-wrapper" style="margin-left: 0px !important;">
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php echo BASE_URL;?>">return to Landing Screen</a>.
          </p>

          <!--<form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group >
          </form> -->
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<div class="clearfix"></div>
<?php echo $footer;?>