<!-- jQuery 2.2.3 -->
<script src="<?php echo SiteAssetsURL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SiteAssetsURL; ?>bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="<?php echo SiteAssetsURL; ?>plugins/pace/pace.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo SiteAssetsURL; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SiteAssetsURL; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SiteAssetsURL; ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SiteAssetsURL; ?>dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart();
    });
    $('.ajax').click(function () {
        $.ajax({url: '#', success: function (result) {
                $('.ajax-content').html('<hr>Ajax Request Completed !');
            }});
    });
</script>
<script src="<?php echo SiteAssetsURL; ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo SiteJSURL; ?>bootbox.js_4.4.0_bootbox.min.js"></script>
<script src="<?php echo SiteJSURL; ?>jquery.validate.min.js"></script>
<script src="<?php echo SiteJSURL; ?>common.js"></script>
</body>
</html>
