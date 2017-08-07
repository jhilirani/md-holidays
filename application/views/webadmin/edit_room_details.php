<?php //pre($resortRoomDetails); //die('kk'); ?>
<?php echo $html_head . $body_start . $header . $left_menu . $page_heading_start; ?>
<form name="AdminAdd" id="AdminAdd" method="post" action="<?php echo base_url(); ?>webadmin/resort/edit_room" enctype="multipart/form-data">
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox">
        <tr>
            <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
            <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
            <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
            <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Resort Room Update <?php echo $resortRoomDetails[0]->title; ?></span></th>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" class="ListHeadingLable"> Resort Room Title </td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top"><input name="title" type="text" id="title"  class="required form-control"  value="<?php echo $resortRoomDetails[0]->title;?>"/></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Select Resort Room Type</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top">
                <select class="form-control" name="roomTypeId" id="roomTypeId">
                    <option value="">Select</option>
                    <?php foreach ($roomTypeDataArr AS $k): pre($k); ?>
                    <option value="<?php echo $k->roomTypeId; ?>" <?php if($resortRoomDetails[0]->roomTypeId==$k->roomTypeId){?>selected<?php }?>><?php echo $k->roomType; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Order No</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top"><input type="text" name="orderNo" id="orderNo" class="form-control" value="<?php echo $resortRoomDetails[0]->orderNo;?>"></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Total Number of rooms</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top"><input type="text" name="totalNosRoom" id="totalNosRoom" class="form-control" value="<?php echo $resortRoomDetails[0]->totalNosRoom;?>"></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Tax and Service Charges</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top"><input value="<?php echo $resortRoomDetails[0]->taxAndServiceCharges;?>" type="text" name="taxAndServiceCharges" id="taxAndServiceCharges" class="form-control"></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Description</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top"><textarea name="roomDescription" id="roomDescription" class="form-control"><?php echo $resortRoomDetails[0]->roomDescription;?></textarea></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Browse room image</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top">
                <?php $path=AssetsPath.'resort_room_image/100X100/'.$resortRoomDetails[0]->image; 
                if(file_exists($path)){?>
                <img src="<?php echo SiteAssetsURL.'resort_room_image/100X100/'.$resortRoomDetails[0]->image;?>" alt="<?php echo $resortRoomDetails[0]->title;?>" title="<?php echo $resortRoomDetails[0]->title;?>" onclick="$('#resort_room_image').show();$(this).hide();" style="cursor: pointer;"/>
                <?php }else{?>
                <img src="<?php echo SiteImagesURL.'no-image-100.png';?>" alt="<?php echo $resortRoomDetails[0]->title;?>" title="<?php echo $resortRoomDetails[0]->title;?>" onclick="$('#resort_room_image').show();$(this).hide();" style="cursor: pointer;"/>
                <?php }?>
                <input type="file" name="resort_room_image" id="resort_room_image" class="form-control" style="display:none;">
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="ListHeadingLable">
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">status</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top">
                <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($resortRoomDetails[0]->status==1){?>checked<?php }?> class="required">Active</label>
                <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($resortRoomDetails[0]->status==0){?>checked<?php }?> class="required">Active</label>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="ListHeadingLable">
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">Pay while booking</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top">
                <label class="radio-inline"><input type="radio" name="needPay" value="1" <?php if($resortRoomDetails[0]->needPay==1){?>checked<?php }?> class="required">Yes</label>
                <label class="radio-inline"><input type="radio" name="needPay" value="0" <?php if($resortRoomDetails[0]->needPay==0){?>checked<?php }?> class="required">No</label></td>
        <input type="hidden" name="resortId" id="resortId" value="<?php echo $resortRoomDetails[0]->resortId; ?>">
        <input type="hidden" name="resortRoomId" id="resortRoomId" value="<?php echo $resortRoomDetails[0]->resortRoomId; ?>">
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">No os of Booking Period</td>
            <td align="left" valign="top"><label><strong>:</strong></label></td>
            <td align="left" valign="top">
                <?php $noOfBookingPeriod=array(2,3,4,5,6);?>
                <select name="noOfBookingPeriod" id="noOfBookingPeriod" class="form-control">
                    <?php foreach ($noOfBookingPeriod AS $k){?>
                    <option value="<?php echo $k;?>" <?php echo ($k==count($resortRoomChargesDetails)) ? 'selected' : '';?>><?php echo $k;?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <?php echo count($resortRoomChargesDetails)+1;?> 
        <tr>
            <td align="left" valign="top" class="bookingPeriodBox" colspan="4">
                <?php $j=0; for ($i = 1; $i < count($resortRoomChargesDetails)+1; $i++): ?>
                    <div class="row">
                        <div class="col-md-4">Booking period <?php echo $i; ?> start date</div>
                        <div class="col-md-8">
                            <div class="col-md-2">1 Adult</div>
                            <div class="col-md-3">2 Adult</div>
                            <div class="col-md-2">3 Adult</div>
                            <div class="col-md-2">4 Adult</div>
                            <div class="col-md-3">Extra Days Charge</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="bookingStartDate<?php echo $i; ?>" id="bookingStartDate<?php echo $i; ?>" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($resortRoomChargesDetails[$j]->bookingStartDate));?>" /></div>
                        <div class="col-md-8">
                            <div class="col-md-2"><input type="text" class="form-control" name="oneAdult<?php echo $i; ?>" id="oneAdult<?php echo $i; ?>" onblur="myJsMain.update_price('<?php echo $i; ?>', this.value);" value="<?php echo $resortRoomChargesDetails[$j]->oneAdult;?>"/></div>
                            <div class="col-md-3"><input type="text" class="form-control" name="twoAdult<?php echo $i; ?>" id="twoAdult<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->twoAdult;?>"/></div>
                            <div class="col-md-2"><input type="text" class="form-control" name="threeAdult<?php echo $i; ?>" id="threeAdult<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->threeAdult;?>"/></div>
                            <div class="col-md-2"><input type="text" class="form-control" name="fourAdult<?php echo $i; ?>" id="fourAdult<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->fourAdult;?>"/></div>
                            <div class="col-md-3"><input type="text" class="form-control" name="extraPerAdult<?php echo $i; ?>" id="extraPerAdult<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->extraPerAdult;?>"/></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Booking period <?php echo $i; ?> End date</div>
                        <div class="col-md-8">
                            <div class="col-md-2">Child Rate</div>
                            <div class="col-md-3">Max Children</div>
                            <div class="col-md-2">Infant Rate</div>
                            <div class="col-md-2">Max Infant</div>
                            <div class="col-md-3">Extra Charge @child</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="bookingEndDate<?php echo $i; ?>" id="bookingEndDate<?php echo $i; ?>" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($resortRoomChargesDetails[$j]->bookingEndDate));?>"/></div>
                        <div class="col-md-8">
                            <div class="col-md-2"><input type="text" class="form-control" name="childRate<?php echo $i; ?>" id="childRate<?php echo $i; ?>" onblur="$('#extraChargesForInfantChild<?php echo $i; ?>').val(this.value);
                                                                $('#infantRate<?php echo $i; ?>').val(this.value);" value="<?php echo $resortRoomChargesDetails[$j]->childRate;?>"/></div>
                            <div class="col-md-3"><input type="text" class="form-control" name="maxChild<?php echo $i; ?>" id="maxChild<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->maxChild;?>"/></div>
                            <div class="col-md-2"><input type="text" class="form-control" name="infantRate<?php echo $i; ?>" id="infantRate<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->infantRate;?>"/></div>
                            <div class="col-md-2"><input type="text" class="form-control" name="maxInfant<?php echo $i; ?>" id="maxInfant<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->maxInfant;?>"/></div>
                            <div class="col-md-3"><input type="text" class="form-control" name="extraChargesForInfantChild<?php echo $i; ?>" id="extraChargesForInfantChild<?php echo $i; ?>" value="<?php echo $resortRoomChargesDetails[$j]->extraChargesForInfantChild;?>"/></div>
                        </div>
                    </div>
                <?php $j++; endfor; ?>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><label></label></td>
            <td align="left" valign="top"><input type="submit" name="Submit3" value="Submit" class="btn btn-success"/>&nbsp;&nbsp;&nbsp;
                <input type="button" name="Submit22" value="Cancel" onclick="return CancelAdd();" class="btn btn-primary"/></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
    </table>
</form>
<?php echo $page_heading_end . $footer; ?>
<script type="text/javascript" src="<?php echo SiteAssetsURL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo SiteJSURL; ?>webadmin/misc-webadmin.js"></script>
<script>
    $(document).ready(function () {
        $("#AdminAdd").validate();
        jQuery('#bookingStartDate1').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingEndDate1').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingStartDate2').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingEndDate2').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        
    });
    myJsMain.load_booking_period();
    function CancelAdd(){
        location.href='<?php echo ADMIN_BASE_URL.'resort/view_rooms/'.$resortRoomDetails[0]->resortId?>';
    }
</script>