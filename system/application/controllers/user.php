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
 * user Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/user
 */
class user extends Controller {

    var $limit = 20;
    var $langfile = 'ca/user';

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
        $this->load->model("muser");
    }

    function index($offset = 0) {
        if (isSuperAdmin()) {
            $limit = ($this->session->userdata('session_limiter')) ? $this->session->userdata('session_limiter') : $this->limit;
            $data['default']['max_show'] = $limit;
            for ($i = 1; $i < 31; $i++) {
                if ($i % 5 == 0) {
                    $data['max_show'][$i] = $i;
                }
            }
            $data['rows'] = $this->muser->count();
            $data['result'] = $this->muser->get_all($limit, $offset)->result();
            $uri_segment = 3;
            $offset = $this->uri->segment($uri_segment);
            $config['base_url'] = site_url("user/index/");
            $config['total_rows'] = $data['rows'];
            $config['per_page'] = $limit;
            $config['div'] = 'div#cen_right';
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['ca_paging'] = $this->pagination->create_links();

            $data['s_username'] = ($this->input->post("s_username")) ? $this->input->post("s_username") : "";
            $data['s_email'] = ($this->input->post("s_email")) ? $this->input->post("s_email") : "";
            $data['s_order'] = ($this->input->post("s_order")) ? $this->input->post("s_order") : "";
            $data['s_by'] = ($this->input->post("s_by")) ? $this->input->post("s_by") : "";
            ca_userLogs('view', 'User');
            $this->load->view("user_index", $data);
        } else {
            ca_error_auth_auth('view', 'user');
        }
    }

    function insert() {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $data = array(
                "action_form" => "do_insert",
                "type" => "1"
            );
            $rs = $this->muser->get_prev();
            if ($rs->num_rows() > 0) {
                $data['access'][0] = "";
                foreach ($rs->result() as $r) {
                    $data['access'][$r->priv_id] = $r->priv_name;
                }
            }
            ca_userLogs('view form input', 'User');
            $this->load->view("user_form", $data);
        } else {
            ca_error_auth_auth('insert', 'user');
        }
    }

    function update() {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $id = $this->input->post("id");
            $data = array(
                "id" => $id['0'],
                "action_form" => "do_update/$id[0]",
                "type" => '2'
            );
            $rs = $this->muser->get_prev();
            if ($rs->num_rows() > 0) {
                $data['access'][0] = "";
                foreach ($rs->result() as $r) {
                    $data['access'][$r->priv_id] = $r->priv_name;
                }
            }
            $row = $this->muser->get_by_id($id['0'])->row();

            $data['default']['username'] = $row->username;
            $data['default']['access'] = $row->priv_id;
            $data['default']['first_name'] = $row->first_name;
            $data['default']['last_name'] = $row->last_name;
            $data['default']['email'] = $row->email;

            ca_userLogs('view form update', 'User');
            $this->load->view("user_form", $data);
        } else {
            ca_('update', 'user');
        }
    }

    function manage() {
        if (isUser()) {
            $id = $this->session->userdata("user_id");
            $data = array(
                "id" => $id,
                "action_form" => "do_manage/$id",
                "type" => ""
            );
            $row = $this->muser->get_by_id($id)->row();

            $data['default']['username'] = $row->username;
            $data['default']['first_name'] = $row->first_name;
            $data['default']['last_name'] = $row->last_name;
            $data['default']['email'] = $row->email;
            ca_userLogs('view form manage account', 'User');
            $this->load->view("user_manage", $data);
        } else {
            errormedia_auth('manage', 'user');
        }
    }

    function change_photo() {
        if (isUser()) {
            $id = $this->session->userdata("user_id");
            $data['row'] = $this->muser->get_by_id($id)->row();
            ca_userLogs('view form manage photo account', 'User');
            $this->load->view("user_change_photo", $data);
        } else {
            errormedia_auth('manage', 'user');
        }
    }

    function do_insert() {
        if (isSuperAdmin()) {
            $username = $this->input->post("username");
            $email = $this->input->post("email");
            $access = $this->input->post("access");
            $password = md5($this->input->post("password"));
            $first_name = $this->input->post("first_name");
            $last_name = $this->input->post("last_name");

            $this->form_validation->set_rules('username', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('first_name', '', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', '', 'trim|required|xss_clean');
            if ($this->form_validation->run()) {
                $query = array(
                    "user_id" => time(),
                    "username" => $username,
                    "email" => $email,
                    "priv_id" => $access,
                    "password" => $password,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    'active' => '1',
                    'order' => '0'
                );
                ca_userLogs('insert', 'User');
                $this->muser->insert($query);
            } else {
                ca_error404('form validation is not valid');
            }
        } else {
            ca_error_auth_auth('insert', 'user');
        }
    }

    function do_manage($id = '') {
        if ($id <> '') {
            if (isUser()) {
                $username = $this->input->post("username");
                $email = $this->input->post("email");
                $password = $this->input->post("password");
                $first_name = $this->input->post("first_name");
                $last_name = $this->input->post("last_name");
                //cek user dan password
                if ($password <> '') {
                    $query = array(
                        "username" => $username,
                        "email" => $email,
                        "password" => md5($password),
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                    );
                } else {
                    $query = array(
                        "username" => $username,
                        "email" => $email,
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                    );                    
                } 
                ca_userLogs('manage account', 'User');
                $this->muser->update($id, $query);
            } else {
                ca_error_auth_auth('manage', 'user');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function do_update($id = '') {
        if ($id <> '') {
            if (isSuperAdmin()) {
                $username = $this->input->post("username");
                $email = $this->input->post("email");
                $access = $this->input->post("access");
                $password = $this->input->post("password");
                $first_name = $this->input->post("first_name");
                $last_name = $this->input->post("last_name");
                //cek user dan password
                $this->form_validation->set_rules('username', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('access', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('first_name', '', 'trim|required|xss_clean');
                $this->form_validation->set_rules('last_name', '', 'trim|required|xss_clean');
                if ($this->form_validation->run()) {
                    if ($password <> '') {
                        $query = array(
                            "username" => $username,
                            "email" => $email,
                            "priv_id" => $access,
                            "password" => md5($password),
                            "first_name" => $first_name,
                            "last_name" => $last_name,
                        );
                    } else {
                        $query = array(
                            "username" => $username,
                            "email" => $email,
                            "priv_id" => $access,
                            "first_name" => $first_name,
                            "last_name" => $last_name,
                        );
                    }
                    $this->muser->update($id, $query);
                    ca_userLogs('update account', 'User');
                    ca_error_auth_auth('update', 'user');
                }
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete() {
        if (isSuperAdmin()) {
            $data['url'] = "user/do_delete";
            ca_userLogs('view form delete', 'User');
            $this->load->view("index_delete", $data);
        } else {
            ca_error_auth_auth('delete', 'user');
        }
    }

    function do_delete() {
        if (isSuperAdmin()) {
            $id = $this->input->post("id");
            for ($i = 0; $i < count($id); $i++) {
                $this->muser->delete($id[$i]);
                echo "#cen_right table tr#id_$id[$i], ";
            }
            ca_userLogs('delete', 'User');
        } else {
            ca_error_auth_auth('delete', 'user');
        }
    }

    function order() {
        if (isSuperAdmin()) {
            $array = $this->input->post('id');
            $counter = 1;
            foreach ($array as $val) {
                $this->muser->update($val, array("order" => $counter));
                $counter = $counter + 1;
            }
            ca_userLogs('order', 'User');
        } else {
            ca_error_auth_auth('order', 'user');
        }
    }

    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {
                if ($text == '1') {
                    $data = array(
                        "active" => '0'
                    );
                } else {
                    $data = array(
                        "active" => '1'
                    );
                }
                $this->muser->update($id, $data);
                if ($text == "1") {
                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('user/publish/$id/0',this)>&nbsp;</a>";
                } else {
                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('user/publish/$id/1',this)>&nbsp;</a>";
                }
                ca_userLogs('publish', 'User');
                echo $txt_show;
            } else {
                ca_error_auth_auth('publish', 'user');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function find() {
        if (isSuperAdmin()) {
            $this->load->helper('js');
            $data['action_form'] = 'user/index';
            ca_userLogs('search', 'User');
            $this->load->view("user_find", $data);
        } else {
            ca_error_auth_auth('search', 'user');
        }
    }

    function upload() {
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/user/';
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
                $rename = rename($uploadfile, $uploaddir . $new_name . ".$t");
                $this->image_thumb_middle($new_name . ".$t");
                $thumb_name = $new_name . '_ca_thumb_middle.' . $t;
                if (is_file($uploaddir . $new_name . ".$t")) {
                    unlink($uploaddir . $new_name . ".$t");
                }
                $id = $this->session->userdata("user_id");
                $r = $this->muser->get_by_id($id)->row();
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
                $this->muser->update($id, array("photo" => $thumb_name));
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
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/user/';
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
        if (isUser()) {
            $this->load->library('media_auth');
            $uploaddir = './assets/images/user/';
            $conf_small = $this->media_auth->set_thumb_small($uploaddir, $image);
            $this->load->library('image_lib', $conf_small);
            if ($this->image_lib->resize()) {
                ca_userLogs('success resize image profile to small', 'User');
                $t = explode('.', $image);
                $n = str_replace('_ca_thumb_middle', '', $t['0']);
                rename($uploaddir . $t['0'] . '_ca_thumb_small.' . $t['1'], $uploaddir . $n . '_ca_thumb_small.' . $t['1']);
            } else {
                ca_userLogs('failed resize image profile to small', 'User');
            }
        } else {
            ca_error_auth_auth('create thumb', 'user');
        }
    }
    
    function forgot(){
        $this->load->helper(array('lang','log','app')); 
        $this->load->view('user_forgot');
    }
    /**
     * get recovery user password 
     */
    function recovery_password() {
        $password = random_string('alnum');
        $email = $this->input->post("email");
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        if ($this->form_validation->run()==TRUE) {
            $query = $this->db->get_where("ca_users", array('email' => $email));
            if ($query->num_rows() > 0) {
                $ndata = array("password" => md5($password));
                $this->db->where('email', $email);
                $this->db->update("ca_users", $ndata);
                echo '1';
                if (ca_check_connection()) {
                    $to = $email;
                    $message = ca_get_content_text(BASEPATH . 'email/forgot_password.txt') . "<br/>";
                    $message.= "Your new password in capanel is $password ";
                    ca_send_email(ca_setting('site_email'), ca_setting('site_name'), $to, 'recovery password in ' . ca_setting('site_name'), $message);
                } 
            } else {
                echo '0';
            }
        }  else{
            echo '0';
        }
    }

}

?>