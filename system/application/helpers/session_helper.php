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
 * session Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/session_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/**
 * function isSuperAdmin 
 */
if (!function_exists('isSuperAdmin')) {

    function isSuperAdmin() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("priv_id"); 
            if ($ss == '1') {
                return TRUE;
            }  
                return FALSE; 
    }

}

/* | 
 * | function : isUser()
 * |----------------------------------------------------------------------------
 * | CodeAnalytic Check User, Return Valid User
 * |----------------------------------------------------------------------------
 * | 
 */
if (!function_exists('isUser')) {

    function isUser() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("user_id"); 
        if ($ss != FALSE) {
            return TRUE;
        }
        return FALSE;
    }

}
/* | 
 * | function : isInsert()
 * |----------------------------------------------------------------------------
 * | CodeAnalytic Check User for insert data
 * |----------------------------------------------------------------------------
 * | 
 */
if (!function_exists('isInsert')) {

    function isInsert() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("priv_id");
        return $CA->db->query("SELECT `insert` FROM ca_privileges WHERE priv_id = '$ss'")->row()->insert;
    }

}

/* | 
 * | function : isUpdate()
 * |----------------------------------------------------------------------------
 * | CodeAnalytic Check User for update data
 * |----------------------------------------------------------------------------
 * | 
 */
if (!function_exists('isUpdate')) {

    function isUpdate() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("priv_id");
        $CA->db->select("update");
        $CA->db->from("ca_privileges");
        $CA->db->where("priv_id", $ss);
        return $CA->db->get()->row()->update;
    }

}
/* | 
 * | function : isDelete()
 * |----------------------------------------------------------------------------
 * | CodeAnalytic Check User for delete data
 * |----------------------------------------------------------------------------
 * | 
 */
if (!function_exists('isDelete')) {

    function isDelete() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("priv_id");
        $CA->db->select("delete");
        $CA->db->from("ca_privileges");
        $CA->db->where("priv_id", $ss);
        return $CA->db->get()->row()->delete;
    }

}
/* | 
 * | function : isPublish()
 * |----------------------------------------------------------------------------
 * | CodeAnalytic Check User for publish data
 * |----------------------------------------------------------------------------
 * | 
 */
if (!function_exists('isPublish')) {

    function isPublish() {
        $CA = & get_instance();
        $ss = $CA->session->userdata("priv_id");
        $CA->db->select("publish");
        $CA->db->from("ca_privileges");
        $CA->db->where("priv_id", $ss);
        return $CA->db->get()->row()->publish;
    }

}
?>