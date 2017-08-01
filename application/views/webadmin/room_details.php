<table width="105%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox">
    <tr>
        <td colspan="4">
            <div class="col-md-3"><strong>Resort Room Title</strong></div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->title;?></div>
            <div class="col-md-3"><strong>Select Resort Room Type</strong></div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->roomType;?></div>
        </td>
    </tr>
    
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="4">
            <div class="col-md-3"><strong>Order No</strong></div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->orderNo;?></div>
            <div class="col-md-3"><strong>Total Number of rooms</strong></div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->totalNosRoom;?></div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="4">
            <div class="col-md-3"><strong>Tax and Service Charges</strong></div>
            <div class="col-md-3"><?php echo $resortRoomDetails[0]->taxAndServiceCharges;?></div>
            <div class="col-md-3"><strong>Description</strong></div>
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
            <div class="col-md-3"><strong>Status</strong></div>
            <div class="col-md-3"><?php echo ($resortRoomDetails[0]->status==1) ? 'ACtive' :'Inactive';?></div>
            <div class="col-md-3"><strong>Pay while booking</strong></div>
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
                <div class="row">
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
                <div class="row">
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
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr>
</table>