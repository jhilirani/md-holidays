<?php

class Banner_model extends CI_Model {

    public $_table = 'banner';
    private $_id="bannerId";
    function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('*')->from($this->_table)->where('status <', '2');
        return $this->db->get()->result();
    }

    public function get_for_fe() {
        $rs=  $this->db->get_where($this->_table,array('status'=>1))->result();
        return $rs;
    }

    public function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }

    public function edit($DataArr, $id) {
        $this->db->where($this->_id, $id);
        $this->db->update($this->_table, $DataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }

    public function change_status($Id, $status) {
        $this->db->where($this->_id, $Id);
        $this->db->update($this->_table, array('status' => $status));
        return TRUE;
    }

    public function delete($id) {
        $this->db->delete($this->_table, array($this->_id => $id));
        return TRUE;
    }
}