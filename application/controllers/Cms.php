<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller{
	
	public function __consturct(){
		parent::__construct();
		$this->load->model('Cms_model');
	}
	
	public function index(){
		redirect(base_url());
	}

	function generate_seo_data_arr($id){
		$CMSDetails=$this->Cms_model->get_content_by_id($id);
        //$CMSDetails=$this->Cms_model->get_content('terms_conditions');
        //echo '<pre>';print_r($CMSDetails);die;
        $SEODataArr["MetaTitle"]=$CMSDetails[0]->MetaTitle;
        $SEODataArr["MetaKeyWord"]=$CMSDetails[0]->MetaKeyWord;
        $SEODataArr["MetaDescription"]=$CMSDetails[0]->MetaDescription;
     	return $SEODataArr;   
	}

	public function about_us(){
            $CmsData=$this->Cms_model->get_content('about_us'); //get_content_by_id(2);
            //pre($CmsData);die;
            $SEODataArr=$this->_get_meta_deetails_of_menu($CmsData[0]);
            if($this->is_loged_in()){
                    $data=$this->_get_logedin_template($SEODataArr);
            }else{
                    $data=$this->_get_tobe_login_template($SEODataArr);
            }

            $data['CmsData']=$CmsData;
            $this->load->view('cms',$data);
	}
	public function privacy_policy(){
		$CmsData=$this->Cms_model->get_content('privacy_policy'); //get_content_by_id(2);
		$SEODataArr=$this->_get_meta_deetails_of_menu($CmsData[0]);
		if($this->is_loged_in()){
			$data=$this->_get_logedin_template($SEODataArr);
		}else{
			$data=$this->_get_tobe_login_template($SEODataArr);
		}
		
		$data['CmsData']=$CmsData;
		$this->load->view('cms',$data);
	}
	
	public function  terms_of_services(){
		$CmsData=$this->Cms_model->get_content('terms_of_services'); //get_content_by_id(2);
		$SEODataArr=$this->_get_meta_deetails_of_menu($CmsData[0]);
		if($this->is_loged_in()){
			$data=$this->_get_logedin_template($SEODataArr);
		}else{
			$data=$this->_get_tobe_login_template($SEODataArr);
		}
		
		$data['CmsData']=$CmsData;
		$this->load->view('cms',$data);
	}

	public function  travel_guide(){
		$CmsData=$this->Cms_model->get_content('travel_guide'); //get_content_by_id(2);
		$SEODataArr=$this->_get_meta_deetails_of_menu($CmsData[0]);
		if($this->is_loged_in()){
			$data=$this->_get_logedin_template($SEODataArr);
		}else{
			$data=$this->_get_tobe_login_template($SEODataArr);
		}
		
		$data['CmsData']=$CmsData;
		$this->load->view('cms',$data);
	}
        
    function _get_meta_deetails_of_menu($Arr){
        $meta=array(
            '0'=>array('name'=>'description','content'=>$Arr['metaDescription']),
            '1'=>array('name'=>'keywords','content'=>$Arr['metaDescription'])
            );
        $SEODataArr=array('MetaTitle'=>$Arr['metaTitle'],'meta'=>$meta);
        return $SEODataArr;
    }
}