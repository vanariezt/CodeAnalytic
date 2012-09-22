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
 * mpanel Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mpanel
 */
class mpanel extends Model {
    /**
     * function constructor
     * @access public 
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * function get_user_data()
     * @return type 
     * @example $this->mpanel->get_user_data();
     * @access public
     */
    function get_user_data() {
        /* check valid user */
        if (isUser()) {
            $sess_user = $this->session->userdata("user_id");
            return $this->db->query("SELECT * FROM ca_users where user_id='$sess_user'")->row();
        }
    }

}

/**
 * end of class mpanel.php
 * Location: system/application/models/mpanel.php
 */
?>

