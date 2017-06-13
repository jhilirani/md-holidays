<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*  @author :: Judhisthira Sahoo
* @ @todo : It will CRUD operation for Model data
*/
class Ckeditor_form extends MY_Controller{
    function __construct() {
        parent::__construct();
        
    }
    
    function upload(){
        $callback = 'null';
        $url = '';
        $get = array();
        
        // for form action, pull CKEditorFuncNum from GET string. e.g., 4 from
        // /ckeditor-form/upload?CKEditor=content&CKEditorFuncNum=4&langCode=en
        // Convert GET parameters to PHP variables
        $qry = $_SERVER['REQUEST_URI'];
        parse_str(substr($qry, strpos($qry, '?') + 1), $get);
        
        if (!isset($_POST) || !isset($get['CKEditorFuncNum'])) {
            $msg = 'CKEditor instance not defined. Cannot upload image.';
        } else {
            $callback = $get['CKEditorFuncNum'];
 
            try {
                $temp_location=$_FILES['upload'];
                $supported_extensions=array('jpg', 'jpeg', 'gif', 'png', 'pdf');
                //$fileUploader = new LocalFileUploader();
                //$url = $fileUploader->upload($_FILES['upload']);
                $filename = basename($temp_location['name']);
                $info = pathinfo($filename);
                $ext = strtolower($info['extension']);
                $file_name=time().'.'.$ext;
                if (isset($temp_location['tmp_name']) &&
                    isset($info['extension']) &&
                    in_array($ext, $supported_extensions)) {
                    $ck_file_path = AssetsPath . 'ck_files';
                    $ck_file_url = SiteAssetsURL . 'ck_files/';
                    if (!is_dir($ck_file_path) ||
                        !is_writable($ck_file_path)) {
                        // Attempt to auto-create upload directory.
                        if (!is_writable($ck_file_path) ||
                            FALSE === @mkdir($ck_file_path, null , TRUE)) {
                            throw new Exception('Error: File permission issue, ' .
                                'please consult your system administrator');
                        }
                    }
                    $new_file_path=$ck_file_path.DIRECTORY_SEPARATOR.$file_name;
                    if (move_uploaded_file($temp_location['tmp_name'], $new_file_path)) {
                        $url= $ck_file_url.$file_name;
                    }
                }
                $msg = "File uploaded successfully to: {$url}";
            } catch (Exception $e) {
                $url = '';
                $msg = $e->getMessage();
            }
        }
        
        // Callback function that inserts image into correct CKEditor instance
        $output = '<html><body><script type="text/javascript">' .
            'window.parent.CKEDITOR.tools.callFunction(' .
            $callback .
            ', "' .
            $url .
            '", "' .
            $msg .
            '");</script></body></html>';
 
        echo $output;
    }
}