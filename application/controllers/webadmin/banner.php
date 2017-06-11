<?php
class Banner extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Banner_model');
	}
	
	public function index(){
		redirect(base_url().'admin');
	}
	
	public function viewlist(){
		$data=$this->_show_admin_logedin_layout();
		$data['DataArr']=$this->Banner_model->get_all();
		$this->load->view('admin/banner_list',$data);
	}
	
	public function add(){
		if($_FILES['Banner']['name']!=""){
			$ImagePath=$this->config->item('ResourcesPath').'banner/';
			$file=$_FILES['Banner'];
			$Image=time().'.'.end(explode('.',$file['name']));
			move_uploaded_file($file['tmp_name'],$ImagePath.$Image);
			$Status=$this->input->post('Status',TRUE);
			
			$dataArr=array(
			'Image'=>$Image,
			'Status'=>$Status
			);
			
			//print_r($dataArr);die;
			$this->Banner_model->add($dataArr);
			
			$this->session->set_flashdata('Message','Banner added successfully.');
			redirect(base_url().'admin/banner/viewlist');	
		}else{
			$this->session->set_flashdata('Message','Invalid Banner uploaded.');
			redirect(base_url().'admin/banner/viewlist');	
		}
		
	}
	
	
	public function edit(){
		if($_FILES['EditBanner']['name']!=""){
			$EditImage=$this->input->post('EditImage',TRUE);
			$Status=$this->input->post('EditStatus',TRUE);
			$BannerID=$this->input->post('BannerID',TRUE);
			
			$ImagePath=$this->config->item('ResourcesPath').'banner/';
			$file=$_FILES['EditBanner'];
			$Image=time().'.'.end(explode('.',$file['name']));
			move_uploaded_file($file['tmp_name'],$ImagePath.$Image);
			unlink($ImagePath.$EditImage);
			
			$dataArr=array(
			'Image'=>$Image,
			'Status'=>$Status
			);
			
			
			//print_r($dataArr);die;
			
			$this->Banner_model->edit($dataArr,$BannerID);
			
			$this->session->set_flashdata('Message','Banner updated successfully.');
			redirect(base_url().'admin/banner/viewlist');
		}else{
			$this->session->set_flashdata('Message','Invalid Banner uploaded.');
			redirect(base_url().'admin/banner/viewlist');
		}
	}
	
	
	public function change_status($BannerID,$Action){
		$this->Banner_model->change_status($BannerID,$Action);
		
		$this->session->set_flashdata('Message','Banner status updated successfully.');
		redirect(base_url().'admin/banner/viewlist');
	}
	
	public function delete($BannerID){
		$this->Banner_model->delete($BannerID);
		
		$this->session->set_flashdata('Message','Banner deleted successfully.');
		redirect(base_url().'admin/banner/viewlist');
	}
}
?>