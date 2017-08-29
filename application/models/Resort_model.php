<?php

class Resort_model extends CI_Model {

    private $_table = 'resort';
    private $_table_room_type = 'room_type';
    private $_table_room;
    private $_table_image;
    private $_id = "resortId";
    private $_id_img = "resortImageId";
    private $_table_factfile ;
    private $_factfile="factfile" ;
    private $_table_facility ;
    private $_facility ="facility";
    private $_table_sports ;
    private $_sports ="sports_recreation";
    private $_table_enjay_type;
    private $_enjay_type="enjay_type";
    private $_table_room_charges;
    private $_table_room_details;

    function __construct() {
        parent::__construct();
        $this->_table_room=  $this->_table."_room";
        $this->_table_image=  $this->_table."_image";
        $this->_table_factfile=  $this->_table."_factfile";
        $this->_table_facility=  $this->_table."_facility";
        $this->_table_sports=  $this->_table."_sports_recreation";
        $this->_table_enjay_type=  $this->_table."_enjay_type";
        $this->_table_room_charges=  $this->_table_room."_charges";
        $this->_table_room_details=  $this->_table_room."_details";
    }

    function add($dataArr) {
        $this->db->insert($this->_table, $dataArr);
        return $this->db->insert_id();
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

    function get_all_admin() {
        //echo $this->_table_images;die;
        $this->db->select('r.*,ri.image')->from($this->_table." as r");
        $this->db->join($this->_table_image." AS ri",'ri.resortId=r.resortId','left');
        $rs=$this->db->where('r.status',1)->group_by('r.resortId')->get()->result();
        //echo $this->db->last_query();die;
        return $rs;
    }
    
    function get_latet_10_resort_for_home(){
        $this->db->select('r.*,ri.image,rrc.oneAdult')->from($this->_table." as r");
        $this->db->join($this->_table_image." AS ri",'ri.resortId=r.resortId','left');
        $this->db->join($this->_table_room." AS rr",'rr.resortId=r.resortId','left');
        $this->db->join($this->_table_room_charges." AS rrc",'rrc.resortRoomId=rr.resortRoomId','left');
        $rs=$this->db->where('r.isShowAtHome',1)->where('r.status',1)->group_by('r.resortId')->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }

    function get_all() {
        $rs = $this->db->get_where($this->_table, array('status' => 1))->result();
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

    function add_factfile($batchDataArr) {
        $this->db->insert_batch($this->_table_factfile, $batchDataArr);
    }

    function remove_factfile($id) {
        $this->db->delete($this->_table_factfile, array($this->_id => $id));
    }

    function add_facility($batchDataArr) {
        $this->db->insert_batch($this->_table_facility, $batchDataArr);
    }

    function remove_facility($id) {
        $this->db->delete($this->_table_facility, array($this->_id => $id));
    }

    function add_sports_recreation($batchDataArr) {
        $this->db->insert_batch($this->_table_sports, $batchDataArr);
    }

    function remove_sports_recreation($id) {
        $this->db->delete($this->_table_sports, array($this->_id => $id));
    }
    
    function add_enjay_type($batchDataArr) {
        $this->db->insert_batch($this->_table_enjay_type, $batchDataArr);
    }

    function remove_enjay_type($id) {
        $this->db->delete($this->_table_enjay_type, array($this->_id => $id));
    }
    
    function add_room_details($batchDataArr) {
        $this->db->insert_batch($this->_table_room_details, $batchDataArr);
    }

    function remove_room_details($id) {
        $this->db->delete($this->_table_room_details, array('resortRoomId' => $id));
    }

    function get_factfile($id) {
        $this->db->select('rf.*,f.factfile')->from($this->_table_factfile." AS rf");
        $this->db->join($this->_factfile." AS f",'rf.factfileId=f.factfileId');
        $rs=$this->db->where('rf.resortId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_factfile, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }

    function get_facility($id) {
        $this->db->select('rf.*,f.facility')->from($this->_table_facility." AS rf");
        $this->db->join($this->_facility.' AS f','rf.facilityId=f.facilityId');
        $rs = $this->db->where('rf.resortId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_facility, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }

    function get_sports_recreation($id) {
        $this->db->select('rsr.*,sr.sportsRecreation')->from($this->_table_sports." AS rsr");
        $this->db->join($this->_sports." AS sr",'rsr.sportsRecreationId=sr.sportsRecreationId');
        $rs=  $this->db->where('rsr.resortId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_sports, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_enjay_type($id){
        $this->db->select('ret.*,et.name,et.image')->from($this->_table_enjay_type." AS ret");
        $this->db->join($this->_enjay_type." AS et",'ret.enjayTypeId=et.enjayTypeId');
        $rs=  $this->db->where('ret.resortId',$id)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_enjay_type, array($this->_id => $id))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function get_room_details($resortRoomId){
        $this->db->select('rrd.*,rd.title')->from($this->_table_room_details.' As rrd');
        $this->db->join('room_details AS rd','rrd.roomDetailsId=rd.roomDetailsId');
        $rs = $this->db->where('rrd.resortRoomId',$resortRoomId)->get()->result_array();
        //$rs = $this->db->get_where($this->_table_room_details, array("resortRoomId" => $resortRoomId))->result_array();
        //echo $this->db->last_query();
        return $rs;
    }

    function get_rooms($id) {
        $sql = "SELECT re.title AS resortTitle,rr.*,rt.roomType FROM "
                . " " . $this->_table . " AS re LEFT JOIN " . $this->_table_room . " AS rr ON(rr.resortId=re.resortId )"
                . " LEFT JOIN " . $this->_table_room_type . " AS rt ON(rt.roomTypeId=rr.roomTypeId) "
                . " WHERE  re.resortId=" . $id;
        $rs = $this->db->query($sql)->result_array();
        //pre($rs);die;
        //echo $this->db->last_query();die;
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

    function get_full_details($resortId){
        $sql="SELECT r.*,rer.*,r.resortId AS ResortID,c.categoryName,r.title AS ResortTitle FROM ".$this->_table." AS r JOIN ".$this->_table_room." AS rr ON(r.resortId=rr.resortId)"
                . " JOIN category AS c ON(c.categoryId=r.categoryId) JOIN ".$this->_table_room." AS rer ON(rer.resortId=r.resortId) "
                . " WHERE r.resortId=".$resortId.' GROUP BY rer.resortRoomId';
        //echo $sql;die;
        $rs=  $this->db->query($sql)->result_array();
        return $rs;
    }
    
    function get_all_by_menue($categoryId){
        $sql=  $this->db->select('r.*,ri.image,rrc.oneAdult,c.categoryName')->from($this->_table." AS r");
        $this->db->join("category AS c",'c.categoryId=r.categoryId');
        $this->db->join($this->_table_image." ri",'ri.resortId=r.resortId','left');
        $this->db->join($this->_table_room." AS rr",'rr.resortId=r.resortId','left');
        $this->db->join($this->_table_room_charges." AS rrc",'rrc.resortRoomId=rr.resortRoomId','left');
        $rs=$this->db->where('r.isShowAtHome',1)->where('r.status',1)->where('r.categoryId',$categoryId)->group_by('r.resortId')->get()->result_array();
        //echo $this->db->last_query();
        return $rs;
    }
    
    function first_charges_by_resortRoomId($resortRoomId){
        $rs=  $this->db->from($this->_table_room_charges)->where('resortRoomId',$resortRoomId)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
}
