<?php echo $AdminHomeLeftPanel;

//print_r($UserDataArr);die;?>
<style>
    .hideMessage{display: none;}
    .showMessage{display: block;}
</style>

<table cellspacing=5 cellpadding=5 width=90% border=0 >
  
  <tr id="PageHeading">
    <td class="PageHeading" >Contact List</td>
  </tr>

  
  <tr>
    <td style="padding-left:50px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><div id="MessaeBox" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#009900; text-decoration:blink; text-align:center;"><?php echo $this->session->flashdata('Message');?></div></td>
  </tr>
  
<script language="javascript"> 
function AskDelete(id){
    if(confirm('Are you sure to delete(Y/N) ?')){
            location.href='<?php echo base_url()?>admin/user/contact_delete/'+id;
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
    <td width="4%">Sl No </td>
    <td width="15%">Full Name </td>
    <td width="20%">Email</td>
    <td width="8%">Phone</td>	
    <td width="48%">Message</td>	
    <td width="5%">Action</td>
  </tr>
  <?php $val=0; 
  if(count($DataArr)>0){
  foreach($DataArr as $InerArr){?>
  <tr class="ListTestLable" height="20px;">
    <td><?php echo $val+1;?></td>
    <td><?php echo $InerArr->Name;?></td>
    <td><?php echo $InerArr->Email;?></td>
    <td><?php echo $InerArr->Phone;?></td>
    <td><?php if(strlen($InerArr->Message)>150){ echo substr($InerArr->Message,0,135).'  ...<a href="#" class="moreMessage">More</a>';}else{ echo $InerArr->Message;}?>
        <div alt="1" class="hideMessage"><?php echo substr($InerArr->Message,135); ?></div></td>
    <td>
	<a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->ContactUsID;?>');" class="AdminDashBoardLinkText"><img src="<?php echo $SiteImagesURL.'admin/';?>delete.png" width="15" height="15" title="Delete"/></a>
	</td> 
  </tr>
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
</table></td>
  </tr>

</table>
<?php echo $AdminHomeRest;?>
<script>
$(document).ready(function(){
    $('.moreMessage').on('click',function(){
        var state=$(this).next().attr('alt');
        console.log(state);
        if(state=='1'){
            $(this).next().addClass('showMessage');
            $(this).next().removeClass('hideMessage');
            $(this).next().attr('alt','0');
        }else{
            $(this).next().addClass('hideMessage');
            $(this).next().removeClass('showMessage');
            $(this).next().attr('alt','1');
        }
    });
});
</script>
