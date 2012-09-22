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
 * categories Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/categories
 */
class categories extends Controller {

    var $limit = 20;
    var $langfile = 'ca/categories';

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
        $this->load->model("mcategories");
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
            $data['rows'] = $this->mcategories->count();
            $data['result'] = $this->mcategories->get_all($limit, $offset)->result();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("categories/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_name'] = ($this->input->post("s_name")) ? $this->input->post("s_name") : "";
            $data['s_keyword'] = ($this->input->post("s_keyword")) ? $this->input->post("s_keyword") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";

            ca_userLogs('view', 'Post Categories');
            $this->load->view("categories_index", $data);
        } else {
            ca_error_auth('view', 'categories');
        }
    }

    function insert($method = '') {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array(
                "action_form" => "do_insert",
                "type" => "1",
                'publish' => '1',
                'order' => '0'
            );

            switch ($method) {
                case 'lightbox':
                    $this->load->view("categories_form_lightbox", $data);
                    break;

                default:
                    $this->load->view("categories_form", $data);
                    break;
            }
            ca_userLogs('view form input', 'Post Categories');
        } else {
            ca_error_auth('insert', 'category of posts');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post("id");
            $data = array(
                "action_form" => "do_update/$id[0]",
            );

            $row = $this->mcategories->get_by_id($id['0'])->row();
            $data['default']['name'] = $row->name;
            $data['default']['keyword'] = $row->meta_keyword;
            $data['default']['description'] = $row->meta_description;
            $data['default']['permalink'] = $row->permalink;
            $data['default']['old_permalink'] = $row->permalink;

            ca_userLogs('view update form', 'Post Categories');
            $this->load->view("categories_form", $data);
        } else {
            ca_error_auth('update', 'category of posts');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $name = $this->input->post("name");
            $keyword = $this->input->post("keyword");
            $description = $this->input->post("description");
            $permalink = ca_text_replace(strtolower($this->input->post('permalink')), '-');
            $last_id = time();
            $link = "posts/kanal/$last_id";
            $fname = APPPATH . 'config/routes.php';
            $fcontent = file_get_contents($fname);
            $fcontent .= "\r\n".'$route[\'' . $permalink . '\'] = \'' . $link . '\';';
            file_put_contents($fname, $fcontent);

            $this->form_validation->set_rules('name', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('keyword', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    "id" => time(),
                    "meta_keyword" => $keyword,
                    "meta_description" => $description,
                    "name" => $name,
                    "publish" => "1",
                    "order" => "0",
                    "permalink" => $permalink
                );
                /**
                 * add logs 
                 */
                ca_userLogs('insert', 'Post Categories');
                $this->mcategories->insert($query);
            } else {
                ca_error_auth('form inputan is not valid for update', 'album');
            }
        } else {
            ca_error_auth('insert', 'category of posts');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $name = $this->input->post("name");
                $keyword = $this->input->post("keyword");
                $description = $this->input->post("description");
                $permalink = ca_text_replace(strtolower($this->input->post('permalink')), '-');
                $old_permalink = $this->input->post('old_permalink');
                $url = 'posts/kanal/' . $id;
                $this->form_validation->set_rules('name', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('keyword', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $query = array(
                        "meta_keyword" => $keyword,
                        "meta_description" => $description,
                        "name" => $name,
                        "permalink" => $permalink
                    );
                    $fname = APPPATH . 'config/routes.php';
                    $fhandle = fopen($fname, 'r');
                    $content = fread($fhandle, filesize($fname));
                    $content = str_replace('$route[\'' . $old_permalink . '\'] = \'' . $url . '\';', '$route[\'' . $permalink . '\'] = \'' . $url . '\';', $content);

                    $fhandle = fopen($fname, 'w');
                    fwrite($fhandle, $content);
                    fclose($fhandle);
                    ca_userLogs('update', 'Post Categories');
                    $this->mcategories->update($id, $query);
                } else {
                    ca_error_auth('form inputan is not valid for update', 'album');
                }
            } else {
                ca_error_auth('update', 'category of posts');
            }
        } else {
            ca_error404('missing parameter input');
            
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'categories/do_delete';
            $this->load->view("index_delete", $data);
            ca_userLogs('view form delete', 'Post Categories');
        } else {
            ca_error_auth('delete', 'category of posts');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                if ($id[$i] <> '8948759595') {
                    $this->mcategories->delete($id[$i]);
                    echo "#cen_right table tr#id_$id[$i], ";
                } else {
                    ca_alert('this category can not be delete');
                }
            }
            ca_userLogs('delete', 'Post Categories');
        } else {
            ca_error_auth('delete', 'category of posts');
        }
    }

    function order() {
        if (isUser() && isPublish()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mcategories->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }

            ca_userLogs('order', 'Post Categories');
        } else {
            ca_error_auth('order', 'category of posts');
        }
    }

    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isUser() && isPublish()) {
                if ($text == '1') {
                    $data = array(
                        "publish" => '0'
                    );
                } else {
                    $data = array(
                        "publish" => '1'
                    );
                }
                $this->mcategories->update($id, $data);
                if ($text == "1") {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('categories/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('categories/publish/$id/1',this)>&nbsp;</a>";
                }
                ca_userLogs('publish', 'Post Categories');
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'category of posts');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $data['action_form'] = 'categories/index';
            ca_userLogs('search', 'Post Categories');
            $this->load->view("categories_find", $data);
        } else {
            ca_error_auth('search', 'category of posts');
        }
    }

}

?>