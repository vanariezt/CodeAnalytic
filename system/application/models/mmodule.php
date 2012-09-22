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
 * mmodule Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mmodule
 */
class mmodule extends Model {

    /**
     * define table name
     * @var type 
     */
    var $table = "ca_module";

    function __construct() {
        parent::__construct();
    }  
    function get($p = '0') {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id <> id_parent and id_parent = '0'");
        if ($p <> '0') {
            $this->db->where("publish", "$p");
        }
        $this->db->order_by("order", "asc");
        return $this->db->get();
    }

    function get_child($id, $p = '') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("(id_parent = '$id')");
        if ($p <> '') {
            $this->db->where("publish", "$p");
        }
        return $this->db->get();
    }

}

/**
 * end of class mmodule.phpS
 * Location: system/application/models/mmodule.php
 */
?>
