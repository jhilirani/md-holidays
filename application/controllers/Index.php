<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Resort_model');
        $this->load->model('Tours_model');
    }
    
    function index(){
        if($this->is_loged_in()){
            $data=  $this->_get_logedin_template();
        }else{
            $data=  $this->_get_tobe_login_template();
        }
        $homePageResort=$this->Resort_model->get_latet_10_resort_for_home();
        //pre($homePageResort);die;
        $homePageTours=$this->Tours_model->get_latet_10_tours_for_home();
        $allResortToursDataArr=array();
        foreach($homePageResort AS $k){
            $k['item_type']='resort';
            $allResortToursDataArr[]=$k;
        }
        foreach($homePageTours AS $k){
            $k['item_type']='tours';
            $allResortToursDataArr[]=$k;
        }
        $data['allResortToursDataArr']=$allResortToursDataArr;
        $this->load->view('home',$data);
    }
}
