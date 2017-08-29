<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<td width="80%"><table cellspacing=5 cellpadding=5 width=90% border=0 >  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><div id="MessaeBox" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#009900; text-decoration:blink; text-align:center;"><?php echo $this->session->flashdata('AdminListPageMsg');?></div></td>
  </tr>
  <tr>
      <td style="padding-left:50px;"><input type="button" name="AddAdminBtn" id="AddAdminBtn" value="Add Admin" onclick="ShowAddAdminBox();" class="btn btn-primary"/></td>
  </tr>
<script language="javascript">

function ShowAddAdminBox()
{
	document.getElementById('MessaeBox').innerHTML="";
	document.getElementById('AdminEditBox').style.display='none';
	document.getElementById('AdminListBox').style.display='none';
	document.getElementById('AddAdminBtn').style.display='none';
	document.getElementById('AdminAddBox').style.display='';
}
 function ShowEditBox(id)
 {
 	document.getElementById('MessaeBox').innerHTML="";
	document.getElementById('AddAdminBtn').style.display='none';
	document.getElementById('AdminEditBox').style.display='';
	document.getElementById('userName').value=AdminDataArr[id]['userName'];
	document.getElementById('fullName').value=AdminDataArr[id]['fullName'];
	if(document.AdminEdit.status[0].value==AdminDataArr[id]['status'])
	{
		document.AdminEdit.status[0].checked=true;
	}else{
		document.AdminEdit.status[1].checked=true;
	}
	document.getElementById('adminId').value=AdminDataArr[id]['adminId'];
	document.getElementById('AdminListBox').style.display='none';
	document.getElementById('AdminAddBox').style.display='none';
 }

 function CancelEdit()
 {
 	document.getElementById('AddAdminBtn').style.display='';
	document.getElementById('AdminAddBox').style.display='none';
 	document.getElementById('AdminEditBox').style.display='none';
 	document.getElementById('AdminListBox').style.display='';
	return false;
 }
 
function AskDelete(id)
{
	if(confirm('Are you sure to delete(Y/N) ?'))
	{
		location.href='<?php echo base_url();?>webadmin/adminuser/delete/'+id;
	}
	return false;
}
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>
          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="AdminListBox" class="table table-bordered table-striped">
              <thead>
  <tr class="ListHeadingLable">
    <td width="5%">Sl No </td>
    <td width="35%">User Name </td>
    <td width="20%">Full Name </td>
    <td width="20%">status</td>
    <td width="20%">Action</td>
  </tr>
  </thead>
  <script language="javascript">
  var AdminDataArr=new Array(<?=count($DataArr)?>);
  </script>
  <tbody>
  <?php $val=0; 
  foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->userName;?></td>
    <td><?php echo $InerArr->fullName;?></td>
    <td> <?php 
	if($InerArr->status==1){$status='Active';}else{ $status='InActive';}
	echo anchor(base_url().'webadmin/adminuser/change_status/'.$InerArr->adminId.'/'.$InerArr->status, $status,array('name'=>$status,'class'=>'AdminDashBoardLinkText'))?>
	</td>
    <td><a href="#" onclick="javascript:ShowEditBox('<?php echo $InerArr->adminId?>')">Edit</a> &nbsp; <a href="#" onclick="javascript:AskDelete('<?php echo $InerArr->adminId?>');">Delete</a> </td> 
  </tr>
  <script language="javascript">
  AdminDataArr[<?php echo $InerArr->adminId?>]=new Array();
  AdminDataArr[<?php echo $InerArr->adminId?>]['adminId']='<?php echo $InerArr->adminId?>';
  AdminDataArr[<?php echo $InerArr->adminId?>]['userName']='<?php echo $InerArr->userName;?>';
  AdminDataArr[<?php echo $InerArr->adminId?>]['fullName']='<?php echo $InerArr->fullName;?>';
  AdminDataArr[<?php echo $InerArr->adminId?>]['status']='<?php echo $InerArr->status;?>';
  </script>
  <?php $val++;}?>
  </tbody>
  <tfoot>
      <tr class="ListHeadingLable">
    <td width="5%">Sl No </td>
    <td width="35%">User Name </td>
    <td width="20%">Full Name </td>
    <td width="20%">status</td>
    <td width="20%">Action</td>
  </tr>
  </tfoot>
</table></td>
  </tr>
 
  <tr>
      <td><form name="AdminEdit" id="AdminEdit" method="post" action="<?=base_url()?>webadmin/adminuser/edit/" onsubmit="return ValidateForm(this);">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="Ad minEditBox" style="display:none;">
  <tr>
    <th width="20%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="17%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="2%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="61%" align="left" valign="top" scope="col"><span class="PageHeading">Admin Edit </span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> userName </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="userName" type="text" id="userName" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Full Name </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="fullName" type="text" id="fullName" /></td>
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
    <td align="left" valign="top">Active
      <input name="status" type="radio" value="1" />
&nbsp;Inactive
<input name="status" type="radio" value="0" /></td>
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
    <td align="left" valign="top"><input type="submit" name="Submit" value="Update" />
      <input type="button" name="Submit2" value="Cancel" onclick="return CancelEdit();" />
<input name="adminId" type="hidden" id="adminId" /></td>
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
      <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=base_url()?>admin/adminuser/add" onsubmit="return ValidateForm(this);">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AdminAddBox" style="display:none;">
  <tr>
    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Admin Add</span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> userName </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="userName" type="text" id="userName" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Password</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="Password" type="password" id="Password" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Full Name </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="fullName" type="text" id="fullName" /></td>
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
    <td align="left" valign="top">Active
      <input name="status" type="radio" value="1" />
&nbsp;Inactive
<input name="status" type="radio" value="0" /></td>
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
    <td align="left" valign="top"><input type="submit" name="Submit3" value="Add Admin" />&nbsp;&nbsp;&nbsp;
      <input type="button" name="Submit22" value="Cancel" onclick="return CancelEdit();" /></td>
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

</table></td>
      </tr>
    </table></td>
  </tr>
  <?php echo $page_heading_end.$footer;?>
 <script type="text/javascript">
     $(document).ready(function(){
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