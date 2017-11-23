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
        $data['app_menu'] = $this->get_mobile_menu();
        $data['contact_no'] = "986-127-5404";
        $data['slogan'] = "Holiday Reviews and Booking Site";
        $data['home_page_list'] = $allResortToursDataArr;
        success_response_after_post_get($data);
    }

    function get_mobile_menu() {
        $this->load->model('Category_model');
        $this->load->model('Cms_model');
        $menuData = array();
        $menuData['menu_data'] = $this->Category_model->get_all_active();
        $menuData['cms'] = $this->Cms_model->get_data_generic_fun('*', array('status' => 1), 'result_arr');
        return $menuData;
    }

    function get_resort_tour_lists_post() {
        $menuId = $this->post('menuId');
        $type = $this->post('type');
        if ($type == 'resort') {
            $data = $this->show_resort_listing($menuId);
        } else {
            $data = $this->show_tour_listing($menuId);
        }

        $data['app_menu'] = $this->get_mobile_menu();
        $data['contact_no'] = "986-127-5404";
        $data['slogan'] = "Holiday Reviews and Booking Site";
        //$data['home_page_list'] = $allResortToursDataArr;
        success_response_after_post_get($data);
    }

    function show_resort_listing($menuId) {
        $this->load->model('Resort_model');
        $data = array();
        $allResortList = $this->Resort_model->get_all_by_menue($menuId);
        $data['toursResortList'] = $allResortList;
        return $data;
    }

    function show_tour_listing($menuId) {
        $this->load->model('Tours_model');
        $data = array();
        $allToursList = $this->Tours_model->get_all_by_menue($menuId);
        $data['toursResortList'] = $allToursList;
        return $data;
    }

    function get_cms_details_post() {
        //$menuId=$this->post('menuId');
        $data = array();
        $data['app_menu'] = $this->get_mobile_menu();
        $data['contact_no'] = "986-127-5404";
        $data['slogan'] = "Holiday Reviews and Booking Site";
        //$data['home_page_list'] = $allResortToursDataArr;
        success_response_after_post_get($data);
    }

    function get_resort_details_post() {
        $this->load->model('Resort_image_model');
        $this->load->model('Resort_model');
        $resortId = $this->post('resortId');
        $dataArr = array();
        $summery = array();
        $rooms = array();
        $photo = array();


        $rsResortImageArr = $this->Resort_image_model->get_data_generic_fun('*', array('resortId' => $resortId), 'result_arrr');
        //pre($rsResortImageArr);
        $resortRoomDataArr = $this->Resort_model->get_full_details($resortId);
        //pre($resortRoomDataArr);

        $resortRoomDetailsDataArr = array();
        //pre($resortRoomDataArr);die;
        foreach ($resortRoomDataArr AS $k) {
            $roomDetails = $this->Resort_model->get_room_details($k['resortRoomId']);
            $first_charges = $this->Resort_model->first_charges_by_resortRoomId($k['resortRoomId']);
            $k['resortRoomCharges'] = $first_charges[0]['oneAdult'];
            $k['resortRoomBookingStartDate'] = $first_charges[0]['bookingStartDate'];
            $k['resortRoomBookingEndDate'] = $first_charges[0]['bookingEndDate'];
            $k['roomDetails'] = $roomDetails;
            //pre($k);die;
            $resortRoomDetailsDataArr[] = $k;
        }

        $enjayTypeDataArr = $this->Resort_model->get_enjay_type($resortId);
        $facilityDataArr = $this->Resort_model->get_facility($resortId);
        $factfileDataArr = $this->Resort_model->get_factfile($resortId);
        $factfileStr = "";
        foreach ($factfileDataArr AS $k => $v) {
            if ($factfileStr == "") {
                $factfileStr = $v['factfile'];
            } else {
                $factfileStr .= ',' . $v['factfile'];
            }
        }
        $summery['enjayType'] = $enjayTypeDataArr;
        $summery['facility'] = $facilityDataArr;
        $summery['factfile'] = $factfileStr;
        $summery['details'] = $this->Resort_model->details_arr($resortId);

        $dataArr['summery'] = $summery;
        $dataArr['rooms'] = $resortRoomDetailsDataArr;
        $dataArr['photo'] = $rsResortImageArr;
        success_response_after_post_get($dataArr);
    }

    function get_resort_room_details_get($resortRoomId) {
        $this->load->model('Resort_room_charges_model');
        $this->load->model('Resort_room_model');
        $dataArr = array();
        $dataArr['resortRoomChargesDetails'] = $this->Resort_room_charges_model->get_data_generic_fun('*', array('resortRoomId' => $resortRoomId), 'result_arr');
        //$resortRoomDetails=$this->Resort_room_model->get_room_details($resortRoomId);
        success_response_after_post_get($dataArr);
    }

    function get_county_state_get($type = "", $parentId = "") {
        $this->load->model("Country_model");
        $dataArr = array();
        if ($type == "") {
            /// it is for country
            $dataArr['countryDataArr'] = $this->Country_model->get_all_country();
            success_response_after_post_get($dataArr);
        } else {
            /// it is for state
            $dataArr['stateDataArr'] = $this->Country_model->get_state_by_country_for_api($parentId);
            success_response_after_post_get($dataArr);
        }
    }

    function get_tours_details_post() {
        $this->load->model('Tours_image_model');
        $this->load->model('Tours_model');
        $toursId = $this->post('toursId');
        $dataArr = array();
        $summery = array();
        $photo = array();

        $rsToursImageArr = $this->Tours_image_model->get_data_generic_fun('*', array('toursId' => $toursId), 'result_arrr');
        //pre($rsResortImageArr);
        $toursDataArr = $this->Tours_model->get_full_details($toursId);
        
        $enjayTypeDataArr = $this->Tours_model->get_enjay_type($toursId);
        
        $summery['enjayType'] = $enjayTypeDataArr;
        $summery['details'] = $this->Tours_model->details_arr($toursId);
        $summery['serviceDataArr'] = $this->Tours_model->get_services($toursId);

        $dataArr['summery'] = $summery;
        $dataArr['photo'] = $rsToursImageArr;
        success_response_after_post_get($dataArr);
    }
	
	function save_device_token_post(){
		$token = $this->post('token');
		$deviceId = $this->post('deviceId');
		$dataArr=array('deviceToken'=>$token,'deviceId'=>$deviceId);
		$this->load->model('User_model');
		$this->User_model->add_token($dataArr);
		$dataArr=array('success'=>'ok');
		success_response_after_post_get($dataArr);
	}
	
	function save_device_location_post(){
		$deviceId = $this->post('deviceId');
		$latitude = $this->post('latitude');
		$longitude = $this->post('longitude');
		$dataArr=array('deviceId'=>$deviceId,'latitude'=>$latitude,'longitude'=>$longitude);
		$this->load->model('User_model');
		$this->User_model->add_device_location($dataArr);
		$dataArr=array('success'=>'ok');
		success_response_after_post_get($dataArr);
    }
    
    function start_booking_post(){
		$this->load->model('User_model');
		$this->load->model('Order_model');
		$firstName=$this->post('firstName');
		$lastName=$this->post('lastName');
		$address=$this->post('address');
		$checkIn=$this->post('checkIn');
		$checkOut=$this->post('checkOut');
		$city=$this->post('city');
		$countryId=$this->post('country');
		$stateId=$this->post('state');
		$email=$this->post('email');
		$resortTourIdVar=$this->post('resortTourIdVar');
		$resortTourTypeVar=$this->post('resortTourTypeVar');
		$zip=$this->post('zip');
		$bookingLat=$this->post('bookingLat');
		$bookingLng=$this->post('bookingLng');
		$userDataArr=array('firstName'=>$firstName,'lastName'=>$lastName,'address'=>$address,'city'=>$city,'stateId'=>$stateId,
		'countryId'=>$countryId,'email'=>$email,'zip'=>$zip,'bookingLat'=>$bookingLat,'bookingLng'=>$bookingLng);
		$userId=$this->User_model->add($userDataArr);
		$bookingNumber="abc0001234";
		if($resortTourTypeVar==1){
			/// it is resort
			/// start query here using $resortTourIdVar on the base of $checkIn and $checkOut 
			/// get the payment amount and get is pay now true of false
			/// create new inactive order for user 
			$bookingAmount=10;
			$payNow=1;
		}else{
			/// it is tours
			$bookingAmount=11;
			$payNow=1;
		}
		
		$orderDataArr=array('userId'=>$userId,'checkIn'=>$checkIn,'checkOut'=>$checkOut,'bookingAmount'=>$bookingAmount,
		'resortTourId'=>$resortTourIdVar,'resortTourType'=>$resortTourTypeVar,'bookingNumber'=>$bookingNumber,'status'=>0,
		'payNow'=>$payNow);
		$orderId=$this->Order_model->add($orderDataArr);
		$dataArr=array('orderId'=>$orderId,'payNow'=>$payNow,'amount'=>$bookingAmount);
		success_response_after_post_get($dataArr);
    }

    function save_player_id_post(){
        $playerId=$this->post('playerId');
        $longitude=$this->post('longitude');
        $latitude=$this->post('latitude');
        $deviceId=$this->post('deviceId');
        
        $this->load->model('User_model');
        $dataArr=array('playerId'=>$playerId,'deviceId'=>$deviceId,'longitude'=>$longitude,'latitude'=>$longitude);
        $id=$this->User_model->add_device_location($dataArr);
        if($id){
            $apiRetDataArr=array('result'=>'success');
        }else{
            $apiRetDataArr=array('result'=>'error');
        }
        success_response_after_post_get($apiRetDataArr);
    }
}
