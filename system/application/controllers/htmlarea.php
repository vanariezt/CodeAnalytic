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
 * htmlarea Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/htmlarea
 */
class htmlarea extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/htmlarea';

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
        $this->lang->index($this->langfile);
        /**
         * load class helper, library and model 
         */
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app','template'));
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('mhtmlarea', 'mwidget','mtemplate'));
    }

    function insert($pos = '',$t='0') {
        if ($pos <> '') {
            if (isUser() && isInsert()) {
                $this->load->helper('js');
                switch ($pos) {
                    case '6':
                        $position = 'mobile top';
                        break;
                    case '1':
                        $position = 'top area';
                        break;
                    case '5':
                        $position = 'timeline area';
                        break;
                    case '2':
                        $position = 'right area';
                        break;
                    case '3':
                        $position = 'bottom area';
                        break;
                    case '4':
                        $position = 'left area';
                        break;
                    case '7':
                        $position = 'mobile bottom';
                        break;
                    default:
                        break;
                }
                $data = array('action_form' => 'do_insert/'.$pos, 'type' => '1', 'pos' => $pos, 'position' => $position, 'id_template'=> ca_theme_id(),'t'=>$t);
                $this->load->view('htmlarea_form', $data);
                ca_userLogs('view form input', 'htmlarea');
            } else {
                ca_error_auth('insert', 'htmlarea');
            }
        } else {
            ca_error_auth('missing parameter', 'htmlarea');
        }
    }

    function update($id = '') {
        if ($id <> '') {
            $this->load->helper('js');
            if (isUser() && isUpdate()) {
                $data['action_form'] = 'do_update/' . $id; 
                $row = $this->mhtmlarea->get_by_id($id)->row();
                $data['default']['title'] = $row->title;
                $data['default']['html'] = $row->html; 
                $this->load->view('htmlarea_form', $data);
                ca_userLogs('view update form', 'htmlarea');
            } else {
                ca_error_auth('update', 'htmlarea');
            }
        } else {
            ca_error_auth('missing parameter', 'htmlarea');
        }
    }

    function do_insert($pos = '', $t='0') {
        if ($pos <> '') {
            if (isUser() && isInsert()) {
                $title = $this->input->post('title');
                $this->input->use_xss_clean = FALSE;
                $html = $this->input->post("html", FALSE);
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('html', '', 'trim|required|xss_clean');
                $id_ = time();
                if ($this->form_validation->run()) {
                    $data = array(
                        'id' => $id_,
                        'title' => $title,
                        'html' => $html,
                        'pos' => $pos
                    );

                    $this->mhtmlarea->insert($data);
                    $data1 = array(
                        "name" => $title,
                        "order" => $this->mwidget->count() + 1,
                        "position" => $pos,
                        'id_htmlarea' => $id_,
                        'id_template'=> ca_theme_id(),
                        'type'=> $t
                    );
                    $this->mwidget->insert($data1);
                    ca_userLogs('insert data', 'htmlarea');
                } else {
                    ca_error404('form inputan is not valid for insert');
                }
            } else {
                ca_error_auth('insert', 'htmlarea');
            }
        } else {
            ca_error_auth('missing parameter', 'htmlarea');
        }
    }
    
     function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $title = $this->input->post('title');
                $this->input->use_xss_clean = FALSE;
                $html = $this->input->post("html", FALSE);
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('html', '', 'trim|required|xss_clean'); 
                if ($this->form_validation->run()) {
                    $data = array( 
                        'title' => $title,
                        'html' => $html
                    );

                    $this->mhtmlarea->update($id,$data);
                    $data1 = array(
                        "name" => $title,
                        "order" => $this->mwidget->count() + 1
                    );
                    
                    $this->db->where('id_htmlarea', $id);
                    $this->db->update('ca_widget', $data1);
                    ca_userLogs('insert data', 'htmlarea');
                } else {
                    ca_error404('form inputan is not valid for insert');
                }
            } else {
                ca_error_auth('insert', 'htmlarea');
            }
        } else {
            ca_error_auth('missing parameter', 'htmlarea');
        }
    }


}

?>
