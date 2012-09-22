<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

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
 * css Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/css
 */
class css extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/template';

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
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app', 'template', 'text'));
        $this->load->library(array('form_validation', 'pagination', 'ca_conf'));
        $this->load->model(array('mtemplate'));
    }

    function index() {
        if (isSuperadmin()) {
            $this->load->helper('js');
            $dir_path = './system/application/views/' . ca_theme_dir();
            $dir_css = './system/application/views/' . ca_theme_dir() . 'css/'; 
            $data['fname'] = $dir_css .'reset.css';
            $data['text'] = ca_get_content_text($data['fname']);
            $data['dir'] = $dir_path;
            $data['file'] = str_replace("/", "-", $data['fname']);
            /**
             * add logs 
             */
            ca_userLogs('view', 'CSS');
            $this->load->view("css_index", $data);
        } else {
            ca_error_auth('update', 'css');
        }
    }

    function view($file = '') {
        if ($file <> '') {
            if (isSuperadmin()) {
                $this->load->helper('js');
                $fname = str_replace('-', '/', $file);
                if (is_file($fname)) {
                    $data['fname'] = $fname;
                    $data['text'] = ca_get_content_text($fname);
                    $data['file'] = $file;
                    /**
                     * add logs 
                     */
                    ca_userLogs('view ' . $fname, 'CSS');
                    $this->load->view("css_view", $data);
                }
            } else {
                ca_error_auth('update', 'css');
            }
        }
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
                            <a href="javascript:void(0)" class="file icon-pencil" style="padding-left: 15px" onclick="ca_lightbox('dir/create_file/<?php echo str_replace('/', '-', $_POST['dir'] . $file) ?>/css')"><?php echo $file . " " . ca_translate("create new file"); ?></a>
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