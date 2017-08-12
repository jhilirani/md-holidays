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
            $this->load->model('Tours_image_model'); //delete_resort_image
            $allToursImages=$this->Tours_image_model->get_data_generic_fun('*',array('toursId'=>$id),'result_arr');
            foreach ($allToursImages AS $k){
                $this->delete_image($k->image);
            }
            $this->Tours_image_model->delete_all_image_by_tours_id($id);
            $this->Tours_model->delete_services($id);
            $this->Tours_model->delete_enjay_type($id);
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
        $this->load->model("Tours_image_model");
        $No = $this->Tours_image_model->edit(array('status'=>$status), $resortImageId);
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
            redirect(ADMIN_BASE_URL.'tours/viewlist');
        }
        $details=$this->Tours_model->details($Id);
        //pre($details);die;
        $allImg=$this->Tours_model->get_images($Id);
        //pre($allImg);die;
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Manage Resort Images of ".$details[0]->title;
        $data['pageSubtitle']=""; //"Manage Resort Images of ".$details[0]->title;
        $data['contName']="resort";
        $data['contAction']="viewlist/";
        $data['contNameLabel']="Manage Resort";
        
        $data['secondContName']="resort";
        $data['secondContAction']="view_images/".$Id;
        $data['secondContNameLabel']="Manage Resort Images of ".$details[0]->title;
        
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["details"] = $details;
        $data["DataArr"] = $allImg;
        $this->load->view('webadmin/tours_images_list', $data);
    }
    
    function delete_tours_image($toursImageId,$toursId){
        $this->load->model("Tours_image_model");
        $imageArr=$this->Tours_image_model->get_data_generic_fun('*',array('toursImageId'=>$toursImageId));
        //pre($imageArr);die;
        $act=  $this->Tours_image_model->delete($toursImageId);
        if($act){
            foreach($imageArr AS $k){
                $this->delete_image($k->image);
            }
        }
        $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
        redirect(ADMIN_BASE_URL.'tours/view_images/'.$toursId);
    }
    
    function delete_image($file_name){
        foreach($this->_resize_file_array As $k){
            $upload_path=AssetsPath.$this->_image_main_path;
            @unlink($upload_path.$k.'/'.$file_name);
        }
        @unlink($upload_path.$file_name);
    }
    
    function resize_image($full_path,$file_name){
        $this->load->library('image_lib');
        $is_file_error=FALSE;
        foreach($this->_resize_file_array As $k){
            $upload_path=AssetsPath.$this->_image_main_path;
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
    
}