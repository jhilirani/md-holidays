<?php

/*
| ----------------------------------------------
| Start Date : 23-11-2010
| Framework : CodeIgniter
| ----------------------------------------------
| Model Video Gallery
| ----------------------------------------------
*/

class Country_model extends CI_Model {

    public $_table = 'country';
	public $_table_state = 'state';
    public $result = null;

    function __construct()
    {
        parent::__construct();
    }
    
	
	function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->_table);
		//$this->db->where('Status <','2');
		$query = $this->db->get();
		$this->result = $query->result();
		return $this->result;
	}	
	
	function get_state_country($CountryID)
	{
		$this->db->select('*');
		$this->db->from($this->_table_state);
		$this->db->where('CountryID',$CountryID);
		$query = $this->db->get();
		$this->result = $query->result();
		return $this->result;
	}	
	
	function get_all_state(){
		$this->db->select('*');
		$this->db->from($this->_table_state);
		//$this->db->where('Status <','2');
		$query = $this->db->get();
		$this->result = $query->result();
		return $this->result;
	}
}

?>