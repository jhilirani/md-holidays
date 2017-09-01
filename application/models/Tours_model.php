<?php

class Tours_model extends CI_Model {

    private $_table = 'tours';
    private $_table_image = 'tours_image';
    private $_table_services = 'tours_services';
    private $_services = 'services';
    private $_table_rattings = 'tours_rattings';
    private $_table_enjay_type = 'tours_enjay_type';
    private $_enjay_type = 'enjay_type';
    private $_id = "toursId";
    private $_category ="category";

    function __construct() {
        parent::__construct();
    }

    function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }
    
    function add_image($dataArr) {
        $this->db->insert($this->_table_image, $dataArr);
        return $this->db->insert_id();
    }
    
    function add_services($dataArr) {
        $this->db->insert_batch($this->_table_services, $dataArr);
        return $this->db->insert_id();
    }
    
    function remove_services($id) {
        $this->db->delete($this->_table_services, array($this->_id => $id));
    }
    
    function add_enjay_type($dataArr) {
        $this->db->insert_batch($this->_table_enjay_type, $dataArr);
        return $this->db->insert_id();
    }
    
    function remove_enjay_type($id) {
        $this->db->delete($this->_table_enjay_type, array($this->_id => $id));
    }

    function edit($dataArr, $id) {
        $this->db->where($this->_id, $id);
        $this->db->update($this->_table, $dataArr);
        //echo $this->db->last_query();die;
        return TRUE;
    }

    function delete($id) {
        $this->db->delete($this->_table, array($this->_id => $id));
        return TRUE;
    }
    
    function delete_image($id) {
        $this->db->delete($this->_table_image, array($this->_id => $id));
        return TRUE;
    }

    function delete_services($id) {
        $this->db->delete($this->_table_services, array($this->_id => $id));
        return TRUE;
    }
    
    function delete_enjay_type($id) {
        $this->db->delete($this->_table_enjay_type, array($this->_id => $id));
        return TRUE;
    }
    
    function get_all_admin() {
        $this->db->select('t.*,ti.image')->from($this->_table." as t");
        $this->db->join($this->_table_image." AS ti",'ti.toursId=t.toursId','left');
        $rs=$this->db->where('t.status',1)->group_by('ti.toursId')->get()->result();
        //echo $this->db->last_query();die;
        return $rs;
    }

    function get_all() {
        $rs = $this->db->get_where($this->_table, array('status' => 1))->result();
        return $rs;
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

    function details($id) {
        $rs = $this->db->get_where($this->_table, array($this->_id => $id))->result();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_images($Id) {
        $rs = $this->db->get_where($this->_table_image, array($this->_id => $Id))->result();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_services($id) {
        $this->db->select('ts.*,s.services')->from($this->_table_services." AS ts");
        $this->db->join($this->_services." AS s",'ts.servicesId=s.servicesId');
        $rs=  $this->db->where('ts.toursId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_services, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_enjay_type($id){
        $this->db->select('tet.*,et.name,et.image')->from($this->_table_enjay_type." AS tet");
        $this->db->join($this->_enjay_type." AS et",'tet.enjayTypeId=et.enjayTypeId');
        $rs=  $this->db->where('tet.toursId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_enjay_type, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_latet_10_tours_for_home(){
        $this->db->select('t.*,ti.image,c.categoryName')->from($this->_table." as t");
        $this->db->join($this->_category." AS c",'t.categoryId=c.categoryId');
        $this->db->join($this->_table_image." AS ti",'ti.toursId=t.toursId','left');
        $rs=$this->db->where('t.isShowAtHome',1)->where('t.status',1)->group_by('t.toursId')->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
    
    function get_all_by_menue(){
        $this->db->select('t.*,ti.image,c.categoryName')->from($this->_table." as t");
        $this->db->join("category AS c",'c.categoryId=t.categoryId');
        $this->db->join($this->_table_image." AS ti",'ti.toursId=t.toursId','left');
        $rs=$this->db->where('t.isShowAtHome',1)->where('t.status',1)->group_by('t.toursId')->get()->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_full_details($toursId){
        $sql="SELECT t.*,c.categoryName FROM ".$this->_table." AS t "
                . " JOIN category AS c ON(c.categoryId=t.categoryId)  "
                . " WHERE t.toursId=".$toursId.' GROUP BY t.toursId';
        //echo $sql;die;
        $rs=  $this->db->query($sql)->result_array();
        return $rs;
    }
}
