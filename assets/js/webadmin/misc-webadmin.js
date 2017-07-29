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