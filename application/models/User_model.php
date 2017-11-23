<?php

class User_model extends CI_Model {

    public $_table = 'user';
    private $_contact = 'contacts';
    public $result = NULL;

    function __construct() {
        parent::__construct();
    }

    public function get_all_user() {
        $this->db->select('*')->from($this->_table)->where('Status <', '2');
        $query = $this->db->get();
        return $query->result();
        //echo $this->db->last_query();die;
    }

    public function add($dataArray) {
        $this->db->insert($this->_table, $dataArray);
        return $this->db->insert_id();
    }

    public function edit($DataArr, $UserID) {
        $this->db->where('UserID', $UserID);
        $this->db->update($this->_table, $DataArr);
        return TRUE;
    }

    public function change_user_status($UserID, $Status) {
        $this->db->where('UserID', $UserID);
        $this->db->update($this->_table, array('Status' => $Status));
        return TRUE;
    }

    public function get_details_by_id($UserID) {
        $this->db->select('*')->from($this->_table)->where('UserID', $UserID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_active_user() {
        return $this->db->select('*')->from($this->_table)->where('Status <', '2')->get()->result();
    }

    public function check_username_exists($Email) {
        //SELECT UserID FROM ".TABLEPREFIX."_user WHERE Email='".$Email."' AND Status<2
        $this->db->select('UserID')->from($this->_table)->where('Email', $Email)->where('Status <', '2');
        if (count($this->db->get()->result()) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_edit_username_exists($Email, $UserID) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE `Email`='" . $Email . "' AND `UserID`<>'" . $UserID . "'";
        $rs = $this->db->query($sql)->result();
        if (count($rs) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_login_data($Email, $Password) {
        $this->db->select('*')->from($this->_table)->where('Email', $Email)->where('Password', base64_encode($Password))->where('Status', '1');
        return $this->db->get()->result();
    }

    public function get_user_for_admin() {
        $this->db->select('*')->from($this->_table)->where('UserTypeID', 1)->where('Status', 1);
        return $this->db->get()->result();
    }

    public function delete($UserID) {
        $this->db->delete($this->_table, array('UserID' => $UserID));
        return TRUE;
    }

    public function get_details_by_email($Email) {
        $rs = $this->db->select('*')->from($this->_table)->where('Email', $Email)->get()->result();
        if (count($rs) > 0) {
            return $rs[0]->UserID;
        } else {
            return '0';
        }
    }

    public function post_contact($dataArray) {
        $this->db->insert($this->_contact, $dataArray);
        return $this->db->insert_id();
    }

    public function get_contacts() {
        return $this->db->from($this->_contact)->order_by('ContactUsID', 'DESC')->get()->result();
    }

    public function contact_delete($id) {
        $this->db->delete($this->_contact, array('ContactUsID' => $id));
        return TRUE;
    }

    /**
     * 
     * @param type $columnName
     * @param type $conditionArr
     * @param type $return_type="result"
     * @return type
     * example it will use in controlelr
     * 
     * =====bellow is for * data without conditions======
     * get_data_generic_fun('parent','*');
     *  =====bellow is for * data witht conditions======
     * get_data_generic_fun('parent','*',array('column1'=>$column1Value,'column2'=>$column2Value));
     * 
     * =====bellow is for 1 or more column data without conditions======
     * get_data_generic_fun('parent','column1,column2,column3');
     *  =====bellow is for 1 or more column data with conditions======
     * get_data_generic_fun('parent','column1,column2,column3',array('column1'=>$column1Value,'column2'=>$column2Value));
     *  =====bellow is for 1 or more column data with conditions and return as result all======
     * get_data_generic_fun('parent','column1,column2,column3',array('column1'=>$column1Value,'column2'=>$column2Value),'result_arr');
     * 
     * ==== modification for  adding sortby and limit and add conditionArr for AND -- OR -- IN ---
     * get_data_generic_fun('parent','parent_id,passcode',array('passcode'=>$passcoad,'device_token'=>$deviceToken,'condition_type'=>'or'),array('parrent_id'=>'asc','date_time'=>'desc'),1);
     */
    function get_data_generic_fun($columnName = "*", $conditionArr = array(), $return_type = "result", $sortByArr = array(), $limit = "") {
        $this->db->select($columnName);
        $condition_type = 'and';
        if (array_key_exists('condition_type', $conditionArr)) {
            if ($conditionArr['condition_type'] != "") {
                $condition_type = $conditionArr['condition_type'];
            }
        }
        unset($conditionArr['condition_type']);
        $condition_in_data_arr = array();
        $startCounter = 0;
        $condition_in_column = "";
        foreach ($conditionArr AS $k => $v) {
            if ($condition_type == 'in') {
                if (array_key_exists('condition_in_data', $conditionArr)) {
                    $condition_in_data_arr = explode(',', $conditionArr['condition_in_data']);
                    $condition_in_column = $conditionArr['condition_in_col'];
                }
            } elseif ($condition_type == 'or') {
                if ($startCounter == 0) {
                    $this->db->where($k, $v);
                } else {
                    $this->db->or_where($k, $v);
                }
            } elseif ($condition_type == 'and') {
                $this->db->where($k, $v);
            }
            $startCounter++;
        }

        if ($condition_type == 'in') {
            if (!empty($condition_in_data_arr))
                $this->db->where_in($condition_in_column, $condition_in_data_arr);
        }

        if ($limit != "") {
            $this->db->limit($limit);
        }

        foreach ($sortByArr AS $key => $val) {
            $this->db->order_by($key, $val);
        }

        if ($return_type == 'result') {
            $rs = $this->db->get($this->_table)->result();
        } else {
            $rs = $this->db->get($this->_table)->result_array();
        }

        return $rs;
    }
	
	public function add_token($dataArray) {
        $this->db->insert('fcm_token', $dataArray);
        return $this->db->insert_id();
    }
	
	public function add_device_location($dataArray) {
        $this->db->insert('device_location', $dataArray);
        return $this->db->insert_id();
    }
	
}
?>