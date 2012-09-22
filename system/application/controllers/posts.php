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
 * post Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/post
 */
class posts extends Controller {

    // define limit of paging and lang file
    var $limit = 20;
    var $langfile = 'ca/post';

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
        $this->load->model(array('mposts', 'mcategories'));
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

            $data['rows'] = $this->mposts->count();

            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url('posts/index/');
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();
            $data['result'] = $this->mposts->get_all($limit, $offset)->result();

            $data['s_title'] = ($this->input->post('s_title')) ? $this->input->post('s_title') : '';
            $data['s_cat_id'] = ($this->input->post('s_cat_id')) ? $this->input->post('s_cat_id') : '';
            $data['s_content'] = ($this->input->post('s_content')) ? $this->input->post('s_content') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';
            $this->load->view('posts_index', $data);
        } else {
            ca_error_auth('view', 'posts');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            // load js helpers
            $this->load->helper('js');
            $data = array(
                'action_form' => 'do_insert',
                'type' => '1'
            );
            $rs = $this->mposts->get_cat();
            if ($rs->num_rows() > 0) {
                $data['cat_id'][''] = '-select category-';
                foreach ($rs->result() as $r) {
                    $data['cat_id'][$r->id] = $r->name;
                }
            }
            $data['cat'] = $this->mposts->get_cat();
            $data['default']['is_like'] = 'TRUE';
            $data['default']['is_show_thumb'] = 'FALSE';
            $data['default']['is_share'] = 'TRUE';
            $data['default']['date'] = date('Y-m-d H:i:s');
            $this->load->view('posts_form', $data);
        } else {
            ca_error_auth('insert', 'posts');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $i = $this->input->post('id');
            $id = $i['0'];

            $this->load->helper('js');

            $data = array(
                'action_form' => "do_update/$id"
            );

            $row = $this->mposts->get_by_id($id)->row();

            $data['default']['title'] = $row->title;
            $data['default']['img'] = $row->img;
            $data['default']['content'] = $row->content;
            $data['cat_id'] = explode(',', $row->cat_id);
            $data['default']['keyword'] = $row->meta_keyword;
            $data['default']['description'] = $row->meta_description;
            $data['default']['is_like'] = $row->is_like;
            $data['default']['is_share'] = $row->is_share;
            $data['default']['is_show_thumb'] = $row->is_show_thumb;
            $data['default']['url'] = $row->link;
            $data['default']['permalink'] = $row->permalink;
            $data['default']['old_permalink'] = $row->permalink;
            $data['default']['date'] = $row->date;
            $data['cat'] = $this->mposts->get_cat();
            $this->load->view('posts_form', $data);
        } else {
            ca_error_auth('update', 'posts');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $this->input->use_xss_clean = FALSE; 
            $title = $this->input->post('title');
            $img = $this->input->post('img');
            $cat_id_array = $this->input->post('cat_id');
            $content = ($this->input->post('content',FALSE));
            $user_id = $this->session->userdata('user_id');
            $keyword = $this->input->post('keyword');
            $description = $this->input->post('description');
            $is_like = ($this->input->post('is_like')) ? $this->input->post('is_like') : '0';
            $is_share = ($this->input->post('is_share')) ? $this->input->post('is_share') : '0';
            $is_show_thumb = ($this->input->post('is_show_thumb')) ? $this->input->post('is_show_thumb') : '0';
            $permalink = strtolower(ca_text_replace($this->input->post('permalink'), '-'));
            $input_date = date_format(date_create($this->input->post('date')), 'Y-m-d H:i:s');

            $explode = explode(' ', $input_date);
            $date = explode('-', $explode['0']);
            $time = explode(':', $explode['1']);
            $last_id = time();
            $datecreate = date_create("$date[0]-$date[1]-$date[2]");
            $timecreate = date_create("$time[0]:$time[1]:$time[2]");
            $link = "posts/detail/$last_id/$date[0]/$date[1]/$date[2]/$time[0]/$time[1]/$time[2]";

            // explode $cat_id
            $cat_id = '';
            $sum = count($cat_id_array);
            for ($i = 0; $i < $sum; $i++) {
                if ($sum == 1 || ($i == ($sum - 1))) {
                    $cat_id.=$cat_id_array[$i];
                } else if ($sum > 1) {
                    $cat_id.=$cat_id_array[$i] . ',';
                }
            }

            $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('content', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    'id' => $last_id,
                    'user_id' => $user_id,
                    'title' => $title,
                    'img' => $img,
                    'date' => $input_date,
                    'cat_id' => $cat_id,
                    'content' => $content,
                    'permalink' => $permalink,
                    'meta_keyword' => $keyword,
                    'meta_description' => $description,
                    'is_like' => $is_like,
                    'is_share' => $is_share,
                    'is_show_thumb' => $is_show_thumb,
                    'link' => $link,
                    'publish' => '1',
                    'order' => '0'
                );
                $this->mposts->insert($query);
                $this->load->model('msubscribe');
                $sub = $this->msubscribe->get();


                // set permalink
                $fname = APPPATH . 'config/routes.php';
                $fcontent = file_get_contents($fname);
                $fcontent .= '$route[\'' . $permalink . '\'] = \'' . $link . '\';';
                file_put_contents($fname, $fcontent);

                $message = ca_get_content_text(BASEPATH . 'email/news_letter.txt') . "<br/>";
                $message.= "Please visit this link " . ca_setting('site_domain') . '/' . $permalink;
                if ($sub->num_rows() > 0) {
                    foreach ($sub->result() as $r) {
                        ca_send_email(ca_setting('site_email'), ca_setting('site_name'), $r->email, ca_setting('site_name') . " News Letter", $message);
                    }
                }
            } else {
                ca_error_auth('invalid form input', 'posts');
            }
        } else {
            ca_error_auth('insert', 'posts');
        }
    }

    function do_update($id) {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $this->input->use_xss_clean = FALSE; 
                $title = $this->input->post('title');
                $img = $this->input->post('img');
                $cat_id_array = $this->input->post('cat_id');
                $content = ($this->input->post('content', FALSE));
                $user_id = $this->session->userdata('user_id');
                $keyword = $this->input->post('keyword');
                $description = $this->input->post('description');
                $is_like = ($this->input->post('is_like')) ? $this->input->post('is_like') : '0';
                $is_share = ($this->input->post('is_share')) ? $this->input->post('is_share') : '0';
                $is_show_thumb = ($this->input->post('is_show_thumb')) ? $this->input->post('is_show_thumb') : '0';
                $permalink = strtolower(ca_text_replace($this->input->post('permalink'), '-'));
                $url = $this->input->post('url');
                $input_date = date_format(date_create($this->input->post('date')), 'Y-m-d H:i:s');
                $explode = explode(' ', $input_date);
                $date = explode('-', $explode['0']);
                $time = explode(':', $explode['1']);

                $link = "posts/detail/$id/$date[0]/$date[1]/$date[2]/$time[0]/$time[1]/$time[2]";
                $old_permalink = $this->input->post('old_permalink');

                // explode $cat_id
                $cat_id = '';
                $sum = count($cat_id_array);
                for ($i = 0; $i < $sum; $i++) {
                    if ($sum == 1 || ($i == ($sum - 1))) {
                        $cat_id.=$cat_id_array[$i];
                    } else if ($sum > 1) {
                        $cat_id.=$cat_id_array[$i] . ',';
                    }
                }

                $this->form_validation->set_rules('keyword', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('content', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $query = array(
                        'user_id' => $user_id,
                        'title' => $title,
                        'img' => $img,
                        'date' => $input_date,
                        'cat_id' => $cat_id,
                        'content' => $content,
                        'link' => $link,
                        'meta_keyword' => $keyword,
                        'meta_description' => $description,
                        'is_like' => $is_like,
                        'is_share' => $is_share,
                        'is_show_thumb' => $is_show_thumb,
                        'permalink' => $permalink
                    );
                    $this->mposts->update($id, $query);
                    $fname = APPPATH . 'config/routes.php';
                    $fhandle = fopen($fname, 'r');
                    $content = fread($fhandle, filesize($fname));
                    $content = str_replace('$route[\'' . $old_permalink . '\'] = \'' . $url . '\';', '$route[\'' . $permalink . '\'] = \'' . $link . '\';', $content);

                    $fhandle = fopen($fname, 'w');
                    fwrite($fhandle, $content);
                    fclose($fhandle);
                } else {
                    ca_error_auth('invalid form input', 'posts');
                }
            } else {
                ca_error_auth('update', 'posts');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'posts/do_delete';
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('delete', 'posts');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mposts->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
        } else {
            ca_error_auth('delete', 'posts');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mposts->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
        } else {
            ca_error_auth('order', 'posts');
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
                $this->mposts->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' name='hide this post' onclick=ca_action_publish('posts/publish/$id/0',this) class='screenshot showx'></a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' name='show this post' onclick=ca_action_publish('posts/publish/$id/1',this) class='screenshot hidex'></a>";
                }
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'posts');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $rs = $this->mposts->get_cat();
            if ($rs->num_rows() > 0) {
                $data['s_cat_id'][0] = '';
                foreach ($rs->result() as $r) {
                    $data['s_cat_id'][$r->id] = $r->name;
                }
            }
            $data['action_form'] = 'posts/index';
            $this->load->view('posts_find', $data);
        } else {
            ca_error_auth('search', 'posts');
        }
    }

    function detail($id = '', $y = '', $m = '', $d = '', $h = '', $i = '', $s = '', $title = '') {
        if ($id <> '' && $y <> '' && $m <> '' && $d <> '' && $h <> '' && $i <> '' && $s <> '') {
            $this->load->helper(array('twit', 'fb', 'g+', 'page', 'template', 'widget'));
            $this->load->model(array('mtemplate', 'mmenu'));
            $this->load->library(array('user_agent'));
            $date = "$y-$m-$d $h:$i:$s";
            $count = $this->mposts->get_detail($id, $date)->num_rows();
            $r = $this->mposts->get_detail($id, $date)->row();
            if ($count > 0) {
                $view = $r->view; //show how many time it's viewed
                $update = array("view" => $view + 1); //update view as + 1
                $this->mposts->update($id, $update); // do update

                $date = $r->date;
                $explode = explode(' ', $date);
                $date = explode('-', $explode['0']);
                $time = explode(':', $explode['1']);

                $datecreate = date_create("$date[0]-$date[1]-$date[2]");
                $timecreate = date_create("$time[0]:$time[1]:$time[2]");
                $data = array(
                    'id' => $id,
                    'r' => $r,
                    'date' => $date,
                    'title' => $r->title,
                    'meta_keyword' => $r->meta_keyword,
                    'meta_description' => $r->meta_description,
                    'format_date' => date_format($datecreate, ca_template_setting('date_format')),
                    'format_time' => date_format($timecreate, ca_template_setting('time_format')),
                    'this_link' => $r->permalink,
                    'num_com' => $this->mposts->get_num_comments($id)
                );
                (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/posts_detail' : '';
                (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/posts_detail' : '';
                (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
                (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
                (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
                (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
                $m_data = array(
                    'id' => $id,
                    'r' => $r,
                    'date' => $date,
                    'title' => $r->title,
                    'mobile_top' => 'mobile/top',
                    'mobile_center' => 'web/posts_detail',
                    'meta_keyword' => $r->meta_keyword,
                    'meta_description' => $r->meta_description,
                    'format_date' => date_format($datecreate, ca_template_setting('date_format')),
                    'format_time' => date_format($timecreate, ca_template_setting('time_format')),
                    'this_link' => $r->permalink,
                    'num_com' => $this->mposts->get_num_comments($id)
                );
                if (is_mobile_user_agent()) {
                    $this->load->helper(array('mobile'));
                    $this->load->model(array('mwidget'));
                    $this->load->view(ca_theme_dir() . 'mindex', $m_data);
                } else {
                    $this->load->view(ca_theme_dir() . 'index', $data);
                }
            } else {
                ca_error404('sorry, there are missing parameter detail for application posts2');
            }
        } else {
            ca_error404('sorry, there are missing parameter detail for application posts1');
        }
    }

    function kanal($id = '', $offset = 0) {
        if ($id <> '') {
            $this->load->model('mcategories');
            $title = $this->mcategories->get_by_id("$id")->row()->name;
            $this->load->helper(array('twit', 'fb', 'g+', 'page', 'template', 'widget'));
            $this->load->model(array('mtemplate', 'mmenu'));
            $this->load->library(array('user_agent'));
            $data = array(
                'offset' => $offset,
                'id' => $id,
                'title' => $title,
                'rows' => $this->mposts->count_cat($id),
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->post_by_cat($id, ca_template_setting('results_per_page'), $offset),
                'count' => $this->mposts->count_cat($id),
                'meta_title' => ca_setting('meta_title'),
                'meta_keyword' => ca_setting('meta_keyword'),
                'meta_description' => ca_setting('meta_description')
            );
            (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/category' : '';
            (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/category' : '';
            (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
            (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
            (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
            (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
            $m_data = array(
                'offset' => $offset,
                'id' => $id,
                'title' => $title,
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->post_by_cat($id, ca_template_setting('results_per_page'), $offset),
                'mobile_top' => 'mobile/top',
                'mobile_center' => 'mobile/category',
                'meta_title' => ca_setting('meta_title'),
                'meta_keyword' => ca_setting('meta_keyword'),
                'meta_description' => ca_setting('meta_description'),
                'rows' => $this->mposts->count_cat($id)
            );
            if (is_mobile_user_agent()) {
                $this->load->helper(array('mobile'));
                $this->load->model(array('mwidget'));
                $this->load->view(ca_theme_dir() . 'mindex', $m_data);
            } else {
                $this->load->view(ca_theme_dir() . 'index', $data);
            }
        } else {
            ca_error404('sorry, there are missing parameter detail for application posts');
        }
    }

    function kanal_($id = '', $offset = 0) {
        $this->load->helper(array('twit', 'fb', 'g+', 'page', 'template', 'widget'));
        $this->load->model(array('mtemplate', 'mmenu'));
        $this->load->library(array('user_agent'));
        if ($id <> '') {
            $this->load->model('mcategories');
            $title = $this->mcategories->get_by_id("$id")->row()->name;
            $data = array(
                'offset' => $offset,
                'id' => $id,
                'title' => $title,
                'rows' => $this->mposts->count_cat($id),
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->post_by_cat($id, ca_template_setting('results_per_page'), $offset),
            );

            $m_data = array(
                'offset' => $offset,
                'id' => $id,
                'title' => $title,
                'mobile_top' => 'mobile/top',
                'mobile_center' => 'mobile/category',
                'rows' => $this->mposts->count_cat($id),
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->post_by_cat($id, ca_template_setting('results_per_page'), $offset),
            );

            if (is_mobile_user_agent()) {
                $this->load->helper(array('mobile'));
                $this->load->model(array('mwidget'));
                $this->load->view(ca_theme_dir() . 'mindex', $m_data);
            } else {
                $this->load->view(ca_theme_dir() . 'web/category', $data);
            }
        } else {
            ca_error404('sorry, there are missing parameter detail for application posts');
        }
    }

    function search($offset = 0) {
        $this->form_validation->set_rules('s_content', '', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $this->load->helper(array('twit', 'fb', 'g+', 'page', 'template', 'widget'));
            $this->load->model(array('mtemplate', 'mmenu'));
            $this->load->library(array('user_agent'));
            $data = array(
                'title' => 'searching on ' . ca_setting('site_name'),
                'offset' => $offset,
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->get_search(ca_template_setting('results_per_page'), $offset, '1'),
                'rows' => $this->mposts->count_search('1'),
                's_content' => ($this->input->post('s_content')) ? $this->input->post('s_content') : ''
            );
            (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/search' : '';
            (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/search' : '';
            (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
            (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
            (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
            (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';

            $m_data = array(
                'title' => 'searching on ' . ca_setting('site_name'),
                'offset' => $offset,
                'limit' => ca_template_setting('results_per_page'),
                'query' => $this->mposts->get_all(ca_template_setting('results_per_page'), $offset, '1'),
                'mobile_top' => 'mobile/top',
                'mobile_center' => 'mobile/search',
                'rows' => $this->mposts->count('1'),
                's_content' => ($this->input->post('s_content')) ? $this->input->post('s_content') : ''
            );
            if (is_mobile_user_agent()) {
                $this->load->helper(array('mobile'));
                $this->load->model(array('mwidget'));
                $this->load->view(ca_theme_dir() . 'mindex', $m_data);
            } else {
                $this->load->view(ca_theme_dir() . 'index', $data);
            }
        } else {
            $this->load->helper('js');
            ca_alert('form filed search is required and please type no special caracter');
            ca_back();
        }
    }

    function search_($s_content, $offset = 0) {
        $this->load->helper(array('twit', 'fb', 'g+', 'page', 'template', 'widget'));
        $this->load->model(array('mtemplate', 'mmenu'));
        $this->load->library(array('user_agent'));
        $_POST['s_content'] = $s_content;
        $data = array(
            'title' => 'searching on ' . ca_setting('site_name'),
            'offset' => $offset,
            'limit' => ca_template_setting('results_per_page'),
            'query' => $this->mposts->get_search(ca_template_setting('results_per_page'), $offset, '1'),
            'rows' => $this->mposts->count_search('1'),
            's_content' => $s_content
        );
        $m_data = array(
            'title' => 'searching on ' . ca_setting('site_name'),
            'offset' => $offset,
            'limit' => ca_template_setting('results_per_page'),
            'query' => $this->mposts->get_all(ca_template_setting('results_per_page'), $offset, '1'),
            'mobile_top' => 'mobile/top',
            'mobile_center' => 'mobile/search',
            'rows' => $this->mposts->count('1'),
            's_content' => $s_content
        );
        if (is_mobile_user_agent()) {
            $this->load->helper(array('mobile'));
            $this->load->model(array('mwidget'));
            $this->load->view(ca_theme_dir() . 'mindex', $m_data);
        } else {
            $this->load->view(ca_theme_dir() . 'web/search', $data);
        }
    }

}

?>