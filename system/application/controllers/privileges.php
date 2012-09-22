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
 * privileges Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/privileges
 */
class privileges extends Controller {

    var $limit = 5;
    var $langfile = 'ca/privileges';

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
        $this->load->helper(array('lang', 'session', 'log', 'app','text')); 
        $this->load->model("mprivileges");
    }

    function index() {
        if (isSuperAdmin()) {
            $this->load->view("privileges_index");
        } else {
            ca_error_auth('view', 'privileges');
        }
    }

    function insert($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {
                if ($text == '1') {
                    $data = array(
                        "insert" => '0'
                    );
                } else {
                    $data = array(
                        "insert" => '1'
                    );
                }
                $this->mprivileges->update($id, $data);
                if ($text == '0') {
                    $txt = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('privileges/insert/$id/1',this)>&nbsp;</a>";
                } else {
                    $txt = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('privileges/insert/$id/0',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('update insert', 'Privialges');
                echo $txt;
            } else {
                ca_error_auth('view', 'privileges');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function update($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {
                if ($text == '1') {
                    $data = array(
                        "update" => '0'
                    );
                } else {
                    $data = array(
                        "update" => '1'
                    );
                }
                $this->mprivileges->update($id, $data);
                if ($text == '0') {
                    $txt = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('privileges/update/$id/1',this)>&nbsp;</a>";
                } else {
                    $txt = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('privileges/update/$id/0',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('update', 'Privialges');
                echo $txt;
            } else {
                ca_error_auth('view', 'privileges');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function delete($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {
                if ($text == '1') {
                    $data = array(
                        "delete" => '0'
                    );
                } else {
                    $data = array(
                        "delete" => '1'
                    );
                }
                $this->mprivileges->update($id, $data);
                if ($text == '0') {
                    $txt = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('privileges/delete/$id/1',this)>&nbsp;</a>";
                } else {
                    $txt = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('privileges/delete/$id/0',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('update delete', 'Privialges');
                echo $txt;
            } else {
                ca_error_auth('view', 'privileges');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

    function publish($id = '', $text = '') {
        if ($id <> '' && $text <> '') {
            if (isSuperAdmin()) {
                if ($text == '1') {
                    $data = array(
                        "publish" => '0'
                    );
                } else {
                    $data = array(
                        "publish" => '1'
                    );
                }
                $this->mprivileges->update($id, $data);
                if ($text == '0') {
                    $txt = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('privileges/publish/$id/1',this)>&nbsp;</a>";
                } else {
                    $txt = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('privileges/publish/$id/0',this)>&nbsp;</a>";
                }
                /**
                 * add logs 
                 */
                ca_userLogs('update publish', 'Privialges');
                echo $txt;
            } else {
                ca_error_auth('view', 'privileges');
            }
        } else {
            ca_error404('missing parameter input');
        }
    }

}

?>