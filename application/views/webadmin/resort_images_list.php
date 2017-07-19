<?php echo $html_head . $body_start . $header . $left_menu . $page_heading_start; ?>
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
    }
    .remove-file{
        color:#000000 !important;
    }
</style>
<table cellspacing=5 cellpadding=5 width=90% border=0 >

    <tr>
        <td style="padding-left:50px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="padding-left:10px;padding-bottom:10px;">
            <input type="button" name="AddBtn" id="AddBtn" value="Add Resort Images" onclick="ShowAddAdminBox();" class="btn btn-primary" accesskey="x"/>
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

        function AskDelete(id) {
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
                        location.href = '<?php echo base_url() ?>webadmin/resort/delete/' + id;
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
                                    <?php
                                    $val = 0;
                                    foreach ($DataArr as $InerArr) {
                                        $images = AsseUploadsPathtsPath . 'resort/100X100/';
                                        if (file_exists($images)) {
                                            ?>
                                            <div class="col-md-4">
                                                <img src="<?php echo ResortSmallImageURL . $InerArr->image ?>" alt="<?php echo $InerArr->caption; ?>" class="img-responsive img-thumbnail" />
                                                <div>
                                                    <?php
                                                    if ($InerArr->status == '1') {
                                                        $action = 0;
                                                    } else {
                                                        $action = 1;
                                                    }
                                                    ?>
                                                    <a href="<?php echo ADMIN_BASE_URL . 'resort/change_status/' . $InerArr->resortId . '/' . $action; ?>" class="AdminDashBoardLinkText"><?php if ($InerArr->status == '1') { ?><i class="fa fa-check-circle fa-lg" title="Active"></i><?php } else { ?><i class="fa fa-ban fa-lg" title="InActive"></i><?php } ?></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0);" onclick="AskDelete('<?php echo $InerArr->resortId; ?>');" class="AdminDashBoardLinkText"><i class="fa fa-remove fa-lg"></i></a>
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
                                    <th width="66%" align="left" valign="top" scope="col"><span class="PageHeading">Upload Resort Image </span></th>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                    <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" colspan="4">
                                        <form action="<?php echo site_url("image_process/start_mulitple_upload") ?>" id="form-upload">            
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Select file</span><span class="fileinput-exists"><i class="glyphicon glyphicon-repeat"></i> Change</span><input type="file" name="file"></span>
                                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-remove"></i> Remove</a>
                                                <a href="#" id="upload-btn" class="input-group-addon btn btn-success fileinput-exists"><i class="glyphicon glyphicon-open"></i> Upload</a>
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
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>   