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
 * muser Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/muser
 */

class muser extends Model {

    var $table = "ca_users";

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        if (isSuperAdmin()) {
            $this->db->select("*");
            $this->db->from("$this->table as u, ca_privileges as p");
            ($this->input->post("s_username")) ? $this->db->like("u.username", $this->input->post("s_username")) : "";
            ($this->input->post("s_email")) ? $this->db->like("u.email", $this->input->post("s_email")) : "";
            ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("u.order", "asc");
            $this->db->where("u.priv_id = p.priv_id");
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }

    function count() {
        if (isSuperAdmin()) {
            $this->db->select("*");
            $this->db->from("$this->table as u, ca_privileges as p");
            ($this->input->post("s_username")) ? $this->db->like("u.username", $this->input->post("s_username")) : "";
            ($this->input->post("s_email")) ? $this->db->like("u.email", $this->input->post("s_email")) : "";
            $this->db->where("u.priv_id = p.priv_id");
            return $this->db->get()->num_rows();
        }
    }

    function get_by_id($id) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("user_id", $id);
        return $this->db->get();
    }

    function get_prev() {
        $this->db->select("*");
        $this->db->from("ca_privileges");
        return $this->db->get();
    }

    function delete($id) {
        if (isSuperAdmin()) {
            $this->db->delete($this->table, array('user_id' => $id));
        }
    }

    function insert($data) {
        if (isSuperAdmin()) {
            $this->db->insert($this->table, $data);
        }
    }

    function update($id, $data) {
        if (isUser()) {
            $this->db->where('user_id', $id);
            $this->db->update($this->table, $data);
        }
    }

}

/**
 * end of class muser.php
 * Location: system/application/models/muser.php
 */
?>
