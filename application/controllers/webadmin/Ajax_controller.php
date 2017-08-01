<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends MY_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model("Admin_model");
    }
    
    function check_login(){
        $config = array(
            array('field'   => 'userName','label'   => 'User Name','rules'   => 'trim|required|xss_clean|valid_email'),
            array('field'   => 'password','label'   => 'Password','rules'   => 'trim|required|xss_clean')
         );
        //initialise the rules with validatiion helper
        $this->form_validation->set_rules($config); 
        //checking validation
        if($this->form_validation->run() == FALSE){
                //retun to login page with peroper error
                echo json_encode(array('result'=>'bad','msg'=>str_replace('</p>','',str_replace('<p>','',validation_errors()))));die;
        }else{
            $UserName=$this->input->post('userName',TRUE);
            $Password=$this->input->post('password',TRUE);
            $DataArr=$this->Admin_model->is_valid_data($UserName,$Password);
            //print_r($DataArr);die;
            if(count($DataArr)>0){
                //$roleArr=$this->User_model->get_roles_for_user($DataArr[0]->userId);
                $this->session->set_userdata('ADMIN_SESSION_VAR',$DataArr[0]->adminId);
                $this->session->set_userdata('ADMIN_SESSION_USERNAME_VAR',$UserName);
                $this->session->set_userdata('ADMIN_SESSION_VAR_FNAME',$DataArr[0]->fullName);
                //$this->session->set_userdata('FE_SESSION_USERNAME_VAR',$UserName);
               // $this->session->set_userdata('ADMIN_SESSION_VAR_TYPE','seller');
                $this->session->set_userdata('ADMIN_SESSION_UDATA',$DataArr[0]);
                
                //$this->db->where('userId',$DataArr[0]->userId)->where('status',0)->from('order');
                //$this->session->set_userdata('TotalItemInCart',$this->db->count_all_results());
                
                //$this->User_model->add_login_history(array('userId'=>$DataArr[0]->userId,'IP'=>$this->input->ip_address()));
                $redirect_url = ADMIN_BASE_URL.'index/dashboard';
                echo json_encode(array('result'=>'good','url'=>$redirect_url?$redirect_url:$_SERVER['HTTP_REFERER']));die; 
            }else{
                echo json_encode(array('result'=>'bad','msg'=>'Please check your "Username" and "Password" and try again.'));die;     
            }
        }
    }
    
    function get_booking_period_element(){
        $no=  $this->input->post("selected_no",TRUE);
        $data['nos']=$no;
        $this->load->view('webadmin/resort_rooms_booking_period',$data);
    }
    
    function update_resort_img_caption(){
        $resortImageId=  $this->input->post("resortImageId",true);
        $this->load->model("Resort_image_model");
        $imageDetails=  $this->Resort_image_model->get_data_generic_fun('*',array('resortImageId'=>$resortImageId),'result_array');
        if(!empty($imageDetails)){
            echo $imageDetails[0]['caption'];
        }else{
            echo '';
        }
    }
    
    function show_room_charges_details(){
        $resortRoomId=  $this->input->post('resortRoomId');
        //pre($resortRoomId);die;
        $this->load->model('Resort_room_charges_model');
        $this->load->model('Resort_room_model');
        $resortRoomChargesDetails=$this->Resort_room_charges_model->get_data_generic_fun('*',array('resortRoomId'=>$resortRoomId));
        $resortRoomDetails=$this->Resort_room_model->get_room_details($resortRoomId);
        $data['resortRoomChargesDetails']=$resortRoomChargesDetails;
        $data['resortRoomDetails']=$resortRoomDetails;
        //pre($data);die;
        $ret=$this->load->view('webadmin/room_details',$data,TRUE);
        echo $ret;die;
    }
}