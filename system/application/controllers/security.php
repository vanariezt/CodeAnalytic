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
 * security Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/security
 */


class security extends Controller {

    /**
     * define file translation 
     */
    var $langfile = 'ca/security';

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
    }

    function index() {
        if (isSuperAdmin()) {
            $data['ip_banned'] = ca_get_content_text(BASEPATH . 'codeanalytic/proxy' . EXT);
            $this->load->view('security_index', $data);
        } else {
            ca_error_auth('view', 'security');
        }
    }

    function ip_banned() {
        if (isSuperAdmin()) {
            $data['title'] = 'type ip banned in your website and separated with coma (,)';
            $data['ip_banned'] = ca_get_content_text(BASEPATH . 'codeanalytic/proxy' . EXT);
            $this->load->view('security_ip', $data);
        } else {
            ca_error_auth('view', 'security');
        }
    }

    function do_ip_banned() {
        if (isSuperAdmin()) {
            $ip_banned = $this->input->post('ip_banned');
            ca_write_content_text(BASEPATH . 'codeanalytic/proxy' . EXT, $ip_banned);
            ca_userLogs('banned an ip', 'security');
        } else {
            ca_error_auth('view', 'security');
        }
    }

    function do_delete() {
        $ip = $this->input->post('ip');
        $last_content = ca_get_content_text(BASEPATH . 'codeanalytic/proxy' . EXT);
        $ex = explode(',', $last_content);
        if ((count($ex) > 1) && ($ip == $ex['0'])) {
            $new_content = str_replace($ip . ',', '', $last_content);
        } else if (($ip == $ex['0']) && (count($ex) == 1)) {
            $new_content = str_replace($ip, '', $last_content);
        } else {
            $new_content = str_replace(',' . $ip, '', $last_content);
        }
        ca_write_content_text(BASEPATH . 'codeanalytic/proxy' . EXT, $new_content);
    }

}

?>
