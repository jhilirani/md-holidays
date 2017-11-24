<?php

class Order_model extends CI_Model {

    private $_table = 'booking_order';
    private $_paypal = 'paypal_data';
    private $_table_pay_online_request = 'pay_online_request';
    public $result = NULL;

    function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_admin() {
        $sql = "SELECT o.*,u.FirstName,u.LastName,c.Title,u.Email FROM `order` AS o JOIN `user` AS u ON(o.UserID=u.UserID) JOIN `course` AS c ON(o.CourseID=c.CourseID)";
        return $this->db->query($sql)->result();
    }

    public function get_all_active_order() {
        $this->db->select('*')->from($this->_table)->where('Status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
    }

    function add_send_link_user($dataArr) {
        $this->db->insert($this->_table_pay_online_request, $dataArr);
        return $this->db->insert_id();
    }

    public function add_paypal_data($dataArray) {
        $this->db->insert($this->_paypal, $dataArray);
        return $this->db->insert_id();
    }

    public function update_status($Status, $OrderID) {
        $this->db->where('OrderID', $OrderID);
        $this->db->update($this->_table, array('Status' => 1));
        return TRUE;
    }

    public function edit($OrderID, $DataArr) {
        $this->db->where('OrderID', $OrderID);
        $this->db->update($this->_table, $DataArr);
        return TRUE;
    }

    public function change_state($OrderID, $Status) {
        $this->db->update($this->_table, array('Status' => $Status))->where('OrderID', $OrderID);
        return TRUE;
    }

    public function get_details($OrderID) {
        $this->db->select('*')->from($this->_table)->where('OrderID', $OrderID);
        return $this->db->get()->result();
    }

    public function get_paypal_transaction_id($OrderID) {
        $sql = "SELECT pd.PayPalTransactionID FROM `order` AS o LEFT JOIN  paypal_data AS pd ON(o.PaypalID=pd.PayPalDataID) WHERE o.OrderID='" . $OrderID . "'";
        $dataArr = $this->db->query($sql)->result();
        return $dataArr[0]->PayPalTransactionID;
    }

    public function remove_order($OrderID) {
        $this->db->where_in('OrderID', $OrderID);
        $this->db->delete($this->_table);
        return TRUE;
    }

    public function get_request_details($link) {
        return $this->db->from($this->_table_pay_online_request)->where('UniqueID', $link)->get()->row_array();
    }
    
    function update_rajorpayPaymentId($orderId,$rajorpayPaymentId){
        $this->db->where('orderId',$orderId);
        $this->db->update($this->_table,array('razorpayPaymentId'=>$rajorpayPaymentId));
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

?>