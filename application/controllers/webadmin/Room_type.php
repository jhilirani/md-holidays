<?php

class Room_type extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Resort_room_type_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('roomType','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Room Type Manager";
        $data['pageSubtitle'] = "Room Type List";
        $data['contName'] = "room_type";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Room Type Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Resort_room_type_model->get_all_admin();
        $this->load->view('webadmin/room_type_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Resort_room_type_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Room type added successfully.');
        redirect(base_url() . 'webadmin/room_type/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $roomDetailsId = $this->input->post('roomDetailsId', TRUE);

        //print_r($dataArr);die;
        $this->Resort_room_type_model->edit($dataArr, $roomDetailsId);
        $this->session->set_flashdata('Message', 'Room type  updated successfully.');
        redirect(base_url() . 'webadmin/room_type/viewlist');
    }

    public function change_status($roomDetailsId, $Action) {
        $this->Resort_room_type_model->edit(array('status'=>$Action), $roomDetailsId);

        $this->session->set_flashdata('Message', 'Room type status updated successfully.');
        redirect(base_url() . 'webadmin/room_type/viewlist');
    }

    public function delete($roomDetailsId) {
        $this->Resort_room_type_model->delete($roomDetailsId);

        $this->session->set_flashdata('Message', 'Room type  deleted successfully.');
        redirect(base_url() . 'webadmin/room_type/viewlist');
    }

}
