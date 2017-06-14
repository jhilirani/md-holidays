<?php
class Category_model extends CI_Model {
	public $_table='category';
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
	
	public function edit($DataArr,$categoryId){
		$this->db->where('categoryId',$categoryId);
		$this->db->update($this->_table,$DataArr);
		//echo $this->db->last_query();die;
		return TRUE;		
	}
	
	public function get_id_by_name($categoryName){
		$this->db->select('categoryId')->from($this->_table)->like('categoryName',$categoryName);
		return $this->db->get()->result();
	}
	
	public function check_category_name_exists($categoryName){
		$dataArr=$this->db->select("categoryId")->from($this->_table)->where('categoryName',$categoryName)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function check_edit_category_name_exists($categoryName,$categoryId){
		$dataArr=$this->db->select("categoryId")->from($this->_table)->where('categoryName',$categoryName)->where('categoryId <>',$categoryId)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function change_category_status($categoryId,$status){
		$this->db->where('categoryId',$categoryId);
		$this->db->update($this->_table,array('status'=>$status));
		return TRUE;
	}
	
	public function delete($categoryId){
		$this->db->delete($this->_table, array('categoryId' => $categoryId)); 
		return TRUE;
	}
	
        public function featured($categoryId){
            $this->db->where('categoryId',$categoryId);
            $this->db->update($this->_table,array('featured'=>'1'));
            return TRUE;
        }
        
        public function get_latest_3_featured(){
            return $this->db->from($this->_table)->where('status',1)->where('featured','1')->order_by('categoryId','DESC')->limit(3)->get()->result();
        }
}