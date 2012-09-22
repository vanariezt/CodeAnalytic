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
 * comments Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/comments
 */
class comments extends Controller {

    var $limit = 20;
    var $langfile = 'ca/comments';

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
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app','template','page','fb','twit'));
        $this->load->library(array('form_validation', 'pagination','user_agent'));
        $this->load->model(array('mcomments','mtemplate','mposts'));
    }

    function index($offset = 0) {
        if (isUser()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['offset'] = $offset;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            $data['result'] = $this->mcomments->get_all($limit, $offset)->result();
            $data['rows'] = $this->mcomments->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url('comments/index/');
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();
            $data['s_username'] = ($this->input->post('s_username')) ? $this->input->post('s_username') : '';
            $data['s_content'] = ($this->input->post('s_content')) ? $this->input->post('s_content') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';
            $this->load->view('comments_index', $data);
        } else {
            ca_error_auth('view', 'comments');
        }
    }

    function insert() {
        $this->load->helper(array('template', 'widget', 'fb', 'twit', 'page'));
        $this->load->model(array('mtemplate', 'mmenu'));  
        if ($this->session->userdata('member_id') <> '') {
            $data['id'] = time();
            $data['member_id'] = $this->session->userdata('member_id');
            $data['id_posts'] = $this->input->post('id_posts');
            $data['content'] = (nl2br($this->input->post('content')));
            $data['date'] = date('Y-m-d H:i:s');
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
            $username = $this->session->userdata('username');
            $this->form_validation->set_rules('content', 'Isi komentar', 'required|min_length[1]');
            $url_back = $this->input->post('url_back') . '#com_';
            $data['com_url'] = base_url() . $url_back;
            if ($this->form_validation->run() == TRUE) {
                $this->mcomments->insert($data);
                $message = ca_get_content_text(BASEPATH . 'email/comments.txt') . "<br/>";
                $message.= "There are new comment in " . ca_setting('site_title') . " pages. Please visit $url_back";
                $row = $this->db->query("SELECT m.email FROM ca_comments as c , ca_members as m WHERE m.id=c.member_id and c.id_posts='$data[id_posts]'");
                if ($row->num_rows() > 0) {
               //    foreach ($row->result() as $r) {
                 //    ca_send_email(ca_setting('site_email'), ca_setting('site_title'), $r->email, 'message replay', $message);
                 //  }
                }
                $d['url_back'] = $url_back;
                $this->session->set_flashdata('success', 'success');
                redirect($d['url_back']);
             } else {
                $d['url_back'] = $url_back;
                $this->session->set_flashdata('error', 'error');
                redirect($d['url_back']);
            }
        } else {
            ca_error_auth('comment', 'comments');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'comments/do_delete';
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('delete', 'comments');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mcomments->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
        } else {
            ca_error_auth('delete', 'comments');
        }
    }

    function c_delete($id = '', $lk = '') {
        if ($id <> '' && $lk <> '') {
             $this->load->helper(array('template'));
             $this->load->model(array('mtemplate'));  
            if ($this->session->userdata('member_id') <> '') {
                $this->mcomments->delete($id);
                $url_back = str_replace('.', '/', $lk);
                redirect($url_back);
            } else {
                ca_error_auth('delete', 'comments');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function v_delete($id = '', $lk = '') {
        if ($id <> '' && $lk <> '') {
            if ($this->session->userdata('member_id') <> '') {
                $this->load->helper(array('template'));
                $this->load->model(array('mtemplate'));  
                $data['page'] = "comments/c_delete/$id/$lk";
                $this->load->view(ca_theme_dir() . 'web/comments_delete', $data);
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function order() {
        if (isUser() && isPublish()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mcomments->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
        } else {
            ca_error_auth('order', 'comments');
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
                $this->mcomments->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('comments/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('comments/publish/$id/1',this)>&nbsp;</a>";
                }
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'comments');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $data['action_form'] = 'comments/index';
            $this->load->view('comments_find', $data);
        } else {
            ca_error_auth('search', 'comments');
        }
    }
    
    function comment_via($num_com,$this_link,$id,$limit){ 
        $data=array('num_com'=>$num_com,'this_link'=>$this_link,'id'=>$id,'query'=>$this->mcomments->get_comments($id,$limit),'limit'=>$limit);
        $this->load->view(ca_theme_dir().'web/comments',$data);
    }

}

?>