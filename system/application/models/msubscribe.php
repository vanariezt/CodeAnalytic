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
 * msubscribe Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/msubscribe
 */
class msubscribe extends Model { 
    /**
     * define table name
     * @var type 
     */
    var $table = "ca_subscribe";
 
    function __construct() {
        parent::__construct();
    }

    function get() {
        $this->db->select("*");
        $this->db->from($this->table); 
        return $this->db->get();
    }  
    function get_by_id($email) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("email", $email);
        return $this->db->get();
    } 
    function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    } 
    function insert($data) {
        $this->db->insert($this->table, $data);
    }  

}

/**
 * end of class msubscribe.php
 * Location: system/application/models/msubscribe.php
 */
?>
