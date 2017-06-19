<?php

class Room_details extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Room_details_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('title','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Room details Manager";
        $data['pageSubtitle'] = "Room details List";
        $data['contName'] = "room_details";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Room details Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Room_details_model->get_all_admin();
        $this->load->view('webadmin/room_details_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Room_details_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Room details added successfully.');
        redirect(base_url() . 'webadmin/room_details/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $roomDetailsId = $this->input->post('roomDetailsId', TRUE);

        //print_r($dataArr);die;
        $this->Room_details_model->edit($dataArr, $roomDetailsId);
        $this->session->set_flashdata('Message', 'Room details  updated successfully.');
        redirect(base_url() . 'webadmin/room_details/viewlist');
    }

    public function change_status($roomDetailsId, $Action) {
        $this->Room_details_model->edit(array('status'=>$Action), $roomDetailsId);

        $this->session->set_flashdata('Message', 'Room details status updated successfully.');
        redirect(base_url() . 'webadmin/room_details/viewlist');
    }

    public function delete($roomDetailsId) {
        $this->Room_details_model->delete($roomDetailsId);

        $this->session->set_flashdata('Message', 'Room details  deleted successfully.');
        redirect(base_url() . 'webadmin/room_details/viewlist');
    }

}
