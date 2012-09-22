<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
 * template Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/template
 */
class template extends Controller {

    /**
     * define limit rows
     * @var type 
     */
    var $limit = 20;

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
        $this->load->model('mtemplate');
    }

    /**
     * @access public
     * @param type $offset 
     */
    function index($offset = 0) {
        if (isSuperAdmin()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;

            $data['rows'] = $this->mtemplate->count();
            $data['result'] = $this->mtemplate->get_all($limit, $offset);
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("template/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            ca_userLogs('view', 'Template');
            $this->load->view("template_index", $data);
        } else {
            ca_error_auth('view', 'template');
        }
    }

    /**
     * @access public
     * get the browser configuration 
     * Location : BASEPATH.'views'.$thema_active.'config.php'
     */
    function browser_config() {
        $this->load->view('browser_config');
    }

    /**
     * @access public
     * update browser configuration 
     * Location : BASEPATH.'views'.$thema_active.'config.php'
     */
    function browser_config_update() {
        if (isSuperAdmin()) {
            $active = ca_theme_dir();
            $this->ca_conf->load('views/' . $active, 'config.php');
            if ($this->ca_conf->count > 0) {
                $path = APPPATH . 'views/' . $active;
                foreach ($this->ca_conf->array as $key => $value) {
                    $old_val = $this->ca_conf->item($key);
                    $val = $this->input->post($key);
                    ca_set_setting($key, $val, $old_val, 'config', $path);
                }
            }
            ca_userLogs('udate config', 'template');
        } else {
            ca_error_auth('update config', 'template');
        }
    }

    /**
     * @access public
     * get mobile configuration 
     * Location : BASEPATH.'views'.$thema_active.'mconfig.php'
     */
    function mobile_config() {
        $this->load->view('mobile_config');
    }

    /**
     * @access public
     * update mobile config 
     * Location : BASEPATH.'views'.$thema_active.'mconfig.php'
     */
    function mobile_config_update() {
        if (isSuperAdmin()) {
            $active = ca_theme_dir();
            $this->ca_conf->load('views/' . $active, 'mconfig.php');
            if ($this->ca_conf->count > 0) {
                $path = APPPATH . 'views/' . $active;
                foreach ($this->ca_conf->array as $key => $value) {
                    $old_val = $this->ca_conf->item($key);
                    $val = $this->input->post($key);
                    ca_set_setting($key, $val, $old_val, 'mconfig', $path);
                }
            }
            ca_userLogs('udate cmonfig', 'template');
        } else {
            ca_error_auth('update mconfig', 'template');
        }
    }

    /**
     * @access public 
     * upload and theme with the spesific rules
     * get the rules and how to create theme in codeanalytic
     * @link http://docs.codeanalytic/template 
     */
    function upload() {
        if (isSuperAdmin()) {
            $file = $_FILES['userfile'];
            $new_path = ca_text_replace($file['name'], '-');
            $path = str_replace('-zip', '', $new_path);
            mkdir(APPPATH . 'views/codeanalytic_template/' . $path, '0777');

            $uploaddir = APPPATH . 'views/codeanalytic_template/' . $path . '/';
            $uploadfile = $uploaddir . basename($file['name']);

            if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                $filename = $file['name'];
                $zipfile = $uploaddir . $filename;
                $dirtemp = unzip($zipfile, $uploaddir);
                if ($dirtemp) {

                    $desc = $uploaddir . "description.txt";
                    if (is_file($desc)) {
                        $content = explode('...', ca_get_content_text($desc));
                        $description = $content['1'];
                        $maker = $content['0'];
                    }
                    $thumb = "preview.jpg";
                    $order = $this->mtemplate->count() + 1;

                    $data = array(
                        "name" => $path,
                        "thumb" => $thumb,
                        "date" => date("Y-m-d"),
                        "maker" => $maker,
                        "order" => $order,
                        "description" => $description
                    );
                    if ($this->mtemplate->insert($data)) {
                        echo $thumb;
                    }
                    unlink($zipfile);
                    echo $thumb;
                }
            }
            ca_userLogs('upload new template', 'Template');
        } else {
            ca_error_auth('upload', 'template');
        }
    }

    /**
     * @access public
     * show a dialog for delete template 
     */
    function delete() {
        if (isSuperAdmin()) {
            $data['url'] = 'template/do_delete';
            $this->load->view("index_delete", $data);
            ca_userLogs('view form delete', 'Template');
        } else {
            ca_error_auth('delete', 'template');
        }
    }

    /**
     * @access public
     * delete template 
     */
    function do_delete() {
        $id = $this->input->post('id');
        if (isSuperAdmin()) {
            $uploaddir = APPPATH . 'views/codeanalytic_template/';
            for ($i = 0; $i < count($id); $i++) {
                $file = $this->mtemplate->get_by_id($id[$i])->name;
                $ex = explode('/', ca_theme_dir());
                if ($ex['1'] != $file) {
                    if ($file <> '') {
                        ca_recursive_delete($uploaddir . '/' . $file);
                    }
                    $this->mtemplate->delete($id[$i]);
                    echo "li#id_$id[$i], ";
                } else {
                    echo '0';
                }
            }
            ca_userLogs('delete', 'Template');
        } else {
            ca_error_auth('delete', 'template');
        }
    }

    /**
     * @access public
     * order the template 
     */
    function order() {
        if (isSuperAdmin()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mtemplate->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'Template');
        } else {
            ca_error_auth('update', 'template');
        }
    }

    /**
     * publish and unpublish template
     * @param type $id
     * @param type $text 
     */
    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {

                $data1 = array(
                    "publish" => '1'
                );
                $data0 = array(
                    "publish" => '0'
                );
                $this->db->update("ca_template", $data0);
                $this->mtemplate->update($id, $data1);
                $active = ca_theme_dir();
                $w_active = '<?php $active="/' . $active . '"; ?>';
                ca_write_content_text(BASEPATH . 'codeanalytic/active.php', $w_active);
                ca_userLogs('publish', 'Template');
            } else {
                ca_error_auth('publish', 'template');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    /**
     * @access public
     * view the dialog window in mobile view 
     */
    function mobile() {
        $this->load->helper(array('mobile'));
        $this->load->model(array('mwidget'));
        $data['default']['mobile_theme'] = ca_setting('mobile_theme');
        $this->load->view(ca_theme_dir() . 'mobile/template', $data);
    }

    /**
     * @access pulic
     * @param type $i 
     * set the mobile template and save it using session
     */
    function mobile_set($i = '') {
        if ($i <> '') {
            $this->session->set_userdata("mobile_theme", $i);
            redirect('/', 'refresh');
        } else {
            ca_error404('missing parameter input');
        }
    }

}

?>