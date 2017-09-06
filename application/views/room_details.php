<style>
    td{color: black !important;}
    td .headingStr{color: black !important;font-size: 15px !important;font-weight:bold;}
    td .headingStrRow{text-color: black !important;font-size: 13px !important;font-weight:bold;margin-right: 10px !important;}
</style>
<table width="105%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox">
    <tr>
        <td colspan="4">
            <div class="col-md-3 headingStr">Resort Room Title</div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->title;?></div>
            <div class="col-md-3 headingStr">Select Resort Room Type</div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->roomType;?></div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="4">
            <div class="col-md-3 headingStr">Total Number of rooms</div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->totalNosRoom;?></div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="4">
            <div class="col-md-3 headingStr">Tax and Service Charges</div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->taxAndServiceCharges;?></div>
            <div class="col-md-3 headingStr">Description</div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->roomDescription;?></div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr class="ListHeadingLable">
        <td align="left" valign="top" colspan="4">
            <div class="col-md-3 headingStr">Status</div>
            <div class="col-md-3"><?php echo ($resortRoomDetails[0]->status==1) ? 'ACtive' :'Inactive';?></div>
            <div class="col-md-3 headingStr">Pay while booking</div>
            <div class="col-md-3"><?php echo ($resortRoomDetails[0]->needPay==1) ? 'Yes' :'No';?></div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
    <?php $tot=count($resortRoomChargesDetails); //die;?>
    <tr>
        <td align="left" valign="top" class="bookingPeriodBox" colspan="4">
            <?php for ($i = 0; $i < $tot; $i++): ?>
                <div class="row headingStrRow">
                    <div class="col-md-3">Booking period <?php echo $i+1; ?> start date</div>
                    <div class="col-md-9">
                        <div class="col-md-2">1 Adult</div>
                        <div class="col-md-3">2 Adult</div>
                        <div class="col-md-2">3 Adult</div>
                        <div class="col-md-2">4 Adult</div>
                        <div class="col-md-3">Extra Days Charge</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><?php echo date('D-m-Y',strtotime($resortRoomChargesDetails[$i]->bookingStartDate));?></div>
                    <div class="col-md-9">
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->oneAdult;?></div>
                        <div class="col-md-3"><?php echo $resortRoomChargesDetails[$i]->twoAdult;?></div>
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->threeAdult;?></div>
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->fourAdult;?></div>
                        <div class="col-md-3"><?php echo $resortRoomChargesDetails[$i]->extraPerAdult;?></div>
                    </div>
                </div>
                <div class="row headingStrRow">
                    <div class="col-md-3">Booking period <?php echo $i+1; ?> End date</div>
                    <div class="col-md-9">
                        <div class="col-md-2">Child Rate</div>
                        <div class="col-md-3">Max Children</div>
                        <div class="col-md-2">Infant Rate</div>
                        <div class="col-md-2">Max Infant</div>
                        <div class="col-md-3">Extra Charge @child</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><?php echo date('D-m-Y',strtotime($resortRoomChargesDetails[$i]->bookingEndDate));?></div>
                    <div class="col-md-9">
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->childRate;?></div>
                        <div class="col-md-3"><?php echo $resortRoomChargesDetails[$i]->maxChild;?></div>
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->infantRate;?></div>
                        <div class="col-md-2"><?php echo $resortRoomChargesDetails[$i]->maxInfant;?></div>
                        <div class="col-md-3"><?php echo $resortRoomChargesDetails[$i]->extraChargesForInfantChild;?></div>
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
        <td align="left" valign="top" class="text-center" colspan="4"><button class="btn btn-primary bookNowPopupBtn" onclick="location.href='<?php echo BASE_URL.'book-resort/'.$strurl.'/'.$resortRoomId*50250341;?>';">Book Now, Pay Latter</button></td>
    </tr>
    <input type="hidden" name="strurl" id="strurl" value="<?php echo $strurl;?>" />
</table>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('.bookNowPopupBtn').on('click','body',function(){
            //alert('kk');
        });
    });
</script>