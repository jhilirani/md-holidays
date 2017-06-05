<?php
class Faq_model extends CI_Model{
	public $_table='sp_faq';
	
	function __construct() {
		parent::__construct();
	}
	
	public function get_all(){
		$this->db->select('*')->from($this->_table)->where('Status',1);
		return $this->db->get()->result();
	}
	
	public function get_answer($Question){
		$this->db->select('*')->from($this->_table)->like('Question',$Question);
		return $this->db->get()->result();
	}
}
?>