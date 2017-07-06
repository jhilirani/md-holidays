<?php

class Sports_recreation extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Sports_recreation_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('sportsRecreation','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Sports and recreation Manager";
        $data['pageSubtitle'] = "Sports and recreation List";
        $data['contName'] = "sports_recreation";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Factfile Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Sports_recreation_model->get_all_admin();
        $this->load->view('webadmin/sports_recreation_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Sports_recreation_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Sports and recreation added successfully.');
        redirect(base_url() . 'webadmin/sports_recreation/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $sportsRecreationId = $this->input->post('sportsRecreationId', TRUE);

        //print_r($dataArr);die;
        $this->Sports_recreation_model->edit($dataArr, $sportsRecreationId);
        $this->session->set_flashdata('Message', 'Sports and recreation  updated successfully.');
        redirect(base_url() . 'webadmin/sports_recreation/viewlist');
    }

    public function change_status($sportsRecreationId, $Action) {
        $this->Sports_recreation_model->edit(array('status'=>$Action), $sportsRecreationId);

        $this->session->set_flashdata('Message', 'Sports and recreation  status updated successfully.');
        redirect(base_url() . 'webadmin/sports_recreation/viewlist');
    }

    public function delete($sportsRecreationId) {
        $this->Sports_recreation_model->delete($sportsRecreationId);

        $this->session->set_flashdata('Message', 'Sports and recreation  deleted successfully.');
        redirect(base_url() . 'webadmin/sports_recreation/viewlist');
    }

}
