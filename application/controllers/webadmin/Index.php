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
        if($this->_is_admin_loged_in()==TRUE){
            $this->_show_admin_home();
        }else{
            redirect('webadmin/index/login','refresh');
        }
    }

    public function login(){
        if($this->_is_admin_loged_in()==FALSE){
            $this->_show_admin_login();
        }else{ die("kkk");
            redirect(base_url().'webadmin/index/admin_home');
        }
    }
    
    function logout(){
        $this->session->unset_userdata('ADMIN_SESSION_VAR');
        $this->session->unset_userdata('ADMIN_SESSION_USERNAME_VAR');
        $this->session->unset_userdata('ADMIN_SESSION_VAR_FNAME');
        $this->session->unset_userdata('ADMIN_SESSION_UDATA');
        $this->session->set_flashdata('LoginPageMsg', 'You are logout successfully');
        redirect(base_url().'webadmin/index/admin_home');
    }
    
    function dashboard(){
        if($this->_is_admin_loged_in()==TRUE){
            $this->_show_admin_home();
        }else{
            $this->login();
        }
    }
}
