<?php

class Factfile extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Factfile_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('factfile','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Factfile Manager";
        $data['pageSubtitle'] = "Factfile List";
        $data['contName'] = "factfile";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Factfile Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Factfile_model->get_all_admin();
        $this->load->view('webadmin/factfile_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Factfile_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Factfile added successfully.');
        redirect(base_url() . 'webadmin/factfile/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $factfileId = $this->input->post('factfileId', TRUE);

        //print_r($dataArr);die;
        $this->Factfile_model->edit($dataArr, $factfileId);
        $this->session->set_flashdata('Message', 'factfile  updated successfully.');
        redirect(base_url() . 'webadmin/factfile/viewlist');
    }

    public function change_status($factfileId, $Action) {
        $this->Factfile_model->edit(array('status'=>$Action), $factfileId);

        $this->session->set_flashdata('Message', 'factfile  status updated successfully.');
        redirect(base_url() . 'webadmin/factfile/viewlist');
    }

    public function delete($factfileId) {
        $this->Factfile_model->delete($factfileId);

        $this->session->set_flashdata('Message', 'factfile  deleted successfully.');
        redirect(base_url() . 'webadmin/factfile/viewlist');
    }

}
