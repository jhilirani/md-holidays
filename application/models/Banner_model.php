<?php

class Banner_model extends CI_Model {

    public $_table = 'banner';
    function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('*')->from($this->_table)->where('status <', '2');
        return $this->db->get()->result();
    }

    public function get_for_fe() {
        $this->db->select('*')->from($this->_table)->where('status', '1');
        return $this->db->get()->result();
    }

    public function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }

    public function edit($DataArr, $bannerId) {
        $this->db->where('bannerId', $bannerId);
        $this->db->update($this->_table, $DataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }

    public function change_status($bannerId, $status) {
        $this->db->where('bannerId', $bannerId);
        $this->db->update($this->_table, array('status' => $status));
        return TRUE;
    }

    public function delete($bannerId) {
        $this->db->delete($this->_table, array('bannerId' => $bannerId));
        return TRUE;
    }
}