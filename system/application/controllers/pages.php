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
 * pages Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/pages
 */
class pages extends Controller {

    var $limit = 20;
    
    var $langfile ='ca/page'; 

    function __construct() {
        parent::__construct();
        /**
         * load class languange 
         * @example libraries/language
         */
        $this->load->library(array('form_validation', 'pagination'));
        $this->lang->index($this->langfile); 
        /**
         * load class helper, library and model 
         */
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app','text'));
        
        $this->load->model(array('mpages','mmenu'));
    }

    function index($offset = 0) {
        if (isUser()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;

            $data['rows'] = $this->mpages->count();
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }

            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("pages/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();
            $data['result'] = $this->mpages->get_all($limit, $offset)->result();

            $data['s_title'] = ($this->input->post('s_title')) ? $this->input->post('s_title') : '';
            $data['s_content'] = ($this->input->post('s_content')) ? $this->input->post('s_content') : '';
            $data['s_from'] = ($this->input->post('s_from')) ? $this->input->post('s_from') : '';
            $data['s_to'] = ($this->input->post('s_to')) ? $this->input->post('s_to') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';

            /**
             * add logs 
             */
            ca_userLogs('view', 'Pages');
            $this->load->view('pages_index', $data);
        } else {
            ca_error_auth('view', 'pages');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array(
                'action_form' => 'do_insert',
                'type' => '1',
                'title' => 'INSERT PAGE'
            );
            $data['default']['show_as_menu'] = '1';
            $data['default']['is_like'] = '1';
            $data['default']['is_share'] = '1';
            $data['default']['date'] = date('Y-m-d H:i:s');
            /**
             * add logs 
             */
            ca_userLogs('view form insert', 'Pages');
            $this->load->view('pages_form', $data);
        } else {
            ca_error_auth('insert', 'pages');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $i = $this->input->post('id');
            $id = $i['0'];

            $this->load->helper('js');
            $data = array(
                'action_form' => 'do_update/' . $id,
                'title' => 'UPDATE PAGE'
            );

            $row = $this->mpages->get_by_id($id)->row();

            $data['default']['title'] = $row->title;
            $data['default']['content'] = $row->content;
            $data['default']['keyword'] = $row->meta_keyword;
            $data['default']['description'] = $row->meta_description;
            $data['default']['permalink'] = $row->permalink;
            $data['default']['old_permalink'] = $row->permalink;
            $data['default']['date'] = $row->date;
            $data['default']['url'] = $row->link;
            $data['default']['show_as_menu'] = $row->show_as_menu;
            $data['default']['is_like'] = $row->is_like;
            $data['default']['is_share'] = $row->is_share;
            /**
             * add logs 
             */
            ca_userLogs('view form update', 'Pages');
            $this->load->view('pages_form', $data);
        } else {
            ca_error_auth('update', 'pages');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $title = $this->input->post('title');
            $content = ($this->input->post('content'));
            $keyword = $this->input->post('keyword');
            $description = $this->input->post('description');
            $user_id = $this->session->userdata('user_id');
            $is_like = ($this->input->post("is_like")) ? $this->input->post("is_like") : "0";
            $is_share = ($this->input->post("is_share")) ? $this->input->post("is_share") : "0";
            $show_as_menu = ($this->input->post("show_as_menu")) ? $this->input->post("show_as_menu") : "0";
            $permalink = strtolower(ca_text_replace($this->input->post('permalink'), '-'));
            $date = date_format(date_create($this->input->post('date')), 'Y-m-d H:i:s');
            $explode = explode(' ', $date);
            $date = explode('-', $explode['0']);
            $time = explode(':', $explode['1']);
            $last_id = time();
            $link = "pages/detail/$last_id/$date[0]/$date[1]/$date[2]/$time[0]/$time[1]/$time[2]";
            $this->form_validation->set_rules('keyword', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('content', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
 
                $this->load->model('mmenu');
                if ($this->form_validation->run()) {
                    $query = array(
                        'id' => $last_id,
                        'name' => $title,
                        'url' => $permalink,
                        'id_parent' => '0',
                        'target' => '_blank',
                        'attr_id' => 'm_page',
                        'attr_class' => 'm_page',
                        'publish' => "$show_as_menu",
                        'order' => '0'
                    );
                    ca_userLogs('insert', 'Menu');
                    $this->mmenu->insert($query); 
            }
            if ($this->form_validation->run()) {

                $query = array(
                    'id' => $last_id,
                    'user_id' => $user_id,
                    'title' => $title,
                    'link' => $link,
                    'show_as_menu' => $show_as_menu,
                    'date' => $this->input->post('date'),
                    'content' => ($content),
                    'meta_keyword' => $keyword,
                    'meta_description' => $description,
                    'is_like' => $is_like,
                    'is_share' => $is_share,
                    'permalink' => $permalink,
                    'publish' => '1',
                    'order' => '0'
                );
                $fname = APPPATH.'config/routes.php';
                $fcontent = file_get_contents($fname);
                $fcontent .= '$route[\'' . $permalink . '\'] = \'' . $link . '\';';
                file_put_contents($fname, $fcontent);

                ca_userLogs('insert', 'Pages');
                $this->mpages->insert($query);
            } else {
                ca_error_auth('form input is not valid', 'pages');
            }
        } else {
            ca_error_auth('insert', 'pages');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $title = $this->input->post('title');
                $content = ($this->input->post('content'));
                $keyword = $this->input->post('keyword');
                $description = $this->input->post('description');
                $user_id = $this->session->userdata('user_id');
                $url = $this->input->post('url');
                $is_like = ($this->input->post("is_like")) ? $this->input->post("is_like") : "0";
                $is_share = ($this->input->post("is_share")) ? $this->input->post("is_share") : "0";
                $permalink = strtolower(ca_text_replace($this->input->post('permalink'), '-'));
                $show_as_menu = ($this->input->post("show_as_menu")) ? $this->input->post("show_as_menu") : "0";
                $date = date_format(date_create($this->input->post('date')), 'Y-m-d H:i:s');
                $explode = explode(' ', $date);
                $date = explode('-', $explode['0']);
                $time = explode(':', $explode['1']);
                $link = "pages/detail/$id/$date[0]/$date[1]/$date[2]/$time[0]/$time[1]/$time[2]";
                $old_permalink = $this->input->post('old_permalink');
                $this->form_validation->set_rules('keyword', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('content', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
                $sam_before = $this->mmenu->get_number_page_menu($id);

                if ($sam_before == '0') {
                    $this->load->model('mmenu');
                    if ($this->form_validation->run()) {
                        $query = array(
                            'id' => $id,
                            'name' => $title,
                            'url' => $permalink,
                            'id_parent' => '0',
                            'target' => '_blank',
                            'attr_id' => 'm_page',
                            'attr_class' => 'm_page',
                            'publish' => $show_as_menu,
                            'order' => '0'
                        );
                        ca_userLogs('insert', 'Menu');
                        $this->mmenu->insert($query);
                    }
                }else{
                    $query=array("publish"=>$show_as_menu);
                    $this->mmenu->update($id,$query);
                }
                if ($this->form_validation->run()) {
                    $query = array(
                        'user_id' => $user_id,
                        'title' => $title,
                        'date' => $this->input->post('date'),
                        'content' => ($content),
                        'meta_keyword' => $keyword,
                        'meta_description' => $description,
                        'show_as_menu' => $show_as_menu,
                        'link' => $link,
                        'is_like' => $is_like,
                        'is_share' => $is_share,
                        'permalink' => $permalink
                    );

                    $fname = APPPATH.'config/routes.php';
                    $fhandle = fopen($fname, 'r');
                    $content = fread($fhandle, filesize($fname));
                    $content = str_replace('$route[\'' . $old_permalink . '\'] = \'' . $url . '\';', '$route[\'' . $permalink . '\'] = \'' . $link . '\';', $content);
                    $fhandle = fopen($fname, 'w');
                    fwrite($fhandle, $content);
                    fclose($fhandle);
                    /**
                     * add logs 
                     */
                    ca_userLogs('update', 'Pages');
                    $this->mpages->update($id, $query);
                }
            } else {
                ca_error_auth('update', 'pages');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'pages/do_delete';
            /**
             * add logs 
             */
            ca_userLogs('view from delete', 'Pages');
            $this->load->view('index_delete', $data);
        } else {
            ca_error_auth('delete', 'pages');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                $this->mpages->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
            /**
             * add logs 
             */
            ca_userLogs('delete', 'Pages');
        } else {
            ca_error_auth('delete', 'pages');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mpages->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            /**
             * add logs 
             */
            ca_userLogs('order', 'Pages');
        } else {
            ca_error_auth('order', 'pages');
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
                $this->mpages->update($id, $data);
                if ($text == "1") {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('pages/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('pages/publish/$id/1',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('publish', 'Pages');
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'pages');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $data['action_form'] = 'pages/index';
            /**
             * add logs 
             */
            ca_userLogs('search', 'Pages');
            $this->load->view('pages_find', $data);
        } else {
            ca_error_auth('search', 'pages');
        }
    }

    function detail($id = '', $y = '', $m = '', $d = '', $h = '', $i = '', $s = '') {
        if ($id <> '' && $y <> '' && $m <> '' && $d <> '' && $h <> '' && $i <> '' && $s <> '') {
            $this->load->helper(array('twit', 'fb', 'g+', 'page','template','widget'));
            $this->load->model(array('mtemplate','mmenu'));
            $this->load->library(array('table','user_agent')); 
            $date = "$y-$m-$d $h:$i:$s";
            $count = $this->mpages->get_detail($id, $date)->num_rows();
            $page = $this->mpages->get_detail($id, $date)->row();
            if ($count > 0) {
                $update = array("view" => $page->view + 1);
                $this->mpages->update($page->id, $update);
                if (ca_setting("is_format_post") == "1") {
                    $content = parse_smileys($page->content, "assets/images/smileys/");
                } else {
                    $content = $page->content;
                }
                $date = $page->date;
                $explode = explode(' ', $date);
                $date = explode('-', $explode['0']);
                $time = explode(':', $explode['1']);
                $datecreate = date_create("$date[0]-$date[1]-$date[2]");
                $timecreate = date_create("$time[0]:$time[1]:$time[2]");
                $format_date = date_format($datecreate, ca_setting('date_format'));
                $format_time = date_format($timecreate, ca_setting('time_format'));
                $link = "pages/detail/$page->id/$date[0]/$date[1]/$date[2]/$time[0]/$time[1]/$time[2]";
                $data['id'] = $id;
                $data['title'] = $page->title;
                (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/pages' : '';
                (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/pages' : '';
                (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
                (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
                (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
                (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
                $data['is_like'] = $page->is_like;
                $data['is_share'] = $page->is_share;
                $data['meta_keyword'] = $page->meta_keyword;
                $data['meta_title'] = $page->title;
                $data['meta_description'] = character_limiter($page->content, 200);
                $data['link'] = $link;
                $data['format_date'] = $format_date;
                $data['format_time'] = $format_time;
                $data['content'] = $content;
                $m_data['content'] = $content;
                $m_data['link'] = $link;
                $m_data['format_date'] = $format_date;
                $m_data['format_time'] = $format_time;
                $m_data['id'] = $id;
                $m_data['page'] = $page;
                $m_data['date'] = $date;
                $m_data['is_like'] = $page->is_like;
                $m_data['is_share'] = $page->is_share;
                $m_data['title'] = $page->title;
                $m_data['mobile_top'] = 'mobile/top';
                $m_data['mobile_center'] = 'web/pages';
                $m_data['meta_keyword'] = $page->meta_keyword;
                $m_data['meta_title'] = $page->title;
                $m_data['meta_description'] = character_limiter($page->content, 200);
                if (is_mobile_user_agent()) {
                    $this->load->helper(array('mobile'));
                    $this->load->model(array('mwidget'));
                    $this->load->view(ca_theme_dir() . 'mindex', $m_data);
                } else {
                    $this->load->view(ca_theme_dir() . 'index', $data);
                }
            } else {
                ca_error404('sorry, there are missing parameter a for application pages');
            }
        } else {
            ca_error404('sorry, there are missing parameter detail for application pages');
        }
    }

}

?>