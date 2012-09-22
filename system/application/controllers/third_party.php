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
 * third_party Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/third_party
 */
class third_party extends Controller {

     /**
     * define file translation 
     */
    var $langfile ='ca/third_party';
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
        $this->load->helper(array('form','lang','session','log','app'));
        $this->load->library(array('form_validation','pagination')); 
        $this->load->model("mthird_party");
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
            $data['result'] = $this->mthird_party->get_all($limit, $offset)->result();            
            $data['rows'] = $this->mthird_party->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("third_party/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();
            
            $data['base'] = APPPATH.'third_party/';
            $data['s_title'] = ($this->input->post("s_title")) ? $this->input->post("s_title") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";
            /**
             * add logs 
             */
            ca_userLogs('view', 'third_party');
            $this->load->view("third_party_index", $data);
        } else {
            ca_error_auth('view', 'third_party');
        }
    }

    function delete() {
        if (isSuperAdmin()) {
            $data['url'] = "third_party/do_delete";
            /**
             * add logs 
             */
            ca_userLogs('view form delete', 'third_party');
            $this->load->view("index_delete", $data);
        } else {
            ca_error_auth('delete', 'third_party');
        }
    }

    function do_delete() {
        if (isSuperAdmin()) {
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                $file = $this->mthird_party->get_by_id($id[$i])->row()->title;
                if ($file <> '') {
                    ca_recursive_delete(APPPATH."third_party/$file/");
                    $this->mthird_party->delete($id[$i]);
                }                
                echo "#cen_right table tr#id_$id[$i], ";
            }
            /**
             * add logs 
             */
            ca_userLogs('delete', 'third_party');
        } else {
            ca_error_auth('delete', 'third_party');
        }
    }

    function order() {
        if (isSuperAdmin()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mthird_party->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            /**
             * add logs 
             */
            ca_userLogs('order', 'third_party');
        } else {
            ca_error_auth('order', 'third_party');
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
            $this->mthird_party->update($id, $data);
            if ($text == "1") {
                $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('third_party/publish/$id/0',this)>&nbsp;</a>";
            } else {
                $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('third_party/publish/$id/1',this)>&nbsp;</a>";
            }
            /**
             * add logs 
             */
            ca_userLogs('publish', 'third_party');
            echo $txt_show;
        } else {
            ca_error_auth('publish', 'third_party');
        }
    }

    function find() {
        if (isSuperAdmin()) {
            $data['action_form'] = 'third_party/index';
            /**
             * add logs 
             */
            ca_userLogs('search', 'third_party');
            $this->load->view("third_party_find", $data);
        } else {
            ca_error_auth('search', 'third_party');
        }
    }

    function upload() {
        if (isSuperAdmin()) { 
            $uploaddir = APPPATH.'third_party/';
            $file = $_FILES['userfile'];
            $uploadfile = $uploaddir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                $filename = $file['name'];
                $zipfile = $uploaddir . $filename;
                $dirtemp = unzip($zipfile, $uploaddir);
                if ($dirtemp) {
                    $data = array(
                        "title" => str_replace('.zip', '', $filename),
                        "date" => date("Y-m-d H:i:s"),
                        'publish' => '1',
                        'order' => '0'
                    );
                    $this->mthird_party->insert($data);
                    unlink($zipfile);
                }
            }
            ca_userLogs('upload new third_party', 'third_party');
        } else { 
            ca_error_auth('upload', 'third_party');
        }
    }

}

?>