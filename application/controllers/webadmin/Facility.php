<?php

class Facility extends MY_Controller {
    private $_ins_columnArr;
    public function __construct() {
        parent::__construct();
        $this->load->model('Facility_model');
        $this->_admin_auth();
        $this->_ins_columnArr=array('facility','status');
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle'] = "Facility Manager";
        $data['pageSubtitle'] = "Facility List";
        $data['contName'] = "facility";
        $data['contAction'] = "viewlist";
        $data['contNameLabel'] = "Facility Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['DataArr'] = $this->Facility_model->get_all_admin();
        $this->load->view('webadmin/facility_list', $data);
    }

    public function add() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post($k, TRUE));
            $dataArr[$k]=$colVal;
        }

        //print_r($dataArr);die;
        $this->Facility_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Facility added successfully.');
        redirect(base_url() . 'webadmin/facility/viewlist');
    }

    public function edit() {
        $dataArr=array();
        foreach($this->_ins_columnArr AS $k){
            $colVal=trim($this->input->post('Edit'.$k, TRUE));
            $dataArr[$k]=$colVal;
        }
        $facilityId = $this->input->post('facilityId', TRUE);

        //print_r($dataArr);die;
        $this->Facility_model->edit($dataArr, $facilityId);
        $this->session->set_flashdata('Message', 'Facility updated successfully.');
        redirect(base_url() . 'webadmin/facility/viewlist');
    }

    public function change_status($facilityId, $Action) {
        $this->Facility_model->edit(array('status'=>$Action),$facilityId);

        $this->session->set_flashdata('Message', 'Facility status updated successfully.');
        redirect(base_url() . 'webadmin/facility/viewlist');
    }

    public function delete($facilityId) {
        $this->Facility_model->delete($facilityId);

        $this->session->set_flashdata('Message', 'Facility deleted successfully.');
        redirect(base_url() . 'webadmin/facility/viewlist');
    }

}
