<?php

class Resort_enjay_type extends MY_Controller {
    private $_resize_file_array;    
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Resort_enjay_type_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('name','status');
        $this->_resize_file_array=array('45X45');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Resort enjay type Manager";
        $data['pageSubtitle'] = "Resort enjay type List";
        $data['contName'] = "resort_enjay_type";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Resort enjay type Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Resort_enjay_type_model->get_all_admin();
        $this->load->view('webadmin/resort_enjay_type_list', $data);
    }

    public function add() {
        if($_FILES['banner']['name']!=""){
            $upload_path=AssetsPath.'resort_enjay_type/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['quality'] = "30";
            $image_data = array();
            $is_file_error = FALSE;

            //load the preferences
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('resort_enjay_type')) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/banner/viewlist');
            }else{
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
            }
            $dataArr=array();
            foreach($this->_ins_columnArr AS $k){
                $colVal=trim($this->input->post($k, TRUE));
                $dataArr[$k]=$colVal;
            }
            $dataArr['image']=$image_data['file_name'];
            //print_r($dataArr);die;
            $this->Resort_enjay_type_model->add($dataArr);

            $this->session->set_flashdata('Message', 'Resort enjay type added successfully.');
        }else{
            $this->session->set_flashdata('Message', 'Invalid Resort enjay type image added successfully.');
        }    
        redirect(base_url() . 'webadmin/resort_enjay_type/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $resortEnjoyTypeId = $this->input->post('resortEnjoyTypeId', TRUE);
        $Editimage = $this->input->post('Editimage', TRUE);
        if($_FILES['Editbanner']['name']!=""){
            $upload_path=AssetsPath.'resort_enjay_type/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['quality'] = "30";

            $is_file_error = FALSE;

            //load the preferences
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('Editresort_enjay_type')) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/resort_enjay_type/viewlist');
            } else {
                //store the file info
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
            }

            if($is_resize_done != 1){
                $this->session->set_flashdata('Message',$is_resize_done);
                redirect(base_url().'webadmin/resort_enjay_type/viewlist');
            }
        }
        if(!empty($image_data)){
            $dataArr['image']=$image_data['file_name'];
            $this->delete_image($Editimage);
        }
        //print_r($dataArr);die;
        $this->Resort_enjay_type_model->edit($dataArr, $resortEnjoyTypeId);
        $this->session->set_flashdata('Message', 'Resort enjay type  updated successfully.');
        redirect(base_url() . 'webadmin/resort_enjay_type/viewlist');
    }

    public function change_status($resortEnjoyTypeId, $Action) {
        $this->Resort_enjay_type_model->edit(array('status'=>$Action), $resortEnjoyTypeId);

        $this->session->set_flashdata('Message', 'Resort enjay type  status updated successfully.');
        redirect(base_url() . 'webadmin/resort_enjay_type/viewlist');
    }

    public function delete($resortEnjoyTypeId) {
        $this->Resort_enjay_type_model->delete($resortEnjoyTypeId);

        $this->session->set_flashdata('Message', 'Resort enjay type  deleted successfully.');
        redirect(base_url() . 'webadmin/resort_enjay_type/viewlist');
    }

    function delete_image($file_name){
        foreach($this->_resize_file_array As $k){
            $upload_path=SiteAssetsURL.'resort_enjay_type/';
            @unlink($upload_path.$k.'/'.$file_name);
        }
        @unlink($upload_path.$file_name);
    }
}
