<?php
class Category_model extends CI_Model {
	public $_table='category';
	function __construct() {
		
	}
	
	public function get_all(){
		$this->db->select('*')->from($this->_table)->where('Status <','2');
		return $this->db->get()->result();
	}
        
        function get_all_active(){
            $this->db->select('*')->from($this->_table)->where('Status','1');
		return $this->db->get()->result();
        }
	
	public function get_for_course(){
		$this->db->select('*')->from($this->_table)->where('Status','1');
		return $this->db->get()->result();
	}
	
	public function add($dataArr){
		$this->db->insert($this->_table,$dataArr);
		return $this->db->insert_id();
	}
	
	public function edit($DataArr,$CategoryID){
		$this->db->where('CategoryID',$CategoryID);
		$this->db->update($this->_table,$DataArr);
		//echo $this->db->last_query();die;
		return TRUE;		
	}
	
	public function get_id_by_name($CategoryName){
		$this->db->select('CategoryID')->from($this->_table)->like('CategoryName',$CategoryName);
		return $this->db->get()->result();
	}
	
	public function check_category_name_exists($CategoryName){
		$dataArr=$this->db->select("CategoryID")->from($this->_table)->where('CategoryName',$CategoryName)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function check_edit_category_name_exists($CategoryName,$CategoryID){
		$dataArr=$this->db->select("CategoryID")->from($this->_table)->where('CategoryName',$CategoryName)->where('CategoryID <>',$CategoryID)->get()->result();
		if(count($dataArr)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function change_category_status($CategoryID,$Status){
		$this->db->where('CategoryID',$CategoryID);
		$this->db->update($this->_table,array('Status'=>$Status));
		return TRUE;
	}
	
	public function delete($CategoryID){
		$this->db->delete($this->_table, array('CategoryID' => $CategoryID)); 
		return TRUE;
	}
	
        public function featured($CategoryID){
            $this->db->where('CategoryID',$CategoryID);
            $this->db->update($this->_table,array('Featured'=>'1'));
            return TRUE;
        }
        
        public function get_latest_3_featured(){
            return $this->db->from($this->_table)->where('Status',1)->where('Featured','1')->order_by('CategoryID','DESC')->limit(3)->get()->result();
        }
}
?>