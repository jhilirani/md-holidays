<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        //$this->load->model('Event_model');
        $this->load->model('Cms_model');
    }

    public function _logout() {
        $this->session->unset_userdata('FE_SESSION_VAR');
        $this->session->unset_userdata('FE_SESSION_USERNAME_VAR');
        $this->session->unset_userdata('FE_SESSION_USER_EMAIL_VAR');
        $this->session->unset_userdata('FE_SESSION_USER_SiteNickName_VAR');
        $this->session->unset_userdata('FE_SESSION_USER_PROFILE_IMG_VAR');
        $this->session->unset_userdata('FE_SESSION_USER_TYPE');

        $this->session->set_flashdata('LoginPageMsg', 'You are logout successfully');
    }

    function is_loged_in() {
        $FE_SESSION_VAR = $this->session->userdata('FE_SESSION_VAR');
        //echo ' admin'.$ADMIN_SESSION_VAR.'<br>';
        if (isset($FE_SESSION_VAR)) {
            //echo 'XX';die;
            if (empty($FE_SESSION_VAR)) {
                /// checking usr already register or login by cookey
                /* if (isset($_COOKIE["MTUserLoginIDCookie"]))
                  echo "Welcome " . $_COOKIE["MTUserLoginIDCookie"] . "!<br />";
                  else
                  echo "Welcome guest!<br />";
                  die; */
                if (isset($_COOKIE["SPUserLoginIDCookie"])) {//$this->input->cookie('MaldivesTravellerUserLoginIDCookie')
                    echo 'comming';
                    die;
                    $UserID = $_COOKIE["SPUserLoginIDCookie"];
                    print_r($UserID);
                    die;
                    if ($UserID != '' || $UserID > 0) {
                        $UserDetails = $this->User_model->get_details_by_id($UserID);

                        $this->session->set_userdata('FE_SESSION_VAR', $UserID);
                        $this->session->set_userdata('FE_SESSION_USERNAME_VAR', $UserDetails[0]->UserName);
                        $this->session->set_userdata('FE_SESSION_USER_EMAIL_VAR', $UserDetails[0]->Email);
                        $this->session->set_userdata('FE_SESSION_USER_SiteNickName_VAR', $UserDetails[0]->SiteNickName);
                        $this->session->set_userdata('FE_SESSION_USER_PROFILE_IMG_VAR', $UserDateArr[0]->Image);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    //echo 'not getting';die;
                    return false;
                }
            } else {
                return true;
            }
        } else {
            if (isset($_COOKIE["SPUserLoginIDCookie"])) {//$this->input->cookie('MaldivesTravellerUserLoginIDCookie')
                //echo 'comming';die;
                $UserID = $_COOKIE["SPUserLoginIDCookie"];
                //print_r($UserID);die;
                if ($UserID != '' || $UserID > 0) {
                    $UserDetails = $this->User_model->get_details_by_id($UserID);

                    $this->session->set_userdata('FE_SESSION_VAR', $UserID);
                    $this->session->set_userdata('FE_SESSION_USERNAME_VAR', $UserDetails[0]->UserName);
                    $this->session->set_userdata('FE_SESSION_USER_EMAIL_VAR', $UserDetails[0]->Email);
                    $this->session->set_userdata('FE_SESSION_USER_SiteNickName_VAR', $UserDetails[0]->SiteNickName);
                    $this->session->set_userdata('FE_SESSION_USER_PROFILE_IMG_VAR', $UserDateArr[0]->Image);
                    return true;
                } else {
                    return false;
                }
            } else {
                //echo 'not getting';die;
                return false;
            }
        }
    }

    public function _get_logedin_template($SEODataArr) {
        $data = array();
        $CountryDataArr = $this->Siteconfig_model->get_country();
        $HiName = $this->session->userdata('FE_SESSION_USER_SiteNickName_VAR');
        $MyAccountLink = base_url() . 'my_account/';
        $LoginType = $this->session->userdata('FE_SESSION_USER_TYPE');
        if ($LoginType == '') {
            $LoginType = 'Standard';
        }
        if ($LoginType == 'Standard') {
            $LogoutLink = base_url() . 'user/logout/';
        } else {
            $LogoutLink = base_url() . 'facebook_user_login/logoutByFacebook/';
        }

        $UrlQueryString = $_SERVER['QUERY_STRING'];
        $UrlQueryStringArr = explode('&', $UrlQueryString);
        foreach ($UrlQueryStringArr as $k => $v) {
            if (substr($v, 0, 2) == 'p=') {
                unset($UrlQueryString_Arr[$k]);
                break;
            }
        }
        $data = $this->html_heading($SEODataArr);
        $data['NewUrlQueryString'] = implode('&', $UrlQueryStringArr);
        $data['HasLogedIn'] = 'Yes';
        /*$CurrentSiteLanguage = $this->session->userdata('site_lang');
        if ($CurrentSiteLanguage == '') {
            $data['CurrentSiteLanguage'] = 'english';
            $this->lang->load('header1', 'english');
            $this->lang->load('footer1', 'english');
        } else {
            $data['CurrentSiteLanguage'] = $CurrentSiteLanguage;
            $this->lang->load('header1', $CurrentSiteLanguage);
            $this->lang->load('footer1', $CurrentSiteLanguage);
        }*/

        //$data['CountryData'] = $CountryDataArr;
        //$data['CMSData'] = $this->Cms_model->get_all();
        //$data['TestimonialData'] = $this->Testimonial_model->get_all();

        $data['BaseURL'] = $this->config->item('base_url');
        $data['SiteImagesURL'] = $this->config->item('SiteImagesURL');
        $data['SiteCSSURL'] = $this->config->item('SiteCSSURL');
        $data['SiteJSURL'] = $this->config->item('SiteJSURL');
        $data['SiteResourcesURL'] = $this->config->item('SiteResourcesURL');

        //$data['html_heading'] = $this->load->view('html_heading', $data, true);
        $data['header'] = $this->load->view('header1', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        return $data;
    }

    public function _get_tobe_login_template($SEODataArr = array()) {
        $data = array();
        //$CountryDataArr=$this->Siteconfig_model->get_country();

        /* $UrlQueryString=$_SERVER['QUERY_STRING'];
          $UrlQueryStringArr=explode('&',$UrlQueryString);
          foreach($UrlQueryStringArr as $k => $v){
          if(substr($v,0,2)=='p='){
          unset($UrlQueryString_Arr[$k]);
          break;
          }
          }
          //$data['HasLogedIn']='No';
          //$data['CAPTCHA_COOKIE_NAME']=$this->config->item('CAPTCHA_COOKIE_NAME');
          $CurrentSiteLanguage=$this->session->userdata('site_lang');
          if($CurrentSiteLanguage==''){
          $data['CurrentSiteLanguage']='english';
          $this->lang->load('header','english');
          $this->lang->load('footer','english');
          }else{
          $data['CurrentSiteLanguage']=$CurrentSiteLanguage;
          $this->lang->load('header',$CurrentSiteLanguage);
          $this->lang->load('footer',$CurrentSiteLanguage);
          }

          $Data['NewUrlQueryString']=implode('&',$UrlQueryStringArr);
          $data['CountryData']=$CountryDataArr;
          $data['CMSData']=$this->Cms_model->get_all();
          $data['TestimonialData']=$this->Testimonial_model->get_all(); */
        $data = $this->html_heading($SEODataArr);

        //$data['CMSDataArr'] = $this->Cms_model->get_all();

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        return $data;
    }

    public function _my_seo_freindly_url_str($String) {
        $ChangedStr = preg_replace('/\%/', ' percentage', $String);
        $ChangedStr = preg_replace('/\@/', ' at ', $ChangedStr);
        $ChangedStr = preg_replace('/\&/', ' and ', $ChangedStr);
        $ChangedStr = preg_replace('/\s[\s]+/', '-', $ChangedStr);    // Strip off multiple spaces
        $ChangedStr = preg_replace('/[\s\W]+/', '-', $ChangedStr);    // Strip off spaces and non-alpha-numeric
        $ChangedStr = preg_replace('/^[\-]+/', '', $ChangedStr); // Strip off the starting hyphens
        $ChangedStr = preg_replace('/[\-]+$/', '', $ChangedStr); // // Strip off the ending hyphens
        return $ChangedStr;
    }

    function _show_short_words_words($str, $NoOfWorrd = 20) {
        $strArr = explode(' ', $str);
        $shortStr = '';
        //echo 'NoOfWorrd '.$NoOfWorrd;die;
        for ($i = 0; $i < $NoOfWorrd; $i++) {
            if ($i == 0) {
                $shortStr = $strArr[$i];
            } else {
                $shortStr.=' ' . $strArr[$i];
            }
        }
        return $shortStr;
    }

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }

    public function _is_admin_loged_in() {
        if ($this->session->userdata('ADMIN_SESSION_VAR') != "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function _show_admin_login() {
        $data = array();
        $data['test'] = "ok";
        $data['html_head'] = $this->load->view("webadmin/html_head", $data, TRUE);
        $data['footer'] = $this->load->view("webadmin/footer", $data, TRUE);
        //pre($data);die;
        $this->load->view('webadmin/login', $data);
    }

    public function _show_admin_home() {
        if ($this->_is_admin_loged_in()) {
            $data = array();
            $data=  $this->admin_head_foot();
            $data['pageTitle']="Dashboard";
            $data['pageSubtitle']="";
            $data['contName']="index";
            $data['contAction']="index";
            $data['contNameLabel']="Dashboard";
            $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
            $this->load->view('webadmin/home', $data);
        } else {
            redirect('webadmin/index');
        }
    }

    public function _show_admin_logedin_layout() {
        $data = array();
        $data['CurrentCont'] = $this->uri->segment(2);
        $data['html_head'] = $this->load->view('webadmin/html_head', $data, TRUE);
        $data['header'] = $this->load->view('webadmin/header', $data, TRUE);
        $data['left_menu'] = $this->load->view('webadmin/left_menu', $data, TRUE);
        $data['footer'] = $this->load->view('webadmin/footer', $data, TRUE);
        $data['body_start'] = $this->load->view('webadmin/body_start', $data, TRUE);
        $data['page_heading_end'] = $this->load->view('webadmin/page_heading_end', $data, TRUE);
        return $data;
    }

    public function html_heading($SEODataArr = array()) {
        $data = array();
        $data['BaseURL'] = $this->config->item('base_url');
        $data['SiteImagesURL'] = $this->config->item('SiteImagesURL');
        $data['SiteCSSURL'] = $this->config->item('SiteCSSURL');
        $data['SiteJSURL'] = $this->config->item('SiteJSURL');
        $data['SiteResourcesURL'] = $this->config->item('SiteResourcesURL');
        $GateWayState=$this->input->get('GateWayState',TRUE);
        //echo '$GateWayState  ='.$GateWayState;die;
        if($GateWayState!=""){
            $this->session->set_userdata('GateWayState',$GateWayState);
        }

        $ClearGateWayState=$this->input->get('ClearGateWayState',TRUE);
        if($ClearGateWayState!=""){
            $this->session->unset_userdata('GateWayState');
        }


        /* $metaInfoUriSegmentArr=array('cms');
          $first_sagment=$this->uri->segment(1);
          if(in_array($first_sagment,$metaInfoUriSegmentArr)){
          if($first_sagment=='cms'){
          $fun=$this->uri->segment(2);
          $MetaData=$this->Cms_model->get_content($fun);
          $data['MetaTitle']=$MetaData[0]->MetaTitle;
          $data['MetaKeyWord']=$MetaData[0]->MetaKeyWord;
          $data['MetaDescription']=$MetaData[0]->MetaDescription;
          }
          }else{
          if(empty($SEODataArr)){
          $MetaData=$this->Siteconfig_model->get_html_head();
          $data['MetaTitle']=$MetaData[0]->ConstantValue;
          $data['MetaKeyWord']=$MetaData[1]->ConstantValue;
          $data['MetaDescription']=$MetaData[2]->ConstantValue;
          }else{
          $data['MetaTitle']=$SEODataArr['MetaTitle'];
          $data['MetaKeyWord']=$SEODataArr['MetaKeyWord'];
          $data['MetaDescription']=$SEODataArr['MetaDescription'];
          }
          } */
        if (empty($SEODataArr)) {
            $MetaData = $this->Siteconfig_model->get_html_head();
            $data['MetaTitle'] = $MetaData[0]->ConstantValue;
            $meta[]=array('name' => 'description', 'content' => $MetaData[2]->ConstantValue);
            $meta[]=array('name' => 'keywords', 'content' =>$MetaData[1]->ConstantValue);
            $data['meta']=$meta;
            $data['ogImage']='';
        } else {
            if(array_key_exists('meta', $SEODataArr)){
                //echo 'rrr ppp';die;
                $data['MetaTitle']=$SEODataArr['MetaTitle'];
                $data['meta']=$SEODataArr['meta'];
                if(!array_key_exists('ogImage', $SEODataArr)){
                    $data['ogImage']='';
                }
            }else{
                $data['MetaTitle'] = $SEODataArr['MetaTitle'];
                $meta[]=array('name' => 'description', 'content' => $SEODataArr['MetaDescription']);
                $meta[]=array('name' => 'keywords', 'content' =>$SEODataArr['MetaKeyWord']);
                $data['meta']=$meta;
                $data['ogImage']='';
            }
        }
        $this->load->model("Category_model");
        $categoryArr=$this->Category_model->get_all_active();
        $data['menuDataArr']=$categoryArr;
        $data['navigation']=  $this->load->view('navigation',$data,TRUE);
        $data['html_heading'] = $this->load->view('html_heading', $data, true);
        return $data;
    }

    public function admin_head_foot(){
        $data=array();
        //$data['CurrentCont'] = $this->uri->segment(2);
        $data['html_head'] = $this->load->view('webadmin/html_head', $data, TRUE);
        $data['header'] = $this->load->view('webadmin/header', $data, TRUE);
        $data['left_menu'] = $this->load->view('webadmin/left_menu', $data, TRUE);
        $data['footer'] = $this->load->view('webadmin/footer', $data, TRUE);
        $data['body_start'] = $this->load->view('webadmin/body_start', $data, TRUE);
        $data['page_heading_end'] = $this->load->view('webadmin/page_heading_end', $data, TRUE);
        return $data;
    }
    
    public function _admin_auth(){
        if($this->_is_admin_loged_in()==FALSE){
            redirect(ADMIN_BASE_URL.'index/login','refresh');
        }else{
            return FALSE;
        }
    }
}

?>