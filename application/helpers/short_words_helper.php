<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('short_words')){
    function short_words($str,$NoOfWorrd=20){
            $strArr=explode(' ',$str);	
            $shortStr='';
            if(count($strArr)<$NoOfWorrd)
                    $NoOfWorrd=count($strArr);
            for($i=0;$i<$NoOfWorrd;$i++){
                    if($i==0){
                            $shortStr=$strArr[$i];
                    }else{
                            $shortStr.=' '.$strArr[$i];
                    }
            }
            return $shortStr;
    }
}


if ( ! function_exists('my_seo_freindly_url')){
    function my_seo_freindly_url($String){
            $ChangedStr = preg_replace('/\%/',' percentage',$String);
            $ChangedStr = preg_replace('/\@/',' at ',$ChangedStr);
            $ChangedStr = preg_replace('/\&/',' and ',$ChangedStr);
            $ChangedStr = preg_replace('/\s[\s]+/','-',$ChangedStr);    // Strip off multiple spaces
            $ChangedStr = preg_replace('/[\s\W]+/','-',$ChangedStr);    // Strip off spaces and non-alpha-numeric
            $ChangedStr = preg_replace('/^[\-]+/','',$ChangedStr); // Strip off the starting hyphens
            $ChangedStr = preg_replace('/[\-]+$/','',$ChangedStr); // // Strip off the ending hyphens
            return $ChangedStr;
    }
}

if ( ! function_exists('check_exists_BPO')){
    function check_exists_BPO($v,$rs){
            foreach($rs AS $k){
                    if($k['Objectives']==$v){
                            return true;
                    }
            }
            return false;
    }
}


if ( ! function_exists('pre')){
    function pre($var){ //die('rrr');
        echo '<pre>';//print_r($var);
        if(is_array($var) || is_object($var)) {
          print_r($var);
        } else {
          var_dump($var);
        }
        echo '</pre>';
    }
}

if ( ! function_exists('jmultiple_array_search')){
    function jmultiple_array_search($id,$column, $dataArray){ //die('rrr');
       foreach ($dataArray as $key => $val) {
           //pre($val);
           //echo $column.'<br>';
           //echo $val[$column].' = '.$id .'<br>';//die;
           if ($val[$column] == $id) {
               //echo $key;die;
               return $key;
           }else{
               //echo 'zzz';
           }
       }
       return -1;
    }
}

if(!function_exists('user_role_check')){
    function user_role_check($controller,$method){
        $CI=&get_instance();
        if($CI->session->userdata('ADMIN_SESSION_VAR')==1){
            return TRUE;
        }
        //$roleArr=$CI->se
        $found=FALSE;
        foreach($CI->session->userdata('ADMIN_ROLE_VAR') AS $k => $v){
            if($v['method']==$method && $v['controller']==$controller){
                return TRUE;
            }
        }
        return FALSE;
    }
}

if ( ! function_exists('get_home_url')){
    function get_home_url(){
        $CI =& get_instance();
        $countryId=$CI->session->userdata('USER_SHIPPING_COUNTRY');
        if($countryId==1){
            return base_url().'send-online-gifts-usa';
        }else if($countryId==99){
            return base_url().'send-wine-cakes-flowers-online-india';
        }else if($countryId==240){
            return base_url().'send-gifts-worldwide';
        }
    }
}

if ( ! function_exists('get_home_url')){
    function title_more_string($str,$no_char=22){
        $strArr=  explode(' ', $str);
        $strLen=0;
        $newStr='';
        foreach($strArr AS $k){
            $strLen=$strLen+strlen($k);
            if($strLen>$no_char){
                return $newStr.' .....';
            }
            $newStr .= $k.' ';
        }
        return $str;
    }
}

if ( ! function_exists('get_cms_title')){
    function get_cms_title($CMSDataArr,$id){
        foreach($CMSDataArr AS $k){
            if($k->CMSID==$id){ //echo 'ddd';die;
                return $k->Title;
            }
        }
    }
}

?>