<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
/**
 * CodeAnalytic
 *
 * An open source application development cms support for php 4.3 and newest
 *
 * @package		CodeAnalytic
 * @author		CodeAnalytic Team Web Developer
 * @copyright           Copyright (c) 2012 , CodeAnalytic, Inc.
 * @license		http://codeanalytic.com/application-license
 * @link		http://codeanalytic.com
 * @since		Version 0.1
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * media Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/media
 */
class media extends Controller {

    var $limit = 5;

    /**
     * define file translation 
     */
    var $langfile = 'ca/media';

    /**
     * function constructor 
     * @access public
     */
    function __construct() {
        parent::__construct();
        /**
         * load class languange 
         * @example libraries/language
         */
        $this->lang->index($this->langfile);
        /**
         * load class helper, library and model 
         */
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app', 'js', 'template'));
        $this->load->library(array('ca_conf'));
        $this->load->model(array('mtemplate'));
        $this->input->use_xss_clean = FALSE;
    }

    function index() {
        if (isUser()) {
            ca_userLogs('view', 'Media');
            $this->load->view('media_index');
        } else {
            ca_error_auth('view', 'media');
        }
    }

    function image_upload() {
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = base_upload() . "image/";
            $file = $_FILES['userfile'];
            $uploadfile = $uploaddir . basename($file['name']);
            $theFileSize = $file['size'];
            if ($theFileSize > ca_setting('max_file_size', 'media')) {
                echo 'error';
            } else {
                if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                    switch ($file['type']) {
                        case 'image/jpeg':
                            $t = 'jpg';
                            break;
                        case 'image/jpg':
                            $t = 'jpg';
                            break;
                        case 'image/gif':
                            $t = 'gif';
                            break;
                        case 'image/png':
                            $t = 'png';
                            break;
                        default:
                            break;
                    }
                    $new_name = random_string('alnum', 25) . '_' . time() . '_codeanalytic_media_' . random_string('alnum', 25);
                    rename($uploadfile, $uploaddir . $new_name . ".$t");
                    $this->image_thumb_big($new_name . ".$t");
                    $thumb_name = $new_name . '_ca_thumb_big.' . $t;
                    if (is_file($uploaddir . $new_name . ".$t")) {
                        unlink($uploaddir . $new_name . ".$t");
                    }
                    echo $thumb_name;
                    /**
                     * add logs 
                     */
                    ca_userLogs('success upload image', 'Media');
                } else {
                    /**
                     * add logs 
                     */
                    ca_userLogs('failde upload image', 'Media');
                }
            }
        } else {
            redirect('/', 'refresh');
        }
    }

    function image_thumb_big($file) {
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = base_upload() . 'image/';
            $conf_big = $this->media_auth->set_thumb_big($uploaddir, $file);
            $this->load->library('image_lib', $conf_big);
            $this->image_lib->resize();
        } else {
            ca_error_auth('create thumb', 'Media');
        }
    }

    function image_thumb_middle($file) {
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = base_upload() . 'image/';
            $conf_middle = $this->media_auth->set_thumb_middle($uploaddir, $file);
            $this->load->library('image_lib', $conf_middle);
            if ($this->image_lib->resize()) {
                ca_userLogs('success resize image profile to middle', 'User');
                $t = explode('.', $file);
                $n = str_replace('_ca_thumb_big', '', $t['0']);
                rename($uploaddir . $t['0'] . '_ca_thumb_middle.' . $t['1'], $uploaddir . $n . '_ca_thumb_middle.' . $t['1']);
            } else {
                ca_userLogs('failed resize image profile to middle', 'User');
            }
        } else {
            ca_error_auth('create thumb', 'Media');
        }
    }

    function image_thumb_small($file) {
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = base_upload() . 'image/';
            $conf_small = $this->media_auth->set_thumb_small($uploaddir, $file);
            $this->load->library('image_lib', $conf_small);
            if ($this->image_lib->resize()) {
                ca_userLogs('success resize image profile to middle', 'User');
                $t = explode('.', $file);
                $n = str_replace('_ca_thumb_big', '', $t['0']);
                rename($uploaddir . $t['0'] . '_ca_thumb_small.' . $t['1'], $uploaddir . $n . '_ca_thumb_small.' . $t['1']);
                echo $n . '_ca_thumb_small.' . $t['1'];
            } else {
                ca_userLogs('failed resize image profile to small', 'User');
            }
        } else {
            ca_error_auth('create thumb', 'Media');
        }
    }

    function place() {
        if (isUser()) {
            /**
             * add logs 
             */
            ca_userLogs('view media in tinyMCE', 'Media');
            $this->load->view('media_place');
        } else {
            ca_error_auth('view', 'media');
        }
    }

    function media_view($abc = 'image/') {
        if (isUser()) {
            $data['abc'] = $abc;
            $this->load->view('media_view', $data);
            /**
             * add logs 
             */
            ca_userLogs('view', 'Media');
        } else {
            redirect('login');
        }
    }

    function zip_view($abc = 'zip/') {
        if (isUser()) {
            $data['abc'] = $abc;
            $this->load->view('zip_view', $data);
            /**
             * add logs 
             */
            ca_userLogs('view in zip', 'Media');
        } else {
            ca_error_auth('zip file', 'Media');
        }
    }

    function doc_upload() {
        if (isUser()) {
            $uploaddir = base_upload() . 'doc/';
            $file = $_FILES['userfile'];
            $theFileSize = $file['size'];
            if ($theFileSize > ca_setting('max_file_size', 'media')) {
                echo 'error';
            } else {
                $uploadfile = $uploaddir . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                    echo $file['name'];
                    /**
                     * add logs 
                     */
                    ca_userLogs('upload document', 'Media');
                } else {
                    ca_error_auth('upload media', 'Media');
                }
            }
        } else {
            ca_error_auth('upload document', 'Media');
        }
    }

    function zip_upload() {
        if (isUser()) {
            $uploaddir = base_upload() . 'zip/';
            $file = $_FILES['userfile'];
            $uploadfile = $uploaddir . basename($file['name']);
            $theFileSize = $file['size'];
            if ($theFileSize > ca_setting('max_file_size', 'media')) {
                echo 'error';
            } else {

                if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                    /**
                     * add logs 
                     */
                    ca_userLogs('upload zip', 'Media');
                    echo $file['name'];
                } else {
                    ca_error_auth('upload zip', 'Media');
                }
            }
        } else {
            ca_error_auth('upload zip', 'Media');
        }
    }

    /**
     * 
     */
    function delete() {
        if (isUser()) {
            /**
             * add logs 
             */
            ca_userLogs('view delete form', 'Media');
            $url = $this->input->post('src');
            ?>
            <div class="information">
                Are you sure, want to delete image was selected ?. <br/> Choose one Yes or No" 
            </div>
            <div class='footer'>
                <a class="button-red" onclick="ca_this_delete('<?php echo $url ?>');"><?php echo ca_translate('yes'); ?></a>
                &nbsp;
                <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate('no'); ?></a>
            </div>
            <?php
        } else {
            ca_error_auth('view delete dialog', 'Media');
        }
    }

    /**
     * 
     */
    function file_delete() {
        if (isUser()) {
            /**
             * add logs 
             */
            ca_userLogs('view delete form for file', 'Media');
            $url = $this->input->post('src');
            ?>
            <div class="information">
            <?php echo ca_translate("are you sure, want to delete image was selected ?. <br/> choose one yes or no"); ?> 
            </div>
            <div class='footer'>
                <a class="button-red" onclick="ca_this_file_delete('<?php echo $url ?>');"><?php echo ca_translate('yes'); ?></a>
                &nbsp;
                <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate('no'); ?></a>
            </div>
            <?php
        } else {
            ca_error_auth('view delete file dialog', 'Media');
        }
    }

    /**
     * 
     */
    function do_delete() {
        if (isUser()) {
            $small = $this->input->post('src');
            $middle = str_replace('small', 'middle', $small);
            $big = str_replace('small', 'big', $small);
            if ($big <> base_upload() . 'image/codeanalytic_media_ca_thumb_big.jpg') {
                if (is_file($small)) {
                    unlink($small);
                }
                if (is_file($middle)) {
                    unlink($middle);
                }
                if (is_file($big)) {
                    unlink($big);
                }
                echo 'file selected is success for deleted';
            } else {
                echo 'this image can not be delete';
            }
            ca_userLogs('delete', 'Media');
        } else {
            ca_error_auth('delete', 'media');
        }
    }

    function config() {
        $this->load->view('media_config');
    }

    function do_update() {
        if (isSuperAdmin()) {
            $this->ca_conf->load('config/', 'media.php');
            if ($this->ca_conf->count > 0) {
                $path = './system/application/config/';
                foreach ($this->ca_conf->array as $key => $value) {
                    $old_val = $this->ca_conf->item($key);
                    $val = $this->input->post($key);
                    ca_set_setting($key, $val, $old_val, 'media', $path);
                }
            }
            ca_userLogs('udate config', 'media');
        } else {
            ca_error_auth('update config', 'media');
        }
    }

}
?>