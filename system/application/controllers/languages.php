<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * language Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/language
 */

class Languages extends Controller {
/**
     * define file translation 
     */
    var $langfile ='ca/language';
    /**
     * define limit view
     * @var type 
     */
    var $limit = 5;
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
        $this->load->helper(array('form','lang','session','log','app'));
        $this->load->library(array('form_validation','pagination')); 
        log_message('debug', "Languages controller initialized");
    }
    function index() {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $data['dir'] = './assets/js/codeanalytic.lang.js';
            $data['file'] = str_replace("/", '-', $data['dir']);
            $data['text'] = ca_get_content_text('./assets/js/codeanalytic.lang.js');
            $this->load->view('lang_index', $data);
        } else {
            
        }
    }

    function view($file = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $this->load->helper('js');
                $fname = str_replace("-", "/", $file);
                if (is_file($fname)) {
                    $data['text'] = ca_get_content_text($fname);
                    $data['file'] = $file;
                    $data['dir'] = $fname; 
                    ca_userLogs("view file $fname", 'Application Languages');
                    $this->load->view("lang_view", $data);
                }
            } else {
                ca_error_auth('update', 'apllication');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }


    function change() {
        extract($_POST);
        log_message('debug', "Languages.change($dlang)");
        $this->lang_detect->changeLang($dlang);
        $this->session->set_userdata('app_language', $dlang);
        $redirect_url = "./" . $current;
        redirect($redirect_url);
    }

     
    function tree() {
        $_POST['dir'] = urldecode($_POST['dir']);

        if (file_exists($_POST['dir'])) {
            $files = scandir($_POST['dir']);
            natcasesort($files);
            if (count($files) > 2) { /* The 2 accounts for . and .. */
                echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                // All dirs
                foreach ($files as $file) {
                    if (file_exists($_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($_POST['dir'] . $file)) {
                        echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
                        ?>
                        <li>
                            <a href="javascript:void(0)" class="file icon-pencil" style="padding-left: 15px" onclick="ca_lightbox('dir/create_file/<?php echo str_replace('/', '-', $_POST['dir'] . $file) ?>/lang')"><?php echo $file . " " . ca_translate("create new file"); ?></a>
                        </li>
                        <?php
                    }
                }
                // All files
                foreach ($files as $file) {
                    if (file_exists($_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($_POST['dir'] . $file)) {
                        $ext = preg_replace('/^.*\./', '', $file);
                        echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities(str_replace('/', '-', $_POST['dir'] . $file)) . "\">" . htmlentities($file) . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
    }

}
?>