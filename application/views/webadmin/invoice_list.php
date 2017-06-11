<?php echo $AdminHomeLeftPanel;

//print_r($UserDataArr);die;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr id="PageHeading">
    <td class="PageHeading" >Invooice Manager</td>
  </tr>

  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><div id="MessaeBox" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#009900; text-decoration:blink; text-align:center;"><?php echo $this->session->flashdata('Message');?></div></td>
  </tr>
  <tr>
    <td style="padding-left:10px;"><input type="button" name="AddBtn" id="AddBtn" value="Send Invoice Link to Customer" onclick="ShowAddAdminBox();" class="common_button"/></td>
  </tr>
<script language="javascript">

function ShowAddAdminBox()
{
	$('#MessaeBox').html("");
	$('#EditBox').hide();
	$('#AddBtn').hide();
	$('#PageHeading').hide();
	$('#ListBox').fadeOut(500);
	$('#AddBox').fadeIn(3500);
}function CancelAdd()
 {
 	$('#AddBox').fadeOut('fast');
 	$('#EditBox').hide();
	$('#PageHeading').fadeIn(3000);
	$('#ListBox').fadeIn(3000);
	$('#AddBtn').fadeIn(3000);
	return false;
 }
 
function AskDelete(id)
{
	if(confirm('Are you sure to delete(Y/N) ?'))
	{
		location.href='<?php echo base_url()?>admin/invoice/delete/'+id;
	}
	return false;
}
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="ListBox" style="border:#FBE554 1px solid;">
  <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
    <td width="5%">Sl No </td>
    <td width="10%">Invoice No </td>
    <td width="15%">User full Name</td>
    <td width="15%">User Email</td>
    <td width="10%">Course Name </td>
    <td width="10%">Order Date</td>
    <td width="10%">Status</td>
    <td width="20%">Action</td>
  </tr>
  <script language="javascript">
  var DataArr=new Array(<?=count($DataArr)?>);
  </script>
  <?php $val=0; 
  if(count($DataArr)>0){
  foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable" height="20px;">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->InvoiceNo;?></td>
    <td><?php echo $InerArr->FirstName.' '.$InerArr->LastName;?></td>
    <td><?php echo $InerArr->Email;?></td>
    <td><?php echo $InerArr->Title;?></td>
    <td><?php echo date('d-m-Y',strtotime($InerArr->Title));?></td>
    <td><?php echo ($InerArr->Status=='1')?'Active':'Inactive';?></td>
    <td>
	<?php if($InerArr->Status=='1'){$action=0;}else{$action=1;}?>
	<a href="<?php echo base_url().'admin/invoice/change_status/'.$InerArr->OrderID.'/'.$action;?>" class="AdminDashBoardLinkText"><?php if($InerArr->Status=='1'){?><img src="<?php echo $SiteImagesURL.'admin/';?>active1.png" alt="Inactive" title="Active" /><?php }else{?><img src="<?php echo $SiteImagesURL.'admin/';?>inactive1.png" alt="Inactive" title="Inactive" /><?php }?></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="ShowEditBox('<?php echo $InerArr->OrderID;?>');" class="AdminDashBoardLinkText"><img src="<?php echo $SiteImagesURL.'admin/';?>edit.png" width="15" height="15" title="Edit"/></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->OrderID;?>');" class="AdminDashBoardLinkText"><img src="<?php echo $SiteImagesURL.'admin/';?>delete.png" width="15" height="15" title="Delete"/></a>
	</td> 
  </tr>
  <script language="javascript">
  DataArr[<?php echo $InerArr->OrderID?>]=new Array();
  DataArr[<?php echo $InerArr->OrderID?>]['OrderID']='<?php echo $InerArr->OrderID?>';
  DataArr[<?php echo $InerArr->OrderID?>]['InvoiceNo']='<?php echo $InerArr->InvoiceNo?>';
  DataArr[<?php echo $InerArr->OrderID?>]['Status']='<?php echo $InerArr->Status?>';
  </script>
  <?php $val++;}
  }else{?>
  <tr class="ListHeadingLable">
    <td colspan="6" style="text-align: center; height: 40px;"> No Report Found</td>
  </tr>
  <?php }?>
