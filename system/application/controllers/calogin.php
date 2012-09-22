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
 * calogin Class
 *
 * @package		CodeAnalytic
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/calogin
 */
class calogin extends Controller {
    /**
     * define file translation 
     */
    var $langfile ='ca/login';
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
         * load class helper 
         */
        $this->load->helper(array('form','lang','session','log','app'));
        $this->load->library(array('form_validation'));
    }

    /**
     * first function will be load
     * @access public
     */
    function index() {
        /**
         * cek validation user login in
         */
        if (isUser()) {
            redirect('capanel');
        } else {
            $data = array(
                'title' => 'Login - CodeAnalytic',
                'bottom' => 'menu_bottom'
            );
            $this->load->view("login_index", $data);
        }
    }
    /**
     * function delete session
     * @access public
     * @example  site_url('calogin/logout','logout');
     * 
     */
    function logout() { 
        ca_userLogs('logout', 'CodeAnalytic Panel');
        $this->session->sess_destroy();
        redirect('calogin', 'refresh');
    }
    /**
     * check user login, retrun true if valid user and false is unvalid user
     * @access public
     */
    function check_login() {
        $this->load->model('mlogin', '', TRUE); 
        $this->form_validation->set_rules('username', "Username", 'required|min_length[5]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('password', "Password", 'required|xss_clean');
        /**
         * using form validation 
         */
        if ($this->form_validation->run() == FALSE) {
            $data = array("title" => "Login - CodeAnalytic");
            ca_userLogs('failed login', 'CodeAnalytic Panel');
            $this->load->view("login_index", $data);
        } else {
            /**
             * if validation form is true 
             */
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->mlogin->check($username, $password) == TRUE) {
                $this->session->set_userdata("session_id", time());
                $this->session->set_flashdata('message', 'Thanks for login');
                ca_userLogs('success login', 'CodeAnalytic Panel');
                redirect('capanel');
            } else {
                $data['message'] = 'Your username or password may be wrong.  try again';
                $data['title'] = 'Login - CodeAnalytic';
                ca_userLogs('failed login', 'CodeAnalytic Panel');
                $this->load->view("login_index", $data);
            }
        }
    }

}

/* End of file calogin.php */
/* Location: ./system/application/controller/calogin.php */

?>