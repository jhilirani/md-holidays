<?php
class Category extends MY_Controller{
	public function __construct(){
            parent::__construct();
            $this->load->model('Category_model');
            $this->_admin_auth();
	}
	
	public function index(){
            $this->viewlist();
	}
	
	public function viewlist(){
            $data=$this->_show_admin_logedin_layout();
            $data['pageTitle']="Category Manager";
            $data['pageSubtitle']="Category List";
            $data['contName']="category";
            $data['contAction']="viewlist";
            $data['contNameLabel']="Category Manager";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $data['DataArr']=$this->Category_model->get_all();
            $this->load->view('webadmin/category_list',$data);
	}
	
	public function add(){
            $categoryName=$this->input->post('categoryName',TRUE);
            $parrentCategoryId=$this->input->post('parrentCategoryId',TRUE);
            $status=$this->input->post('status',TRUE);

            $dataArr=array(
            'categoryName'=>$categoryName,
            'parrentCategoryId'=>$parrentCategoryId,
            'status'=>$status
            );

            //print_r($dataArr);die;
            $this->Category_model->add($dataArr);

            $this->session->set_flashdata('Message','Category added successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	
	public function edit(){
            $categoryName=$this->input->post('EditcategoryName',TRUE);
            $status=$this->input->post('Editstatus',TRUE);
            $categoryId=$this->input->post('categoryId',TRUE);

            $dataArr=array(
                'categoryName'=>$categoryName,
                'status'=>$status
            );

            //print_r($categoryId);die;
            $this->Category_model->edit($dataArr,$categoryId);
            $this->session->set_flashdata('Message','Category updated successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	
	public function change_status($CategoryID,$Action){
            $this->Category_model->change_category_status($CategoryID,$Action);

            $this->session->set_flashdata('Message','Category status updated successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	public function delete($CategoryID){
		$this->Category_model->delete($CategoryID);
		
		$this->session->set_flashdata('Message','Category deleted successfully.');
		redirect(base_url().'webadmin/category/viewlist');
	}
        
        public function featured($CategoryID){
            $this->Category_model->featured($CategoryID);
            $this->session->set_flashdata('Message','Category featured successfully.');
            redirect(base_url().'webadmin/category/viewlist');
        }
}