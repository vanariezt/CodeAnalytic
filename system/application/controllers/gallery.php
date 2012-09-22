<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

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
 * gallery Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/gallery
 */
class Gallery extends Controller {

    var $limit=20;
    /**
     * define file translation 
     */
    var $langfile = 'ca/gallery';

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
        $this->load->model(array('mgallery', 'malbum'));
    }

    function index($id = '0') {
        $this->load->helper(array('twit', 'fb', 'g+', 'page', 'smiley', 'template', 'widget'));
        $this->load->model(array('mtemplate', 'mmenu'));
        $this->load->library(array('table', 'user_agent'));
        if ($id <> '0') {
            $link = 'gallery/index/' . $id;
            $tt = 'Gallery | ' . $this->mgallery->get_album_name($id)->row()->name;
            $id = $this->mgallery->get_album_name($id)->row()->id;
        } else {
            $link = 'gallery';
            $tt = 'Gallery';
        }
        $data = array(
            'title' => $tt,
            'cat' => $this->mgallery->get_album()->result(),
            'count_cat' => $this->mgallery->get_album()->num_rows(),
            'meta_title' => 'Gallery In ' . ca_setting('site_name'),
            'meta_keyword' => 'Gallery,' . ca_setting('site_name') . ',Album',
            'meta_description' => 'All Gallery In ' . ca_setting('site_name'),
        );
        (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/gallery' : ''; 
        (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/gallery' : '';
        (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
        (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
        (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
        (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
        $m_data = array(
            'title' => $tt,
            'query' => $this->mgallery->get_by_cat($id),
            'mobile_center' => 'mobile/gallery',
            'meta_title' => 'Gallery In ' . ca_setting('site_name'),
            'meta_keyword' => 'Gallery,' . ca_setting('site_name') . ',Album',
            'meta_description' => 'All Gallery In ' . ca_setting('site_name')
        );
        if (is_mobile_user_agent()) {            
            $this->load->helper(array('mobile'));
            $this->load->model(array('mwidget'));
            $this->load->view(ca_theme_dir() . 'mindex', $m_data);
        } else {
            $this->load->view(ca_theme_dir() . 'index', $data);
        }
    }

    function album($id = '0') {
        $this->load->helper(array('twit', 'fb', 'g+', 'page','smiley','template','widget'));
        $this->load->model(array('mtemplate','mmenu'));
        $this->load->library(array('table','user_agent')); 
        if ($id <> '0') {
            $link = 'gallery/index/' . $id;
            $tt = 'Gallery | ' . $this->mgallery->get_album_name($id)->row()->name;
            $id = $this->mgallery->get_album_name($id)->row()->id;
        } else {
            $link = 'gallery';
            $tt = 'All Gallery In ' . ca_setting('site_name');
        }
        $data = array(
            'title' => $tt,
            'query' => $this->mgallery->get_by_cat($id),
            'cat' => $this->mgallery->get_album()->result(),
            'count_cat' => $this->mgallery->get_album()->num_rows(),
            'link' => $link,
            'selected' => $id,
            'meta_title' => 'Gallery In ' . ca_setting('site_name'),
            'meta_keyword' => 'Gallery,' . ca_setting('site_name') . ',Album',
            'meta_description' => 'All Gallery In ' . ca_setting('site_name'),
        );
        (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/album' : '';
        (ca_template_setting('column_timeline') == 'TRUE') ? $data['column_timeline'] = 'web/column_timeline' : '';
        (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/album' : '';
        (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
        (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
        (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
        (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
        $m_data = array(
            'title' => $tt,
            'query' => $this->mgallery->get_by_cat($id),
            'mobile_center' => 'mobile/gallery',
            'meta_title' => 'Gallery In ' . ca_setting('site_name'),
            'meta_keyword' => 'Gallery,' . ca_setting('site_name') . ',Album',
            'meta_description' => 'All Gallery In ' . ca_setting('site_name')
        );
        if (is_mobile_user_agent()) {
            $this->load->helper(array('mobile'));
            $this->load->model(array('mwidget'));
            $this->load->view(ca_theme_dir() . 'mindex', $m_data);
        } else {
            $this->load->view(ca_theme_dir() . 'index', $data);
        }
    }

    function data($offset = 0) {
        if (isUser()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            $data['rows'] = $this->mgallery->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url('gallery/data/');
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();
            $data['result'] = $this->mgallery->get_all($limit, $offset)->result();
            $data['s_title'] = ($this->input->post('s_title')) ? $this->input->post('s_title') : '';
            $data['s_album'] = ($this->input->post('s_album')) ? $this->input->post('s_album') : '';
            $data['s_description'] = ($this->input->post('s_description')) ? $this->input->post('s_description') : '';
            $data['s_order'] = ($this->input->post('s_order')) ? $this->input->post('s_order') : '';
            $data['s_by'] = ($this->input->post('s_by')) ? $this->input->post('s_by') : '';
            ca_userLogs('view', 'gallery');
            $this->load->view('gallery_data', $data);
        } else {
            ca_error_auth('view', 'gallery');
        }
    }

    function insert() {
        if (isUser() && isInsert()) {
            $this->load->helper('js');
            $data = array('action_form' => 'do_insert', 'type' => '1');
            $data['album'][''] = '-select album-';
            $query = $this->malbum->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $r) {
                    $data['album'][$r->id] = $r->name;
                }
            }
            $this->load->view('gallery_form', $data);
            ca_userLogs('view form input', 'Gallery');
        } else {
            ca_error_auth('insert', 'gallery');
        }
    }

    function do_insert() {
        if (isUser() && isInsert()) {
            $title = $this->input->post('title');
            $img = $this->input->post('image');
            $album_id = $this->input->post('album');
            $description = $this->input->post('description');

            $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('album', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('image', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $data = array(
                    'id' => time(),
                    'user_id' => $this->session->userdata('user_id'),
                    'title' => $title,
                    'img' => $img,
                    'date' => date('Y-m-d H:i:s'),
                    'album_id' => $album_id,
                    'description' => $description,
                    'publish' => '1',
                    'order' => '0'
                );
            } else {
                ca_error_auth('form inputan is not valid for insert data', 'gallery');
            }
            $this->mgallery->insert($data);
            ca_userLogs('insert', 'Gallery');
        } else {
            ca_error_auth('insert', 'gallery');
        }
    }

    function update() {
        if (isUser() && isUpdate()) {
            $this->load->helper('js');
            $id = $this->input->post('id');
            $data['id'] = $id['0'];
            $data = array('action_form' => 'do_update/' . $id[0]);
            $row = $this->mgallery->get_by_id($id['0']);
            $data['default']['title'] = $row->title;
            $data['default']['image'] = $row->img;
            $data['default']['album'] = $row->album_id;
            $data['default']['description'] = $row->description;
            $query = $this->malbum->get();
            $data['album'][''] = '-select album-';
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $r) {
                    $data['album'][$r->id] = $r->name;
                }
            }
            $this->load->view('gallery_form', $data);
            ca_userLogs('view form update', 'Gallery');
        } else {
            ca_error_auth('update', 'gallery');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isUser() && isUpdate()) {
                $title = $this->input->post('title');
                $thumb = $this->input->post('image');
                $album = $this->input->post('album');
                $description = $this->input->post('description');
                $this->form_validation->set_rules('title', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('description', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('album', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('image', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    $data = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'title' => $title,
                        'img' => $thumb,
                        'album_id' => $album,
                        'description' => $description
                    );
                } else {
                    ca_error_auth('form inputan is not valid for update', 'gallery');
                }
                $this->mgallery->update($id, $data);
                ca_userLogs('update', 'Gallery');
            } else {
                ca_error_auth('update', 'gallery');
            }
        } else {
            ca_error404('missing parameter');
        }
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = 'gallery/do_delete';
            $this->load->view('index_delete', $data);
            ca_userLogs('view form delete', 'Gallery');
        } else {
            ca_error_auth('delete', 'gallery');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $id = $this->input->post('id');
            for ($i = 0; $i < count($id); $i++) {
                $this->mgallery->delete($id[$i]);
                echo "tr#id_$id[$i], ";
            }
            ca_userLogs('delete', 'Gallery');
        } else {
            ca_error_auth('delete', 'gallery');
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mgallery->update($val, array('order' => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'Gallery');
        } else {
            ca_error_auth('order', 'gallery');
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
                $this->mgallery->update($id, $data);
                if ($text == '1') {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('gallery/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('gallery/publish/$id/1',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('publish', 'Gallery');
                echo $txt_show;
            } else {
                ca_error_auth('publish', 'gallery');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isUser()) {
            $this->load->helper('js');
            $query = $this->malbum->get();
            $data['s_album'][''] = '-select album-';

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $r) {
                    $data['s_album'][$r->id] = $r->name;
                }
            }
            $data['action_form'] = 'gallery/data';
            ca_userLogs('search', 'Gallery');
            $this->load->view('gallery_find', $data);
        } else {
            ca_error_auth('search', 'find');
        }
    }

}

?>