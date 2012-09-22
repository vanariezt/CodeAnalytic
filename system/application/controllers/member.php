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
 * member Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/member
 */
class member extends Controller {

    var $limit = 20;
    var $langfile = 'ca/member';

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
        $this->load->helper(array('form', 'lang', 'session', 'log', 'app', 'template'));
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('mmember', 'mtemplate'));
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
            $data['rows'] = $this->mmember->count();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("member/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['result'] = $this->mmember->get_all($limit, $offset)->result();


            $data['s_username'] = ($this->input->post("s_username")) ? $this->input->post("s_username") : "";
            $data['s_email'] = ($this->input->post("s_email")) ? $this->input->post("s_email") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";
            /**
             * add logs 
             */
            ca_userLogs('view', 'Member');
            $this->load->view("member_index", $data);
        } else {
            ca_error_auth('view', 'member');
        }
    }

    function login() {
        $this->load->helper(array('template'));
        $this->load->model(array('mtemplate'));
        $this->load->view(ca_theme_dir() . 'web/member/login');
    }

    function do_login() {
        $uri = $this->input->post("uri");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        if ($this->mmember->check($email, $password)) {
            echo '1';
        } else {
            echo "0";
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    function register() {
        $this->load->helper(array('template', 'widget'));
        $this->load->model(array('mtemplate', 'mmenu'));
        $this->load->view(ca_theme_dir() . "web/member/register");
    }

    function account() {
        $data['member_id'] = $this->session->userdata("member_id");
        if ($data['member_id'] <> '') {
            $this->load->helper(array('template', 'widget', 'fb', 'twit', 'page', 'js'));
            $this->load->model(array('mtemplate', 'mmenu',));
            $data['m'] = $this->mmember->get_by_id($data['member_id'])->row();
            $data['title'] = "member account (" . $data['m']->username . ") di " . ca_setting("site_name");
            $data['meta_keyword'] = "account member in " . ca_setting('site_name');
            $data['meta_title'] = "account member in " . ca_setting('site_name');
            $data['meta_description'] = "account member in " . ca_setting('site_name');
            $data['column_full'] = 'web/member/detail';
            (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
            (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
            (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
            (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';

            $this->load->view(ca_theme_dir() . 'index', $data);
        } else {
            ca_error_auth('account', 'member');
        }
    }

    function general() {
        $data['member_id'] = $this->session->userdata("member_id");
        if ($data['member_id'] <> '') {
            $data['m'] = $this->mmember->get_by_id($data['member_id'])->row();
            $this->load->view(ca_theme_dir() . 'web/member/general', $data);
        }
    }

    function info($id) {
        if ($id <> '') {
            $this->load->helper(array('template', 'widget', 'fb', 'twit', 'page', 'js'));
            $this->load->model(array('mtemplate', 'mmenu',));
            $data['m'] = $this->mmember->get_by_id($id)->row();
            $data['title'] = "Member Account (" . $data['m']->username . ") di " . ca_setting("site_name");
            $data['column_full'] = 'web/member/info';
            (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
            (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
            (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
            (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
            $this->load->view(ca_theme_dir() . 'index', $data);
        } else {
            ca_error404("page not found");
        }
    }

    function forgot() {
        if ($this->session->userdata('member_id') == '') {
            $this->load->helper(array('template', 'widget', 'fb', 'twit', 'page'));
            $this->load->model(array('mtemplate', 'mmenu',));

            $data['column_full'] = 'web/member/forgot';
            (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
            (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
            (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
            (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';

            $data['title'] = 'Forgot Password';

            $this->load->view(ca_theme_dir() . 'index', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function recovery_password() {
        $this->load->helper(array('template', 'widget', 'fb', 'twit', 'page'));
        $this->load->model(array('mtemplate', 'mmenu', 'mwidget'));
        $password = random_string('alnum');
        $email = $this->input->post("email");
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $query = $this->db->get_where("ca_members", array('email' => $email));
            if ($query->num_rows() > 0) {
                $ndata = array("password" => md5($password));
                $this->db->where('email', $email);
                $this->db->update("ca_members", $ndata);
                if (ca_check_connection()) {
                    $to = $email;
                    $message = ca_get_content_text(BASEPATH . 'email/forgot_password.txt') . "<br/>";
                    $message.= "Your new password is $password ";
                    ca_send_email(ca_setting('site_email'), ca_setting('site_name'), $to, 'recovery password in ' . ca_setting('site_name'), $message);
                }

                $data['message'] = "Congrulation!!!!! password was send to your email";

                $data['column_full'] = 'web/member/forgot';
                (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
                (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
                (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
                (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';

                $data['title'] = 'Forgot Password';

                $this->load->view(ca_theme_dir() . 'index', $data);
            } else {
                $data['message'] = "Email is not available";
                $data['column_full'] = 'web/member/forgot';
                (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
                (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
                (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
                (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';

                $data['title'] = 'Forgot Password';

                $this->load->view(ca_theme_dir() . 'index', $data);
            }
        } else {
            $this->lang->index('email');
            $this->forgot();
        }
    }

    function do_register() {
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $uri = $this->input->post("uri");
        $data = array(
            "id" => random_string('alnum', 10),
            "username" => $username,
            "email" => $email,
            "password" => md5($password)
        );
        $this->mmember->insert($data);
        $to = $this->input->post("email");
        $message = ca_get_content_text(BASEPATH . 'email/registration.txt') . "<br/>";
        ca_send_email(ca_setting('site_email'), ca_setting('site_name'), $email, "Registration Member In " . ca_setting('site_name'), $message);
    }

    function cek_username_avilable() {
        $username = $this->input->post("username");
        echo $this->mmember->cek_username_avilable($username);
    }

    function cek_email_avilable() {
        $email = $this->input->post("email");
        echo $this->mmember->cek_email_avilable($email);
    }

    function delete() {
        if (isUser() && isDelete()) {
            $data['url'] = "member/do_delete";
            $this->load->view("index_delete", $data);
        } else {
            ca_error_auth('delete', 'member');
        }
    }

    function do_delete() {
        if (isUser() && isDelete()) {
            $uploaddir = './assets/images/member/'; 
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) { 
                $r = $this->mmember->get_by_id($id[$i])->row();
                $photo = $r->photo;
                $sphoto = str_replace('_ca_thumb_middle', '_ca_thumb_small', $photo);
                if ($photo <> 'default_ca_thumb_middle.jpg' && $photo <> 'default_ca_thumb_small.jpg') {
                    if (is_file($uploaddir . $photo)) {
                        unlink($uploaddir . $photo);
                    }
                    if (is_file($uploaddir . $sphoto)) {
                        unlink($uploaddir . $sphoto);
                    }
                }
                $this->mmember->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
        } else {
            ca_error_auth('delete', 'member');
        }
    }

    function cek_old_password() {
        $id = $this->session->userdata("member_id");
        if ($id <> '') {
            $old = $this->input->post("old");
            $password = $this->mmember->get_by_id($this->session->userdata("member_id"))->row()->password;
            if (md5($old) == $password) {
                echo "1";
            } else {
                echo "0";
            }
        } else {
            ca_error404("page not found");
        }
    }

    function change_password() {
        $id = $this->session->userdata("member_id");
        if ($id <> '') {
            $this->load->view(ca_theme_dir() . 'web/member/password');
        } else {
            ca_error404("page not found");
        }
    }

    function change_profile() {
        $id = $this->session->userdata("member_id");
        if ($id <> '') {
            $this->load->helper(array('fb', 'twit', 'page'));
            $row = $this->mmember->get_by_id($id)->row();

            $data['default']['username'] = $row->username;
            $data['default']['email'] = $row->email;
            $data['default']['first_name'] = $row->first_name;
            $data['default']['last_name'] = $row->last_name;
            $data['default']['born'] = $row->born;
            $data['default']['address'] = $row->address;
            $data['default']['phone'] = $row->phone;
            $data['default']['about'] = $row->about;
            $this->load->view(ca_theme_dir() . 'web/member/profile', $data);
        } else {
            ca_error404("page not found");
        }
    }

    function do_change_profile() {
        $id = $this->session->userdata("member_id");
        if ($id <> '') {
            $this->load->helper(array('fb', 'twit', 'page'));
            $data['username'] = $this->input->post("username");
            $data['first_name'] = $this->input->post("first_name");
            $data['last_name'] = $this->input->post("last_name");
            $data['email'] = $this->input->post("email");
            $data['born'] = $this->input->post("born");
            $data['address'] = $this->input->post("address");
            $data['phone'] = $this->input->post("phone");
            $data['about'] = $this->input->post("about");
            $this->mmember->update($this->session->userdata("member_id"), $data);
        } else {
            ca_error404("page not found");
        }
    }

    function do_change_password() {
        $id = $this->session->userdata("member_id");
        if ($id <> '') {
            $password = $this->input->post("password");
            $data['password'] = md5($password);
            $this->mmember->update($this->session->userdata("member_id"), $data);
        } else {
            ca_error404("page not found");
        }
    }

    function order() {
        if (isUser() && isUpdate()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->mmember->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
        } else {
            ca_error404("page not found");
        }
    }

    function publish($id, $text) {
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
            $this->mmember->update($id, $data);
            if ($text == "1") {
                $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('member/publish/$id/0',this)>&nbsp;</a>";
            } else {
                $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('member/publish/$id/1',this)>&nbsp;</a>";
            }
            echo $txt_show;
        } else {
            ca_error404("page not found");
        }
    }

    function find() {
        if (isUser()) {
            $data['action_form'] = 'member/index';
            $this->load->view("member_find", $data);
        } else {
            ca_error404("page not found");
        }
    }

    function upload() {
        if ($this->session->userdata("member_id") <> '') {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/member/';
            $file = $_FILES['userfile'];
            $uploadfile = $uploaddir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                switch ($file['type']) {
                    case 'image/jpeg':
                        $t = 'jpg';
                        break;
                    case 'image/jpg':
                        $t = 'jpg';
                        break;
                    case 'image/gif':
                        $t = 'gif';
                        break;
                    case 'image/png':
                        $t = 'png';
                        break;
                    default:
                        break;
                }
                $new_name = time();
                rename($uploadfile, $uploaddir . $new_name . ".$t");
                $this->image_thumb_middle($new_name . ".$t");
                $thumb_name = $new_name . '_ca_thumb_middle.' . $t;
                if (is_file($uploaddir . $new_name . ".$t")) {
                    unlink($uploaddir . $new_name . ".$t");
                }
                $id = $this->session->userdata("member_id");
                $r = $this->mmember->get_by_id($id)->row();
                $photo = $r->photo;
                $sphoto = str_replace('_ca_thumb_middle', '_ca_thumb_small', $photo);
                if ($photo <> 'default_ca_thumb_middle.jpg' && $photo <> 'default_ca_thumb_small.jpg') {
                    if (is_file($uploaddir . $photo)) {
                        unlink($uploaddir . $photo);
                    }
                    if (is_file($uploaddir . $sphoto)) {
                        unlink($uploaddir . $sphoto);
                    }
                }
                $this->mmember->update($id, array("photo" => $thumb_name));
                echo $thumb_name;
                /**
                 * add logs 
                 */
                ca_userLogs('upload image profile', 'User');
            } else {
                ca_userLogs('failed upload image profile', 'user');
            }
        } else {
            ca_userLogs('failed upload image profile', 'user');
        }
    }

    function image_thumb_middle($new_name) {
        if ($this->session->userdata("member_id") <> '') {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/member/';
            $conf_middle = $this->media_auth->set_thumb_middle($uploaddir, $new_name);
            $this->load->library('image_lib', $conf_middle);
            $this->image_lib->resize();
            if ($this->image_lib->resize()) {
                ca_userLogs('success resize image profile to middle', 'User');
            } else {
                ca_userLogs('failed resize image profile to middle', 'User');
            }
        } else {
            ca_error_auth_auth('create thumb', 'user');
        }
    }

    function image_thumb_small($image) {
        if ($this->session->userdata("member_id") <> '') {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/member/';
            $conf_small = $this->media_auth->set_thumb_small($uploaddir, $image);
            $this->load->library('image_lib', $conf_small);
            if ($this->image_lib->resize()) {
                ca_userLogs('success resize image profile to small', 'User');
                $t = explode('.', $image);
                $n = str_replace('_ca_thumb_middle', '', $t['0']);
                rename($uploaddir . $t['0'] . '_ca_thumb_small.' . $t['1'], $uploaddir . $n . '_ca_thumb_small.' . $t['1']);
                echo $n . '_ca_thumb_small.' . $t['1'];
            } else {
                ca_userLogs('failed resize image profile to small', 'User');
            }
        } else {
            ca_error_auth_auth('create thumb', 'user');
        }
    }

}

?>