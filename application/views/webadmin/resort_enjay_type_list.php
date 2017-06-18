<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:10px;"><input type="button" name="AddBtn" id="AddBtn" value="Add Resort enjay type" onclick="ShowAddAdminBox();" class="btn btn-primary"/></td>
  </tr>
<script language="javascript">

function ShowAddAdminBox(){
	$('#MessaeBox').html("");
	$('#EditBox').hide();
	$('#AddBtn').hide();
	$('#PageHeading').hide();
	$('#ListBox_wrapper').fadeOut(500);
	$('#AddBox').fadeIn(3500);
}
 function ShowEditBox(id){
 	$('#MessaeBox').html("");
	$('#AddBtn').fadeOut();
	$('#PageHeading').fadeOut();
	$('#AddBox').fadeOut();
	$('#ListBox_wrapper').fadeOut(400);
	
	$('#EditBox').fadeIn(2500);
	$('#Editname').val(DataArr[id]['name']);
	$('#Editurl').val(DataArr[id]['url']);
	$('#Editimage').val(DataArr[id]['image']);
	if(document.AdminEdit.Editstatus[0].value==DataArr[id]['status'])
	{
		document.AdminEdit.Editstatus[0].checked=true;
	}else{
		document.AdminEdit.Editstatus[1].checked=true;
	}
	$('#resortEnjoyTypeId').val(DataArr[id]['resortEnjoyTypeId']);
	
 }

 function CancelEdit()
 {
	$('#AddBox').hide();
	$('#PageHeading').fadeIn(3000);
	$('#ListBox_wrapper').fadeIn(3000);
	$('#AddBtn').fadeIn(3000);
	$('#EditBox').fadeOut(3500);
	return false;
 }
 function CancelAdd()
 {
 	$('#AddBox').fadeOut('fast');
 	$('#EditBox').hide();
	$('#PageHeading').fadeIn(3000);
	$('#ListBox_wrapper').fadeIn(3000);
	$('#AddBtn').fadeIn(3000);
	return false;
 }
 
function AskDelete(id){
    swal({
            title: myJsMain.SystemMessageName,
            text: "Are you sure to delete(Y/N) ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
	},
	function(){
            location.href='<?php echo base_url()?>webadmin/resort_enjay_type/delete/'+id;
	});
}
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="ListBox" style="border:#FBE554 1px solid;" class="table-bordered table-striped">
            <thead>
  <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
    <td width="10%">Sl No </td>
    <td width="20%">Image</td>
    <td width="20%">Caption</td>
    <td width="10%">status</td>
    <td width="20%">Action</td>
  </tr>
  </thead>
  <script language="javascript">
  var DataArr=new Array(<?=count($DataArr)?>);
  </script>
  <?php $val=0; 
  if(count($DataArr)>0){?>
  <tbody>
  <?php foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable" height="20px;">
    <td><?php echo $val+1;?></td>
    <td><img src="<?php echo SiteAssetsURL.'resort_enjay_type/150X150/'.$InerArr->image;?>" alt="" height="70px" width="130px"/></td>
    <td><?php echo $InerArr->name;?></td>
    <td><?php echo ($InerArr->status=='1')?'Active':'Inactive';?></td>
    <td>
	<?php if($InerArr->status=='1'){$action=0;}else{$action=1;}?>
	<a href="<?php echo base_url().'webadmin/resort_enjay_type/change_status/'.$InerArr->resortEnjoyTypeId.'/'.$action;?>" class="AdminDashBoardLinkText"><?php if($InerArr->status=='1'){?><img src="<?php echo SiteImagesURL.'webadmin/';?>active1.png" alt="Inactive" title="Active" /><?php }else{?><img src="<?php echo SiteImagesURL.'webadmin/';?>inactive1.png" alt="Inactive" title="Inactive" /><?php }?></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="ShowEditBox('<?php echo $InerArr->resortEnjoyTypeId;?>');" class="AdminDashBoardLinkText"><img src="<?php echo SiteImagesURL.'webadmin/';?>edit.png" width="15" height="15" title="Edit"/></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->resortEnjoyTypeId;?>');" class="AdminDashBoardLinkText"><img src="<?php echo SiteImagesURL.'webadmin/';?>delete.png" width="15" height="15" title="Delete"/></a>
	</td> 
  </tr>
  <script language="javascript">
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]=new Array();
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]['resortEnjoyTypeId']='<?php echo $InerArr->resortEnjoyTypeId?>';
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]['image']='<?php echo $InerArr->image?>';
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]['name']='<?php echo $InerArr->name?>';
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]['url']='<?php echo $InerArr->url?>';
  DataArr[<?php echo $InerArr->resortEnjoyTypeId?>]['status']='<?php echo $InerArr->status?>';
  </script>
  <?php $val++;}?>
  </tbody>
  <?php }else{?>
  <tr class="ListHeadingLable">
    <td colspan="6" style="text-align: center; height: 40px;"> No Report Found</td>
  </tr>
  <?php }?>
  <tfoot>
    <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
        <td width="10%">Sl No </td>
        <td width="20%">Image</td>
        <td width="20%">Caption</td>
        <td width="10%">status</td>
        <td width="20%">Action</td>
    </tr>
  </tfoot>
</table></td>
  </tr>
 
  <tr>
    <td><form name="AdminEdit" id="AdminEdit" method="post" action="<?=base_url()?>webadmin/resort_enjay_type/edit/" enctype="multipart/form-data">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="EditBox" style="display:none;">
  <tr>
    <th colspan="4"><span class="PageHeading">Resort enjay type Edit Form</span></th>
  </tr>
  <tr>
    <td align="left" valign="top" height="40px;">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> Resort enjay type image </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input  type="file" name="Editresort_enjay_type" id="Editresort_enjay_type"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Image Caption </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input  type="text" name="Editname" id="Editname" class="form-control"/></td>
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
    <td align="left" valign="top"><label class="radio-inline"><input type="radio" name="Editstatus" value="1" checked="" class="required">Active</label>
        <label class="radio-inline"><input type="radio" name="Editstatus" value="0"  class="required">Active</label></td>
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
      <input type="button" name="Submit22" value="Cancel" onclick="return CancelAdd();" class="btn btn-primary"/>
	  <input  type="hidden" name="resortEnjoyTypeId"  id="resortEnjoyTypeId" value=""/>
	  <input  type="hidden" name="Editimage" id="Editimage" value=""/></td>
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
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=base_url()?>webadmin/resort_enjay_type/add"  enctype="multipart/form-data">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
  <tr>
    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Resort enjay type Add From</span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> Resort enjay type image </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input  type="file" name="resort_enjay_type" id="resort_enjay_type" class="required"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Image Caption </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input  type="text" name="name" id="name" class="form-control"/></td>
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
    <td align="left" valign="top"><label class="radio-inline"><input type="radio" name="Editstatus" value="1" checked="" class="required">Active</label>
        <label class="radio-inline"><input type="radio" name="Editstatus" value="0"  class="required">Active</label></td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table></td>
  </tr>

</table>
<?php echo $page_heading_end.$footer;?>
<script>
$(document).ready(function(){
	$("#AdminAdd").validate();
    $("#ListBox").DataTable({
      "paging": true,
      //"lengthChange": false,
      //"searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
});
</script>