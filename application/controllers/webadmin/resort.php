<?php
class Category extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Resort_model');
        $this->_admin_auth();
    }

    public function index(){
        $this->viewlist();
    }
    
    function viewlist(){
        
    }
    
    function view_add(){
        
    }
}