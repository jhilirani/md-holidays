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
        $this->_ins_columnArr=array('title','description','metaDescription','metaKeywords','metaTitle','status','chargesPerPerson','chargesPerChild');
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
        $data['DataArr'] = $dataArr;
        $toursEnjayTypeArr=$this->Enjay_type_model->get_all();
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
        redirect(ADMIN_BASE_URL.'tours/viewlist');
    }

    public function view_edit($toursId) {
        $this->load->model('Enjay_type_model');
        $this->load->model('Category_model');
        $details=$this->Tours_model->details($toursId);
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Update Tours ".$details[0]->title;
        $data['pageSubtitle']="Update Tours ".$details[0]->title;
        $data['contName']="tours";
        $data['contAction']="view_edit";
        $data['contNameLabel']="Update Tours ".$details[0]->title;
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
        
        $toursEnjayTypeArr=$this->Enjay_type_model->get_all();
        $data['toursEnjayTypeArr'] = $toursEnjayTypeArr;
        $data['servicesDataArr'] = $this->Services_model->get_all();
        $data['selectedServicesDataArr']=  $this->Tours_model->get_services($toursId);
        $data['selectedEnjayTypeDataArr']=  $this->Tours_model->get_enjay_type($toursId);
        
        $this->load->view('webadmin/tours_edit', $data);
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $toursId=  $this->input->post("toursId",TRUE);
        //pre($toursId);
        //pre($dataArr);die;
        $this->Tours_model->edit($dataArr, $toursId);
        
        $services=  $this->input->post('services',TRUE);
        $enjayType=  $this->input->post('enjayType',TRUE);
        
        $servicesBatchArr=array();
        foreach($services As $k=>$v){
            $servicesBatchArr[]=array('toursId'=>$toursId,'servicesId'=>$v);
        }
        //pre($servicesBatchArr);die;
        if(!empty($servicesBatchArr)){
            $this->Tours_model->remove_services($toursId);
            $this->Tours_model->add_services($servicesBatchArr);
        }
        
        $enjayTypeBatchArr=array();
        foreach($enjayType As $k=>$v){
            $enjayTypeBatchArr[]=array('toursId'=>$toursId,'enjayTypeId'=>$v);
        }
        if(!empty($enjayTypeBatchArr)){
            $this->Tours_model->remove_enjay_type($toursId);
            $this->Tours_model->add_enjay_type($enjayTypeBatchArr);
        }
        
        $this->session->set_flashdata('Message', 'Tours  edited successfully.');
        redirect(ADMIN_BASE_URL.'tours/');
    }

    public function delete($id) {
        //echo 'comming for delete to id '.$id;die;
        $this->load->model('Tours_image_model'); //delete_resort_image
        $allToursImages=$this->Tours_image_model->get_data_generic_fun('*',array('toursId'=>$id));
        //pre($allToursImages);die;
        foreach ($allToursImages AS $k){
            $this->delete_image($k->image);
        }
        $this->Tours_image_model->delete_all_image_by_tours_id($id);
        $this->Tours_model->delete_services($id);
        $this->Tours_model->delete_enjay_type($id);
        $No = $this->Tours_model->delete($id);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
            redirect(ADMIN_BASE_URL.'tours/');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unabel to delete the record,please try again .');
            redirect(ADMIN_BASE_URL.'tours/');
        }
    }

    public function change_status($id, $status) {
        $No = $this->Tours_model->edit(array('status'=>$status), $id);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect(ADMIN_BASE_URL.'tours/');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect(ADMIN_BASE_URL.'tours/');
        }
    }
    
    public function image_change_status($toursId, $status,$resortImageId) {
        $this->load->model("Tours_image_model");
        $No = $this->Tours_image_model->edit(array('status'=>$status), $resortImageId);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect(ADMIN_BASE_URL.'tours/view_images/'.$toursId);
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect(ADMIN_BASE_URL.'tours/view_images/'.$toursId);
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
        $data['pageTitle']="Manage Tours Images of ".$details[0]->title;
        $data['pageSubtitle']=""; //"Manage Tours Images of ".$details[0]->title;
        $data['contName']="tours";
        $data['contAction']="viewlist/";
        $data['contNameLabel']="Manage Tours";
        
        $data['secondContName']="tours";
        $data['secondContAction']="view_images/".$Id;
        $data['secondContNameLabel']="Manage Tours Images of ".$details[0]->title;
        
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