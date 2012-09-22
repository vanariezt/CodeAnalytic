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
 * link Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/link
 */
class link extends Controller {

    var $limit = 20;

    /**
     * define file translation 
     */
    var $langfile = 'ca/link';

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
        $this->load->model('mlink');
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
            $data['result'] = $this->mlink->get_all($limit, $offset)->result();
            $data['rows'] = $this->mlink->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url('link/index/');
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_title'] = ($this->input->post('s_title')) ? $this->input->post('s_title') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';
            $this->load->view('link_index', $data);
            ca_userLogs('view', 'Link');
        } else {
            ca_error_auth('view', 'link');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array('action_form' => 'do_insert', 'type' => '1');
            $data['default']['target'] = '_blank';
            $this->load->view('link_form', $data);
            ca_userLogs('view from input', 'Link');
        } else {
            ca_error_auth('insert', 'link');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post('id');
            $data = array('action_form' => 'do_update/' . $id[0]);
            $row = $this->mlink->get_by_id($id['0'])->row();
            $data['default']['url'] = $row->url;
            $data['default']['title'] = $row->title;
            $data['default']['target'] = $row->target;
            $data['default']['attr_class'] = $row->attr_class;
            $data['default']['attr_id'] = $row->attr_id;
            $this->load->view('link_form', $data);
            ca_userLogs('view form update', 'Link');
        } else {
            ca_error_auth('update', 'link');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $url = $this->input->post('url');
            $title = $this->input->post('title');
            $target = $this->input->post('target');
            $attr_class = $this->input->post('attr_class');
            $attr_id = $this->input->post('attr_id');
            //cek link dan password
            $this->form_validation->set_rules('url', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    'id' => time(),
                    'title' => $title,
                    'url' => $url,
                    'target' => $target,
                    'attr_class' => $attr_class,
                    'attr_id' => $attr_id,
                    'publish' => '1',
                    'order' => '0'
                );
                $this->mlink->insert($query);
                ca_userLogs('insert', 'Link');
            } else {
                ca_error_auth('form inputan is not valid for update', 'album');
            }
        } else {
            ca_error_auth('insert', 'link');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $target = $this->input->post('target');
                $attr_class = $this->input->post('attr_class');
                $attr_id = $this->input->post('attr_id');
                $url = $this->input->post('url');
                $title = $this->input->post('title');
                $this->form_validation->set_rules('url', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $query = array(
                        'title' => $title,
                        'target' => $target,
                        'attr_class' => $attr_class,
                        'attr_id' => $attr_id,
                        'url' => $url
                    );
                    $this->mlink->update($id, $query);
                    ca_userLogs('update', 'Link');
                } else {
                    ca_error_auth('form inputan is not valid for update', 'album');
                }
            } else {
                ca_error_auth('update', 'link');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'link/do_delete';
            ca_userLogs('view form delete', 'Link');
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('delete', 'link');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mlink->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
            ca_userLogs('delete', 'Link');
        } else {
            ca_error_auth('delete', 'link');
        }
    }

    function order() {
        if (isUser() && isPublish()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mlink->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'Link');
        } else {
            ca_error_auth('order', 'link');
        }
    }

    function publish($id, $text) {
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
                $this->mlink->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('link/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('link/publish/$id/1',this)>&nbsp;</a>";
                }
                echo $txt_show;
                ca_userLogs('publish', 'Link');
            } else {
                ca_error_auth('publish', 'link');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'link/index';
            $this->load->view('link_find', $data);
            ca_userLogs('search', 'Link');
        } else {
            ca_error_auth('search', 'link');
        }
    }

}

?>