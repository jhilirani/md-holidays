<?php
echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  
<tr>
    <td style="padding-left:5px;"><span class="PageHeading">Resort Edit for <?php echo $dataArr[0]->title?></span></td>
  </tr>
  
  <tr>
    <td style="padding-left:5px;">&nbsp;</td>
  </tr>
  
  <tr>
  <td valign="top"> 
  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30px;"></td>
  </tr>
  
  <tr>
    <td><form name="AdminAdd" id="AdminAdd" method="post" action="<?=base_url()?>webadmin/resort/edit" >
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox">
  <tr>
    <th width="9%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
    <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
    <th width="70%" align="left" valign="top" scope="col"></th>
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
    <td align="left" valign="top"><input name="title" type="text" id="title" value="<?php echo $dataArr[0]->title;?>"  class="required form-control"  /></td>
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
    <td align="left" valign="top"><textarea name="overview" id="overview" class="required form-control"><?php echo $dataArr[0]->overview;?></textarea></td>
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
    <td align="left" valign="top"><input name="latitude" type="text" id="latitude" value="<?php echo $dataArr[0]->latitude;?>"  class="required form-control" maxlength="25"/></td>
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
    <td align="left" valign="top"><input name="longitude" type="text" id="longitude" value="<?php echo $dataArr[0]->longitude;?>"  class="required form-control" maxlength="25"/></td>
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
    <td align="left" valign="top"><input name="location" type="text" id="location" value="<?php echo $dataArr[0]->location;?>"  class="required form-control" maxlength="50"/></td>
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
        <textarea name="contactInfo" id="contactInfo" class="required form-control">value="<?php echo $dataArr[0]->contactInfo;?>"</textarea>
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
    <td align="left" valign="top"><input name="metaTitle" type="text" id="metaTitle" value="<?php echo $dataArr[0]->metaTitle;?>"  class="required form-control"/></td>
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
    <td align="left" valign="top"><textarea name="metaKeywords" id="metaKeywords" class="required form-control"><?php echo $dataArr[0]->metaKeywords;?></textarea></td>
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
    <td align="left" valign="top"><textarea name="metaDescription" id="metaDescription" class="required form-control"><?php echo $dataArr[0]->metaDescription;?></textarea></td>
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
            <?php $srch=jmultiple_array_search($k->factfileId,'factfileId',$selectedFactfileDataArr);?>
            <input type="checkbox" name="factfile[]" value="<?php echo $k->factfileId;?>" <?php if($srch!='-1'){?>checked<?php }?>/><?php echo $k->factfile;?>
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
            <?php $srch=jmultiple_array_search($k->facilityId,'facilityId',$selectedFacilityDataArr);?>
            <input type="checkbox" name="facility[]" value="<?php echo $k->facilityId;?>" <?php if($srch!='-1'){?>checked<?php }?>><?php echo $k->facility;?>
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
                <?php $srch=jmultiple_array_search($k->sportsRecreationId,'sportsRecreationId',$selectedSportsRecreationDataArr);?>
                <input type="checkbox" name="sportsRecreation[]" <?php if($srch!='-1'){?>checked<?php }?> value="<?php echo $k->sportsRecreationId;?>"><?php echo $k->sportsRecreation;?>
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
    <td align="left" valign="top">
        <label class="radio-inline"><input type="radio" name="status" value="1" class="required" <?php if($dataArr[0]->status==1){echo 'checked';}?>>Active</label>
        <label class="radio-inline"><input type="radio" name="status" value="0"  class="required" <?php if($dataArr[0]->status==0){echo 'checked';}?>>Active</label></td>
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
    <td align="left" valign="top"><input type="submit" name="Submit3" value="Submit" class="btn btn-primary"/>&nbsp;&nbsp;&nbsp;
      <input type="button" name="Submit22" value="Cancel" onclick="window.location.href='<?php echo base_url()?>webadmin/resort/viewlist/';" class="btn btn-danger"/>
	  <input  type="hidden" name="resortId" id="resortId" value="<?php echo $dataArr[0]->resortId;?>"/>
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
});
</script>