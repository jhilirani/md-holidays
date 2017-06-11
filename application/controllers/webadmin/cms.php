<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {

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
		$this->load->model('Cms_model');
	}
	
	
	public function index(){	
	
	}
	
	
	public function viewlist(){
		$data=$this->_show_admin_logedin_layout();
		$data['DataArr']=$this->Cms_model->get_all();
		$this->load->view('admin/cms_list',$data);
	}

	
	public function add_view(){
		$data=$this->_show_admin_logedin_layout();
		$data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'Body',
			'path'	=>	$this->config->item('SiteJSURL').'ckeditor',
			'judhipath'	=>	$this->config->item('SiteJSURL'),
                        'filebrowserImageUploadUrl'=> base_url().'admin/ckeditor_form/upload',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"120%",	//Setting a custom width
				'height' 	=> 	'250px',	//Setting a custom height
			),
			//Replacing styles from the "Styles tool"
			'styles' => array(
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 	=> 	'Blue',
						'font-weight' 	=> 	'bold'
					)
				),
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 	=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 		=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)
			)
		);
		$this->load->view('admin/cms_add',$data);
	}

	public function add(){
		$Title=$this->input->post('Title',TRUE);
		$Body=$this->input->post('Body',TRUE);
		$ShortBody=$this->input->post('ShortBody',TRUE);
		$MetaTitle=$this->input->post('MetaTitle',TRUE);
		$MetaKeyWord=$this->input->post('MetaKeyWord',TRUE);
		$MetaDescription=$this->input->post('MetaDescription',TRUE);
		$Status=$this->input->post('Status',TRUE);
		
		$dataArr=array(
		'Title'=>$Title,
		'ShortBody'=>$ShortBody,
		'Body'=>$Body,
		'MetaTitle'=>$MetaTitle,
		'MetaKeyWord'=>$MetaKeyWord,
		'MetaDescription'=>$MetaDescription,
		'Status'=>$Status
		);
		
		//print_r($dataArr);die;
		$this->Cms_model->add($dataArr);
		
		$this->session->set_flashdata('Message','Course added successfully.');
		redirect(base_url().'admin/cms/viewlist');
	}
	
	public function view_edit($CmsID){
		$data=$this->_show_admin_logedin_layout();
		$data["dataArr"]=$this->Cms_model->get_content_by_id($CmsID);
		$data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'Body',
			'path'	=>	$this->config->item('SiteJSURL').'ckeditor',
			'judhipath'	=>	$this->config->item('SiteJSURL'),
                        'filebrowserImageUploadUrl'=> base_url().'admin/ckeditor_form/upload',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"120%",	//Setting a custom width
				'height' 	=> 	'250px',	//Setting a custom height
			)
		);
		$this->load->view('admin/cms_edit',$data);
	}
	
	
	public function edit(){
		$CMSID=$this->input->post('CMSID',TRUE);
		$Title=$this->input->post('Title',TRUE);
		$Body=$this->input->post('Body',TRUE);
		$ShortBody=$this->input->post('ShortBody',TRUE);
		$MetaTitle=$this->input->post('MetaTitle',TRUE);
		$MetaKeyWord=$this->input->post('MetaKeyWord',TRUE);
		$MetaDescription=$this->input->post('MetaDescription',TRUE);
		$Status=$this->input->post('Status',TRUE);
		
		$dataArr=array(
		'Title'=>$Title,
		'ShortBody'=>$ShortBody,
		'Body'=>$Body,
		'MetaTitle'=>$MetaTitle,
		'MetaKeyWord'=>$MetaKeyWord,
		'MetaDescription'=>$MetaDescription,
		'Status'=>$Status
		);
		
		//print_r($dataArr);die;
		$this->Cms_model->edit($dataArr,$CMSID);
		
		$this->session->set_flashdata('Message','Course edited successfully.');
		redirect(base_url().'admin/cms/viewlist');
	}
	
	public function delete($id)
	{
		//echo 'comming for delete to id '.$id;die;
		$No=$this->User_model->delete($id);
		if($No>0)
		{
			$this->session->set_flashdata('UserListPageMsg','Record deleted successfully.');
			redirect($this->config->item('base_url').'admin/feuser/');
		}else{
			$this->session->set_flashdata('UserListPageMsg','Unabel to delete the record,please try again .');
			redirect($this->config->item('base_url').'admin/feuser/');
			/*$data=$this->AfterLogInTemplate();
			$DataArr=$this->User_model->get_all();
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
		$No=$this->Cms_model->change_status($id,$status);
		if($No>0)
		{
			$this->session->set_flashdata('UserListPageMsg','Record status changed successfully.');
			redirect($this->config->item('base_url').'admin/cms/viewlist');
		}else{
			$this->session->set_flashdata('UserListPageMsg','Unable to changed the for this record,please try again .');
			redirect($this->config->item('base_url').'admin/cms/viewlist');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>