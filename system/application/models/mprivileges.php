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
 * mprivileges Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mprivileges
 */
class mprivileges extends Model {

    var $table = "ca_privileges";

    function __construct() {
        parent::__construct();
    }

    function get_by_id($id) {
        if (isSuperAdmin()) {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where("priv_id", $id);
            return $this->db->get()->row();
        }
    }

    function get_all() {
        if (isSuperAdmin()) {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->order_by('priv_id', 'asc');
            return $this->db->get()->result();
        }
    }

    function count() {
        if (isSuperAdmin()) {
            $this->db->select('*');
            $this->db->from($this->table);
            return $this->db->get()->num_rows();
        }
    }

    function update($id, $data) {
        if (isSuperAdmin()) {
            $this->db->where('priv_id', $id);
            $this->db->update($this->table, $data);
        }
    }

}

/**
 * end of class mprivileges.php
 * Location: system/application/models/mprivileges.php
 */
?>
