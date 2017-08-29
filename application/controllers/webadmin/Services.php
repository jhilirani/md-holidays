<?php

class Services extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Services_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('services','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Services Manager";
        $data['pageSubtitle'] = "Services List";
        $data['contName'] = "facility";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Services Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Services_model->get_all_admin();
        $this->load->view('webadmin/services_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Services_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Services added successfully.');
        redirect(base_url() . 'webadmin/services/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $servicesId = $this->input->post('servicesId', TRUE);

        //print_r($dataArr);die;
        $this->Services_model->edit($dataArr, $servicesId);
        $this->session->set_flashdata('Message', 'Services updated successfully.');
        redirect(base_url() . 'webadmin/services/viewlist');
    }

    public function change_status($servicesId, $Action) {
        $this->Services_model->edit(array('status'=>$Action),$servicesId);

        $this->session->set_flashdata('Message', 'Services status updated successfully.');
        redirect(base_url() . 'webadmin/services/viewlist');
    }

    public function delete($servicesId) {
        $this->Services_model->delete($servicesId);

        $this->session->set_flashdata('Message', 'Services deleted successfully.');
        redirect(base_url() . 'webadmin/services/viewlist');
    }

}
