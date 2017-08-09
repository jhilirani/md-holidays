<?php

class Enjay_type extends MY_Controller {
    private $_resize_file_array;    
    private $_image_main_path;    
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Enjay_type_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('name','status');
        $this->_resize_file_array=array('45X45');
        $this->_image_main_path='resort_enjay_type';
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Enjay type Manager";
        $data['pageSubtitle'] = "Enjay type List";
        $data['contName'] = "enjay_type";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Enjay type Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Enjay_type_model->get_all_admin();
        $this->load->view('webadmin/enjay_type_list', $data);
    }

    public function add() {
        if($_FILES[$this->_image_main_path]['name']!=""){
            $upload_path=AssetsPath.$this->_image_main_path.'/';
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

            if (!$this->upload->do_upload($this->_image_main_path)) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/enjay_type/viewlist');
                
            }else{
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
            }
            
            if($is_resize_done != 1){
                $this->session->set_flashdata('Message',$is_resize_done);
                redirect(base_url().'webadmin/enjay_type/viewlist');
            }
            $dataArr=array();
            foreach($this->_ins_columnArr AS $k){
                $colVal=trim($this->input->post($k, TRUE));
                $dataArr[$k]=$colVal;
            }
            $dataArr['image']=$image_data['file_name'];
            $this->Enjay_type_model->add($dataArr);

            $this->session->set_flashdata('Message', 'Resort enjay type added successfully.');
        }else{
            $this->session->set_flashdata('Message', 'Invalid Resort enjay type image added successfully.');
        }
        //die("kk");
        redirect(base_url() . 'webadmin/enjay_type/viewlist');
    }

    public function edit() {
        $image_data=array();
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $enjayTypeId = $this->input->post('enjayTypeId', TRUE);
        $Editimage = $this->input->post('Editimage', TRUE);
        if($_FILES['Edit'.$this->_image_main_path]['name']!=""){
            $upload_path=AssetsPath.$this->_image_main_path.'/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['quality'] = "30";

            $is_file_error = FALSE;

            //load the preferences
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('Edit'.$this->_image_main_path)) {
                //if file upload failed then catch the errors
                $errMsg=$this->upload->display_errors();
                $this->session->set_flashdata('Message',$errMsg);
                redirect(base_url().'webadmin/enjay_type/viewlist');
            } else {
                //store the file info
                $image_data = $this->upload->data();
                $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
            }

            if($is_resize_done != 1){
                $this->session->set_flashdata('Message',$is_resize_done);
                redirect(base_url().'webadmin/enjay_type/viewlist');
            }
        }
        if(!empty($image_data)){
            $dataArr['image']=$image_data['file_name'];
            $this->delete_image($Editimage);
        }
        //print_r($dataArr);die;
        $this->Enjay_type_model->edit($dataArr, $enjayTypeId);
        $this->session->set_flashdata('Message', 'Resort enjay type  updated successfully.');
        redirect(base_url() . 'webadmin/enjay_type/viewlist');
    }

    public function change_status($enjayTypeId, $Action) {
        $this->Enjay_type_model->edit(array('status'=>$Action), $enjayTypeId);

        $this->session->set_flashdata('Message', 'Resort enjay type  status updated successfully.');
        redirect(base_url() . 'webadmin/enjay_type/viewlist');
    }

    public function delete($enjayTypeId) {
        $rs=  $this->db->get_where('enjay_type',array('enjayTypeId'=>$enjayTypeId))->result();
        $this->Enjay_type_model->delete($enjayTypeId);
        $this->delete_image($rs[0]->image);
        $this->session->set_flashdata('Message', 'Resort enjay type  deleted successfully.');
        redirect(base_url() . 'webadmin/enjay_type/viewlist');
    }

    function delete_image($file_name){
        foreach($this->_resize_file_array As $k){
            $upload_path=AssetsPath.$this->_image_main_path.'/';
            @unlink($upload_path.$k.'/'.$file_name);
        }
        @unlink($upload_path.$file_name);
    }
    
    function resize_image($full_path,$file_name){
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
                $config2['quality'] = '100';
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
}
