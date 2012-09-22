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
 * mtemplate Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mtemplate
 */
class mtemplate extends Model {
    
    /**
     * define table name
     * @var type 
     */
    var $table = "ca_template";

    function __construct() {
        parent::__construct();
    }

    function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    function get_all($limit, $offset) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($limit, $offset);
        $this->db->order_by('order', 'asc');
        return $this->db->get()->result();
    }

    function used() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("publish", "1");
        return $this->db->get()->row();
    }

    function count() {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->get()->num_rows();
    }

    function delete($id) {
        if (isSuperAdmin()) {
            $this->db->delete($this->table, array('id' => $id));
        }
    }

    function insert($data) {
        if (isSuperAdmin()) {
            $this->db->insert($this->table, $data);
        }
    }

    function update($id, $data) {
        if (isSuperAdmin()) {
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
        }
    }

}

/**
 * end of class mtemplate.php
 * Location: system/application/models/mtemplate.php
 */
?>
