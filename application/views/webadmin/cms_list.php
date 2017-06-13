<?php echo $html_head.$body_start.$header.$left_menu.$page_heading_start;?>
<table cellspacing=5 cellpadding=5 width=90% border=0 >
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:10px;"></td>
  </tr>
<script language="javascript">

 function ShowEditBox(id){
 	location.href='<?php echo base_url()?>webadmin/cms/view_edit/'+id;
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
                location.href='<?php echo base_url()?>webadmin/cms/delete/'+id;
        });
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
    <td width="10%">Sl No </td>
    <td width="60%">CMS Page Title </td>
    <td width="10%">Status</td>
    <td width="20%">Action</td>
  </tr>
  </thead>
  <?php $val=0; 
  if(count($DataArr)>0){ ?> <tbody>
    <?php foreach($DataArr as $InerArr){ //pre($InerArr);die;?>
  <tr class="ListTestLable" height="20px;">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->title;?></td>
    <td><?php echo ($InerArr->status=='1')?'Active':'Inactive';?></td>
    <td>
	<a href="javascript:void(0);" onclick="ShowEditBox('<?php echo $InerArr->cmsId;?>');" class="AdminDashBoardLinkText"><img src="<?php echo SiteImagesURL.'webadmin/';?>edit.png" width="15" height="15" title="Edit"/></a>
	</td> 
  </tr>
  <?php $val++;}?>
  </tbody>
  <?php }else{?>
  <tr class="ListHeadingLable">
    <td colspan="4" style="text-align: center; height: 40px;"> No Record Found</td>
  </tr>
  <?php }?>
  <tfoot>
      <tr class="ListHeadingLable" bgcolor="#FBE554" height="25px;">
    <td width="10%">Sl No </td>
    <td width="60%">CMS Page Title </td>
    <td width="10%">Status</td>
    <td width="20%">Action</td>
  </tr>
  </tfoot>
</table></td>
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