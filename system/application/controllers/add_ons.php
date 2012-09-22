<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');
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
 * add_ons Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/add_ons
 */
class add_ons extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/add_ons';

    /**
     * define limit view
     * @var type 
     */
    var $limit = 20;

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
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app'));
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('madd_ons'));
    }

    function index($offset = 0) {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            $data['result'] = $this->madd_ons->get_all($limit, $offset)->result();
            $data['rows'] = $this->madd_ons->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("add_ons/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['base'] = APPPATH . 'add_ons/';
            $data['s_title'] = ($this->input->post("s_title")) ? $this->input->post("s_title") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";
            /**
             * add logs 
             */
            ca_userLogs('view', 'add_ons');
            $this->load->view("add_ons_index", $data);
        } else {
            ca_error_auth('view', 'add_ons');
        }
    }

    function delete() {
        if (isSuperAdmin()) {
            $data['page'] = "add_ons/do_delete/";
            /**
             * add logs 
             */
            ca_userLogs('view form delete', 'add_ons');
            $this->load->view("add_ons_delete", $data);
        } else {
            ca_error_auth('delete', 'add_ons');
        }
    }

    function do_delete($m='') {
        $this->load->helper('url');
        $id = $this->input->post('id'); 
        $q = $this->madd_ons->get_by_id($id['0'])->row();
        $title=$q->title . '_wi';
        $file = ".-system-application-widgets-$title.php";
        if (isSuperAdmin()) {
            $filename = str_replace("-", "/", $file);
            $ex = explode('/', $filename);
            // delete for bowser widget
            $conf = 'config/config_' . $ex[count($ex) - 1];
            $ex_w = explode('widgets/', $filename);
            $config = $ex_w['0'] . 'widgets/' . $conf;
            if (is_file($config)) {
                unlink($config);
                ca_userLogs("delete file $config in Directory $m", 'Application Directory');
            }
            // delete for mobile widget
            $conf = 'mconfig/config_' . $ex[count($ex) - 1];
            $ex_w = explode('widgets/mobile/', $filename);
            $mconfig = $ex_w['0'] . 'widgets/mobile/' . $conf;
            if (is_file($mconfig)) {
                unlink($mconfig);
                ca_userLogs("delete file $mconfig in Directory $m", 'Application Directory');
            }


            $all_file = str_replace('_wi.php', '', $ex[count($ex) - 1]);
            // drop table if exist 
            $this->db->query("DROP TABLE ca_$all_file");
            // delete  filed in table widget where name if find
            $wi_name = $all_file . '_wi';
            $this->db->query("DELETE FROM ca_widget WHERE name='$wi_name'");
            $this->db->query("DELETE FROM ca_module WHERE name='$all_file'");
            $this->db->query("DELETE FROM ca_add_ons WHERE title='$all_file'");
            // delete controller if exists
            $controller = './system/application/controllers/' . $all_file . EXT;
            if (is_file($controller)) {
                unlink($controller);
                ca_userLogs("delete file $controller in Directory $m", 'Application Directory');
            }
            // delete model if exists
            $model = './system/application/models/m' . $all_file . EXT;
            if (is_file($model)) {
                unlink($model);
                ca_userLogs("delete file $model in Directory $m", 'Application Directory');
            }
            $view = './system/application/views/' . $all_file;
            if (is_dir($view)) {
                ca_recursive_delete($view);
                ca_userLogs("delete file $view in Directory $m", 'Application Directory');
            }
            $plugin = './system/application/plugins/' . $all_file;
            if (is_dir($plugin)) {
                ca_recursive_delete($plugin);
                ca_userLogs("delete file $plugin in Directory $m", 'Application Directory');
            }
            $third_party = './system/application/third_party/' . $all_file;
            if (is_dir($plugin)) {
                ca_recursive_delete($third_party);
                ca_userLogs("delete file $third_party in Directory $m", 'Application Directory');
            }
            $helper = './system/application/helpers/' . $all_file . '_helper' . EXT;
            if (is_file($helper)) {
                unlink($helper);
                ca_userLogs("delete file $helper in Directory $m", 'Application Directory');
            }
            //
            if (is_file($filename)) {
                unlink($filename);
                ca_userLogs("delete file $filename in Directory $m", 'Application Directory');
            }
        }
    }

    function order() {
        if (isSuperAdmin()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->madd_ons->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            /**
             * add logs 
             */
            ca_userLogs('order', 'add_ons');
        } else {
            ca_error_auth('order', 'add_ons');
        }
    }

    function publish($id, $text) {
        if (isSuperAdmin()) {
            if ($text == '1') {
                $data = array(
                    "publish" => '0'
                );
            } else {
                $data = array(
                    "publish" => '1'
                );
            }
            $this->madd_ons->update($id, $data);
            if ($text == "1") {
                $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('add_ons/publish/$id/0',this)>&nbsp;</a>";
            } else {
                $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('add_ons/publish/$id/1',this)>&nbsp;</a>";
            }
            /**
             * add logs 
             */
            ca_userLogs('publish', 'add_ons');
            echo $txt_show;
        } else {
            ca_error_auth('publish', 'add_ons');
        }
    }

    function find() {
        if (isSuperAdmin()) {
            $data['action_form'] = 'add_ons/index';
            /**
             * add logs 
             */
            ca_userLogs('search', 'add_ons');
            $this->load->view("add_ons_find", $data);
        } else {
            ca_error_auth('search', 'add_ons');
        }
    }

}
?>