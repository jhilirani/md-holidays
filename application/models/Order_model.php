<?php
class Order_model extends CI_Model {
	private $_table='order';
        private $_paypal='paypal_data';
        private $_table_pay_online_request='pay_online_request';


        public $result=NULL;
	
	function __construct() {
		parent::__construct();
	}
	
	public function get_all(){
		$this->db->select($this->_table);
		$query=$this->db->get();
		return $query->result();
	}
        
        public function get_all_admin(){
            $sql="SELECT o.*,u.FirstName,u.LastName,c.Title,u.Email FROM `order` AS o JOIN `user` AS u ON(o.UserID=u.UserID) JOIN `course` AS c ON(o.CourseID=c.CourseID)";
            return $this->db->query($sql)->result();
        }
	
	public function get_all_active_order(){
		$this->db->select('*')->from($this->_table)->where('Status',1);
		$query=$this->db->get();
		return $query->result();
	}
	
	public function add($dataArr){
		$this->db->insert($this->_table,$dataArr);
		return $this->db->insert_id();
	}
        
        function add_send_link_user($dataArr){
            $this->db->insert($this->_table_pay_online_request,$dataArr);
            return $this->db->insert_id();
        }
	
        public function add_paypal_data($dataArray){
		$this->db->insert($this->_paypal,$dataArray);
		return $this->db->insert_id();
	}
	
	
	public function update_status($Status,$OrderID){
		$this->db->where('OrderID',$OrderID);
		$this->db->update($this->_table,array('Status'=>1));
		return TRUE;
	}
        
	public function edit($OrderID,$DataArr){
                $this->db->where('OrderID',$OrderID);
		$this->db->update($this->_table,$DataArr);
		return TRUE;
	}
	
	public function change_state($OrderID,$Status){
		$this->db->update($this->_table,array('Status'=>$Status))->where('OrderID',$OrderID);
		return TRUE;
	}
	
	
	public function get_details($OrderID){
		$this->db->select('*')->from($this->_table)->where('OrderID',$OrderID);
		return $this->db->get()->result();
	}
	
        public function get_paypal_transaction_id($OrderID){
            $sql="SELECT pd.PayPalTransactionID FROM `order` AS o LEFT JOIN  paypal_data AS pd ON(o.PaypalID=pd.PayPalDataID) WHERE o.OrderID='".$OrderID."'";
            $dataArr=$this->db->query($sql)->result();
            return $dataArr[0]->PayPalTransactionID;
	}
        
        public function remove_order($OrderID){
		$this->db->where_in('OrderID',$OrderID);
		$this->db->delete($this->_table);
		return TRUE;
	}
        
        public function get_request_details($link){
            return $this->db->from($this->_table_pay_online_request)->where('UniqueID',$link)->get()->row_array();
        }
}
?>