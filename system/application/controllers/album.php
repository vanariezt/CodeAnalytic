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
 * album Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/album
 */

class album extends Controller {

    /**
     * define file translation 
     */
    var $langfile ='ca/album';
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
        $this->load->model('malbum');
    }

    function index($offset = 0) {
        if (isUser()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }

            $data['rows'] = $this->malbum->count();
            $data['result'] = $this->malbum->get_all($limit, $offset)->result();

            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("album/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_name'] = ($this->input->post('s_name')) ? $this->input->post('s_name') : '';
            $data['s_description'] = ($this->input->post('s_description')) ? $this->input->post('s_description') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';

            $this->load->view('album_index', $data);
            ca_userLogs('view', 'Album');
        } else {
            ca_error_auth('view', 'album');
        }
    }

    function insert($method = '') {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array('action_form' => 'do_insert','type' => '1');
            switch ($method) {
                case 'lightbox':
                    $this->load->view('album_form_lightbox', $data);
                    break;
                default:
                    $this->load->view('album_form', $data);
                    break;
            }
            ca_userLogs('view form input', 'Album');
        } else {
            ca_error_auth('insert', 'album');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $this->form_validation->set_rules('name', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $data = array(
                    'id' => time(),
                    'name' => $name,
                    'description' => $description,
                    'publish' => '1',
                    'order' => '0'
                );
                $this->malbum->insert($data);
                ca_userLogs('insert data', 'Album');
            } else {
                ca_error404('form inputan is not valid for insert');
            }
        } else {
            ca_error_auth('insert', 'album');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'album/do_delete'; 
            $this->load->view('index_delete', $data);
            ca_userLogs('view delete form', 'Album');
        } else {
            ca_error_auth('delete', 'album');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->malbum->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            } 
            ca_userLogs('delete', 'Album');
        } else {
            ca_error_auth('delete', 'album');
        }
    }

    function update() {
        $this->load->helper('js');
        $i = $this->input->post('id');
        $id = $i['0'];
        if (isUser() && isUpdate()) {
            $data['action_form'] = 'do_update/' . $id;
            
            $row = $this->malbum->get_by_id($id);
            $data['default']['description'] = $row->description;
            $data['default']['name'] = $row->name;
            $this->load->view('album_form', $data); 
            ca_userLogs('view update form', 'Album');
        } else {
            ca_error_auth('update', 'album');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                if (isset($id)) {
                    $name = $this->input->post('name');
                    $description = $this->input->post('description');
                    $this->form_validation->set_rules('name', '', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
                    if ($this->form_validation->run()) {
                        $data = array(
                            'name' => $name, 
                            'description' => $description
                        );
                        $this->malbum->update($id, $data);
                        ca_userLogs('update', 'Album');
                    } else {
                        ca_error_auth('form inputan is not valid for update', 'album');
                    }
                } else {
                    ca_error404('page not found');
                }
            } else {
                ca_error_auth('update', 'album');
            }
        } else {
            ca_error404('missing input parameter');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->malbum->update($val, array('order' => $counter));
                $counter = $counter + 1;
            } 
            ca_userLogs('order', 'Album');
        } else {
            ca_error_auth('order', 'album');
        }
    }

    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isUser() && isPublish()) {
                if ($text == '1') {
                    $data = array(
                        'publish' => '0'
                    );
                } else {
                    $data = array(
                        'publish' => '1'
                    );
                }
                $this->malbum->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('album/publish/$id/0',this)>Ã�ï¿½Ã¯Â¿Â½Ã�ï¿½Ã�Â </a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('album/publish/$id/1',this)>Ã�ï¿½Ã¯Â¿Â½Ã�ï¿½Ã�Â </a>";
                }
                echo $txt_show;
                ca_userLogs('publish', 'Album');
            } else {
                ca_error_auth('publish', 'album');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'album/index';
            ca_userLogs('search', 'Album');
            $this->load->view('album_find', $data);
        } else {
            ca_error_auth('search', 'album');
        }
    }

}

/**
 * End of class album.php
 * Location: system/application/controllers/album.php
 */
?>
