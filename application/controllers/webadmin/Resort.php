<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resort extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Resort_model');
        $this->load->model('Factfile_model');
        $this->load->model('Facility_model');
        $this->load->model('Sports_recreation_model');
        $this->_admin_auth();
        $this->_resize_file_array=array('150X150');
        $this->_ins_columnArr=array('title','overview','latitude','mapZoomLevel','longitude','metaDescription','metaKeywords','metaTitle','location','status','contactInfo');
        $this->_ins_room_columnArr=array('roomTypeId','title','orderNo','totalNosRoom','taxAndServiceCharges','status','roomDescription','resortId');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $this->load->helper("ckeditor");
        $data['pageTitle']="Resort Manager";
        $data['pageSubtitle']="Resort List";
        $data['contName']="resort";
        $data['contAction']="viewlist";
        $data['contNameLabel']="Resort Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $dataArr=$this->Resort_model->get_all_admin();
        $data['DataArr'] = $dataArr;
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
        $data['factfileDataArr']=  $this->Factfile_model->get_all();
        $data['facilityDataArr']=  $this->Facility_model->get_all();
        $data['sportsRecreationDataArr']=  $this->Sports_recreation_model->get_all();
        $this->load->view('webadmin/resort_list', $data);
    }
    
    public function add() {
        //pre($_POST);
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $factfile=  $this->input->post('factfile',TRUE);
        $facility=  $this->input->post('facility',TRUE);
        $sportsRecreation=  $this->input->post('sportsRecreation',TRUE);
        
        //pre($dataArr);die;
        $resortId=$this->Resort_model->add($dataArr);
        
        $factfileBatchArr=array();
        foreach($factfile As $k=>$v){
            $factfileBatchArr[]=array('resortId'=>$resortId,'factfileId'=>$v);
        }
        if(!empty($factfileBatchArr))
            $this->Resort_model->add_factfile($factfileBatchArr);
        
        $facilityBatchArr=array();
        foreach($facility As $k=>$v){
            $facilityBatchArr[]=array('resortId'=>$resortId,'facilityId'=>$v);
        }
        if(!empty($facilityBatchArr))
            $this->Resort_model->add_facility($facilityBatchArr);
        
        $sportsBatchArr=array();
        foreach($sportsRecreation As $k=>$v){
            $sportsBatchArr[]=array('resortId'=>$resortId,'sportsRecreationId'=>$v);
        }
        if(!empty($sportsBatchArr))
            $this->Resort_model->add_sports_recreation($sportsBatchArr);

        $this->session->set_flashdata('Message', 'Resort added successfully.');
        redirect(base_url() . 'webadmin/resort/viewlist');
    }

    public function view_edit($resortId) {
        $details=$this->Resort_model->details($resortId);
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Update Resort ".$details[0]->title;
        $data['pageSubtitle']="Update Resort ".$details[0]->title;
        $data['contName']="resort";
        $data['contAction']="view_edit";
        $data['contNameLabel']="Update Resort ".$details[0]->title;
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["dataArr"] = $details;
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
        
        $data['selectedFactfileDataArr']=  $this->Resort_model->get_factfile($resortId);
        $data['selectedFacilityDataArr']=  $this->Resort_model->get_facility($resortId);
        $data['selectedSportsRecreationDataArr']=  $this->Resort_model->get_sports_recreation($resortId);
        
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
        $this->Resort_model->edit($dataArr, $resortId);
        
        $factfile=  $this->input->post('factfile',TRUE);
        $facility=  $this->input->post('facility',TRUE);
        $sportsRecreation=  $this->input->post('sportsRecreation',TRUE);
        
        $factfileBatchArr=array();
        foreach($factfile As $k=>$v){
            $factfileBatchArr[]=array('resortId'=>$resortId,'factfileId'=>$v);
        }
        if(!empty($factfileBatchArr)){
            $this->Resort_model->remove_factfile($resortId);
            $this->Resort_model->add_factfile($factfileBatchArr);
        }
        $facilityBatchArr=array();
        foreach($facility As $k=>$v){
            $facilityBatchArr[]=array('resortId'=>$resortId,'facilityId'=>$v);
        }
        if(!empty($facilityBatchArr)){
            $this->Resort_model->remove_facility($resortId);
            $this->Resort_model->add_facility($facilityBatchArr);
        }
        $sportsBatchArr=array();
        foreach($sportsRecreation As $k=>$v){
            $sportsBatchArr[]=array('resortId'=>$resortId,'sportsRecreationId'=>$v);
        }
        if(!empty($sportsBatchArr)){
            $this->Resort_model->remove_sports_recreation($resortId);
            $this->Resort_model->add_sports_recreation($sportsBatchArr);
        }
        $this->session->set_flashdata('Message', 'Resort edited successfully.');
        redirect(base_url() . 'webadmin/resort/viewlist');
    }

    public function delete($id) {
        //echo 'comming for delete to id '.$id;die;
        $No = $this->Resort_model->delete($id);
        if ($No > 0) {
            $this->Resort_model->remove_factfile($id);
            $this->Resort_model->remove_facility($id);
            $this->Resort_model->remove_sports_recreation($id);
            $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
            redirect($this->config->item('base_url') . 'webadmin/resort/');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unabel to delete the record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/resort/');
        }
    }

    public function change_status($id, $status) {
        $No = $this->Resort_model->edit(array('status'=>$status), $id);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect($this->config->item('base_url') . 'webadmin/resort/viewlist');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/resort/viewlist');
        }
    }
    
    function view_images($Id){
        $details=$this->Resort_model->details($Id);
        $allImg=$this->Resort_model->get_images($Id);
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="Manage Resort Images of ".$details[0]->title;
        $data['pageSubtitle']="Manage Resort Images of ".$details[0]->title;
        $data['contName']="resort";
        $data['contAction']="view_images";
        $data['contNameLabel']="Manage Resort Images of ".$details[0]->title;
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["details"] = $details;
        $data["DataArr"] = $allImg;
        $this->load->view('webadmin/resort_images_list', $data);
    }
    
    function delete_image($file_name){
        foreach($this->_resize_file_array As $k){
            $upload_path=AssetsPath.'banner/';
            @unlink($upload_path.$k.'/'.$file_name);
        }
        @unlink($upload_path.$file_name);
    }
    
    function resize_image($full_path,$file_name){
        $this->load->library('image_lib');
        $is_file_error=FALSE;
        foreach($this->_resize_file_array As $k){
            $upload_path=AssetsPath.$this->_image_main_path.'/';
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
            return $errMsg;
        }else{
            return 1;
        }
    }
    
    function view_rooms($id){ 
        $this->load->model('Resort_room_type_model');
        $allRooms=$this->Resort_model->get_rooms($id);
        $data = $this->_show_admin_logedin_layout();
        $data['resortTitle']=$allRooms[0]['resortTitle'];
        $data['pageTitle']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $data['pageSubtitle']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $data['roomTypeDataArr']=$this->Resort_room_type_model->get_all();
        $data['contName']="resort";
        $data['contAction']="view_rooms";
        $data['contNameLabel']="Manage Resort Rooms of ".$allRooms[0]['resortTitle'];
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data["DataArr"] = $allRooms;
        $data["resortId"] = $id;
        $this->load->view('webadmin/resort_room_list', $data);
    }
    
    function add_room(){
        
    }
    
    function view_edit_room($resortRoomId){
        
    }
    
    function edit_room(){
        
    }
    
    function delete_room($resortRoomId){
        
    }
    
    function change_room_status($resortRoomId){
        
    }
}