<?php

class Category extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Category_model');
        $this->_admin_auth();
    }

    public function index() {
        redirect(base_url() . 'admin');
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['DataArr'] = $this->Category_model->get_all();
        $this->load->view('admin/category_list', $data);
    }

    public function add() {
        $CategoryName = $this->input->post('CategoryName', TRUE);
        $Status = $this->input->post('Status', TRUE);

        $dataArr = array(
            'CategoryName' => $CategoryName,
            'Status' => $Status
        );

        //print_r($dataArr);die;
        $this->Category_model->add($dataArr);

        $this->session->set_flashdata('Message', 'Category added successfully.');
        redirect(base_url() . 'admin/category/viewlist');
    }

    public function edit() {
        $CategoryName = $this->input->post('EditCategoryName', TRUE);
        $Status = $this->input->post('EditStatus', TRUE);
        $CategoryID = $this->input->post('CategoryID', TRUE);


        $dataArr = array(
            'CategoryName' => $CategoryName,
            'Status' => $Status
        );


        //print_r($dataArr);die;

        $this->Category_model->edit($dataArr, $CategoryID);

        $this->session->set_flashdata('Message', 'Category updated successfully.');
        redirect(base_url() . 'admin/category/viewlist');
    }

    public function change_status($CategoryID, $Action) {
        $this->Category_model->change_category_status($CategoryID, $Action);

        $this->session->set_flashdata('Message', 'Category status updated successfully.');
        redirect(base_url() . 'admin/category/viewlist');
    }

    public function delete($CategoryID) {
        $this->Category_model->delete($CategoryID);

        $this->session->set_flashdata('Message', 'Category deleted successfully.');
        redirect(base_url() . 'admin/category/viewlist');
    }

}

?>