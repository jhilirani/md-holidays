<?php
class Category extends MY_Controller{
	public function __construct(){
            parent::__construct();
            $this->load->model('Category_model');
            $this->_admin_auth();
            $this->_ins_columnArr=array('categoryName','type','metaDescription','metaKeywords','metaTitle','status');
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
            $dataArr=array();
            foreach($this->_ins_columnArr AS $k){
                $colVal=trim($this->input->post($k, TRUE));
                $dataArr[$k]=$colVal;
            }
            $dataArr['parrentCategoryId']=0;
            //print_r($dataArr);die;
            $categoryId=$this->Category_model->add($dataArr);
            if($this->is_max_menu_activated()){
                $this->Category_model->edit(array('status'=>'0'),$categoryId);
            }
            
            $this->session->set_flashdata('Message','Category added successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
        public function view_edit($categoryId){
            $data=$this->_show_admin_logedin_layout();
            $categoryDetailsArr=  $this->Category_model->get_data_generic_fun('*',array('categoryId'=>$categoryId),'result_arrr');
            $data['pageTitle']="Category Update of : ".$categoryDetailsArr[0]['categoryName'];
            $data['pageSubtitle']="Category Update of : ".$categoryDetailsArr[0]['categoryName'];
            $data['contName']="category";
            $data['contAction']="viewlist";
            $data['contNameLabel']="Update Category Info";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $data['categoryDetailsArr'] =   $categoryDetailsArr;
            //$data['DataArr']=$this->Category_model->get_all();
            $this->load->view('webadmin/category_edit',$data);
	}
	
	public function edit(){
            $dataArr=array();
            foreach($this->_ins_columnArr AS $k){
                $colVal=trim($this->input->post($k, TRUE));
                $dataArr[$k]=$colVal;
            }
            $categoryId=$this->input->post('categoryId',TRUE);
            //pre($dataArr);die;
            $this->Category_model->edit($dataArr,$categoryId);
            $this->session->set_flashdata('Message','Category updated successfully.');
            redirect(base_url().'webadmin/category/viewlist');
	}
	
	
	public function change_status($categoryId,$Action){
            if($Action==1){
                if(!$this->is_max_menu_activated()){
                    $this->Category_model->change_category_status($categoryId,$Action);
                    $this->session->set_flashdata('Message','Category status updated successfully.');
                }else{
                    $this->session->set_flashdata('Message','4 Categories already activated,So no more category allow for activation status updated successfully.');
                }
            }else{
                $this->Category_model->change_category_status($categoryId,$Action);
                $this->session->set_flashdata('Message','Category status updated successfully.');
            }
            redirect(base_url().'webadmin/category/viewlist');
	}
        
        function is_max_menu_activated(){
            $rs=  $this->db->query("SELECT count(categoryId) AS tot FROM `category` WHERE status=1")->get()->result();
            if($rs[0]->tot<4){
                return TRUE;
            }else{
                return FALSE;
            }
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