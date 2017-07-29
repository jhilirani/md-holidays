<?php echo $html_head . $body_start . $header . $left_menu . $page_heading_start; ?>
<style>
    .dynamicTile .col-sm-2.col-xs-4{
        padding:5px;
    }

    .dynamicTile .col-sm-4.col-xs-8{
        padding:5px;
    }    
    .tile10{
        background: rgb(0,93,233);
    }
    
    .tilecaption{
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%); 
        margin:0!important;
        text-align: center;
        color:white;
        font-family: Segoe UI;
        font-weight: lighter;
        font-size: 20px;
    }
    .tile,.carousel,.item{
        border-radius: 7px;
    }
</style>
<!-- Default box -->
<div class="box">
    <div class="container dynamicTile">
        <div class="row">
            <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3">
                <div class="tile tile10" data-color="green">
                    <div class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <h3 class="tilecaption"><a href="<?php echo ADMIN_BASE_URL.'facility/viewlist';?>"><i class="fa fa-building fa-3x"></i></a></h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption"><a href="<?php echo ADMIN_BASE_URL.'facility/viewlist';?>">Manage Facility</a></h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption"><a href="<?php echo ADMIN_BASE_URL.'facility/viewlist';?>">Create,Update and Facilities</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4">
                <div class="tile tile10" data-color="red">
                    <div class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <h3 class="tilecaption"><i class="fa fa-circle-o fa-3x"></i></h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption">Manage Factfile</h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption">Create,Update and Factfile</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4">
                <div class="tile tile10" data-color="blue">
                    <div class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <h3 class="tilecaption"><i class="fa fa-gamepad fa-3x"></i></h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption">Manage Sports and Recreation</h3>
                            </div>
                            <div class="item">
                                <h3 class="tilecaption">Create,Update and Sports and Recreation</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="box-header with-border">
      <h3 class="box-title">Title</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <!--div class="box-body">
      Pace loading works automatically on page. You can still implement it with ajax requests by adding this js:
      <br /><code>$(document).ajaxStart(function() { Pace.restart(); });</code>
      <br />
        
    </div>
    <!-- <i class="fa fa-spin fa-refresh"></i>&nbsp; Get External Content  
    <!-- /.box-body -
    <div class="box-footer">
      Footer
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
<?php echo $page_heading_end . $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".tile").height('250px');
        $(".tile").width('250px')
        $(".carousel").height('250px');
        $(".carousel").width('250px')
        $(".item").height('250px');
        $(".item").width('250px');
        $(window).resize(function () {
            if (this.resizeTO)
                clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function () {
                $(this).trigger('resizeEnd');
            }, 10);
        });

        $(window).bind('resizeEnd', function () {
            $(".tile").height('250px');
            $(".carousel").height('250px');
            $(".item").height('250px');
        });
        
        $(".tile").each(function(){
            $(this).css("background-color",$(this).data("color"));
        });

    });
</script>    