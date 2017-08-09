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
            $data['pageTitle']="Menu Manager";
            $data['pageSubtitle']="Menu List";
            $data['contName']="category";
            $data['contAction']="viewlist";
            $data['contNameLabel']="Menu Manager";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $data['DataArr']=$this->Category_model->get_all();
            $this->load->view('webadmin/category_list',$data);
	}
	
	public function add(){
            $categoryName=$this->input->post('categoryName',TRUE);
            $parrentCategoryId=$this->input->post('parrentCategoryId',TRUE);
            $type=$this->input->post('type',TRUE);
            if($parrentCategoryId==""){
                $parrentCategoryId=0;
            }
            $status=$this->input->post('status',TRUE);
            if($status==""){
                $status=1;
            }
            
            $dataArr=array(
            'categoryName'=>$categoryName,
            'parrentCategoryId'=>$parrentCategoryId,
            'type'=>$type,
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
            $type=$this->input->post('Edittype',TRUE);
            $categoryId=$this->input->post('categoryId',TRUE);

            $dataArr=array(
                'categoryName'=>$categoryName,
                'type'=>$type,
                'status'=>$status
            );

            //print_r($categoryId);die;
            $this->Category_model->edit($dataArr,$categoryId);
            $this->session->set_flashdata('Message','Category updated successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	
	public function change_status($categoryId,$Action){
            $this->Category_model->change_category_status($categoryId,$Action);

            $this->session->set_flashdata('Message','Category status updated successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	public function delete($categoryId){
		$this->Category_model->delete($categoryId);
		
		$this->session->set_flashdata('Message','Category deleted successfully.');
		redirect(base_url().'webadmin/category/viewlist');
	}
        
        public function featured($categoryId){
            $this->Category_model->featured($categoryId);
            $this->session->set_flashdata('Message','Category featured successfully.');
            redirect(base_url().'webadmin/category/viewlist');
        }
}