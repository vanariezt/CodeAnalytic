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
 * menu Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/menu
 */

class menu extends Controller {

     var $limit = 20;
    /**
     * define file translation 
     */
    var $langfile ='ca/menu';
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
        $this->load->model('mmenu');
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
            $data['result'] = $this->mmenu->get_all($limit, $offset)->result();
                
            $data['rows'] = $this->mmenu->count_parent();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("menu/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config); 
            $data['ca_paging'] = $this->pagination->create_links();
            
            $data['s_name'] = ($this->input->post('s_name')) ? $this->input->post('s_name') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : ''; 
            ca_userLogs('view', 'Menu');
            $this->load->view('menu_index', $data);
        } else {
            ca_error_auth('view', 'menu');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array(
                'action_form' => 'do_insert',
                'type' => '1'
            );
            $rs = $this->mmenu->get();
            $data['parent']['0'] = '';
            if ($rs->num_rows() > 0) {
                foreach ($rs->result() as $r) {
                    $data['parent'][$r->id] = $r->name;
                    $rs1 = $this->mmenu->get_child($r->id);
                    if ($rs1->num_rows() > 0) {
                        foreach ($rs1->result() as $r1) {
                            $data['parent'][$r1->id] = '&nbsp;&nbsp;&nbsp;+&nbsp;' . $r1->name;
                            $rs2 = $this->mmenu->get_child($r1->id);
                            if ($rs2->num_rows() > 0) {
                                foreach ($rs2->result() as $r2) {
                                    $data['parent'][$r2->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;' . $r2->name;
                                    $rs3 = $this->mmenu->get_child($r2->id);
                                    if ($rs3->num_rows() > 0) {
                                        foreach ($rs3->result() as $r3) {
                                            $data['parent'][$r3->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;' . $r3->name;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data['default']['target'] = '_blank';
            /**
             * add logs 
             */
            ca_userLogs('view form insert', 'Menu');
            $this->load->view('menu_form', $data);
        } else {
            ca_error_auth('insert', 'menu');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post('id');
            $data = array(
                'id' => $id['0'],
                'action_form' => 'do_update/' . $id[0]
            );
            $rs = $this->mmenu->get();
            $data['parent']['0'] = '';
            if ($rs->num_rows() > 0) {
                foreach ($rs->result() as $r) {
                    $data['parent'][$r->id] = $r->name;
                    $rs1 = $this->mmenu->get_child($r->id);
                    if ($rs1->num_rows() > 0) {
                        foreach ($rs1->result() as $r1) {
                            $data['parent'][$r1->id] = '&nbsp;&nbsp;&nbsp;+&nbsp;' . $r1->name;
                            $rs2 = $this->mmenu->get_child($r1->id);
                            if ($rs2->num_rows() > 0) {
                                foreach ($rs2->result() as $r2) {
                                    $data['parent'][$r2->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;' . $r2->name;
                                    $rs3 = $this->mmenu->get_child($r2->id);
                                    if ($rs3->num_rows() > 0) {
                                        foreach ($rs3->result() as $r3) {
                                            $data['parent'][$r3->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;' . $r3->name;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $row = $this->mmenu->get_by_id($id['0'])->row();

            $data['default']['title'] = $row->name;
            $data['default']['url'] = $row->url;
            $data['default']['parent'] = $row->id_parent;
            $data['default']['target'] = $row->target;
            $data['default']['attr_id'] = $row->attr_id;
            $data['default']['attr_class'] = $row->attr_class;
            /**
             * add logs 
             */
            ca_userLogs('view form update', 'Menu');
            $this->load->view('menu_form', $data);
        } else {
            ca_error_auth('update', 'menu');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $name = $this->input->post('title');
            $url = $this->input->post('url');
            $parent = $this->input->post('parent');
            $target = $this->input->post('target');
            $attr_id = $this->input->post('attr_id');
            $attr_class = $this->input->post('attr_class');

            $this->form_validation->set_rules('url', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('parent', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    'id' => time(),
                    'name' => $name,
                    'url' => $url,
                    'id_parent' => $parent,
                    'target' => $target,
                    'attr_id' => $attr_id,
                    'attr_class' => $attr_class,
                    'publish' => '1',
                    'order' => '0'
                );
                ca_userLogs('insert', 'Menu');
                $this->mmenu->insert($query);
            } else {
                ca_error_auth('form input is not valid to insert', 'Menu');
            }
            /**
             * add logs 
             */
        } else {
            ca_error_auth('insert', 'menu');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $name = $this->input->post('title');
                $url = $this->input->post('url');
                $parent = $this->input->post('parent');
                $target = $this->input->post('target');
                $attr_id = $this->input->post('attr_id');
                $attr_class = $this->input->post('attr_class');
                $this->form_validation->set_rules('url', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('parent', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $query = array(
                        'name' => $name,
                        'url' => $url,
                        'id_parent' => $parent,
                        'target' => $target,
                        'attr_id' => $attr_id,
                        'attr_class' => $attr_class
                    );
                    ca_userLogs('update', 'Menu');
                    $this->mmenu->update($id, $query);
                } else {
                    ca_error_auth('form input is not valid to update', 'menu');
                } 
            } else {
                ca_error_auth('update', 'menu');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'menu/do_delete';
            /**
             * add logs 
             */
            ca_userLogs('view form delete', 'Menu');
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('update', 'menu');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mmenu->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
            /**
             * add logs 
             */
            ca_userLogs('delete', 'Menu');
        } else {
            ca_error_auth('delete', 'menu');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mmenu->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
            /**
             * add logs 
             */
            ca_userLogs('order', 'Menu');
        } else {
            ca_error_auth('order', 'menu');
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
                $this->mmenu->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('menu/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('menu/publish/$id/1',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('publish', 'Menu');
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'menu');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'menu/index';
            /**
             * add logs 
             */
            ca_userLogs('search', 'Menu');
            $this->load->view('menu_find', $data);
        } else {
            ca_error_auth('search', 'menu');
        }
    }

}

?>