<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Resort_model');
        $this->load->model('Category_model');
        $this->load->model('Tours_model');
    }
    
    function show_resort($str){
        $realMenuId=  $this->_get_real_id($str,'menue');
        $allResortList=  $this->Resort_model->get_all_by_menue($realMenuId);
        if(empty($allResortList)){
            redirect(BASE_URL);
        }
        $SEODataArr=$this->_get_meta_deetails_of_menu($realMenuId);
        if($this->is_loged_in($SEODataArr)){
            $data=  $this->_get_logedin_template();
        }else{
            $data=  $this->_get_tobe_login_template($SEODataArr);
        }
        $breadCrumb=array('link1'=>array('url'=>'','label'=>$allResortList[0]['categoryName']));
        $data['breadCrumb']=$breadCrumb;
        //$data['']
        //pre($allResortList);die;
        
        $data['allResortList']=$allResortList;
        $data['bread_crumb']=  $this->load->view('bread_crumb',$data,TRUE);
        $this->load->view('resort_list',$data);
    }
    
    function show_tours($str){
        //pre($str);die;
        $realMenuId=  $this->_get_real_id($str,'menue');
        $allToursList=  $this->Tours_model->get_all_by_menue($realMenuId);
        if(empty($allToursList)){
            redirect(BASE_URL);
        }
        $SEODataArr=$this->_get_meta_deetails_of_menu($realMenuId);
        if($this->is_loged_in($SEODataArr)){
            $data=  $this->_get_logedin_template($SEODataArr);
        }else{
            $data=  $this->_get_tobe_login_template($SEODataArr);
        }
        $breadCrumb=array('link1'=>array('url'=>'','label'=>$allToursList[0]['categoryName']));
        $data['breadCrumb']=$breadCrumb;
        $data['bread_crumb']=  $this->load->view('bread_crumb',$data,TRUE);
        $data['allToursList']=$allToursList;
        $this->load->view('tours_list',$data);
    }
    
    function resort_details($str){
        //die("kkk");
        $resortId=  $this->_get_real_id($str,'non_menue');
        //pre($resortId);die;
        $resortRoomDataArr=  $this->Resort_model->get_full_details($resortId);
        $this->load->model("Resort_image_model");
        $rsResortImageArr=  $this->Resort_image_model->get_data_generic_fun('*',array('resortId'=>$resortId),'result_arrr');
        //pre($rsResortImageArr);die;
        $SEODataArr=  $this->_get_meta_deetails_of_item($resortRoomDataArr[0],$rsResortImageArr[0]);
        $breadCrumb=array('link1'=>array(
                                    'url'=>BASE_URL.'resort-listing/'.my_seo_freindly_url($resortRoomDataArr[0]['categoryName'])."-".($resortRoomDataArr[0]['categoryId']*102102),
                                    'label'=>$resortRoomDataArr[0]['categoryName']),
            'link2'=>array('label'=>$resortRoomDataArr[0]['ResortTitle'])
            );
        if($this->is_loged_in()){
            $data=  $this->_get_logedin_template($SEODataArr);
        }else{
            $data=  $this->_get_tobe_login_template($SEODataArr);
        }
        
        $data['breadCrumb']=$breadCrumb;
        //pre($resortRoomDataArr);die;
        $resortRoomDetailsDataArr=array();
        //pre($resortRoomDataArr);die;
        foreach($resortRoomDataArr AS $k){
            $roomDetails=  $this->Resort_model->get_room_details($k['resortRoomId']);
            $first_charges=  $this->Resort_model->first_charges_by_resortRoomId($k['resortRoomId']);
            $k['resortRoomCharges']=$first_charges[0]['oneAdult'];
            $k['resortRoomBookingStartDate']=$first_charges[0]['bookingStartDate'];
            $k['resortRoomBookingEndDate']=$first_charges[0]['bookingEndDate'];
            $k['roomDetails']=$roomDetails;
            //pre($k);die;
            $resortRoomDetailsDataArr[]=$k;
        }
        $enjayTypeDataArr=  $this->Resort_model->get_enjay_type($resortId);
        $facilityDataArr=  $this->Resort_model->get_facility($resortId);
        $factfileDataArr=  $this->Resort_model->get_factfile($resortId);
        $factfileStr="";
        foreach ($factfileDataArr AS $k =>$v){
            if($factfileStr==""){
                $factfileStr=$v['factfile'];
            }else{
                $factfileStr.=','.$v['factfile'];
            }
        }
        ///pre($factfileStr);die;
        $sportsAndRecreationDataArr=  $this->Resort_model->get_sports_recreation($resortId);
        
        //pre($rsResortImageArr);die;
        $data['bread_crumb']=  $this->load->view('bread_crumb',$data,TRUE);
        $data['resortRoomDetailsDataArr']=$resortRoomDetailsDataArr;
        $data['enjayTypeDataArr']=$enjayTypeDataArr;
        $data['factfileStr']=$factfileStr;
        $data['facilityDataArr']=$facilityDataArr;
        $data['sportsAndRecreationDataArr']=$sportsAndRecreationDataArr;
        $data['rsResortImageArr']=$rsResortImageArr;
        $this->load->view('resort',$data);
    }
    
    function tours_details($str){
        $toursId=  $this->_get_real_id($str,'non_menue');
        $toursDataArr=  $this->Tours_model->get_full_details($toursId);
        $this->load->model("Tours_image_model");
        $rsToursImageArr=  $this->Tours_image_model->get_data_generic_fun('*',array('toursId'=>$toursId),'result_arrr');
        //pre($rsToursImageArr);die;
        $SEODataArr=  $this->_get_meta_deetails_of_item($toursDataArr[0],$rsToursImageArr[0]);
        //pre($SEODataArr);die;
        $breadCrumb=array('link1'=>array(
                                    'url'=>BASE_URL.'tours-listing/'.my_seo_freindly_url($toursDataArr[0]['categoryName'])."-".($toursDataArr[0]['categoryId']*102102),
                                    'label'=>$toursDataArr[0]['categoryName']),
            'link2'=>array('label'=>$toursDataArr[0]['title'])
            );
        if($this->is_loged_in()){
            $data=  $this->_get_logedin_template($SEODataArr);
        }else{
            $data=  $this->_get_tobe_login_template($SEODataArr);
        }
        
        $data['breadCrumb']=$breadCrumb;
        $enjayTypeDataArr=  $this->Tours_model->get_enjay_type($toursId);
        $servicesDataArr=  $this->Tours_model->get_services($toursId);
        //pre($servicesDataArr);die;
        //pre($rsToursImageArr);die;
        $data['bread_crumb']=  $this->load->view('bread_crumb',$data,TRUE);
        $data['toursDataArr']=$toursDataArr;
        $data['enjayTypeDataArr']=$enjayTypeDataArr;
        $data['servicesDataArr']=$servicesDataArr;
        $data['rsToursImageArr']=$rsToursImageArr;
        $this->load->view('tour',$data);
    }
    
    function resort_room_book($roomIdNumber){
        $roomId=$roomIdNumber/50250341;
        if (strpos($roomId,'.') !== false) {
            redirect(BASE_URL);
        }
        $this->load->model("Resort_model");
        //$dataArr=  $this->Resort_model->get_data_for_checkout($roomId);
        redirect('404_override');
    }
    
    function _get_real_id($str,$type){
        if(!isset($str) || $str==""){
            redirect(BASE_URL);
        }
        $urlStrArr=  explode('-', $str);
        if(count($urlStrArr)<2){
            redirect(BASE_URL);
        }
        end($urlStrArr);
        $id=  current($urlStrArr);
        
        if($type=='menue'){
            $realMenuId=$id/102102;
        }else{
            $realMenuId=$id/204204;
        }
        //echo $realMenuId.'<br>';die;
        if (strpos($realMenuId,'.') !== false) {
            redirect(BASE_URL);
        }
        return $realMenuId;
    }
    
    function _get_meta_deetails_of_menu($realMenuId){
        $menueDetails=  $this->Category_model->get_data_generic_fun('*',array('categoryId'=>$realMenuId),'result_arrr');
        //pre($menueDetails);die;
        $meta=array(
            '0'=>array('name'=>'description','content'=>$menueDetails[0]['metaDescription']),
            '1'=>array('name'=>'keywords','content'=>$menueDetails[0]['metaDescription'])
            );
        $SEODataArr=array('MetaTitle'=>$menueDetails[0]['metaTitle'],'meta'=>$meta);
        return $SEODataArr;
    }
    
    function _get_meta_deetails_of_item($Arr,$ImgArr=array()){
        $meta=array(
            '0'=>array('name'=>'description','content'=>$Arr['metaDescription']),
            '1'=>array('name'=>'keywords','content'=>$Arr['metaDescription'])
            );
        $SEODataArr=array('MetaTitle'=>$Arr['metaTitle'],'meta'=>$meta,'ogImage'=>$ImgArr['image']);
        
        return $SEODataArr;
    }
    
    
}