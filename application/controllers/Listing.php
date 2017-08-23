<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Resort_model');
        $this->load->model('Tours_model');
    }
    
    function show_rerort($str){
        if(!isset($str) || $str==""){
            redirect(BASE_URL);
        }
        $urlStrArr=  explode('-', $str);
        if(count($urlStrArr)<2){
            redirect(BASE_URL);
        }
        end($urlStrArr);
        $id=  current($urlStrArr);
        //$id=11;
        $realId=$id/102102;
        //echo $realId.'<br>';
        if (strpos($realId,'.') !== false) {
            redirect(BASE_URL);
        }
        
    }
    
    function show_tours($str){
        die($str);
    }
}