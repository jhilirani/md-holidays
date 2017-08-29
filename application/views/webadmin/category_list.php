<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  
  <tr>
        <td style="padding-left:10px;padding-bottom:10px;">
            <?php if(count($DataArr)<4):?>
            <input type="button" name="AddBtn" id="AddBtn" value="Add Category" onclick="ShowAddAdminBox();" class="btn btn-primary"/>
            <?php endif;?>
        </td>
  </tr>
<script language="javascript">

function ShowAddAdminBox()
{
	$('#MessaeBox').html("");
	$('#EditBox').hide();
	$('#AddBtn').hide();
	$('#PageHeading').hide();
	$('#ListBox_wrapper').fadeOut(500);
	//$('#ListBox').fadeOut(500);
	$('#AddBox').fadeIn(3500);
}
 function ShowEditBox(id)
 {
     location.href='<?php echo ADMIN_BASE_URL.'category/view_edit/';?>'+id;
 	<?php /*$('#MessaeBox').html("");
	$('#AddBtn').fadeOut();
	$('#PageHeading').fadeOut();
	$('#AddBox').fadeOut();
	$('#ListBox_wrapper').fadeOut(400);
	
	$('#EditBox').fadeIn(2500);
	$('#EditUserFullName').text(DataArr[id]['categoryName']+' '+DataArr[id]['categoryName']);
	$('#EditcategoryName').val(DataArr[id]['categoryName']);
        $('#Edittype').val(DataArr[id]['type']);
	//$('#EditDescription').val(UserDataArr[id]['Description']);
	if(document.AdminEdit.Editstatus[0].value==DataArr[id]['status'])
	{
		document.AdminEdit.Editstatus[0].checked=true;
	}else{
		document.AdminEdit.Editstatus[1].checked=true;
	}
	$('#categoryId').val(DataArr[id]['categoryId']);
	<?php */?>
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
		location.href='<?php echo base_url()?>webadmin/category/delete/'+id;
	});
	/*if(confirm('Are you sure to delete(Y/N) ?'))
	{
		location.href='<?php //echo base_url()?>admin/category/delete/'+id;
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
    <td width="35%">Category Name </td>
    <td width="20%">Type </td>
    <td width="20%">status</td>
    <td width="20%">Action</td>
  </tr>
  </thead>
  <tbody>
  <script language="javascript">
  var DataArr=new Array(<?=count($DataArr)?>);
  </script>
  <?php $val=0; 
  if(count($DataArr)>0){
  foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable" height="20px;">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->categoryName;?></td>
    <td><?php echo ($InerArr->type==1) ? 'Resort' : 'Tour';?></td>
    <td><?php echo ($InerArr->status=='1')?'Active':'Inactive';?></td>
    <td>
	<?php if($InerArr->status=='1'){$action=0;}else{$action=1;}?>
	<a href="<?php echo ADMIN_BASE_URL.'category/change_status/'.$InerArr->categoryId.'/'.$action;?>" class="AdminDashBoardLinkText"><?php if($InerArr->status=='1'){?><img src="<?php echo SiteImagesURL.'webadmin/';?>active1.png" alt="Inactive" title="Active" /><?php }else{?><img src="<?php echo SiteImagesURL.'webadmin/';?>inactive1.png" alt="Inactive" title="Inactive" /><?php }?></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="ShowEditBox('<?php echo $InerArr->categoryId;?>');" class="AdminDashBoardLinkText"><img src="<?php echo SiteImagesURL.'webadmin/';?>edit.png" width="15" height="15" title="Edit"/></a>
	&nbsp;&nbsp;
	<a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->categoryId;?>');" class="AdminDashBoardLinkText"><img src="<?php echo SiteImagesURL.'webadmin/';?>delete.png" width="15" height="15" title="Delete"/></a>
	</td> 
  </tr>
  
  <?php $val++;} ?>
  </tbody>
  <?php }else{?>
  <tr class="ListHeadingLable">
    <td colspan="6" style="text-align: center; height: 40px;"> No Report Found</td>
  </tr>
  <?php }?>
  <tfoot>
  <tr>
    <td width="5%">Sl No </td>
    <td width="35%">Category Name </td>
    <td width="20%">Type</td>
    <td width="20%">status</td>
    <td width="20%">Action</td>
  </tr>
  </tfoot>
</table></td>
  </tr>
 
  <tr>
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=base_url()?>webadmin/category/add" >
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
  <tr>
    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Category Add</span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> Category Name </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="categoryName" type="text" id="categoryName"  class="required form-control"  /></td>
  </tr>
  <tr>
    <td align="left" valign="top" height="40px;">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Type </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
        <select name="type" id="type" class="form-control" required="required">
            <option value="" selected>Select Category</option>
            <option value="1">Resort</option>
            <option value="2">Tour</option>
        </select></td>
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
     $("#ListBox").DataTable({
      "paging": true,
      //"lengthChange": false,
      //"searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	$("#AdminAdd").validate();	
	
	$('#categoryName').live('blur',function(){
		var CheckUserNameAjaxURL='<?php echo ADMIN_BASE_URL.'ajax/check_category_name/'?>';
		var CheckUserNameAjaxData='categoryName='+$(this).val();
		$.ajax({
		   type: "POST",
		   url: CheckUserNameAjaxURL,
		   data: CheckUserNameAjaxData,
		   success: function(msg){
		   	if(msg=='1'){
				alert($('#categoryName').val()+' has already used,Please enter a new one.');
				$('#categoryName').val('');
				return false;
			}else{
				alert('rrr');
				return true;
			}
		   }
		 });
	});
	
	
	
	$('#EditcategoryName').live('blur',function(){
		var CheckEditUserNameAjaxURL='<?php echo ADMIN_BASE_URL.'ajax/check_edit_category_name/'?>';
		var CheckEditUserNameAjaxData='categoryName='+$(this).val()+'&categoryId='+$('#categoryId').val();
		$.ajax({
		   type: "POST",
		   url: CheckEditUserNameAjaxURL,
		   data: CheckEditUserNameAjaxData,
		   success: function(msg){ 
		   	if(msg=='1'){
				alert($('#EditcategoryName').val()+' has already used,Please enter a new one.');
				$('#EditcategoryName').val('');
				return false;
			}else{
				return true;
			}
		   }
		 });
	});
});
</script>