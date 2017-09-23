<?php

class Cms_model extends CI_Model {

    public $_table = 'cms';

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        $this->db->select('*')->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }

    public function edit($DataArr, $CMSID) {
        $this->db->where('CMSID', $CMSID);
        $this->db->update($this->_table, $DataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }

    public function get_content_by_id($CMSID) {
        $this->db->select('*')->from($this->_table)->where('CMSID', $CMSID);
        return $this->db->get()->result_array();
    }

    public function change_status($CMSID, $Status) {
        $this->db->where('CMSID', $CMSID);
        $this->db->update($this->_table, array('Status' => $Status));
        return TRUE;
    }

    public function delete($CMSID) {
        $this->db->delete($this->_table, array('CMSID' => $CMSID));
        return TRUE;
    }

    public function get_content($string) {
        $funIdArr = array(
            'about_us' => 1,
            'terms_of_services' => 3,
            'privacy_policy' => 4,
            'travel_guide' => 5,
            'contact_us' => 2,
        );
        //contact-us ===  2
        return $this->get_content_by_id($funIdArr[$string]);
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
    
}

?>