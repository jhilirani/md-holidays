<?php
class Menu_model extends CI_Model {
	public $_table='menu_category';
	function __construct() {
            parent::__construct();
	}
	
	public function get_all(){
		$this->db->select('*')->from($this->_table)->where('status <','2');
		return $this->db->get()->result();
	}
        
        function get_all_active(){
            $this->db->select('*')->from($this->_table)->where('status','1');
		return $this->db->get()->result();
        }
	
	public function get_for_course(){
		$this->db->select('*')->from($this->_table)->where('status','1');
		return $this->db->get()->result();
	}
	
	public function add($dataArr){
		$this->db->insert($this->_table,$dataArr);
		return $this->db->insert_id();
	}
	
	public function edit($DataArr,$menuCategoryId){
		$this->db->where('menuCategoryId',$menuCategoryId);
		$this->db->update($this->_table,$DataArr);
		//echo $this->db->last_query();die;
		return TRUE;		
	}
	
	public function get_id_by_name($menuCategoryName){
		$this->db->select('menuCategoryId')->from($this->_table)->like('menuCategoryName',$menuCategoryName);
		return $this->db->get()->result();
	}
	
	public function check_category_name_exists($menuCategoryName){
		$dataArr=$this->db->select("menuCategoryId")->from($this->_table)->where('menuCategoryName',$menuCategoryName)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function check_edit_category_name_exists($menuCategoryName,$menuCategoryId){
		$dataArr=$this->db->select("menuCategoryId")->from($this->_table)->where('menuCategoryName',$menuCategoryName)->where('menuCategoryId <>',$menuCategoryId)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function change_category_status($menuCategoryId,$status){
		$this->db->where('menuCategoryId',$menuCategoryId);
		$this->db->update($this->_table,array('status'=>$status));
		return TRUE;
	}
	
	public function delete($menuCategoryId){
		$this->db->delete($this->_table, array('menuCategoryId' => $menuCategoryId)); 
		return TRUE;
	}
	
        public function featured($menuCategoryId){
            $this->db->where('menuCategoryId',$menuCategoryId);
            $this->db->update($this->_table,array('Featured'=>'1'));
            return TRUE;
        }
        
}