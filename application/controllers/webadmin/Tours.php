<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tours extends MY_Controller {
    private $_resize_file_array;
    private $_image_main_path;
    //private $_room_image_main_path;
    private $_ins_columnArr;
    //private $_ins_room_columnArr;
    //private $_ins_room_booking_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Tours_model');
        $this->load->model('Services_model');
        $this->_admin_auth();
        $this->_resize_file_array=array('100X100','200X200','300X300');
        $this->_image_main_path='tours_images/';
        $this->_ins_columnArr=array('title','description','metaDescription','metaKeywords','metaTitle','status','chargesPerPerson');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $this->load->model('Enjay_type_model');
        $data = $this->_show_admin_logedin_layout();
        //$this->load->helper("ckeditor");
        $data['pageTitle']="Tours Manager";
        $data['pageSubtitle']="Tours List";
        $data['contName']="tours";
        $data['contAction']="viewlist";
        $data['contNameLabel']="Tours Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $dataArr=$this->Tours_model->get_all_admin();
        $toursEnjayTypeArr=$this->Enjay_type_model->get_all();
        $data['DataArr'] = $dataArr;
        $data['toursEnjayTypeArr'] = $toursEnjayTypeArr;
        $data['servicesDataArr'] = $this->Services_model->get_all();
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'contactInfo',
            'path' => SiteJSURL . 'ckeditor',
            'judhipath' => SiteJSURL,
            'filebrowserImageUploadUrl' => base_url() . 'webadmin/ckeditor_form/upload',
            //Optionnal values
            'config' => array(
                'toolbar' => "Basic", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '150px', //Setting a custom height
            )
        );
        $this->load->view('webadmin/tours_list', $data);
    }
    
    public function add() {
        //pre($_POST);
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $enjayType=  $this->input->post('enjayType',TRUE);
        $services=  $this->input->post('services',TRUE);
        
        //pre($dataArr);die;
        $toursId=$this->Tours_model->add($dataArr);
        //$toursId=1;
        
        $servicesBatchArr=array();
        foreach($services As $k=>$v){
            $servicesBatchArr[]=array('toursId'=>$toursId,'servicesId'=>$v);
        }
        if(!empty($servicesBatchArr)){
            //pre($servicesBatchArr);die;
            $this->Tours_model->add_services($servicesBatchArr);
        }
        $enjayTypesBatchArr=array();
        foreach($enjayType As $k=>$v){
            $enjayTypesBatchArr[]=array('toursId'=>$toursId,'enjayTypeId'=>$v);
        }
        if(!empty($enjayTypesBatchArr)){
            //pre($enjayTypesBatchArr);die;
            $this->Tours_model->add_enjay_type($enjayTypesBatchArr);
        }
        $this->session->set_flashdata('Message', 'Tours  added successfully.');
        redirect(base_url() . 'webadmin/tours/viewlist');
    }

    public function view_edit($resortId) {
        $this->load->model('Enjay_type_model');
        $this->load->model('Category_model');
        $details=$this->Tours_model->details($resortId);
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Update Resort ".$details[0]->title;
        $data['pageSubtitle']="Update Resort ".$details[0]->title;
        $data['contName']="resort";
        $data['contAction']="view_edit";
        $data['contNameLabel']="Update Resort ".$details[0]->title;
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["dataArr"] = $details;
        $data['categoryArr'] = $this->Category_model->get_data_generic_fun('*',array('type'=>1));
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'contactInfo',
            'path' => SiteJSURL . 'ckeditor',
            'judhipath' => SiteJSURL,
            'filebrowserImageUploadUrl' => base_url() . 'webadmin/ckeditor_form/upload',
            //Optionnal values
            'config' => array(
                'toolbar' => "Basic", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '150px', //Setting a custom height
            )
        );
        $data['dataArr']=$details;
        
        $data['factfileDataArr']=  $this->Factfile_model->get_all();
        $data['facilityDataArr']=  $this->Facility_model->get_all();
        $data['sportsRecreationDataArr']=  $this->Sports_recreation_model->get_all();
        $resortEnjayTypeArr=$this->Enjay_type_model->get_all();
        $data['resortEnjayTypeArr'] = $resortEnjayTypeArr;
        $data['selectedFactfileDataArr']=  $this->Tours_model->get_factfile($resortId);
        $data['selectedFacilityDataArr']=  $this->Tours_model->get_facility($resortId);
        $data['selectedEnjayTypeDataArr']=  $this->Tours_model->get_enjay_type($resortId);
        $data['selectedSportsRecreationDataArr']=  $this->Tours_model->get_sports_recreation($resortId);
        
        $this->load->view('webadmin/resort_edit', $data);
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $resortId=  $this->input->post("resortId",TRUE);
        //pre($resortId);
        //pre($dataArr);die;
        $this->Tours_model->edit($dataArr, $resortId);
        
        $factfile=  $this->input->post('factfile',TRUE);
        $facility=  $this->input->post('facility',TRUE);
        $sportsRecreation=  $this->input->post('sportsRecreation',TRUE);
        $enjayType=  $this->input->post('enjayType',TRUE);
        
        $factfileBatchArr=array();
        foreach($factfile As $k=>$v){
            $factfileBatchArr[]=array('resortId'=>$resortId,'factfileId'=>$v);
        }
        if(!empty($factfileBatchArr)){
            $this->Tours_model->remove_factfile($resortId);
            $this->Tours_model->add_factfile($factfileBatchArr);
        }
        
        $facilityBatchArr=array();
        foreach($facility As $k=>$v){
            $facilityBatchArr[]=array('resortId'=>$resortId,'facilityId'=>$v);
        }
        if(!empty($facilityBatchArr)){
            $this->Tours_model->remove_facility($resortId);
            $this->Tours_model->add_facility($facilityBatchArr);
        }
        
        $sportsBatchArr=array();
        foreach($sportsRecreation As $k=>$v){
            $sportsBatchArr[]=array('resortId'=>$resortId,'sportsRecreationId'=>$v);
        }
        if(!empty($sportsBatchArr)){
            $this->Tours_model->remove_sports_recreation($resortId);
            $this->Tours_model->add_sports_recreation($sportsBatchArr);
        }
        
        $enjayTypeBatchArr=array();
        foreach($enjayType As $k=>$v){
            $enjayTypeBatchArr[]=array('resortId'=>$resortId,'enjayTypeId'=>$v);
        }
        if(!empty($enjayTypeBatchArr)){
            $this->Tours_model->remove_enjay_type($resortId);
            $this->Tours_model->add_enjay_type($enjayTypeBatchArr);
        }
        
        $this->session->set_flashdata('Message', 'Tours  edited successfully.');
        redirect(base_url() . 'webadmin/tours/viewlist');
    }

    public function delete($id) {
        //echo 'comming for delete to id '.$id;die;
        $No = $this->Tours_model->delete($id);
        if ($No > 0) {
            $this->load->model('Resort_image_model'); //delete_resort_image
            $allResortImages=$this->Resort_image_model->get_data_generic_fun('*',array('resortId'=>$id),'result_arr');
            foreach ($allResortImages AS $k){
                $this->delete_image($k->image);
            }
            $this->Resort_image_model->delete_all_image_by_resort_id($id);
            $this->Tours_model->remove_factfile($id);
            $this->Tours_model->remove_facility($id);
            $this->Tours_model->remove_sports_recreation($id);
            $this->delete_all_rooms($id);
            $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
            redirect($this->config->item('base_url') . 'webadmin/tours/');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unabel to delete the record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/tours/');
        }
    }

    public function change_status($id, $status) {
        $No = $this->Tours_model->edit(array('status'=>$status), $id);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect($this->config->item('base_url') . 'webadmin/tours/viewlist');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/tours/viewlist');
        }
    }
    
    public function image_change_status($resortId, $status,$resortImageId) {
        $this->load->model("Resort_image_model");
        $No = $this->Resort_image_model->edit(array('status'=>$status), $resortImageId);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect($this->config->item('base_url') . 'webadmin/tours/view_images/'.$resortId);
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/tours/view_images/'.$resortId);
        }
    }
    
    function view_images($Id){
        if($Id==""){
            redirect(ADMIN_BASE_URL.'resort/viewlist');
        }
        $details=$this->Tours_model->details($Id);
        //pre($details);die;
        $allImg=$this->Tours_model->get_images($Id);
        //pre($allImg);die;
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Manage Resort Images of ".$details[0]->title;
        $data['pageSubtitle']="Manage Resort Images of ".$details[0]->title;
        $data['contName']="resort";
        $data['contAction']="viewlist/";
        $data['contNameLabel']="Manage Resort";
        
        $data['secondContName']="resort";
        $data['secondContAction']="view_images/".$Id;
        $data['secondContNameLabel']="Manage Resort Images of ".$details[0]->title;
        
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["details"] = $details;
        $data["DataArr"] = $allImg;
        $this->load->view('webadmin/resort_images_list', $data);
    }
    
    function delete_resort_image($resortImageId,$resortId){
        $this->load->model("Resort_image_model");
        $imageArr=$this->Resort_image_model->get_data_generic_fun('*',array('resortImageId'=>$resortImageId));
        //pre($imageArr);die;
        $act=  $this->Resort_image_model->delete($resortImageId);
        if($act){
            foreach($imageArr AS $k){
                $this->delete_image($k->image);
            }
        }
        $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
        redirect(ADMIN_BASE_URL.'resort/view_images/'.$resortId);
    }
    
    function delete_image($file_name,$image_type='main'){
        foreach($this->_resize_file_array As $k){
            if($image_type=='main')
                $upload_path=AssetsPath.$this->_image_main_path;
            else
                $upload_path=AssetsPath.$this->_room_image_main_path.'/';
            
            @unlink($upload_path.$k.'/'.$file_name);
        }
        @unlink($upload_path.$file_name);
    }
    
    function resize_image($full_path,$file_name,$image_type='main'){
        $this->load->library('image_lib');
        $is_file_error=FALSE;
        foreach($this->_resize_file_array As $k){
            if($image_type=='main')
                $upload_path=AssetsPath.$this->_image_main_path;
            else
                $upload_path=AssetsPath.$this->_room_image_main_path.'/';
            $imagePathArr=  explode('X', $k);

            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $full_path; //get original image
            $config2['maintain_ratio'] = TRUE;
            //$config2['create_thumb'] = TRUE;
            $config2['width'] = $imagePathArr[0];
            $config2['height'] = $imagePathArr[1];
            $config2['new_image'] = $upload_path.$k.'/'.$file_name;
            //$config['thumb_marker'] = '_thumb';
            $config2['quality'] = '60';
            //echo '<pre>';print_r($config2);//die;
             $this->image_lib->clear(); // added this line
             $this->image_lib->initialize($config2); // added this line
            //$this->load->library('image_lib', $config2);
            if (!$this->image_lib->resize()) {
                $errMsg=$this->image_lib->display_errors();
                //echo '<pre>';print_r($errMsg);
                $is_file_error=TRUE;
            }
        }
        if($is_file_error==TRUE){
            //return $errMsg;
            return $errMsg;
        }else{
            return 1;
        }
    }
    
    function view_rooms($id){ 
        $this->load->model('Resort_room_type_model');
        $allRooms=$this->Tours_model->get_rooms($id);
        //pre($allRooms);die;
        $data = $this->_show_admin_logedin_layout();
        $data['resortTitle']=$allRooms[0]['resortTitle'];
        $data['pageTitle']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $data['pageSubtitle']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $roomTypeDataArr=$this->Resort_room_type_model->get_all();
        //pre($roomTypeDataArr);die;
        $data['roomTypeDataArr']=$roomTypeDataArr;
        
        $data['contName']="resort";
        $data['contAction']="viewlist/";
        $data['contNameLabel']="Manage Resort";
        
        $data['secondContName']="resort";
        $data['secondContAction']="view_rooms/".$id;
        $data['secondContNameLabel']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data["DataArr"] = $allRooms;
        $data["resortId"] = $id;
        $this->load->view('webadmin/resort_room_list', $data);
    }
    
    function add_room(){
        $dataArr=array();
        foreach($this->_ins_room_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $resortId=$dataArr['resortId'];
        $noOfBookingPeriod=  $this->input->post('noOfBookingPeriod');
        //pre($resortId);
        $allRoomChargesDataArr=array();
        for($i=1;$i<$noOfBookingPeriod+1;$i++){
            $roomChargesDataArr=array();
            foreach($this->_ins_room_booking_columnArr AS $k){  //echo $k.' == '.$v.'<br>';
                $colVal=trim($this->input->post($k.$i, TRUE));
                $roomChargesDataArr[$k]=$colVal;
            }
            $bookingStartDateArr=  explode('-',trim($this->input->post('bookingStartDate'.$i, TRUE)));
            $bookingEndDateArr=  explode('-',trim($this->input->post('bookingEndDate'.$i, TRUE)));
            $roomChargesDataArr['bookingStartDate']=$bookingStartDateArr[2].'-'.$bookingStartDateArr[1].'-'.$bookingStartDateArr[0];
            $roomChargesDataArr['bookingEndDate']=$bookingEndDateArr[2].'-'.$bookingEndDateArr[1].'-'.$bookingEndDateArr[0];
            //pre($roomChargesDataArr);die;
            $allRoomChargesDataArr[]=$roomChargesDataArr;
        }
        //pre($allRoomChargesDataArr);
        //pre($_FILES);die;
        //echo $this->_room_image_main_path;die;
        if($_FILES[$this->_room_image_main_path]['name']!=""){
            $upload_path=AssetsPath.$this->_room_image_main_path."/";
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['quality'] = "50";
            //pre($config);die;
            $image_data = array();
            //$is_file_error = FALSE;

            //load the preferences
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($this->_room_image_main_path)) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                //die($errMsg);
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);
            }else{
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name'],'room_image');
            }
            //die($is_resize_done);
            if($is_resize_done != 1){
                $this->session->set_flashdata('Message',$is_resize_done);
                redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);
            }else{
                $dataArr['image']=$image_data['file_name'];
                $this->load->model('Resort_room_model');
                $this->load->model('Resort_room_charges_model');
                //pre($dataArr);die;
                $resortRoomId=$this->Resort_room_model->add($dataArr);
                $newAllRoomChargesDataArr=array();
                foreach($allRoomChargesDataArr AS $k => $v){
                    $v['resortRoomId']=$resortRoomId;
                    $newAllRoomChargesDataArr[]=$v;
                }
                //pre($newAllRoomChargesDataArr);die;
                $this->Resort_room_charges_model->add_bulk($newAllRoomChargesDataArr);
            }
        }else{
            $this->session->set_flashdata('Message','Invalid room image uploaded.');
        }
        redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);	
    }
    
    function view_edit_room($resortRoomId){
        $this->load->model('Resort_room_charges_model');
        $this->load->model('Resort_room_model');
        $this->load->model('Resort_room_type_model');
        $resortRoomChargesDetails=$this->Resort_room_charges_model->get_data_generic_fun('*',array('resortRoomId'=>$resortRoomId));
        $resortRoomDetails=$this->Resort_room_model->get_room_details($resortRoomId);
        $data = $this->_show_admin_logedin_layout();
        $roomTypeDataArr=$this->Resort_room_type_model->get_all();
        //pre($roomTypeDataArr);die;
        $data['roomTypeDataArr']=$roomTypeDataArr;
        //pre($resortRoomDetails);die;
        $data['pageTitle']="Manage Resort Rooms of ".$resortRoomDetails[0]->title;
        $data['pageSubtitle']="Manage Resort Rooms of ".$resortRoomDetails[0]->title;
        
        $data['contName']="resort";
        $data['contAction']="viewlist/";
        $data['contNameLabel']="Manage Resort";
        
        $data['secondContName']="resort";
        $data['secondContAction']="view_rooms/".$resortRoomDetails[0]->resortId;
        $data['secondContNameLabel']="Manage Resort Rooms of ".$resortRoomDetails[0]->title;
        
        $data['resortRoomChargesDetails']=$resortRoomChargesDetails;
        $data['resortRoomDetails']=$resortRoomDetails;
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        //pre($data);die;
        $this->load->view('webadmin/edit_room_details',$data);
    }
    
    function edit_room(){
        $resortRoomId=  trim($this->input->post("resortRoomId",TRUE));
        $resortId= trim($this->input->post("resortId",TRUE));
        if($resortId=="" || $resortRoomId==""){
            //$this->session->set_flashdata('Message','Invalid room image uploaded.');
            redirect(ADMIN_BASE_URL.'resort');
        }
        
        $dataArr=array();
        foreach($this->_ins_room_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        //pre($dataArr);die;
        //$resortId=$dataArr['resortId'];
        $noOfBookingPeriod=  $this->input->post('noOfBookingPeriod');
        echo '$noOfBookingPeriod : '.$noOfBookingPeriod;
        //pre($_POST);
        
        $allRoomChargesDataArr=array();
        for($i=1;$i<$noOfBookingPeriod+1;$i++){
            $roomChargesDataArr=array();
            foreach($this->_ins_room_booking_columnArr AS $k){  //echo $k.' == '.$v.'<br>';
                $colVal=trim($this->input->post($k.$i, TRUE));
                $roomChargesDataArr[$k]=$colVal;
            }
            //pre('bookingStartDate'.$i);
            $bookingStartDateArr=  explode('-',trim($this->input->post('bookingStartDate'.$i, TRUE)));
            $bookingEndDateArr=  explode('-',trim($this->input->post('bookingEndDate'.$i, TRUE)));
            
            //pre($bookingStartDateArr);pre($bookingEndDateArr);
            
            $roomChargesDataArr['bookingStartDate']=$bookingStartDateArr[2].'-'.$bookingStartDateArr[1].'-'.$bookingStartDateArr[0];
            $roomChargesDataArr['bookingEndDate']=$bookingEndDateArr[2].'-'.$bookingEndDateArr[1].'-'.$bookingEndDateArr[0];
            //pre($roomChargesDataArr);die;
            $allRoomChargesDataArr[]=$roomChargesDataArr;
        }
        //pre($allRoomChargesDataArr);die;
        if($_FILES[$this->_room_image_main_path]['name']!=""){
            $upload_path=AssetsPath.$this->_room_image_main_path."/";
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['quality'] = "50";
            //pre($config);die;
            $image_data = array();
            //$is_file_error = FALSE;

            //load the preferences
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($this->_room_image_main_path)) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                //die($errMsg);
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);
            }else{
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name'],'room_image');
            }
            //die($is_resize_done);
            if($is_resize_done != 1){
                $this->session->set_flashdata('Message',$is_resize_done);
                redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);
            }else{
                $dataArr['image']=$image_data['file_name'];
            }
        }
        $this->load->model('Resort_room_model');
        $this->load->model('Resort_room_charges_model');
        //pre($dataArr);die;
        $this->Resort_room_model->edit($dataArr,$resortRoomId);
        $this->Resort_room_charges_model->delete_by_room_id($resortRoomId);
        $newAllRoomChargesDataArr=array();
        foreach($allRoomChargesDataArr AS $k => $v){
            $v['resortRoomId']=$resortRoomId;
            $newAllRoomChargesDataArr[]=$v;
        }
        //pre($newAllRoomChargesDataArr);die;
        $this->Resort_room_charges_model->add_bulk($newAllRoomChargesDataArr);
        redirect(base_url().'webadmin/tours/view_rooms/'.$resortId);	
    }
    
    function delete_room($resortRoomId,$resortId){
        $this->load->model('Resort_room_model');
        $this->load->model('Resort_room_charges_model');
        $resortRoomDetails=$this->Resort_room_model->get_room_details($resortRoomId);
        $this->delete_image($resortRoomDetails[0]->image,'room_image');
        $this->Resort_room_model->delete($resortRoomId);
        $this->Resort_room_charges_model->delete_by_room_id($resortRoomId);
        $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
        redirect(ADMIN_BASE_URL.'resort/view_rooms/'.$resortId);
    }
    
    function delete_all_rooms($resortId){
        $this->load->model('Resort_room_model');
        $allRooms=  $this->Resort_room_model->all_rooms_by_resort_id($resortId);
        foreach ($allRooms As $k){
            $this->delete_room($k->resortRoomId);
        }
    }
    
    function change_room_status($resortRoomId,$action,$resortId){
        $this->load->model('Resort_room_model');
        $this->Resort_room_model->edit(array('status'=>$action),$resortRoomId);
        $this->session->set_flashdata('UserListPageMsg', 'Record updated successfully.');
        redirect(ADMIN_BASE_URL.'resort/view_rooms/'.$resortId);
    }
}