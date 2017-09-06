myJsMain.show_room_charges_details=function(){
    jQuery('.viewRoomDetails').on('click',function(){
        var roomid=$(this).data('roomid');
        var strurl=$(this).data('strurl');
        var dialog = bootbox.dialog({
            title: '<center><b>View Selected Room Details</b></center>',
            message: '<p class="text-center"><i class="fa fa-spin fa-spinner fa-5x"></i> Loading...</p>',
            size:'large'
        });
        dialog.init(function(){
                setTimeout(function(){
                    //var roomid=jQuery('.viewChargesDetails').attr('alt');
                    if(roomid!=""){
                        var ajaxURL=myJsMain.MainSiteBaseURL +'ajax_controller/show_room_charges_details/';
                        jQuery.ajax({
                            url:ajaxURL,
                            type:'POST',
                            data:'resortRoomId='+roomid+'&strurl='+strurl,
                            success:function(msg){
                                if(msg!=""){ 
                                    dialog.find('.bootbox-body').html(msg);
                                }else{
                                    dialog.modal('hide');
                                }
                            }
                        });
                    }
                }, 2000);
            });
    });
}

myJsMain.go_book_now=function(){
    jQuery('.bookNow').on('click',function(){
        var roomid=$(this).data('roomid');
        var strurl=$(this).data('strurl');
        location.href=myJsMain.MainSiteBaseURL+'book-resort/'+strurl+'/'+roomid*50250341;
    });
}