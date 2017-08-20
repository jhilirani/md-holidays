<?php
//pre($DataArr);die;
echo $html_head . $body_start . $header . $left_menu . $page_heading_start;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<link href="<?php echo base_url(); ?>assets/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .pull-right1{
        position: absolute;
        top: 7px;
        right: 8px;
    }
    .list-group-item1{
        width: 150px;
        padding: 8px;
        float:left;
        min-height: 150px !important;
        border-radius: 4px;
        border:1px solid #367FA9;
        margin: 2px 3px;
    }
    .remove-file{
        color:#000000 !important;
    }
    #upload-btn{
        background-color: #008d4c !important;
        color: #FFF !important;
    }

</style>
<table cellspacing=5 cellpadding=5 width=90% border=0 >

    <tr>
        <td style="padding-left:50px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="padding-left:10px;padding-bottom:10px;">
            <input type="button" name="AddBtn" id="AddBtn" value="Add Tours Images" onclick="ShowAddAdminBox();" class="btn btn-primary" accesskey="x"/>
        </td>
    </tr>
    <script language="javascript">
        function ShowAddAdminBox() {
            $('#MessaeBox').html("");
            $('#AddBtn').hide();
            $('#PageHeading').hide();
            $('#ListBox_wrapper').fadeOut(500);
            //$('#ListBox').fadeOut(500);
            $('#AddBox').fadeIn(3500);
        }
        function CancelAdd() {
            $('#AddBox').fadeOut('fast');
            $('#PageHeading').fadeIn(3000);
            $('#ListBox_wrapper').fadeIn(3000);
            $('#AddBtn').fadeIn(3000);
            return false;
        }

        function showUpdateCaption(id) {
            $('#MessaeBox').html("");
            $('#AddBtn').hide();
            $('#PageHeading').hide();
            $('#ListBox_wrapper').fadeOut(500);
            $('#ListBox').fadeOut(500);
            $('#AddBox').fadeIn(3500);
            myJsMain.commonFunction.showWebAdminPleaseWait();
            $.ajax({
                url: '<?php echo ADMIN_BASE_URL.'ajax_controller/update_resort_img_caption/'?>',
                type: 'POST',
                data: 'toursImageId=' + id,
                success: function (data) {
                    myJsMain.commonFunction.hideWebAdminPleaseWait();
                    $('#caption').val(data);
                    $('#myModal').modal('show')
                }
            });
        }

        function AskDelete(toursImageId, id) {
            swal({
                title: myJsMain.SystemMessageName,
                text: "Are you sure to delete(Y/N) ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false
            },
            function () {
                location.href = '<?php echo base_url(); ?>webadmin/tours/delete_resort_image/' + toursImageId + '/' + id;
            });
            return false;
        }
    </script>
    <tr>
        <td valign="top"> 

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="ListBox_wrapper" class="table"><!-- table-bordered table-striped-->
                            <tr>
                                <td>
                                    <?php
                                    $val = 0;
                                    foreach ($DataArr as $InerArr) { //pre($InerArr);die;
                                        $images = AsseUploadsPathtsPath . 'tours_images/100X100/';
                                        if (file_exists($images . $InerArr->image)) {
                                            ?>
                                            <div class="col-md-2">
                                                <img src="<?php echo ToursSmallImageURL. $InerArr->image ?>" alt="<?php echo $InerArr->caption; ?>" class="img-responsive img-thumbnail" />
                                                <div>
                                                    <?php
                                                    if ($InerArr->status == '1') {
                                                        $action = 0;
                                                    } else {
                                                        $action = 1;
                                                    }
                                                    ?>
                                                    <a href="<?php echo ADMIN_BASE_URL . 'tours/image_change_status/' . $InerArr->toursId . '/' . $action . '/' . $InerArr->toursImageId; ?>" class="AdminDashBoardLinkText">
                                                        <?php if ($InerArr->status == '1') { ?>
                                                            <i class="fa fa-check-circle fa-lg" title="Active"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-ban fa-lg" title="InActive"></i>
        <?php } ?>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->toursImageId; ?>', '<?php echo $InerArr->toursId; ?>');"><i class="fa fa-remove fa-lg"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0);" onclick="showUpdateCaption('<?php echo $InerArr->toursImageId; ?>')"><i class="fa fa-header fa-lg"><i class="fa fa-plus-circle"></i></i></a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table></td>
                </tr>

                <tr>
                    <td>
                        <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="AddBox" style="display:none;">
                            <tr>
                                <th width="13%" align="left" valign="top" scope="col">&nbsp;</th>
                                <th width="18%" align="left" valign="top" scope="col">&nbsp;</th>
                                <th width="3%" align="left" valign="top" scope="col" class="PageHeading">&nbsp;</th>
                                <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Upload Tours Image </span></th>
                            </tr>
                            <tr>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" colspan="4">
                                    <form action="<?php echo site_url("image_process/start_mulitple_upload_tours") ?>" id="form-upload"> 
                                        <input type="hidden" name="toursId" id="toursId" value="<?php echo $details[0]->toursId; ?>" />
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput" style="width:100% !important;">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">
                                                    <i class="glyphicon glyphicon-paperclip"></i>
                                                    Select file
                                                </span>
                                                <span class="fileinput-exists">
                                                    <i class="glyphicon glyphicon-repeat"></i>
                                                    Browse a new file
                                                </span>
                                                <input type="file" name="file">
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists clearFileData" data-dismiss="fileinput">
                                                <i class="glyphicon glyphicon-remove"></i> Remove
                                            </a>
                                            <a href="#" id="upload-btn" class="input-group-addon btn btn-success fileinput-exists">
                                                <i class="glyphicon glyphicon-open"></i> Upload
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" colspan="4">
                                    <div class="progress" style="display:none;">
                                        <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                                            20%
                                        </div>
                                    </div>

                                    <div class="list-group1 row">

                                    </div>
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
                            <tr>
                                <td align="left" valign="top">&nbsp;</td>
                                <td align="left" valign="top" colspan="2">
                                    <input type="button" class="btn btn-success" value="Show Tours Image List" onclick="location.href = '<?php echo ADMIN_BASE_URL . 'tours/view_images/' . $details[0]->toursId; ?>'">
                                </td>
                                <td align="left" valign="top">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
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
<?php echo $page_heading_end . $footer; ?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-header"></span> Update Caption data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usrname"><span class="glyphicon glyphicon-tags glyphicon-header"></span>Update Image Caption</label>
                    <input type="text" class="form-control" id="caption" name="caption" placeholder="Update Caption">
                </div>
                <button type="button" id="update-caption-btn" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Caption</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/custom1.js"></script>   
<script>
</script>