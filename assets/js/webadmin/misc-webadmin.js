myJsMain.load_booking_period=function(){
    jQuery('#noOfBookingPeriod').on('change',function(){
        var bookingPeriodNo=$(this).val();
        var SecretTextSetAjaxData='selected_no='+bookingPeriodNo;
        myJsMain.commonFunction.showPleaseWait();
        jQuery.ajax({
            type: "POST",
            url: myJsMain.adminBaseURL+'ajax_controller/get_booking_period_element/',
            data: SecretTextSetAjaxData,
            success: function(msg){
                jQuery('.bookingPeriodBox').html(msg);
                myJsMain.commonFunction.hidePleaseWait();
            }
        });
    });
}

myJsMain.update_price=function(id,val){
    $('#twoAdult'+id).val(val*2);
    $('#threeAdult'+id).val(val*3);
    $('#fourAdult'+id).val(val*4);
    $('#extraPerAdult'+id).val(val);
}

myJsMain.show_charges_details=function(){
    jQuery('.viewChargesDetails').on('click',function(){
            var dialog = bootbox.dialog({
                title: '<b>Selected Room Details</b>',
                message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                size:'large'
            });
            dialog.init(function(){
                setTimeout(function(){
                    var roomId=jQuery('.viewChargesDetails').attr('alt');
                    if(roomId!=""){
                        var ajaxURL=myJsMain.adminBaseURL+'ajax_controller/show_room_charges_details/';
                        jQuery.ajax({
                            url:ajaxURL,
                            type:'POST',
                            data:'resortRoomId='+roomId,
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