<?php echo $html_head;?>
<?php echo $header;?>
<link href="<?=$SiteCSSURL.'admin.css'?>" rel="stylesheet" type="text/css">
<script language="JavaScript" src=<?=$SiteJSURL?>validator.js></script>
<?php echo $left;?><td width="80%"><table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr>
    <td class="PageHeading">Admin Manager</td>
  </tr>

  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><div id="MessaeBox" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#009900; text-decoration:blink; text-align:center;"><?php echo $this->session->flashdata('AdminListPageMsg');?></div></td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><input type="button" name="AddAdminBtn" id="AddAdminBtn" value="Add Admin" onclick="ShowAddAdminBox();"/></td>
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
	document.getElementById('UserName').value=AdminDataArr[id]['UserName'];
	document.getElementById('FullName').value=AdminDataArr[id]['FullName'];
	if(document.AdminEdit.Status[0].value==AdminDataArr[id]['Status'])
	{
		document.AdminEdit.Status[0].checked=true;
	}else{
		document.AdminEdit.Status[1].checked=true;
	}
	document.getElementById('AdminID').value=AdminDataArr[id]['AdminID'];
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
		location.href='<?php echo $BaseURL?>admin/adminuser/delete/'+id;
	}
	return false;
}
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="AdminListBox">
  <tr class="ListHeadingLable">
    <td width="5%">Sl No </td>
    <td width="35%">User Name </td>
    <td width="20%">Full Name </td>
    <td width="20%">Status</td>
    <td width="20%">Action</td>
  </tr>
  <script language="javascript">
  var AdminDataArr=new Array(<?=$NoOfRec?>);
  </script>
  <?php $val=0; 
  //print_r($DataArr);
  foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->UserName;?></td>
    <td><?php echo $InerArr->FullName;?></td>
    <td> <?php 
	if($InerArr->Status==1){$Status='Active';}else{ $Status='InActive';}
	
	echo anchor($BaseURL.'admin/adminuser/change_status/'.$InerArr->AdminID.'/'.$InerArr->Status, $Status,array('name'=>$Status,'class'=>'AdminDashBoardLinkText'))?>
	
	
	<?php ?></td>
    <td><a href="#" onclick="javascript:ShowEditBox('<?php echo $InerArr->AdminID?>')">Edit</a> &nbsp; <a href="#" onclick="javascript:AskDelete('<?php echo $InerArr->AdminID?>');">Delete</a> </td> 
  </tr>
  <script language="javascript">
  AdminDataArr[<?php echo $InerArr->AdminID?>]=new Array();
  AdminDataArr[<?php echo $InerArr->AdminID?>]['AdminID']='<?php echo $InerArr->AdminID?>';
  AdminDataArr[<?php echo $InerArr->AdminID?>]['UserName']='<?php echo $InerArr->UserName;?>';
  AdminDataArr[<?php echo $InerArr->AdminID?>]['FullName']='<?php echo $InerArr->FullName;?>';
  AdminDataArr[<?php echo $InerArr->AdminID?>]['Status']='<?php echo $InerArr->Status;?>';
  
  </script>
  <?php $val++;}?>
</table></td>
  </tr>
 
  <tr>
    <td><form name="AdminEdit" id="AdminEdit" method="post" action="<?=$BaseURL?>admin/adminuser/edit/" onsubmit="return ValidateForm(this);">
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AdminEditBox" style="display:none;">
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
    <td align="left" valign="top" class="ListHeadingLable"> UserName </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="UserName" type="text" id="UserName" /></td>
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
    <td align="left" valign="top"><input name="FullName" type="text" id="FullName" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr class="ListHeadingLable">
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">Status</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">Active
      <input name="Status" type="radio" value="1" />
&nbsp;Inactive
<input name="Status" type="radio" value="0" /></td>
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
<input name="AdminID" type="hidden" id="AdminID" /><input type="hidden" name="Validation" 
						  value="Field=UserName|Alias=User Name|Validate=EMAIL^
								Field=FullName|Alias=FullName|Validate=BLANK^
								Field=Status|Alias=Active|Validate=SELECT"></td>
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
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=$BaseURL?>admin/adminuser/add" onsubmit="return ValidateForm(this);">
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
    <td align="left" valign="top" class="ListHeadingLable"> UserName </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="UserName" type="text" id="UserName" /></td>
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
    <td align="left" valign="top"><input name="FullName" type="text" id="FullName" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr class="ListHeadingLable">
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">Status</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">Active
      <input name="Status" type="radio" value="1" />
&nbsp;Inactive
<input name="Status" type="radio" value="0" /></td>
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
      <input type="button" name="Submit22" value="Cancel" onclick="return CancelEdit();" />
	   <input type="hidden" name="Validation" 
						  value="Field=UserName|Alias=User Name|Validate=EMAIL^
						  		Field=Password|Alias=Password|Validate=BLANK^
								Field=FullName|Alias=FullName|Validate=BLANK^
								Field=Status|Alias=Active|Validate=SELECT"></td>
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
  <?php echo $footer;?>