</table></td>
  </tr>
 
  <tr>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?php echo base_url();?>admin/invoice/send_link_user" >
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
  <tr>
    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Send Invoice to User</span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Select Course Type</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><select name="CategoryID" id="CategoryID" class="required">
                            <option value="">*Select*</option>
                            <?php foreach($AllCategory AS $k){?>
                            <option value="<?php echo $k->CategoryID;?>"><?php echo $k->CategoryName;?></option>
                            <?php }?>
                        </select></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Select Course</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
                    <div id="CourseDiv">
                        <label>Select Course</label>
                    </div>
    <input type="hidden" id="CourseData" name="CourseData" value="" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Course Charges</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><label id="CourseChargesLbl"><?php echo 'Select Course';?></label>
                    <input type="hidden" name="CourseCharges" id="CourseCharges" value="" />
                    <input type="hidden" name="Discount" id="Discount" value="" />
                    <div id="CountrseDiscountDiv" style="display:none;">$ <label id="CountrseDiscountLbl" style="font-size:16px;font-weight: bold;text-decoration: line-through;color: red;"></label></div></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">First Name</td>
    <td align="left" valign="top">:</td>
    <td align="left" valign="top"><input type="text" name="FirstName" id="FirstName" class="textfield_bg required" value=""/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Last Name</td>
    <td align="left" valign="top">:</td>
    <td align="left" valign="top"><input type="text" name="LastName" id="LastName" class="textfield_bg required" value=""/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  
  <tr class="ListHeadingLable">
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">User Email</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="Email" type="text" id="Email"  class="required email" /></td>
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
    <td align="left" valign="top"><input type="submit" name="Submit3" value="Submit" class="common_button"/>&nbsp;&nbsp;&nbsp;
      <input type="button" name="Submit22" value="Cancel" onclick="return CancelAdd();" class="common_button"/></td>
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
</form></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table></td>
  </tr>

</table>
<?php echo $AdminHomeRest;?>
<script>
$(document).ready(function(){
	$("#AdminAdd").validate();	
	
        $('#CategoryID').live('change',function(){
            $('#CountrseDiscountDiv').hide();
            var invalidData="<select id='CourseID' id='CourseID' class='required'><option value=''>*Select Course*</option></select>";
            
            if($(this).val()==''){
                $('#CourseDiv').html(invalidData);
                $('#CourseData').val('');
                $('#CourseChargesLbl').text('Select Course');
                $('#CourseCharges').val('');
                return false;
            }
            var img='<img src="<?php echo $SiteImagesURL.'ajax_img.gif';?>" alt=""/>';
            $('#CourseDiv').html(img);
            var ajaxUrl='<?php echo base_url().'index/ajax_course'?>';
            var ajaxData='CategoryID='+$(this).val();
            //alert(ajaxData);
            $.ajax({
                type:"POST",
                url:ajaxUrl,
                data:ajaxData,
                success:function(msg){
                    if(msg=="0"){
                        alert('There is not course availble for thise selected course type.');
                        $('#CourseDiv').html(invalidData);
                        $('#CourseData').val('');
                        $('#CourseChargesLbl').text('Select Course');
                        $('#CourseCharges').val('');
                    }else{
                        var msgArr=msg.split('~');
                        $('#CourseDiv').html(msgArr[0]);
                        $('#CourseData').val(msgArr[1]);
                    }
                }
            });
        });
        
        $('#CourseID').live('change',function(){
            var PriceData=$('#CourseData').val();
            //alert($("select[name='CourseID'] option:selected").index());
            var idx=$("select[name='CourseID'] option:selected").index();
            var PriceIdx=idx-1;
            if(PriceData!=""){
                PriceDataArr=PriceData.split('^');
                //alert(PriceDataArr[PriceIdx]);
                var price_discount_arr=PriceDataArr[PriceIdx].split('@');
                var final_price=parseFloat(price_discount_arr[0])-parseFloat(price_discount_arr[1]);
                $('#CourseChargesLbl').text('$'+final_price);
                $('#CourseCharges').val(parseFloat(price_discount_arr[0]));
                $('#Discount').val(parseFloat(price_discount_arr[1]));
                if(parseInt(price_discount_arr[1])!=0){
                    $('#CountrseDiscountLbl').text(price_discount_arr[0]);
                    $('#CountrseDiscountDiv').show();
                }else{
                    $('#CountrseDiscountDiv').hide();
                }
            }
        })
});
</script>