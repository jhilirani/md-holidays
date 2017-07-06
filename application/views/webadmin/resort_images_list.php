<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;padding-bottom:10px;">
        <input type="button" name="AddBtn" id="AddBtn" value="Add Resort" onclick="ShowAddAdminBox();" class="btn btn-primary" accesskey="x"/>
    </td>
  </tr>
<script language="javascript">
function ShowAddAdminBox(){
	$('#MessaeBox').html("");
	$('#AddBtn').hide();
	$('#PageHeading').hide();
	$('#ListBox_wrapper').fadeOut(500);
	//$('#ListBox').fadeOut(500);
	$('#AddBox').fadeIn(3500);
}
 function CancelAdd(){
 	$('#AddBox').fadeOut('fast');
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
		location.href='<?php echo base_url()?>webadmin/resort/delete/'+id;
	});
	return false;
}
 </script>
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="" style="border:#FBE554 1px solid;" class="table table-bordered table-striped">
        <tr height="20px;">
          <td>
              <?php $val=0; 
              foreach($DataArr as $InerArr){
                  $images=AsseUploadsPathtsPath.'resort/100X100/';
                  if(file_exists($images)){?>
              <div class="col-md-4">
                  <img src="<?php echo ResortSmallImageURL.$InerArr->image?>" alt="<?php echo $InerArr->caption;?>" class="img-responsive img-thumbnail" />
                  <div>
                      <?php if($InerArr->status=='1'){$action=0;}else{$action=1;}?>
                        <a href="<?php echo ADMIN_BASE_URL.'resort/change_status/'.$InerArr->resortId.'/'.$action;?>" class="AdminDashBoardLinkText"><?php if($InerArr->status=='1'){?><i class="fa fa-check-circle fa-lg" title="Active"></i><?php }else{?><i class="fa fa-ban fa-lg" title="InActive"></i><?php }?></a>
                        &nbsp;&nbsp;
              <a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->resortId;?>');" class="AdminDashBoardLinkText"><i class="fa fa-remove fa-lg"></i></a>
                  </div>
              </div>
              <?php }
              }?>
          </td>
        </tr>
</table></td>
  </tr>
 
  <tr>
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=base_url()?>webadmin/resort/add_image" >
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
  <tr>
    <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Add Resort </span></th>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable"> Resort Name </td>
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
    <td align="left" valign="top" class="ListHeadingLable">Overview</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><textarea name="overview" id="overview" class="required form-control"></textarea></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">latitude </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="latitude" type="text" id="latitude"  class="required form-control" maxlength="25"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">longitude </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="longitude" type="text" id="longitude"  class="required form-control" maxlength="25"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Location </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="location" type="text" id="location"  class="required form-control" maxlength="50"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Contact Information </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
        <textarea name="contactInfo" id="contactInfo" class="required form-control"></textarea>
        <?php echo display_ckeditor($ckeditor);?>
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
    <td align="left" valign="top" class="ListHeadingLable">Max Zoom Level </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
        <select name="mapZoomLevel" id="mapZoomLevel" class="form-control">
            <option value="1" selected>1</option>
            <?php for($i=2;$i<11;$i++):?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php endfor;?>
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
    <td align="left" valign="top" class="ListHeadingLable">Meta title </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><input name="metaTitle" type="text" id="metaTitle"  class="required form-control"/></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Meta Key Word </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><textarea name="metaKeywords" id="metaKeywords" class="required form-control"></textarea></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Meta Description </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top"><textarea name="metaDescription" id="metaDescription" class="required form-control"></textarea></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Select Factfile </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
    <?php foreach($factfileDataArr AS $k):?>
        <label class="checkbox-inline col-md-3">
            <input type="checkbox" name="factfile[]" value="<?php echo $k->factfileId;?>" required="required"/><?php echo $k->factfile;?>
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
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Select Facility </td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
        <?php foreach($facilityDataArr AS $k):?>
        <label class="checkbox-inline col-md-3">
            <input type="checkbox" name="facility[]" value="<?php echo $k->facilityId;?>" required="required"><?php echo $k->facility;?>
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
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" class="ListHeadingLable">Select Sports and Recreation</td>
    <td align="left" valign="top"><label><strong>:</strong></label></td>
    <td align="left" valign="top">
        <?php foreach($sportsRecreationDataArr AS $k):?>
            <label class="checkbox-inline col-md-3">
                <input type="checkbox" name="sportsRecreation[]" required="required" value="<?php echo $k->sportsRecreationId;?>"><?php echo $k->sportsRecreation;?>
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