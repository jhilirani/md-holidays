<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminuser extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->_admin_auth();
    }

    public function index() {
        $this->viewlist();
    }

    function viewlist(){
        $data=$this->_show_admin_logedin_layout();
        $data['pageTitle']="Admin Manager";
        $data['pageSubtitle']="Admin List";
        $data['contName']="adminuser";
        $data['contAction']="viewlist";
        $data['contNameLabel']="Admin Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $dataArr=$this->Admin_model->get_all_admin();
        //pre($dataArr);die;
        $data['DataArr']=$dataArr;
        $this->load->view('webadmin/admin_list',$data);
    }

    public function add() {
        $userName = $this->input->post('userName', true);
        $password = $this->input->post('password', true);
        $fullName = $this->input->post('fullName', true);
        $status = $this->input->post('status', true);
        $DataArr = array('userName' => trim($userName), 'password' => base64_encode($password).'~'.  sha1(MTH_SHA1_SULT), 'fullName' => trim($fullName), 'status' => trim($status));

        if (!$this->CheckAllDataSet($DataArr)) {
            $this->session->set_flashdata('AdminListPageMsg', 'Invalid data to add admin user,Please try again.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        }

        if ($this->Admin_model->add($DataArr)) {
            $this->session->set_flashdata('AdminListPageMsg', 'Admin user added successfully.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        } else {
            $this->session->set_flashdata('AdminListPageMsg', 'Unable to admin user,Please try again.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        }
    }

    public function edit() {
        $adminId = $this->input->post('adminId');
        if ($adminId > 0) {
            $userName = $this->input->post('userName');
            $fullName = $this->input->post('fullName');
            $status = $this->input->post('status');
            $DataArray = array('userName' => $userName, 'fullName' => $fullName, 'status' => $status);
            $No = $this->Admin_model->edit($DataArray, $adminId);
            if ($No > 0) {
                $this->session->set_flashdata('AdminListPageMsg', 'Admin user updated successfully.');
                redirect($this->config->item('base_url') . 'webadmin/adminuser/');
            }
        } else {
            $this->session->set_flashdata('AdminListPageMsg', 'Invalid ID selected,Please try again.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        }
    }

    public function delete($id) {
        //echo 'comming for delete to id '.$id;die;
        $No = $this->Admin_model->delete($id);
        if ($No > 0) {
            $this->session->set_flashdata('AdminListPageMsg', 'Record deleted successfully.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        } else {
            $this->session->set_flashdata('AdminListPageMsg', 'Unabel to delete the record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        }
    }

    public function change_status($id, $status) {
        if ($status == 1)
            $status = 0;
        else
            $status = 1;
        $No = $this->Admin_model->change_status($id, $status);
        if ($No > 0) {
            $this->session->set_flashdata('AdminListPageMsg', 'Record status changed successfully.');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        } else {
            $this->session->set_flashdata('AdminListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/adminuser/');
        }
    }

    public function checkLogin() {
        $ADMIN_SESSION_VAR = $this->session->userdata('ADMIN_SESSION_VAR');
        if (isset($ADMIN_SESSION_VAR)) {
            return true;
        } else {
            return false;
        }
    }

    public function CheckAllDataSet($arr) {
        foreach ($arr as $key => $val) {
            if (empty($arr[$key])) {
                return false;
            }
        }
        return true;
    }

    function return_current_country_code() {
        $params = getopt('l:i:');
        if (!isset($params['l']))
            $params['l'] = 'puDQd5MDgVxy';
//if (!isset($params['i'])) $params['i'] = '24.24.24.24';
        if (!isset($params['i']))
            $params['i'] = '122.177.246.210';

        $query = 'http://geoip.maxmind.com/a?' . http_build_query($params);

        $insights_keys = array(
                    'country_code',
                    'country_name',
                    'region_code',
                    'region_name',
                    'city_name',
                    'latitude',
                    'longitude',
                    'metro_code',
                    'area_code',
                    'time_zone',
                    'continent_code',
                    'postal_code',
                    'isp_name',
                    'organization_name',
                    'domain',
                    'as_number',
                    'netspeed',
                    'user_type',
                    'accuracy_radius',
                    'country_confidence',
                    'city_confidence',
                    'region_confidence',
                    'postal_confidence',
                    'error'
        );

        $curl = curl_init();
        curl_setopt_array(
                $curl, array(
            CURLOPT_URL => $query,
            CURLOPT_USERAGENT => 'MaxMind PHP Sample',
            CURLOPT_RETURNTRANSFER => true
                )
        );

        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new Exception(
            'GeoIP request failed with a curl_errno of '
            . curl_errno($curl)
            );
        }

        $insights_values = str_getcsv($resp);
        $insights_values = array_pad($insights_values, sizeof($insights_keys), '');
        $insights = array_combine($insights_keys, $insights_values);

        print_r($insights);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */