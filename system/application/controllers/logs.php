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
 * logs Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/logs
 */

class logs extends Controller {

     /**
     * define file translation 
     */
    var $langfile = 'ca/logs';

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
        $this->load->helper(array('session', 'log','lang','app')); 
    }

    function index() {
        if (isSuperAdmin()) {
            $data['e404'] = $this->error404();
            $data['eAuth'] = $this->errorAuth();
            $data['uLogs'] = $this->userLogs();
            $data['mLogs'] = $this->memberLogs();

            $this->load->view("logs_index", $data);
        } else {
            ca_error_auth('view', 'logs');
        }
    }

    function error404($m = 'off') {
        if (isSuperAdmin()) {
            $fe404 = BASEPATH.'logs/ca_error404.txt';
            $fhandle404 = fopen($fe404, 'r');
            if ($m == 'off') {
                return fread($fhandle404, filesize($fe404));
            } else {
                echo fread($fhandle404, filesize($fe404));
            }
        } else {
            ca_error_auth('view', 'logs');
        }
    }

    function errorAuth($m = 'off') {
        if (isSuperAdmin()) {
            $feAuth = BASEPATH.'logs/ca_errorAuth.txt';
            $fhandleAuth = fopen($feAuth, 'r');
            if ($m == 'off') {
                return fread($fhandleAuth, filesize($feAuth));
            } else {
                echo fread($fhandleAuth, filesize($feAuth));
            }
        } else {
            ca_error_auth('view', 'logs');
        }
    }

    function userLogs($m = 'off') {
        if (isSuperAdmin()) {
            $fu = BASEPATH.'logs/ca_userLogs.txt';
            $fhu = fopen($fu, 'r');
            if ($m == 'off') {
                return fread($fhu, filesize($fu));
            } else {
                echo fread($fhu, filesize($fu));
            }
        } else {
            ca_error_auth('view', 'logs');
        }
    }

    function memberLogs($m = 'off') {
        if (isSuperAdmin()) {
            $fm = BASEPATH.'logs/ca_memberLogs.txt';
            $fhm = fopen($fm, 'r');
            if ($m == 'off') {
                return fread($fhm, filesize($fm));
            } else {
                echo fread($fhm, filesize($fm));
            }
        } else {
            ca_error_auth('view', 'logs');
        }
    }

    function clear($method = '') {
        if ($method <> '') {
            if (isSuperAdmin()) {
                switch ($method) {
                    case '404':
                        $file_name = 'ca_error404';
                        $content = '/** error 404 page not found <br/>';
                        break;
                    case 'auth':
                        $file_name = 'ca_errorAuth';
                        $content = '/** error Authentification  user <br/>';
                        break;
                    case 'user':
                        $file_name = 'ca_userLogs';
                        $content = '/** all activity ,, history of user <br/>';
                        break;
                    case 'member':
                        $file_name = 'ca_memberLogs';
                        $content = '/** all activity ,, history of member <br/>';
                        break;
                    default:
                        break;
                }
                $fname = BASEPATH."logs/$file_name.txt";
                $w = ca_get_content_text($fname);
                ca_write_content_text($fname, $content);
            } else {
                ca_error_auth('view', 'logs');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

}

?>
