<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model('Resort_model');
        $this->load->model('Tours_model');
    }

    function test_api_post() {
        $name = $this->post('name');
        if ($name == "") {
            $this->response(array('error' => 'Name should not be blank'), 400);
            return false;
        }
    }

    function login_post() {
        $userName = $this->post('userName');
        if ($userName == "") {
            $this->response(array('error' => 'User name should not blank'), 400);
            return false;
        }
        $password = $this->post('password');
        if ($password == "") {
            $this->response(array('error' => 'Password should not blank'), 400);
            return false;
        }

        $result_arr = $this->db->select('*')->from('users')->where('username', $userName)->where('password', $password)->get()->result_array();
        //echo '<pre>';print_r($result_arr);die;
        if (!empty($result_arr)) {
            $data['user_id'] = $result_arr[0]['id'];
            $data['userNameFromService'] = $userName;
            $data['nameFromService'] = "judhisthira";
            success_response_after_post_get($data);
        } else {
            $this->response(array('error' => 'Invalid username and password provied,please try again'), 400);
            return false;
        }
    }

    function home_page_get() {
        $homePageResort = $this->Resort_model->get_latet_10_resort_for_home();
        //pre($homePageResort);die;
        $homePageTours = $this->Tours_model->get_latet_10_tours_for_home();
        $allResortToursDataArr = array();
        foreach ($homePageResort AS $k) {
            $k['item_type'] = 'resort';
            $allResortToursDataArr[] = $k;
        }
        foreach ($homePageTours AS $k) {
            $k['item_type'] = 'tours';
            $allResortToursDataArr[] = $k;
        }
        $data['app_menu']=  $this->get_mobile_menu();
        $data['contact_no'] = "986-127-5404";
        $data['slogan'] = "Holiday Reviews and Booking Site";
        $data['home_page_list'] = $allResortToursDataArr;
        success_response_after_post_get($data);
    }

    function get_mobile_menu(){
        $this->load->model('Category_model');
        $this->load->model('Cms_model');
        $menuData=array();
        $menuData['menu_data']=$this->Category_model->get_all_active();
        $menuData['cms']=$this->Cms_model->get_data_generic_fun('*',array('status'=>1),'result_arr');
        return $menuData;
    }
	
	function get_resort_tour_lists_post(){
		$menuId=$this->post('menuId');
		$type=$this->post('type');
		if($type=='resort'){
			$data=$this->show_resort_listing($menuId);
		}else{
			$data=$this->show_tour_listing($menuId);
		}
		
		$data['app_menu']=  $this->get_mobile_menu();
		$data['contact_no'] = "986-127-5404";
		$data['slogan'] = "Holiday Reviews and Booking Site";
		//$data['home_page_list'] = $allResortToursDataArr;
		success_response_after_post_get($data);
	}
	
	function show_resort_listing($menuId){
		$this->load->model('Resort_model');
		$data=array();
		$allResortList=  $this->Resort_model->get_all_by_menue($menuId);
		$data['toursResortList']=$allResortList;
		return $data;
	}
	
	function show_tour_listing($menuId){
		$this->load->model('Tours_model');
		$data=array();
		$allToursList=  $this->Tours_model->get_all_by_menue($menuId);
		$data['toursResortList']=$allToursList;
		return $data;
	}
	
	function get_cms_details_post(){
		//$menuId=$this->post('menuId');
		$data=array();
		$data['app_menu']=  $this->get_mobile_menu();
		$data['contact_no'] = "986-127-5404";
		$data['slogan'] = "Holiday Reviews and Booking Site";
		//$data['home_page_list'] = $allResortToursDataArr;
		success_response_after_post_get($data);
	}
    function get_resort_details_post(){
        $this->load->model('Resort_image_model');
        $this->load->model('Resort_model');
        $resortId=  $this->post('resortId');
        $dataArr=array();
        $summery=array();
        $rooms=array();
        $photo=array();
        
        
        $rsResortImageArr=  $this->Resort_image_model->get_data_generic_fun('*',array('resortId'=>$resortId),'result_arrr');
        //pre($rsResortImageArr);
        $resortRoomDataArr=  $this->Resort_model->get_full_details($resortId);
        //pre($resortRoomDataArr);
        
        $resortRoomDetailsDataArr=array();
        //pre($resortRoomDataArr);die;
        foreach($resortRoomDataArr AS $k){
            $roomDetails=  $this->Resort_model->get_room_details($k['resortRoomId']);
            $first_charges=  $this->Resort_model->first_charges_by_resortRoomId($k['resortRoomId']);
            $k['resortRoomCharges']=$first_charges[0]['oneAdult'];
            $k['resortRoomBookingStartDate']=$first_charges[0]['bookingStartDate'];
            $k['resortRoomBookingEndDate']=$first_charges[0]['bookingEndDate'];
            $k['roomDetails']=$roomDetails;
            //pre($k);die;
            $resortRoomDetailsDataArr[]=$k;
        }
        
        $enjayTypeDataArr=  $this->Resort_model->get_enjay_type($resortId);
        $facilityDataArr=  $this->Resort_model->get_facility($resortId);
        $factfileDataArr=  $this->Resort_model->get_factfile($resortId);
        $factfileStr="";
        foreach ($factfileDataArr AS $k =>$v){
            if($factfileStr==""){
                $factfileStr=$v['factfile'];
            }else{
                $factfileStr.=','.$v['factfile'];
            }
        }
        $summery['enjayType']=$enjayTypeDataArr;
        $summery['facility']=$facilityDataArr;
        $summery['factfile']=$factfileStr;
        $summery['details']=  $this->Resort_model->details_arr($resortId);
        
        $dataArr['summery']=$summery;
        $dataArr['rooms']=$resortRoomDetailsDataArr;
        $dataArr['photo']=$rsResortImageArr;
        success_response_after_post_get($dataArr);
    }
}