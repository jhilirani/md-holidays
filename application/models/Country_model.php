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
    
	
	function get_all($type="")
	{
		$this->db->select('*');
		$this->db->from($this->_table);
		//$this->db->where('Status <','2');
		$query = $this->db->get();
                if($type=="")
                    $this->result = $query->result();
                else
                    $this->result = $query->result_array();
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
        
        function get_all_country(){
            $rs= $this->db->from($this->_table)->where('locationType',0)->get()->result_array();
            //echo $this->db->last_query();die;
            return $rs;
        }
        
        function get_state_by_country_for_api($parentId){
            $rs= $this->db->from($this->_table)->where('locationType',1)->where('parentId',$parentId)->get()->result_array();
            //echo $this->db->last_query();die;
            return $rs;
        }
}

?>