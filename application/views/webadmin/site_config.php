<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"></td>
  </tr>
<script language="javascript">
 function ShowEditBox(id){
 	$('#MessaeBox').html("");
	$('#AddBtn').hide();
	$('#PageHeading').hide();
	$('#EditBox').fadeIn(2000);
	$('#LabelconstantName').text(SiteConfigDataArr[id]['constantName']);
	$('#EditconstantValue').val(SiteConfigDataArr[id]['constantValue']);
	$('#Editdescription').val(SiteConfigDataArr[id]['description']);
	$('#constantId').val(SiteConfigDataArr[id]['constantId']);
	$('#ListBox_wrapper').hide();
	$('#AddBox').hide();
 }

 function CancelEdit(){
 	$('#AddBtn').hide();
	$('#AddBox').hide();
 	$('#EditBox').hide();
 	$('#ListBox_wrapper').show();
	$('#PageHeading').show();
	$('#AddAdminBtn').show();
	return false;
 }
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="ListBox" class="table table-bordered table-striped">
            <thead>
  <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
    <td width="5%">Sl No </td>
    <td width="35%">Constant Name </td>
    <td width="20%">Constant Value</td>
	<td width="20%">Constant description</td>
    <td width="20%">Action</td>
  </tr>
  </thead>
  <script language="javascript">
  var SiteConfigDataArr=new Array(<?=count($SiteConfigDataArr)?>);
  </script>
  <tbody>
  <?php $val=0; 
  //print_r($DataArr);
  foreach($SiteConfigDataArr as $InerArr){?>
  <tr class="ListTestLable">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->constantName;?></td>
    <td><?php echo $InerArr->constantValue;?></td>
    <td><?php echo $InerArr->description;?></td>
    <td><a href="javascript:void(0);" onclick="javascript:ShowEditBox('<?php echo $InerArr->constantId?>')"><img src="<?php echo SiteImagesURL.'webadmin/';?>edit.png" width="15" height="15" title="Edit"/></a></td> 
  </tr>
  <script language="javascript">
  SiteConfigDataArr[<?php echo $InerArr->constantId?>]=new Array();
  SiteConfigDataArr[<?php echo $InerArr->constantId?>]['constantId']='<?php echo $InerArr->constantId?>';
  SiteConfigDataArr[<?php echo $InerArr->constantId?>]['constantName']='<?php echo $InerArr->constantName;?>';
  SiteConfigDataArr[<?php echo $InerArr->constantId?>]['constantValue']='<?php echo $InerArr->constantValue;?>';
  SiteConfigDataArr[<?php echo $InerArr->constantId?>]['description']='<?php echo $InerArr->description;?>';
  
  </script>
  <?php $val++;}?>
  </tbody>
  <tfoot>
      <tr class="ListTestLable">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->constantName;?></td>
    <td><?php echo $InerArr->constantValue;?></td>
    <td><?php echo $InerArr->description;?></td>
    <td><a href="javascript:void(0);" onclick="javascript:ShowEditBox('<?php echo $InerArr->constantId?>')"><img src="<?php echo SiteImagesURL.'webadmin/';?>edit.png" width="15" height="15" title="Edit"/></a></td> 
  </tr>
  </tfoot>
</table></td>
  </tr>
 
  <tr>
    <td><form name="AdminEdit" id="AdminEdit" method="post" action="<?=base_url()?>webadmin/site_config/edit/">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="EditBox" style="display:none;">
  <tr>
    <th width="20%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="17%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="2%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="61%" align="left" valign="top" scope="col"><span class="PageHeading">Configuration Update </span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> Constant Name </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><label name="LabelconstantName" id="LabelconstantName"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Constant Value </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="EditconstantValue" type="text" id="EditconstantValue" class="required form-control"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr class="ListHeadingLable">
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">Editdescription</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input  type="text" name="Editdescription" id="Editdescription" value="" class="required form-control"/></td>
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
    <td align="left" valign="top"><input type="submit" name="Submit" value="Update"  class="btn btn-success"/>
      <input type="button" name="Submit2" value="Cancel" onclick="return CancelEdit();" class="btn btn-primary" />
<input name="constantId" type="hidden" id="constantId" value="" /></td>
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