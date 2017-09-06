<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends MY_Controller{
    
    function __construct() {
        parent::__construct();
        //$this->load->model("Admin_model");
    }
    
    function show_room_charges_details(){
        $resortRoomId=  $this->input->post('resortRoomId');
        $strurl=  $this->input->post('strurl');
        //pre($resortRoomId);die;
        $this->load->model('Resort_room_charges_model');
        $this->load->model('Resort_room_model');
        $resortRoomChargesDetails=$this->Resort_room_charges_model->get_data_generic_fun('*',array('resortRoomId'=>$resortRoomId));
        $resortRoomDetails=$this->Resort_room_model->get_room_details($resortRoomId);
        $data['resortRoomChargesDetails']=$resortRoomChargesDetails;
        $data['resortRoomDetails']=$resortRoomDetails;
        $data['strurl']=$strurl;
        $data['resortRoomId']=$resortRoomId;
        //pre($data);die;
        $this->load->view('room_details',$data);
        //echo $ret;die;
    }
}