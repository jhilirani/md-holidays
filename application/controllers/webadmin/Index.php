<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("Admin_model");
    }
    
    function index(){
        if($this->_is_admin_loged_in()==FALSE){
            $this->session->set_flashdata('Message','Please login to access admin section');
            redirect(base_url().'webadmin/index/login');
        }else{
            redirect(base_url().'webadmin/index/admin_home');
        }
    }
    
    function admin_home(){
        $this->_show_admin_home();
    }

    public function login(){
        $this->_show_admin_login();
    }
}
