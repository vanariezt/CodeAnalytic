<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
 * mwidget Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mwidget
 */
class mwidget extends Model {

    var $table = "ca_widget";

    function __construct() {
        parent::__construct();
    }

    function get_where($id) {
        $id_template = ca_theme_id();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id", "$id");
        $this->db->where("id_template", "$id_template");
        return $this->db->get();
    }

    function get_name($name, $id_template) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("name", "$name");
        $this->db->where("id_template", "$id_template");
        return $this->db->get();
    }

    function get_all($pos, $id_template = '', $type = '0') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("position", "$pos");
        $this->db->where("type", "$type");
        $this->db->where("id_template", "$id_template");
        $this->db->order_by('order', 'asc');
        return $this->db->get();
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
 * end of class mwidget.php
 * Location: system/application/models/mwidget.php
 */
?>
