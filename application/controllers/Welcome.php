<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Welcome extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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
	
	 function test_api_post(){
		$name=$this->post('name');
		if($name==""){
			$this->response(array('error' => 'Name should not be blank'), 400);
			return false;
		}

		 
	 }
	 
	 function login_post(){
		$userName=$this->post('userName');
		if($userName==""){
			$this->response(array('error'=>'User name should not blank'),400);
			return false;
		}
		$password=$this->post('password');
		if($password==""){
			$this->response(array('error'=>'Password should not blank'),400);
			return false;
		}
		
		$result_arr=$this->db->select('*')->from('users')->where('username',$userName)->where('password',$password)->get()->result_array();
		//echo '<pre>';print_r($result_arr);die;
		if(!empty($result_arr)){
			$data['user_id']=$result_arr[0]['id'];
			$data['userNameFromService']=$userName;
			$data['nameFromService']="judhisthira";
			success_response_after_post_get($data);
		}else{
			$this->response(array('error'=>'Invalid username and password provied,please try again'),400);
			return false;
		}
	 }
	 
	function home_page_get(){
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
		$data['contact_no']="986-127-5404";
		$data['slogan']="Holiday Reviews and Booking Site";
		$data['home_page_list']=$allResortToursDataArr;
		success_response_after_post_get($data);
	} 
}
