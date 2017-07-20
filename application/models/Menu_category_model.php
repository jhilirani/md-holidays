<?php

class Menu_category_model extends CI_Model {

    public $_table = 'menu_category';

    function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('*')->from($this->_table)->where('status <', '2');
        return $this->db->get()->result();
    }

    function get_all_active() {
        $this->db->select('*')->from($this->_table)->where('status', '1');
        return $this->db->get()->result();
    }

    public function get_for_course() {
        $this->db->select('*')->from($this->_table)->where('status', '1');
        return $this->db->get()->result();
    }

    public function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }

    public function edit($DataArr, $menuCategoryId) {
        $this->db->where('menuCategoryId', $menuCategoryId);
        $this->db->update($this->_table, $DataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }

    public function get_id_by_name($menuCategoryName) {
        $this->db->select('menuCategoryId')->from($this->_table)->like('menuCategoryName', $menuCategoryName);
        return $this->db->get()->result();
    }

    public function check_category_name_exists($menuCategoryName) {
        $dataArr = $this->db->select("menuCategoryId")->from($this->_table)->where('menuCategoryName', $menuCategoryName)->get()->result();
        if (count($dataArr) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_edit_category_name_exists($menuCategoryName, $menuCategoryId) {
        $dataArr = $this->db->select("menuCategoryId")->from($this->_table)->where('menuCategoryName', $menuCategoryName)->where('menuCategoryId <>', $menuCategoryId)->get()->result();
        if (count($dataArr) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function change_category_status($menuCategoryId, $status) {
        $this->db->where('menuCategoryId', $menuCategoryId);
        $this->db->update($this->_table, array('status' => $status));
        return TRUE;
    }

    public function delete($menuCategoryId) {
        $this->db->delete($this->_table, array('menuCategoryId' => $menuCategoryId));
        return TRUE;
    }

    public function featured($menuCategoryId) {
        $this->db->where('menuCategoryId', $menuCategoryId);
        $this->db->update($this->_table, array('featured' => '1'));
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

}
