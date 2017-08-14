<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Cms_model');
        $this->_admin_auth();
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="CMS Manager";
        $data['pageSubtitle']="CMS List";
        $data['contName']="cms";
        $data['contAction']="viewlist";
        $data['contNameLabel']="CMS Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $dataArr=$this->Cms_model->get_all();
        $data['DataArr'] = $dataArr;
        $this->load->view('webadmin/cms_list', $data);
    }

    public function add_view() {
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="CMS Manager";
        $data['pageSubtitle']="CMS Add";
        $data['contName']="cms";
        $data['contAction']="add";
        $data['contNameLabel']="CMS Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'body',
            'path' => SiteJSURL . 'ckeditor',
            'judhipath' => SiteJSURL,
            'filebrowserImageUploadUrl' => base_url() . 'webadmin/ckeditor_form/upload',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "120%", //Setting a custom width
                'height' => '250px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
        $this->load->view('webadmin/cms_add', $data);
    }

    public function add() {
        $title = $this->input->post('title', TRUE);
        $body = $this->input->post('body', TRUE);
        $shortbody = $this->input->post('shortBody');
        $metatitle = $this->input->post('metaTitle', TRUE);
        $metaKeyWord = $this->input->post('metaKeyWord', TRUE);
        $metaDescription = $this->input->post('metaDescription', TRUE);
        $status = $this->input->post('status', TRUE);

        $dataArr = array(
            'title' => $title,
            'shortBody' => $shortbody,
            'body' => $body,
            'metaTitle' => $metatitle,
            'metaKeyWord' => $metaKeyWord,
            'metaDescription' => $metaDescription,
            'status' => $status
        );

        //print_r($dataArr);die;
        $this->Cms_model->add($dataArr);

        $this->session->set_flashdata('Message', 'CMS added successfully.');
        redirect(base_url() . 'webadmin/cms/viewlist');
    }

    public function view_edit($cmsId) {
        $this->load->helper("ckeditor");
        $data = $this->_show_admin_logedin_layout();
        $data['pageTitle']="CMS Manager";
        $data['pageSubtitle']="CMS Update";
        $data['contName']="cms";
        $data['contAction']="view_edit";
        $data['contNameLabel']="CMS Manager";
        $data['page_heading_start'] = $this->load->view('webadmin/page_heading_start', $data, TRUE);
        
        $data["dataArr"] = $this->Cms_model->get_content_by_id($cmsId);
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'body',
            'path' => SiteJSURL . 'ckeditor',
            'judhipath' => SiteJSURL,
            'filebrowserImageUploadUrl' => base_url() . 'webadmin/ckeditor_form/upload',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "120%", //Setting a custom width
                'height' => '250px', //Setting a custom height
            )
        );
        $this->load->view('webadmin/cms_edit', $data);
    }

    public function edit() {
        $cmsId = $this->input->post('cmsId', TRUE);
        $title = $this->input->post('title', TRUE);
        $body = $this->input->post('body');
        $shortbody = $this->input->post('shortBody', TRUE);
        $metatitle = $this->input->post('metaTitle', TRUE);
        $metaKeyWord = $this->input->post('metaKeyWord', TRUE);
        $metaDescription = $this->input->post('metaDescription', TRUE);
        $status = $this->input->post('status', TRUE);

        $dataArr = array(
            'title' => $title,
            'shortbody' => $shortbody,
            'body' => $body,
            'metatitle' => $metatitle,
            'metaKeyWord' => $metaKeyWord,
            'metaDescription' => $metaDescription,
            'status' => $status
        );

        //print_r($dataArr);die;
        $this->Cms_model->edit($dataArr, $cmsId);

        $this->session->set_flashdata('Message', 'CMS edited successfully.');
        redirect(base_url() . 'webadmin/cms/viewlist');
    }

    public function delete($id) {
        //echo 'comming for delete to id '.$id;die;
        $No = $this->cms_model->delete($id);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record deleted successfully.');
            redirect($this->config->item('base_url') . 'webadmin/feuser/');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unabel to delete the record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/feuser/');
        }
    }

    public function change_status($id, $status) {
        if($status == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $No = $this->Cms_model->change_status($id, $status);
        if ($No > 0) {
            $this->session->set_flashdata('UserListPageMsg', 'Record status changed successfully.');
            redirect($this->config->item('base_url') . 'webadmin/cms/viewlist');
        } else {
            $this->session->set_flashdata('UserListPageMsg', 'Unable to changed the for this record,please try again .');
            redirect($this->config->item('base_url') . 'webadmin/cms/viewlist');
        }
    }
}