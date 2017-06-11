<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin');
	}
	
	
	public function index()
	{
		//$this->load->view('welcome_message');
		//$this->load->view('admin/index');
		//echo $this->config->item('SiteResourcesURL');die;
		if($this->checkLogin())
		{
			$data=$this->AfterLogInTemplate();
			$DataArr=$this->Admin->get_all();
			$data['NoOfRec']=count($DataArr);
			$data['DataArr']=$DataArr;
			$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
			$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
			$this->load->view('admin/admin_list',$data);
		}else{
			$data=$this->BeforeLogInTemplate();
			$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
			$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
			$this->load->view('admin/login',$data);
		}
	}
	/*public function valid_login()
	{
		$this->form_validation->set_rules('UserName', 'User name', 'trim|required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required');
		//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data=$this->BeforeLogInTemplate();
			$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
			$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
			$this->load->view('admin/login',$data);
		}
		else
		{
			$UserName=$this->input->post('UserName');
			$Password=$this->input->post('Password');
			$DataArr=$this->Admin->check_login($UserName,$Password);
			if(count($DataArr)==1)
			{
				$this->session->set_userdata('ADMIN_SESSION_VAR',$DataArr[0]->AdminID);
				//$this->session->set_userdata('UserID',$DataArr[0]->UserID);
				$this->session->set_flashdata('DashboardPageMsg','You are logedin successfully.');
				$data=$this->AfterLogInTemplate();
				$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
				$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
				$this->load->view('admin/dashboard',$data);
			}else{
				$this->session->set_flashdata('LoginPageMsg', 'Invalid User name and password, Please try again.');
				$data=$this->BeforeLogInTemplate();
				$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
				$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
				$this->load->view('admin/login',$data);
			}
			//$this->load->view('formsuccess');
		}
		
		
		
		//$this->load->view('go_next');
	}*/
	
	public function add()
	{
		$UserName=$this->input->post('UserName',true);
		$Password=$this->input->post('Password',true);
		$FullName=$this->input->post('FullName',true);
		$Status=$this->input->post('Status',true);
		$DataArr=array('UserName'=>trim($UserName),'Password'=>trim($Password),'FullName'=>trim($FullName),'Status'=>trim($Status));
		
		if(!$this->CheckAllDataSet($DataArr)){
			$this->session->set_flashdata('AdminListPageMsg','Invalid data to add admin user,Please try again.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}
		
		if($this->Admin->add($DataArr))
		{
			$this->session->set_flashdata('AdminListPageMsg','Admin user added successfully.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}else{
			$this->session->set_flashdata('AdminListPageMsg','Unable to admin user,Please try again.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}
	}
	
	public function edit()
	{
		$AdminID=$this->input->post('AdminID');
		if($AdminID>0){
			$UserName=$this->input->post('UserName');
			$FullName=$this->input->post('FullName');
			$Status=$this->input->post('Status');
			$DataArray=array('UserName'=>$UserName,'FullName'=>$FullName,'Status'=>$Status);
			$No=$this->Admin->edit($DataArray,$AdminID);
			if($No>0)
			{
				$this->session->set_flashdata('AdminListPageMsg','Admin user updated successfully.');
				redirect($this->config->item('base_url').'admin/adminuser/');
			}
		}else{
			$this->session->set_flashdata('AdminListPageMsg','Invalid ID selected,Please try again.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}
	}
	
	
	public function delete($id)
	{
		//echo 'comming for delete to id '.$id;die;
		$No=$this->Admin->delete($id);
		if($No>0)
		{
			$this->session->set_flashdata('AdminListPageMsg','Record deleted successfully.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}else{
			$this->session->set_flashdata('AdminListPageMsg','Unabel to delete the record,please try again .');
			redirect($this->config->item('base_url').'admin/adminuser/');
			/*$data=$this->AfterLogInTemplate();
			$DataArr=$this->Admin->get_all();
			$data['NoOfRec']=count($DataArr);
			$data['DataArr']=$DataArr;
			$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
			$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
			$this->load->view('admin/admin_list',$data);*/
		}
	}
	
	public function change_status($id,$status){
		if($status==1)
			$status=0;
		else
			$status=1;
		$No=$this->Admin->change_status($id,$status);
		if($No>0)
		{
			$this->session->set_flashdata('AdminListPageMsg','Record status changed successfully.');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}else{
			$this->session->set_flashdata('AdminListPageMsg','Unable to changed the for this record,please try again .');
			redirect($this->config->item('base_url').'admin/adminuser/');
		}
	}
	
	public function checkLogin()
	{
		$ADMIN_SESSION_VAR = $this->session->userdata('ADMIN_SESSION_VAR');
		if(isset($ADMIN_SESSION_VAR)){
			return true;
		}else{
			return false;
		}
	}
	
	public function AfterLogInTemplate()
	{
		$data['BaseURL']=$this->config->item('base_url');
		$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
		$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
		$data['SiteJSURL']=$this->config->item('SiteJSURL');
		
		$data['html_head']=$this->load->view('admin/html_head',$data,true);
		$data['header']=$this->load->view('admin/header',$data,true);
		$data['left']=$this->load->view('admin/left',$data,true);
		$data['footer']=$this->load->view('admin/footer',$data,true);
		return $data;
	}
	
	public function BeforeLogInTemplate()
	{
		$data['BaseURL']=$this->config->item('base_url');
		$data['SiteImagesURL']=$this->config->item('SiteImagesURL');
		$data['SiteCSSURL']=$this->config->item('SiteCSSURL');
		$data['SiteJSURL']=$this->config->item('SiteJSURL');
		
		$data['html_head']=$this->load->view('admin/html_head',$data,true);
		$data['header']=$this->load->view('admin/header',$data,true);
		$data['footer']=$this->load->view('admin/footer',$data,true);
		return $data;
	}
	
	public function	CheckAllDataSet($arr)
	{
		foreach($arr as $key => $val)
		{
			if(empty($arr[$key]))
			{
				return false;
			}
		}
		return true;
	}
        
    function return_current_country_code(){
        $params = getopt('l:i:');
if (!isset($params['l'])) $params['l'] = 'puDQd5MDgVxy';
//if (!isset($params['i'])) $params['i'] = '24.24.24.24';
if (!isset($params['i'])) $params['i'] = '122.177.246.210';
 
$query = 'http://geoip.maxmind.com/a?' . http_build_query($params);
 
$insights_keys =
  array(
    'country_code',
    'country_name',
    'region_code',
    'region_name',
    'city_name',
    'latitude',
    'longitude',
    'metro_code',
    'area_code',
    'time_zone',
    'continent_code',
    'postal_code',
    'isp_name',
    'organization_name',
    'domain',
    'as_number',
    'netspeed',
    'user_type',
    'accuracy_radius',
    'country_confidence',
    'city_confidence',
    'region_confidence',
    'postal_confidence',
    'error'
    );
 
$curl = curl_init();
curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => $query,
        CURLOPT_USERAGENT => 'MaxMind PHP Sample',
        CURLOPT_RETURNTRANSFER => true
    )
);
 
$resp = curl_exec($curl);
 
if (curl_errno($curl)) {
    throw new Exception(
        'GeoIP request failed with a curl_errno of '
        . curl_errno($curl)
    );
}
 
$insights_values = str_getcsv($resp);
$insights_values = array_pad($insights_values, sizeof($insights_keys), '');
$insights = array_combine($insights_keys, $insights_values);
 
print_r($insights);
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>