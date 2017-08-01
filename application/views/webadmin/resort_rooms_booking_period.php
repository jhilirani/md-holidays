<link rel="stylesheet" href="<?php echo SiteAssetsURL?>plugins/datepicker/datepicker3.css">
<?php
for($i=1;$i<($nos+1);$i++){?>
    <div class="row">
              <div class="col-md-4">Booking period <?php echo $i;?> start date</div>
              <div class="col-md-8">
                  <div class="col-md-2">1 Adult</div>
                  <div class="col-md-3">2 Adult</div>
                  <div class="col-md-2">3 Adult</div>
                  <div class="col-md-2">4 Adult</div>
                  <div class="col-md-3">Extra Days Charge</div>
              </div> 
          </div>
          <div class="row">
              <div class="col-md-4"><input type="text" name="bookingStartDate<?php echo $i;?>" id="bookingStartDate<?php echo $i;?>" class="form-control datepicker" /></div>
              <div class="col-md-8">
                  <div class="col-md-2"><input type="text" class="form-control" name="1adult<?php echo $i;?>" id="1adult<?php echo $i;?>" onblur="myJsMain.update_price('<?php echo $i; ?>', this.value);"/></div>
                  <div class="col-md-3"><input type="text" class="form-control" name="2adult<?php echo $i;?>" id="2adult<?php echo $i;?>"/></div>
                  <div class="col-md-2"><input type="text" class="form-control" name="3adult<?php echo $i;?>" id="3adult<?php echo $i;?>"/></div>
                  <div class="col-md-2"><input type="text" class="form-control" name="4adult<?php echo $i;?>" id="4adult<?php echo $i;?>"/></div>
                  <div class="col-md-3"><input type="text" class="form-control" name="extraPerAdult<?php echo $i;?>" id="extraPerAdult<?php echo $i;?>"/></div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">Booking period <?php echo $i;?> End date</div>
              <div class="col-md-8">
                  <div class="col-md-2">Child Rate</div>
                  <div class="col-md-3">Max Children</div>
                  <div class="col-md-2">Infant Rate</div>
                  <div class="col-md-2">Max Infant</div>
                  <div class="col-md-3">Extra Charge @child</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4"><input type="text" name="bookingEndDate<?php echo $i;?>" id="bookingEndDate<?php echo $i;?>" class="form-control datepicker" /></div>
              <div class="col-md-8">
                  <div class="col-md-2"><input type="text" class="form-control" name="childRate<?php echo $i;?>" id="childRate<?php echo $i;?>" onblur="$('#extraChargesForInfantChild<?php echo $i; ?>').val(this.value);$('#infantRate<?php echo $i; ?>').val(this.value);"/></div>
                  <div class="col-md-3"><input type="text" class="form-control" name="maxChild<?php echo $i;?>" id="maxChild<?php echo $i;?>"/></div>
                  <div class="col-md-2"><input type="text" class="form-control" name="infantRate<?php echo $i;?>" id="infantRate<?php echo $i;?>"/></div>
                  <div class="col-md-2"><input type="text" class="form-control" name="maxInfant<?php echo $i;?>" id="maxInfant<?php echo $i;?>"/></div>
                  <div class="col-md-3"><input type="text" class="form-control" name="extraChargesForInfantChild<?php echo $i;?>" id="extraChargesForInfantChild<?php echo $i;?>"/></div>
              </div>
          </div>
<?php }?>
<script type="text/javascript" src="<?php echo SiteAssetsURL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        <?php   for($i=1;$i<($nos+1);$i++){?>
        jQuery('#bookingStartDate<?php echo $i;?>').datepicker({format: 'dd-mm-yyyy',todayHighlight:'TRUE',autoclose: true,});
        jQuery('#bookingEndDate<?php echo $i;?>').datepicker({format: 'dd-mm-yyyy',todayHighlight:'TRUE',autoclose: true,});
        <?php }?>
    });
</script>