<?php

class Admin_model extends CI_Model {

    public $_table = 'admin';
    public $result = NULL;
    function __construct() {
        parent::__construct();
    }

    public function add_admin($DataArr) {
        $this->db->insert($this->_table, $DataArr);
        return $this->db->insert_id();
    }

    public function get_all_admin() {
        $rs = $this->db->select('*')->from($this->_table)->get()->result();
        //echo $this->db->last_query();die;
        return $rs;
    }

    public function update_info($DataArr, $Id) {
        $this->db->where('adminId', $Id);
        $this->db->update($this->_table, $DataArr);
        return TRUE;
    }

    public function delete($id) {
        $this->db->where('adminId', $id);
        $this->db->delete($this->_table);
        return TRUE;
    }

    public function is_valid_data($UserName, $Password) {
        $rs = $this->db->select('')->from($this->_table)->where('userName', $UserName)->where('password', base64_encode($Password) . '~' . sha1(MTH_SHA1_SULT))->get()->result();
        //echo $this->db->last_query();die;
        return $rs;
    }

}

?>