<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_process extends MY_Controller {

    private $_resize_file_array;
    private $_resize_tours_file_array;
    private $_image_main_path;
    private $_image_main_path_tours;

    public function __construct() {
        parent::__construct();
        //$this->_resize_bulk_file_array = array('100X100');
        $this->_resize_file_array = array('100X100','200X200','300X300');
        $this->_image_main_path = 'resort_images/';
        $this->_image_main_path_tours = 'tours_images/';
    }

    function start_mulitple_upload() {
        if (!empty($_FILES)) {
            $this->mulitple_upload();
        } else if ($this->input->post('file_to_remove')) {
            $img=$this->input->post('file_to_remove');
            $this->delete_image($this->input->post('file_to_remove'));
        }else{
            echo 'nothing-in-start-mulitple-upload';die;
        }
    }

    private function mulitple_upload() {
        $resortId= $this->input->post('resortId');
        $upload_path = AssetsPath . $this->_image_main_path ;
        //echo $upload_path;die;
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = '0';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['quality'] = "30";
        $image_data = array();
        $is_file_error = FALSE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            //if file upload failed then catch the errors
            $errMsg = $this->upload->display_errors();
            echo "judhi".$errMsg;
            die;
        } else {
            $image_data = $this->upload->data();
            $is_resize_done = $this->resize_image($image_data['full_path'], $image_data['file_name']);
            if ($is_resize_done != 1) {
                echo $is_resize_done;
                die;
            } else {
                $this->load->model("Resort_image_model");
                $this->Resort_image_model->add(array('resortId'=>$resortId,'image'=>$image_data["file_name"]));
                echo $image_data["file_name"];
                die;
            }
        }
    }

    function resize_image($full_path, $file_name) {
        $is_file_error = FALSE;
        $img_resise_arr = $this->_resize_file_array;
        $this->load->library('image_lib');
        foreach ($this->_resize_file_array As $k) {
            $upload_path = AssetsPath . $this->_image_main_path ;
            
            $imagePathArr = explode('X', $k);
            $new_img_path=$upload_path . $k . '/' . $file_name;
            //echo $new_img_path;die;
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $full_path; //get original image
            $config2['maintain_ratio'] = TRUE;
            //$config2['create_thumb'] = TRUE;
            $config2['width'] = $imagePathArr[0];
            $config2['height'] = $imagePathArr[1];
            $config2['new_image'] = $new_img_path;
            //$config['thumb_marker'] = '_thumb';
            $config2['quality'] = '60';
            //echo '<pre>';print_r($config2);die;
            $this->image_lib->clear(); // added this line
            $this->image_lib->initialize($config2); // added this line
            //$this->load->library('image_lib', $config2);
            if (!$this->image_lib->resize()) {
                $errMsg = $this->image_lib->display_errors();
                //echo '<pre>kkk';print_r($errMsg);die;
                $is_file_error = TRUE;
            }else{
                
            }
        }
        if ($is_file_error == TRUE) {
            return 1;
            //return $errMsg;
        } else {
            return 1;
        }
    }

    function delete_image($file_name) {
        foreach ($this->_resize_file_array As $k) {
            $upload_path = AssetsPath . $this->_image_main_path;
            $full_img_path=$upload_path . $k . '/' . $file_name;
            //die($full_img_path);
            @unlink($full_img_path);
        }
        @unlink($upload_path . $file_name);
        $this->load->model("Resort_image_model");
        $this->Resort_image_model->delete_by_img($file_name);
    }
    
    function start_mulitple_upload_tours() {
        if (!empty($_FILES)) {
            $this->mulitple_upload_tours();
        } else if ($this->input->post('file_to_remove')) {
            $img=$this->input->post('file_to_remove');
            $this->delete_image_tours($this->input->post('file_to_remove'));
        }else{
            echo 'nothing-in-start-mulitple-upload';die;
        }
    }
    
    public function mulitple_upload_tours() {
        $toursId= $this->input->post('toursId');
        $upload_path = AssetsPath . $this->_image_main_path_tours ;
        //echo $upload_path;die;
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = '0';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['quality'] = "30";
        $image_data = array();
        $is_file_error = FALSE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            //if file upload failed then catch the errors
            $errMsg = $this->upload->display_errors();
            echo "judhi".$errMsg;
            die;
        } else {
            $image_data = $this->upload->data();
            $is_resize_done = $this->resize_image_tours($image_data['full_path'], $image_data['file_name']);
            if ($is_resize_done != 1) {
                echo $is_resize_done;
                die;
            } else {
                $this->load->model("Tours_image_model");
                $this->Tours_image_model->add(array('toursId'=>$toursId,'image'=>$image_data["file_name"]));
                echo $image_data["file_name"];
                die;
            }
        }
    }
    
    function resize_image_tours($full_path, $file_name) {
        $is_file_error = FALSE;
        $img_resise_arr = $this->_resize_file_array;
        $this->load->library('image_lib');
        foreach ($this->_resize_file_array As $k) {
            $upload_path = AssetsPath . $this->_image_main_path_tours ;
            
            $imagePathArr = explode('X', $k);
            $new_img_path=$upload_path . $k . '/' . $file_name;
            //echo $new_img_path;die;
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $full_path; //get original image
            $config2['maintain_ratio'] = TRUE;
            //$config2['create_thumb'] = TRUE;
            $config2['width'] = $imagePathArr[0];
            $config2['height'] = $imagePathArr[1];
            $config2['new_image'] = $new_img_path;
            //$config['thumb_marker'] = '_thumb';
            $config2['quality'] = '60';
            //echo '<pre>';print_r($config2);die;
            $this->image_lib->clear(); // added this line
            $this->image_lib->initialize($config2); // added this line
            //$this->load->library('image_lib', $config2);
            if (!$this->image_lib->resize()) {
                $errMsg = $this->image_lib->display_errors();
                //echo '<pre>kkk';print_r($errMsg);die;
                $is_file_error = TRUE;
            }else{
                
            }
        }
        if ($is_file_error == TRUE) {
            return 1;
            //return $errMsg;
        } else {
            return 1;
        }
    }
    
    function delete_image_tours($file_name) {
        foreach ($this->_resize_file_array As $k) {
            $upload_path = AssetsPath . $this->_image_main_path_tours;
            $full_img_path=$upload_path . $k . '/' . $file_name;
            //die($full_img_path);
            @unlink($full_img_path);
        }
        @unlink($upload_path . $file_name);
        $this->load->model("Tours_image_model");
        $this->Tours_image_model->delete_by_img($file_name);
    }
}
