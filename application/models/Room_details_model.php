<?php
class Room_details_model extends CI_Model {

    private $_table = 'room_details';
    private $_id="roomDetailsId";
    function __construct() {
        parent::__construct();
    }
    
    function add($dataArr){
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }
    
    function edit($dataArr,$id){
        $this->db->where($this->_id, $id);
        $this->db->update($this->_table, $dataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }
    
    function delete($id){
        $this->db->delete($this->_table, array($this->_id => $id));
        return TRUE;
    }
    
    function get_all_admin(){
        $rs=  $this->db->get($this->_table)->result();
        return $rs;
    }
    
    function get_all(){
        $rs=  $this->db->get_where($this->_table,array('status'=>1))->result();
        return $rs;
    }
}