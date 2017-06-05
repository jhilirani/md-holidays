<?php
class User_model extends CI_Model {
	public $_table='user';
	private $_contact='contacts';
	public $result=NULL;
	function __construct() {
		parent::__construct();
	}
	
	public function get_all_user(){
		$this->db->select('*')->from($this->_table)->where('Status <','2');
		$query=$this->db->get();
		return $query->result();	
	//echo $this->db->last_query();die;
	}
	
	public function add($dataArray){
		$this->db->insert($this->_table,$dataArray);
		return $this->db->insert_id();
	}
	
	public function edit($DataArr,$UserID){
		$this->db->where('UserID',$UserID);
		$this->db->update($this->_table,$DataArr);
		return TRUE;		
	}
	
	public function change_user_status($UserID,$Status){
		$this->db->where('UserID',$UserID);
		$this->db->update($this->_table,array('Status'=>$Status));
		return TRUE;
	}
	
	public function get_details_by_id($UserID){
		$this->db->select('*')->from($this->_table)->where('UserID',$UserID);
		$query=$this->db->get();
		return $query->result();
	}
	
	public function get_active_user(){
		return $this->db->select('*')->from($this->_table)->where('Status <','2')->get()->result();
	}
	
	public function check_username_exists($Email){
		//SELECT UserID FROM ".TABLEPREFIX."_user WHERE Email='".$Email."' AND Status<2
		$this->db->select('UserID')->from($this->_table)->where('Email',$Email)->where('Status <','2');
		if(count($this->db->get()->result())>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	public function check_edit_username_exists($Email,$UserID){
		$sql="SELECT * FROM ".$this->_table." WHERE `Email`='".$Email."' AND `UserID`<>'".$UserID."'";
		$rs=$this->db->query($sql)->result();
		if(count($rs)>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function check_login_data($Email,$Password){
		$this->db->select('*')->from($this->_table)->where('Email',$Email)->where('Password',base64_encode($Password))->where('Status','1');
		return $this->db->get()->result();
	}
	
	
	
	public function get_user_for_admin(){
		$this->db->select('*')->from($this->_table)->where('UserTypeID',1)->where('Status',1);
		return $this->db->get()->result();
	}
	
	public function delete($UserID){
		$this->db->delete($this->_table, array('UserID' => $UserID)); 
		return TRUE;
	}
        
        public function get_details_by_email($Email){
            $rs=$this->db->select('*')->from($this->_table)->where('Email',$Email)->get()->result();
            if(count($rs)>0){
                return $rs[0]->UserID;
            }else{
                return '0';
            }
        }
        
        public function post_contact($dataArray){
            $this->db->insert($this->_contact,$dataArray);
            return $this->db->insert_id();
        }
        
        public function get_contacts(){
            return $this->db->from($this->_contact)->order_by('ContactUsID','DESC')->get()->result();
        }
        
        public function contact_delete($id){
            $this->db->delete($this->_contact, array('ContactUsID' => $id)); 
            return TRUE;
        }
}
?>