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
?>