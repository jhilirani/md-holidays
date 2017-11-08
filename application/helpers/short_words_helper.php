<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('short_words')) {

    function short_words($str, $NoOfWorrd = 20) {
        $strArr = explode(' ', $str);
        $shortStr = '';
        if (count($strArr) < $NoOfWorrd)
            $NoOfWorrd = count($strArr);
        for ($i = 0; $i < $NoOfWorrd; $i++) {
            if ($i == 0) {
                $shortStr = $strArr[$i];
            } else {
                $shortStr.=' ' . $strArr[$i];
            }
        }
        return $shortStr;
    }

}



if (!function_exists('check_exists_BPO')) {

    function check_exists_BPO($v, $rs) {
        foreach ($rs AS $k) {
            if ($k['Objectives'] == $v) {
                return true;
            }
        }
        return false;
    }

}


if (!function_exists('pre')) {

    function pre($var) { //die('rrr');
        echo '<pre>'; //print_r($var);
        if (is_array($var) || is_object($var)) {
            print_r($var);
        } else {
            var_dump($var);
        }
        echo '</pre>';
    }

}

if (!function_exists('jmultiple_array_search')) {

    function jmultiple_array_search($id, $column, $dataArray) { //die('rrr');
        foreach ($dataArray as $key => $val) {
            //pre($val); //die;
            //echo $column.'<br>'; //die;
            //echo $val[$column];die;
            //echo $val[$column].' = '.$id .'<br>';//die;
            if ($val[$column] == $id) {
                //echo $key;die;
                return $key;
            } else {
                //echo 'zzz';
            }
        }
        return -1;
    }

}

if (!function_exists('user_role_check')) {

    function user_role_check($controller, $method) {
        $CI = &get_instance();
        if ($CI->session->userdata('ADMIN_SESSION_VAR') == 1) {
            return TRUE;
        }
        //$roleArr=$CI->se
        $found = FALSE;
        foreach ($CI->session->userdata('ADMIN_ROLE_VAR') AS $k => $v) {
            if ($v['method'] == $method && $v['controller'] == $controller) {
                return TRUE;
            }
        }
        return FALSE;
    }

}

if (!function_exists('get_home_url')) {

    function title_more_string($str, $no_char = 22) {
        $strArr = explode(' ', $str);
        $strLen = 0;
        $newStr = '';
        foreach ($strArr AS $k) {
            $strLen = $strLen + strlen($k);
            if ($strLen > $no_char) {
                return $newStr . ' .....';
            }
            $newStr .= $k . ' ';
        }
        return $str;
    }

}

if (!function_exists('get_cms_title')) {

    function get_cms_title($CMSDataArr, $id) {
        foreach ($CMSDataArr AS $k) {
            if ($k->CMSID == $id) { //echo 'ddd';die;
                return $k->Title;
            }
        }
    }

}


if (!function_exists('get_site_breadcrumb')) {

    function get_site_breadcrumb() {
        
    }

}

if ( ! function_exists('isValidTimeStamp'))
{
    function isValidTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp) 
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }   
}

if ( ! function_exists('success_response_after_post_get')){
    function success_response_after_post_get($parram=array()){
        $result=array();
        if(!array_key_exists('ajaxType', $parram)):
            $result=  get_default_urls();    
        endif;
        //$result['message']="Shipping address data updated successfully.";
        $result['timestamp'] = (string)time();
        if(!empty($parram)):
            foreach ($parram as $k => $v){
                $result[$k]=$v;
            }
        endif;
        
        header('Content-type: application/json');
        echo json_encode($result);
    }
}

if ( ! function_exists('get_default_urls')){
	function get_default_urls(){
		$result=array();
        $result['site_image_url']=SiteImagesURL;
        $result['site_resort_image_url']=ResortSmallImageURL;
	$result['site_resort_midium_image_url']=ResortModiumURL;
        $result['site_tour_midium_image_url']=ToursModiumURL;
        $result['site_tour_image_url']=ToursSmallImageURL;
        $result['site_resort_enjay_type_image_url']=SiteAssetsURL.'resort_enjay_type/';
        $result['site_resort_room_image_image_url']=SiteAssetsURL.'resort_room_image/100X100/';
        $result['main_site_url']=BASE_URL;
        return $result;
	}
}
?>