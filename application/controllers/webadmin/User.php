<?php

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Country');
        $this->load->model('Demo_model');
        $this->_admin_auth();
    }

    public function index() {
        redirect(base_url() . 'admin');
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['StateData'] = $this->Country->get_all_state();
        //$data['CountryData']=$this->Country->get_all();
        $data['DataArr'] = $this->User_model->get_all_user();
        $this->load->view('admin/user_list', $data);
    }

    public function add() {
        $Email = $this->input->post('Email', TRUE);
        $FirstName = $this->input->post('FirstName', TRUE);
        $LastName = $this->input->post('LastName', TRUE);
        $Address = $this->input->post('Address', TRUE);
        //$CountryID=$this->input->post('CountryID',TRUE);
        $State = $this->input->post('State', TRUE);
        $City = $this->input->post('City', TRUE);
        $Zip = $this->input->post('Zip', TRUE);
        $ContactNo = $this->input->post('ContactNo', TRUE);
        $Status = $this->input->post('Status', TRUE);

        $Password = uniqid();

        $dataArr = array(
            'Email' => $Email,
            'Password' => base64_encode($Password),
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Address' => $Address,
            //'CountryID'=>$CountryID,
            'State' => $State,
            'City' => $City,
            'Zip' => $Zip,
            'ContactNo' => $ContactNo,
            'AddDate' => date('Y-m-d H:i:s'),
            'Status' => $Status
        );

        //print_r($dataArr);die;
        $this->User_model->add_user($dataArr);

        $this->load->library('email');


        $this->email->from('no-reply@e-learning.com', 'E-learning Administrator');
        $this->email->to($Email, $FName . ' ' . $LName);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Account Creation By Elearning Administrator');
        $msg = 'Hi ,<br><br> Your account has been created at e-learning.com.<br>You Login username is :' . $Email . '.<br>';
        $msg .= 'Your temporary password is :' . $Password . '.<br>You can change it after login in e-learning account section.<br><br>Thanks,<br>E-learning Team';
        $this->email->message($msg);

        $this->email->send();

        $this->session->set_flashdata('Message', 'User added successfully.');
        redirect(base_url() . 'admin/user/viewlist');
    }

    public function edit() {
        $Email = $this->input->post('EditEmail', TRUE);
        $FirstName = $this->input->post('EditFirstName', TRUE);
        $LastName = $this->input->post('EditLastName', TRUE);
        $Address = $this->input->post('EditAddress', TRUE);
        //$CountryID=$this->input->post('EditCountryID',TRUE);
        $State = $this->input->post('EditState', TRUE);
        $City = $this->input->post('EditCity', TRUE);
        $Zip = $this->input->post('EditZip', TRUE);
        $ContactNo = $this->input->post('EditContactNo', TRUE);
        $Status = $this->input->post('EditStatus', TRUE);
        $UserID = $this->input->post('UserID', TRUE);


        $dataArr = array(
            'Email' => $Email,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Address' => $Address,
            //'CountryID'=>$CountryID,
            'State' => $State,
            'City' => $City,
            'Zip' => $Zip,
            'ContactNo' => $ContactNo,
            //'AddDate'=>date('Y-m-d H:i:s'),
            'Status' => $Status
        );

        $this->User_model->edit_user($dataArr, $UserID);

        $this->session->set_flashdata('Message', 'User updated successfully.');
        redirect(base_url() . 'admin/user/viewlist');
    }

    public function change_status($UserID, $Action) {
        $this->User_model->change_user_status($UserID, $Action);

        $this->session->set_flashdata('Message', 'User status updated successfully.');
        redirect(base_url() . 'admin/user/viewlist');
    }

    public function delete($UserID) {
        $this->User_model->delete($UserID);

        $this->session->set_flashdata('Message', 'User deleted successfully.');
        redirect(base_url() . 'admin/user/viewlist');
    }

    public function contact_list() {
        $DataArr = $this->User_model->get_contacts();
        $data = $this->_show_admin_logedin_layout();
        $data['DataArr'] = $DataArr;
        $this->load->view('admin/contact_list', $data);
    }

    public function contact_delete($id) {
        $this->User_model->contact_delete($id);

        $this->session->set_flashdata('Message', 'Contact deleted successfully.');
        redirect(base_url() . 'admin/user/demo_list');
    }

    public function demo_list() {
        $DataArr = $this->Demo_model->get_all();
        $data = $this->_show_admin_logedin_layout();
        $data['DataArr'] = $DataArr;
        $this->load->view('admin/demo_list', $data);
    }

    public function demo_delete($id) {
        $this->Demo_model->delete($id);

        $this->session->set_flashdata('Message', 'Demo request deleted successfully.');
        redirect(base_url() . 'admin/user/demo_list');
    }

    public function demo_change_status($id) {
        $dataArr = array('DemoAttend' => '1', 'DemoAttendDate' => date('Y-m-d h:i:s'));
        $this->Demo_model->edit($id, $dataArr);

        $this->session->set_flashdata('Message', 'Demo attended successfully.');
        redirect(base_url() . 'admin/user/demo_list');
    }

}

?>