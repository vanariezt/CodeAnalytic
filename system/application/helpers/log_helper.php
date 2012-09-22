<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');

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
 * log Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/log_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* |
  | Helper : ca_error_auth
  |----------------------------------------------------------------------------
  | Get error handler for missing user permission
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_error_auth')) {

    function ca_error_auth($action, $application) {
        $CA = & get_instance();
        $data['title'] = 'missing user permision';
        $data['heading'] = 'missing user permision';
        $data['message'] = "sorry, your user permission is not valid for $action data in $application";
        if (ca_setting('is_record_auth', 'logs')) {
            $date = date('Y-m-d H:i:s');
            $admin = ($CA->session->userdata('username')) ? $CA->session->userdata('username').'=>'.$_SERVER['REMOTE_ADDR'].'<=' : $_SERVER['REMOTE_ADDR'];
            $fname = BASEPATH.'logs/ca_errorAuth.txt';
            $w = ca_get_content_text($fname);
            $w.="[$date] -> [$admin] -> PHP:Warning -> [MESSAGE: " . $data['message'] . "] <br/>";
            ca_write_content_text($fname, $w);
        }
        $CA->load->view("error/error_auth", $data);
    }

}

/* |
  | Helper : ca_userLogs
  |----------------------------------------------------------------------------
  | Get history of user
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_userLogs')) {

    function ca_userLogs($action, $application) {
        if (ca_setting('is_record_user', 'logs')) {
            $CA = & get_instance();
            $date = date('Y-m-d H:i:s');
            $admin = ($CA->session->userdata('username')) ? $CA->session->userdata('username').'=>'.$_SERVER['REMOTE_ADDR'].'<=' : $_SERVER['REMOTE_ADDR'];
            $m = "$action data in $application";
            $fname = BASEPATH.'logs/ca_userLogs.txt';
            $w = ca_get_content_text($fname);
            $w.="[$date] -> [$admin] -> PHP:Info -> [MESSAGE: " . $m . "] <br/>";
            ca_write_content_text($fname, $w);
        }
    }

}
/* |
  | Helper : ca_memberLogs
  |----------------------------------------------------------------------------
  | Get log or history of member
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_memberLogs')) {

    function ca_memberLogs($m) {
        if (ca_setting('is_record_member', 'logs')) {
            $CA = & get_instance();
            $date = date('Y-m-d H:i:s');
            $admin = ($CA->session->userdata('username')) ? $CA->session->userdata('username').'=>'.$_SERVER['REMOTE_ADDR'].'<=' : $_SERVER['REMOTE_ADDR'];
            $fname = BASEPATH.'logs/ca_userLogs.txt';
            $w = ca_get_content_text($fname);
            $w.="[$date] -> [$admin] -> PHP:Info -> [MESSAGE: " . $m . "] <br/>";
            ca_write_content_text($fname, $w);
        }
    }

}
/* |
  | Helper : ca_error_404
  |----------------------------------------------------------------------------
  | Get error handler for missing url
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_error404')) {

    function ca_error404($message) {
        $CA = & get_instance();
        $data['title'] = 'page not found';
        $data['heading'] = 'page not found';
        $data['message'] = $message;
        if (ca_setting('is_record_auth', 'logs')) {
            $date = date('Y-m-d H:i:s');
            $admin = ($CA->session->userdata('username')) ? $CA->session->userdata('username').'=>'.$_SERVER['REMOTE_ADDR'].'<=' : $_SERVER['REMOTE_ADDR'];
            $fname = BASEPATH.'logs/ca_error404.txt';
            $w = ca_get_content_text($fname);
            $w.="[$date] -> [$admin] -> PHP:Warning -> [MESSAGE: " . $data['message'] . "] <br/>";
            ca_write_content_text($fname, $w);
        } 
        $CA->load->view("error/error_404", $data); 
        
    }

}

?>
