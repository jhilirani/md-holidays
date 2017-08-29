<?php //pre($DataArr);die('kk');?>
<?php echo $html_head . $body_start . $header . $left_menu . $page_heading_start; ?>
<link rel="stylesheet" href="<?php echo SiteAssetsURL ?>plugins/datepicker/datepicker3.css">
<table cellspacing=5 cellpadding=5 width=90% border=0 >

    <tr>
        <td style="padding-left:50px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="padding-left:10px;padding-bottom:10px;">
            <input type="button" name="AddBtn" id="AddBtn" value="Add Resort Room" onclick="ShowAddAdminBox();" class="btn btn-primary" accesskey="x"/>
        </td>
    </tr>
    <script language="javascript">
        function ShowAddAdminBox() {
            $('#MessaeBox').html("");
            $('#EditBox').hide();
            $('#AddBtn').hide();
            $('#PageHeading').hide();
            $('#ListBox_wrapper').fadeOut(500);
            //$('#ListBox').fadeOut(500);
            $('#AddBox').fadeIn(3500);
        }
        function CancelAdd() {
            $('#AddBox').fadeOut('fast');
            $('#EditBox').hide();
            $('#PageHeading').fadeIn(3000);
            $('#ListBox_wrapper').fadeIn(3000);
            $('#AddBtn').fadeIn(3000);
            return false;
        }

        function AskDelete(id) {
            swal({
                title: myJsMain.SystemMessageName,
                text: "Are you sure to delete(Y/N) ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false
            },
            function () {
                location.href = '<?php echo base_url() ?>webadmin/resort/delete_room/' + id+'/<?php echo $resortId;?>';
            });
            /*if(confirm('Are you sure to delete(Y/N) ?'))
             {
             location.href='<?php //echo base_url()   ?>admin/facility/delete/'+id;
             }*/
            return false;
        }
    </script>
    <tr>
        <td valign="top"> 

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="ListBox" style="border:#FBE554 1px solid;" class="table table-bordered table-striped">
                            <thead>
                                <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
                                    <td width="5%">Sl No </td>
                                    <td width="20%">Room Title </td>
                                    <td width="10%">Room Type </td>
                                    <td width="10%">Room Order No</td>
                                    <td width="10%">Room Image</td>
                                    <td width="10%">Room Tax and Service Charges</td>
                                    <td width="10%">Room Nos</td>
                                    <td width="10%">Room Status</td>
                                    <td width="20%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <script language="javascript">
                                var DataArr = new Array(<?= count($DataArr) ?>);
                            </script>
                            <?php
                            $val = 0;
                            if (count($DataArr) == 1 && $DataArr[0]['title'] == "") {
                                //pre($DataArr);die('mmmm');
                                ?>
                                <tr class="ListHeadingLable">
                                    <td colspan="9" style="text-align: center; height: 40px;"> No Report Found</td>
                                </tr>
                                <?php
                            } else {
                                //pre($DataArr);die('kkkk');
                                foreach ($DataArr as $InerArr) {
                                    ?>
                                    <tr class="ListTestLable" height="20px;">
                                        <td><?php echo $val + 1; ?></td>
                                        <td><?php echo $InerArr['title']; ?></td>
                                        <td><?php echo $InerArr['roomType']; ?></td>
                                        <td><?php echo $InerArr['orderNo']; ?></td>
                                        <td>
                                            <?php $imagePath=AssetsPath.'resort_room_image/100X100/'.$InerArr['image'];
                                            if(file_exists($imagePath)):?>
                                            <img src="<?php echo SiteAssetsURL.'resort_room_image/100X100/'.$InerArr['image'];?>" alt="<?php echo $InerArr['title']; ?>" title="<?php echo $InerArr['title']; ?>">
                                            <?php else:?>
                                            <img src="<?php echo SiteImagesURL.'no-image-100.png';?>" alt="<?php echo $InerArr['title']; ?>" title="<?php echo $InerArr['title']; ?>">
                                            <?php endif;?>
                                        </td>
                                        <td><?php echo $InerArr['taxAndServiceCharges']; ?></td>
                                        <td><?php echo $InerArr['totalNosRoom']; ?></td>
                                        <td><?php echo ($InerArr['status'] == '1') ? 'Active' : 'Inactive'; ?></td>
                                        <td>
                                            <?php
                                            if ($InerArr['status'] == '1') {
                                                $action = 0;
                                            } else {
                                                $action = 1;
                                            }
                                            ?>
                                            <a href="<?php echo ADMIN_BASE_URL . 'resort/change_room_status/' . $InerArr['resortRoomId'] . '/' . $action.'/'.$resortId; ?>" class="AdminDashBoardLinkText"><?php if ($InerArr['status'] == '1') { ?><i class="fa fa-check-circle fa-lg" title="Active"></i><?php } else { ?><i class="fa fa-ban fa-lg" title="InActive"></i><?php } ?></a>
                                            &nbsp;&nbsp;
                                            <a href="<?php echo ADMIN_BASE_URL . 'resort/view_edit_room/' . $InerArr['resortRoomId']; ?>"  class="AdminDashBoardLinkText"><i class="fa fa-edit fa-lg" title="Edit"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:void(0);" alt="<?php echo $InerArr['resortRoomId']; ?>"  class="AdminDashBoardLinkText viewChargesDetails"><i class="fa fa-eye fa-lg" title="Edit"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr['resortRoomId']; ?>');" class="AdminDashBoardLinkText"><i class="fa fa-remove fa-lg" title="Delete"></i></a>
                                        </td> 
                                    </tr>
                                    <?php
                                    $val++;
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td width="5%">Sl No </td>
                                    <td width="20%">Room Title </td>
                                    <td width="10%">Room Type </td>
                                    <td width="10%">Room Order No</td>
                                    <td width="10%">Room Image</td>
                                    <td width="10%">Room Tax and Service Charges</td>
                                    <td width="10%">Room Nos</td>
                                    <td width="10%">Room Status</td>
                                    <td width="20%">Action</td>
                                </tr>
                            </tfoot>
                        </table></td>
                </tr>

                <tr>
                    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?php echo base_url();?>webadmin/resort/add_room" enctype="multipart/form-data">
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
                                <tr>
                                    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
                                    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
                                    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
                                    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Resort Room Add <?php echo $resortTitle; ?></span></th>
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
                                    <td align="left" valign="top"><input name="title" type="text" id="title"  class="required form-control"  /></td>
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
                                            <?php foreach ($roomTypeDataArr AS $k): ?>
                                                <option value="<?php echo $k->roomTypeId; ?>"><?php echo $k->roomType; ?></option>
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
                                    <td align="left" valign="top">Select Resort Room Details</td>
                                    <td align="left" valign="top"><label><strong>:</strong></label></td>
                                    <td align="left" valign="top">
                                        <?php foreach($roomDetailsDataArr AS $k):?>
                                            <label class="checkbox-inline col-md-3">
                                                <input type="checkbox" name="roomDetails[]" required="required" value="<?php echo $k->roomDetailsId;?>"><?php echo $k->title;?>
                                            </label>
                                        <?php endforeach;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <?php $maxAdultPerRoomDataArr=array(1,2,3,4);?>
                                <tr>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">Select Number Adult can use room</td>
                                    <td align="left" valign="top"><label><strong>:</strong></label></td>
                                    <td align="left" valign="top">
                                        <select class="form-control" name="maxAdultPerRoom" id="maxAdultPerRoom">
                                            <?php foreach ($maxAdultPerRoomDataArr AS $k): ?>
                                                <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
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
                                    <td align="left" valign="top"><input type="text" name="orderNo" id="orderNo" class="form-control"></td>
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
                                    <td align="left" valign="top"><input type="text" name="totalNosRoom" id="totalNosRoom" class="form-control"></td>
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
                                    <td align="left" valign="top"><input type="text" name="taxAndServiceCharges" id="taxAndServiceCharges" class="form-control"></td>
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
                                    <td align="left" valign="top">
                                        <input type="text" name="roomDescription" id="roomDescription" class="form-control">
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
                                    <td align="left" valign="top">Browse room image</td>
                                    <td align="left" valign="top"><label><strong>:</strong></label></td>
                                    <td align="left" valign="top"><input type="file" name="resort_room_image" id="resort_room_image" class="form-control"></td>
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
                                    <td align="left" valign="top"><label class="radio-inline"><input type="radio" name="status" value="1" checked="" class="required">Active</label>
                                        <label class="radio-inline"><input type="radio" name="status" value="0"  class="required">Active</label></td>
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
                                    <td align="left" valign="top"><label class="radio-inline"><input type="radio" name="needPay" value="1" checked="" class="required">Yes</label>
                                        <label class="radio-inline"><input type="radio" name="needPay" value="0"  class="required">No</label></td>
                                <input type="hidden" name="resortId" id="resortId" value="<?php echo $resortId;?>">
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
                                        <select name="noOfBookingPeriod" id="noOfBookingPeriod" class="form-control">
                                            <option value="2" selected>2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
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
                                    <td align="left" valign="top" class="bookingPeriodBox" colspan="4">
                                        <?php for ($i = 1; $i < 3; $i++): ?>
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
                                                <div class="col-md-4"><input type="text" name="bookingStartDate<?php echo $i; ?>" id="bookingStartDate<?php echo $i; ?>" class="form-control datepicker" /></div>
                                                <div class="col-md-8">
                                                    <div class="col-md-2"><input type="text" class="form-control" name="oneAdult<?php echo $i; ?>" id="oneAdult<?php echo $i; ?>" onblur="myJsMain.update_price('<?php echo $i; ?>', this.value);"/></div>
                                                    <div class="col-md-3"><input type="text" class="form-control" name="twoAdult<?php echo $i; ?>" id="twoAdult<?php echo $i; ?>"/></div>
                                                    <div class="col-md-2"><input type="text" class="form-control" name="threeAdult<?php echo $i; ?>" id="threeAdult<?php echo $i; ?>"/></div>
                                                    <div class="col-md-2"><input type="text" class="form-control" name="fourAdult<?php echo $i; ?>" id="fourAdult<?php echo $i; ?>"/></div>
                                                    <div class="col-md-3"><input type="text" class="form-control" name="extraPerAdult<?php echo $i; ?>" id="extraPerAdult<?php echo $i; ?>"/></div>
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
                                                <div class="col-md-4"><input type="text" name="bookingEndDate<?php echo $i; ?>" id="bookingEndDate<?php echo $i; ?>" class="form-control datepicker" /></div>
                                                <div class="col-md-8">
                                                    <div class="col-md-2"><input type="text" class="form-control" name="childRate<?php echo $i; ?>" id="childRate<?php echo $i; ?>" onblur="$('#extraChargesForInfantChild<?php echo $i; ?>').val(this.value);$('#infantRate<?php echo $i; ?>').val(this.value);"/></div>
                                                    <div class="col-md-3"><input type="text" class="form-control" name="maxChild<?php echo $i; ?>" id="maxChild<?php echo $i; ?>"/></div>
                                                    <div class="col-md-2"><input type="text" class="form-control" name="infantRate<?php echo $i; ?>" id="infantRate<?php echo $i; ?>"/></div>
                                                    <div class="col-md-2"><input type="text" class="form-control" name="maxInfant<?php echo $i; ?>" id="maxInfant<?php echo $i; ?>"/></div>
                                                    <div class="col-md-3"><input type="text" class="form-control" name="extraChargesForInfantChild<?php echo $i; ?>" id="extraChargesForInfantChild<?php echo $i; ?>"/></div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
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
                        </form></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table></td>
    </tr>

</table>
<?php echo $page_heading_end . $footer; ?>
<script type="text/javascript" src="<?php echo SiteAssetsURL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo SiteJSURL; ?>webadmin/misc-webadmin.js"></script>
<script>
    $(document).ready(function () {
        $("#ListBox").DataTable({
            "paging": true,
            //"lengthChange": false,
            //"searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false
        });
        $("#AdminAdd").validate();
        jQuery('#bookingStartDate1').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingEndDate1').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingStartDate2').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        jQuery('#bookingEndDate2').datepicker({format: 'dd-mm-yyyy', todayHighlight: 'TRUE', autoclose: true, });
        
    });
    myJsMain.load_booking_period();
    myJsMain.show_charges_details();
</script>