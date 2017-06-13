<?php
class Banner extends MY_Controller{
    private $_resize_file_array;    
	public function __construct(){
            parent::__construct();
            $this->load->model('Banner_model');
            $this->_resize_file_array=array('75X75');
	}
	
	public function index(){
            redirect(base_url().'admin');
	}
	
	public function viewlist(){
            $data=$this->_show_admin_logedin_layout();
            $data['pageTitle']="Banner Manager";
            $data['pageSubtitle']="Banner List";
            $data['contName']="banner";
            $data['contAction']="viewlist";
            $data['contNameLabel']="Banner Manager";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $data['DataArr']=$this->Banner_model->get_all();
            $this->load->view('webadmin/banner_list',$data);
	}
	
	public function add(){
            if($_FILES['banner']['name']!=""){
                $upload_path=SiteAssetsURL.'banner/';
                
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '0';
                $config['max_filename'] = '255';
                $config['encrypt_name'] = TRUE;
                $config['quality'] = "30";
                $image_data = array();
                $is_file_error = FALSE;
                
                //load the preferences
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('banner')) {
                    //if file upload failed then catch the errors
                    $errMsg=$this->upload->display_errors();
                    $this->session->set_flashdata('Message',$errMsg);
                    redirect(base_url().'webadmin/banner/viewlist');
                }else{
                    $image_data = $this->upload->data();
                    $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
                }    
                $status=$this->input->post('status',TRUE);
                $caption=$this->input->post('caption',TRUE);
                $url=$this->input->post('url',TRUE);
                if($is_resize_done != 1){
                    $this->session->set_flashdata('Message',$is_resize_done);
                    redirect(base_url().'webadmin/banner/viewlist');
                }
                $dataArr=array(
                'image'=>$image_data['file_name'],
                'status'=>$status,
                'caption'=>$caption,
                'url'=>$url,
                );

                //print_r($dataArr);die;
                $this->Banner_model->add($dataArr);

                $this->session->set_flashdata('Message','Banner added successfully.');
                redirect(base_url().'webadmin/banner/viewlist');	
            }else{
                $this->session->set_flashdata('Message','Invalid Banner uploaded.');
                redirect(base_url().'webadmin/banner/viewlist');	
            }
	}
	
	
	public function edit(){
            $Editcaption=$this->input->post('Editcaption',TRUE);
            $status=$this->input->post('Editstatus',TRUE);
            $url=$this->input->post('Editurl',TRUE);
            $bannerId=$this->input->post('bannerId',TRUE);
            $image_data = array();
            if($_FILES['Editbanner']['name']!=""){
                $upload_path=SiteAssetsURL.'banner/';
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '0';
                $config['max_filename'] = '255';
                $config['encrypt_name'] = TRUE;
                $config['quality'] = "30";
                
                $is_file_error = FALSE;
                
                //load the preferences
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('EditBanner')) {
                    //if file upload failed then catch the errors
                    $errMsg=$this->upload->display_errors();
                    $this->session->set_flashdata('Message',$errMsg);
                    redirect(base_url().'webadmin/banner/viewlist');
                } else {
                    //store the file info
                    $image_data = $this->upload->data();
                    $is_resize_done=$this->resize_image($image_data['full_path'],$image_data['file_name']);
                }
                
                if($is_resize_done != 1){
                    $this->session->set_flashdata('Message',$is_resize_done);
                    redirect(base_url().'webadmin/banner/viewlist');
                }
            }
            
            if(!empty($image_data)){
                $dataArr['image']=$image_data['file_name'];
                $this->delete_image($EditImage);
            }
            
            $dataArr['caption']=$Editcaption;
            $dataArr['url']=$Editurl;
            $dataArr['status']=$status;
            //print_r($bannerId);die;
            $this->Banner_model->edit($dataArr,$bannerId);

            $this->session->set_flashdata('Message','Banner updated successfully.');
            redirect(base_url().'webadmin/banner/viewlist');
	}
	
	
	public function change_status($bannerId,$Action){
		$this->Banner_model->change_status($bannerId,$Action);
		
		$this->session->set_flashdata('Message','Banner status updated successfully.');
		redirect(base_url().'webadmin/banner/viewlist');
	}
	
	public function delete($bannerId){
            $rs=  $this->db->get_where('banner',array('bannerId'=>$bannerId))->result();
            $this->Banner_model->delete($bannerId);
            $this->delete_image($rs[0]->Image);
            $this->session->set_flashdata('Message','Banner deleted successfully.');
            redirect(base_url().'webadmin/banner/viewlist');
	}
        
        function delete_image($file_name){
            foreach($this->_resize_file_array As $k){
                $upload_path=SiteAssetsURL.'banner/';
                @unlink($upload_path.$k.'/'.$file_name);
            }
            @unlink($upload_path.$file_name);
        }
        
        function resize_image($full_path,$file_name){
            $is_file_error=FALSE;
            foreach($this->_resize_file_array As $k){
                $upload_path=SiteAssetsURL.'banner/';
                $imagePathArr=  explode('X', $k);
                
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $full_path; //get original image
                $config2['maintain_ratio'] = TRUE;
                //$config2['create_thumb'] = TRUE;
                $config2['width'] = $imagePathArr[0];
                $config2['height'] = $imagePathArr[1];
                $config2['new_image'] = $upload_path.$k.'/'.$file_name;
                //$config['thumb_marker'] = '_thumb';
                $config2['quality'] = '100';
                //echo '<pre>';print_r($config2);//die;
                 $this->image_lib->clear(); // added this line
                 $this->image_lib->initialize($config2); // added this line
                //$this->load->library('image_lib', $config2);
                if (!$this->image_lib->resize()) {
                    $errMsg=$this->image_lib->display_errors();
                    //echo '<pre>';print_r($errMsg);
                    $is_file_error=TRUE;
                }
            }
            if($is_file_error==TRUE){
                return $errMsg;
            }else{
                return 1;
            }
        }
}