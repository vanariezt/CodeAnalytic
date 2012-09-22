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
 * widget Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/widget
 */
class widget extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/widget';

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
        $this->load->helper(array('lang', 'session', 'log', 'app', 'js', 'template', 'form','mobile'));
        $this->load->library(array('ca_conf'));
        $this->load->model(array('mtemplate', 'mwidget'));
    }

    function index() {
        if (isSuperAdmin()) {
            ca_userLogs('view', 'Widget');
            $this->load->view("widget_index");
        } else {
            ca_error_auth('view', 'widget');
        }
    }

    function mobile() {
        if (isSuperAdmin()) {
            ca_userLogs('view', 'Widget');
            $this->load->view("widget_mindex");
        } else {
            ca_error_auth('view', 'widget');
        }
    }

    function do_insert($pos = '',$type='0') {
        if ($pos <> '') {
            if (isSuperAdmin()) {
                if ($pos <> '') {
                    $array = $this->input->post('id');
                    $d = $this->mwidget->get_all($pos)->row()->name;
                    foreach ($array as $val) {
                        $vals = str_replace("#", "_", $val);
                        if ($d <> $vals) {
                            $data = array(
                                "name" => $vals,
                                "order" => $this->mwidget->count() + 1,
                                "position" => $pos,
                                "id_template" => ca_theme_id(),
                                "type" => $type
                                );
                            $this->mwidget->insert($data);
                        } else {
                            
                        }
                    }
                    ca_userLogs('insert new widget', 'Widget');
                } else {
                    ca_error404('url not found');
                }
            } else {
                ca_error_auth('insert', 'widget');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function update($file = '',$type='0') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $title = str_replace('_wi', '', $file);
                $data['title'] = $title;
                $data['type'] = $type;
                ca_userLogs('view update form', 'Widget');
                $this->load->view("widget_update", $data);
            } else {
                ca_error_auth('update', 'widgets');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function do_update($file = '') {
        if ($file <> '') {
            if (isSuperAdmin()) {
                $this->ca_conf->load('widgets/config/', 'config_' . $file . '_wi');
                if ($this->ca_conf->count > 0) {
                    $path = APPPATH . 'widgets/config/';
                    foreach ($this->ca_conf->array as $key => $value) {
                        $old_val = $this->ca_conf->item($key);
                        $val = $this->input->post($key);
                        ca_set_setting($key, $val, $old_val, 'config_' . $file . '_wi', $path);
                    }
                }
                ca_userLogs('udate widget', 'Widget');
            } else {
                ca_error_auth('update', 'widgets');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete($id = '') {
        if ($id <> '') {
            if (isSuperAdmin()) {
                $data['id'] = $id;
                ca_userLogs('view form delete', 'Widget');
                $this->load->view("widget_delete", $data);
            } else {
                ca_error_auth('delete', 'widgets');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function do_delete($id = '') {
        if ($id <> '') {
            if (isSuperAdmin()) {
                $id_template=ca_theme_id();
                $id_htmlarea = $this->mwidget->get_where($id,$id_template)->row()->id_htmlarea;
                if ($id_htmlarea <> '0') {
                    $this->db->delete('ca_htmlarea', array('id' => $id_htmlarea));
                }
                $this->mwidget->delete($id);

                ca_userLogs('delete', 'Widget');
            } else {
                ca_error_auth('update', 'widgets');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function get_current($id = '',$type='0') {
        if ($id <> '' && $type <> '') {
            if (isSuperAdmin()) {
                if ($id <> '') {
                    $data['id'] = $id;
                    $data['id_template'] = ca_theme_id();
                    $data['type'] = $type;
                    $this->load->view("widget_current", $data);
                } else {
                    ca_error404('page not found');
                }
            } else {
                ca_error_auth('insert', 'widget');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function widget_list($type='0') {
        if (isSuperAdmin() && $type <> '') {
            $data['type'] = $type;
            $this->load->view('widget_list',$data);
        }
    }

    function order() {
        if (isSuperAdmin()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mwidget->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'Widget');
        } else {
            ca_error_auth('order', 'widgets');
        }
    }

    function set_script($f, $config) {
        $data['f'] = $f;
        $data['config'] = $config;
        $this->load->view('widget_set_script', $data);
    }

}

?>