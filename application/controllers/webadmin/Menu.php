<?php
class Menu extends MY_Controller{
	public function __construct(){
            parent::__construct();
            $this->load->model('Menu_category_model');
            $this->_admin_auth();
	}
	
	public function index(){
            $this->viewlist();
	}
	
	public function viewlist(){
            $data=$this->_show_admin_logedin_layout();
            $data['pageTitle']="Menu Category Manager";
            $data['pageSubtitle']="Maneu Category List";
            $data['contName']="menu";
            $data['contAction']="viewlist";
            $data['contNameLabel']="Menu Category Manager";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $data['DataArr']=$this->Menu_category_model->get_all();
            $this->load->view('webadmin/menu_category_list',$data);
	}
	
	public function add(){
            $menuCategoryName=$this->input->post('menuCategoryName',TRUE);
            $menuParentCategoryId=$this->input->post('menuParentCategoryId',TRUE);
            $status=$this->input->post('status',TRUE);
            if($menuParentCategoryId==""){
                $menuParentCategoryId=0;
            }
            if($status==""){
                $status=1;
            }
            $dataArr=array(
            'menuCategoryName'=>$menuCategoryName,
            'menuParentCategoryId'=>$menuParentCategoryId,
            'status'=>$status
            );

            //print_r($dataArr);die;
            $this->Menu_category_model->add($dataArr);

            $this->session->set_flashdata('Message','Menu Category added successfully.');
            redirect(base_url().'webadmin/menu/viewlist');
	}
	
	
	public function edit(){
            $menuCategoryName=$this->input->post('EditmenuCategoryName',TRUE);
            $status=$this->input->post('Editstatus',TRUE);
            $categoryId=$this->input->post('categoryId',TRUE);

            $dataArr=array(
                'menuCategoryName'=>$menuCategoryName,
                'status'=>$status
            );

            //print_r($categoryId);die;
            $this->Menu_category_model->edit($dataArr,$categoryId);
            $this->session->set_flashdata('Message','Menu Category updated successfully.');
            redirect(base_url().'webadmin/menu/viewlist');
	}
	
	
	public function change_status($menuCategoryId,$Action){
            $this->Menu_category_model->change_category_status($menuCategoryId,$Action);

            $this->session->set_flashdata('Message','Menu Category status updated successfully.');
            redirect(base_url().'webadmin/menu/viewlist');
	}
	
	public function delete($menuCategoryId){
		$this->Menu_category_model->delete($menuCategoryId);
		
		$this->session->set_flashdata('Message','Menu Category deleted successfully.');
		redirect(base_url().'webadmin/menu/viewlist');
	}
        
        public function featured($menuCategoryId){
            $this->Menu_category_model->featured($menuCategoryId);
            $this->session->set_flashdata('Message','Menu Category featured successfully.');
            redirect(base_url().'webadmin/menu/viewlist');
        }
}