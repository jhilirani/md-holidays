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
        //pre($data);die;
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
    
    function contact_us(){
        $this->load->model('Cms_model');
        $CmsData=$this->Cms_model->get_content('contact_us'); //get_content_by_id(2);
        $SEODataArr=$this->_get_meta_deetails_of_menu($CmsData[0]);
        if($this->is_loged_in()){
                $data=$this->_get_logedin_template($SEODataArr);
        }else{
                $data=$this->_get_tobe_login_template($SEODataArr);
        }
        
        $data['CmsData']=$CmsData;
        $this->load->view('contact',$data);
    }
    
    function _get_meta_deetails_of_menu($Arr){
        $meta=array(
            '0'=>array('name'=>'description','content'=>$Arr['metaDescription']),
            '1'=>array('name'=>'keywords','content'=>$Arr['metaDescription'])
            );
        $SEODataArr=array('MetaTitle'=>$Arr['metaTitle'],'meta'=>$meta);
        return $SEODataArr;
    }
    
    function contact_us_submit(){
        $Email=$this->input->post('email',TRUE);
        $Name=$this->input->post('fullName',TRUE);
        $Phone=$this->input->post('phone',TRUE);
        $Message=$this->input->post('message',TRUE);
        $secret=$this->input->post('secret',TRUE);
        $error=FALSE;
        $error_message='';

        /*if($error==FALSE){
            $server_secret=$this->session->userdata('secret');
            //echo '$server_secret :- '.$server_secret;die;
            if($server_secret!=$secret){
                    //print_r($_SESSION);
                    $error=TRUE;
                    //die('zzzzzzzzzz');
                    $error_message='Please enter valid security code';
            }
        }*/

        if($error==FALSE){
            $dataArr=array('Name'=>$Name,'Email'=>$Email,'Phone'=>$Phone,'Message'=>$Message,'addedDate'=>date('Y-m-d H:i:s'),'IP'=>  $this->input->ip_address());

            $this->User_model->post_contact($dataArr);
            die("OK");
        }else{
            die('<i class="fa fa-exclamation-triangle fa-2x"></i> '.$error_message);
        }
    }
}
