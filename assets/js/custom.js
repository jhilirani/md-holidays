$(function () {
    var inputFile = $('input[name=file]');
    var uploadURI = $('#form-upload').attr('action');
    var progressBar = $('#progress-bar');

    listFilesOnServer();

    $('#upload-btn').on('click', function (event) {
        var fileToUpload = inputFile[0].files[0];
        // make sure there is file to upload
        if (fileToUpload != 'undefined') {
            // provide the form data
            // that would be sent to sever through ajax
            var formData = new FormData();
            formData.append("file", fileToUpload);
            formData.append("resortId", $('#resortId').val());
            progressBar.show();
            // now upload the file using $.ajax
            $.ajax({
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    //alert(data);
                    //listFilesOnServer();
                    showuploadedImage(data);
                },
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (event) {
                        if (event.lengthComputable) {
                            var percentComplete = Math.round((event.loaded / event.total) * 100);
                            // console.log(percentComplete);

                            $('.progress').show();
                            progressBar.css({width: percentComplete + "%"});
                            progressBar.text(percentComplete + '%');
                            if (parseInt(percentComplete) > 98) {
                                myJsMain.commonFunction.showPleaseWait();
                            }
                        }
                        ;
                    }, false);

                    return xhr;
                }
            });
        }
    });

    $('body').on('click', '.remove-file', function () {
        var me = $(this);

        $.ajax({
            url: uploadURI,
            type: 'post',
            data: {file_to_remove: me.attr('data-file')},
            success: function () {
                //me.closest('li').remove();
                me.parent().parent().remove();
            }
        });

    });
    function showuploadedImage(data) {
        var imgURL = myJsMain.baseURL + 'assets/resort_images/100X100/' + data;
        //alert(imgURL);
        var imgsEle = '<div class="list-group-item1 col-md-3"><img src="' + imgURL + '" class="img-responsive img-thumbnail" /><div class="pull-right pull-right1"><a href="#" data-file="' + data + '" class="remove-file"><i class="glyphicon glyphicon-remove"></i></a></div></div>';
        $('.list-group1').append(imgsEle);
        progressBar.hide();
        $('.clearFileData').trigger('click');
        myJsMain.commonFunction.hidePleaseWait();
    }
    function listFilesOnServer() {
        var items = [];

        $.getJSON(uploadURI, function (data) {
            $.each(data, function (index, element) {
                items.push('<li class="list-group-item">' + element + '<div class="pull-right"><a href="#" data-file="' + element + '" class="remove-file"><i class="glyphicon glyphicon-remove"></i></a></div></li>');
            });
            $('.list-group').html("").html(items.join(""));
        });
    }

    $('body').on('change.bs.fileinput', function (e) {
        $('.progress').hide();
        progressBar.text("0%");
        progressBar.css({width: "0%"});
    });
    
    $('#update-caption-btn').on("click",function(){
        myJsMain.commonFunction.showWebAdminPleaseWait();
        $.ajax({
            url: myJsMain.baseURL+'webadmin/ajax_controller/edit_resort_img_caption/',
            type: 'POST',
            data: 'resortImageId=' + $('#resortImageIdIndex').val()+'&caption='+$('#caption').val(),
            success: function (data) {
                myJsMain.commonFunction.hideWebAdminPleaseWait();
                if(data=='ok'){
                    showMessage("Image caption updated successfully",'success');
                }
                $('#myModal').modal('hide');
            }
        });
    });
});