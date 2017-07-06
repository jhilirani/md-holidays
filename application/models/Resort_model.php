<?php
class Resort_model extends CI_Model {

    private $_table = 'resort';
    private $_table_room_type = 'room_type';
    private $_table_room = 'resort_room';
    private $_table_image = 'resort_image';
    private $_id="resortId";
    private $_id_img="resortImageId";
    private $_table_factfile="resort_factfile";
    private $_table_facility="resort_facility";
    private $_table_sports="resort_sports_recreation";
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
    
    function details($id){
        $rs=  $this->db->get_where($this->_table,array($this->_id=>$id))->result();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_images($Id){
        $rs=  $this->db->get_where($this->_table_image,array($this->_id_img=>$Id))->result();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function add_factfile($batchDataArr){
        $this->db->insert_batch($this->_table_factfile,$batchDataArr);
    }
    
    function remove_factfile($id){
        $this->db->delete($this->_table_factfile, array($this->_id => $id));
    }
    
    function add_facility($batchDataArr){
        $this->db->insert_batch($this->_table_facility,$batchDataArr);
    }
    
    function remove_facility($id){
        $this->db->delete($this->_table_facility, array($this->_id => $id));
    }
    
    function add_sports_recreation($batchDataArr){
        $this->db->insert_batch($this->_table_sports,$batchDataArr);
    }
    
    function remove_sports_recreation($id){
        $this->db->delete($this->_table_sports, array($this->_id => $id));
    }
    
    function get_factfile($id){
        $rs=  $this->db->get_where($this->_table_factfile,array($this->_id=>$id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_facility($id){
        $rs=  $this->db->get_where($this->_table_facility,array($this->_id=>$id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_sports_recreation($id){
        $rs=  $this->db->get_where($this->_table_sports,array($this->_id=>$id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_rooms($id){
        $sql="SELECT re.title AS resortTitle,rr.*,rt.roomType FROM "
                . " ".  $this->_table." AS re LEFT JOIN ". $this->_table_room." AS rr ON(rr.resortId=re.resortId )"
                . " LEFT JOIN ". $this->_table_room_type." AS rt ON(rt.roomTypeId=rr.roomTypeId) "
                . " WHERE  re.resortId=".$id;
        $rs=  $this->db->query($sql)->result_array();
        return $rs;
    }
}