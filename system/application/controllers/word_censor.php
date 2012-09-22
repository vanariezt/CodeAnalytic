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
 * word_censor Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/word_censor
 */
class word_censor extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/wordcensor';

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
        $this->load->model('mword_censor'); 
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
            $data['result'] = $this->mword_censor->get_all($limit, $offset)->result();
            $data['rows'] = $this->mword_censor->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url('word_censor/index/');
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_word'] = ($this->input->post('s_word')) ? $this->input->post('s_word') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';
            $this->load->view('word_censor_index', $data);
            ca_userLogs('view', 'word_censor');
        } else {
            ca_error_auth('view', 'word_censor');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array('action_form' => 'do_insert', 'type' => '1');
            $data['default']['target'] = '_blank';
            $this->load->view('word_censor_form', $data);
            ca_userLogs('view from input', 'word_censor');
        } else {
            ca_error_auth('insert', 'word_censor');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post('id');
            $data = array('action_form' => 'do_update/' . $id[0]);
            $row = $this->mword_censor->get_by_id($id['0'])->row();
            $data['default']['word'] = $row->word;
            $data['default']['replace'] = $row->replace;
            $this->load->view('word_censor_form', $data);
            ca_userLogs('view form update', 'word_censor');
        } else {
            ca_error_auth('update', 'word_censor');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $word = $this->input->post('word');
            $replace = $this->input->post('replace');
            $this->form_validation->set_rules('word', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('replace', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    'id' => time(),
                    'word' => $word,
                    'replace' => $replace,
                    'publish' => '1',
                    'order' => '0'
                );
                $this->mword_censor->insert($query);
                ca_userLogs('insert', 'word_censor');
            } else {
                ca_error_auth('form inputan is not valid for update', 'album');
            }
        } else {
            ca_error_auth('insert', 'word_censor');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $word = $this->input->post('word');
                $replace = $this->input->post('replace');
                $this->form_validation->set_rules('word', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('replace', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $query = array(
                        'word' => $word,
                        'replace' => $replace,
                    );
                    $this->mword_censor->update($id, $query);
                    ca_userLogs('update', 'word_censor');
                } else {
                    ca_error_auth('form inputan is not valid for update', 'album');
                }
            } else {
                ca_error_auth('update', 'word_censor');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'word_censor/do_delete';
            ca_userLogs('view form delete', 'word_censor');
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('delete', 'word_censor');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mword_censor->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
            ca_userLogs('delete', 'word_censor');
        } else {
            ca_error_auth('delete', 'word_censor');
        }
    }

    function order() {
        if (isUser() && isPublish()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mword_censor->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'word_censor');
        } else {
            ca_error_auth('order', 'word_censor');
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
                $this->mword_censor->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('word_censor/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('word_censor/publish/$id/1',this)>&nbsp;</a>";
                }
                echo $txt_show;
                ca_userLogs('publish', 'word_censor');
            } else {
                ca_error_auth('publish', 'word_censor');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'word_censor/index';
            $this->load->view('word_censor_find', $data);
            ca_userLogs('search', 'word_censor');
        } else {
            ca_error_auth('search', 'word_censor');
        }
    }

}

?>