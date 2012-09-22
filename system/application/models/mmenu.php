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
 * mmenu Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mmenu
 */
class mmenu extends Model {
    
    /**
     * define table use
     * @var type 
     */
    var $table = 'ca_menu';

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id <> id_parent and id_parent = '0'");
        ($this->input->post('s_name')) ? $this->db->like('name', $this->input->post('s_name')) : '';
        ($this->input->post('s_order') && $this->input->post('s_by')) ? $this->db->order_by($this->input->post('s_order'), $this->input->post('s_by')) : $this->db->order_by('order', 'asc');
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function count_parent() {
        $this->db->select('*');
        $this->db->from($this->table);
        ($this->input->post('s_name')) ? $this->db->like('name', $this->input->post('s_name')) : '';
        $this->db->where("id <> id_parent and id_parent = '0'");
        return $this->db->get()->num_rows();
    }

    function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }

    function get_id($name) {
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        return $this->db->get();
    }

    function count() {
        $this->db->select('*');
        $this->db->from($this->table);
        ($this->input->post('s_name')) ? $this->db->like('name', $this->input->post('s_name')) : '';
        return $this->db->get()->num_rows();
    }
    function get_number_page_menu($id){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->num_rows();
    }
    function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function get($p = '0', $ord = 'asc') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id <> id_parent and id_parent = '0'");
        if ($p <> '0') {
            $this->db->where('publish', "$p");
        }
        $this->db->order_by('order', "$ord");
        return $this->db->get();
    }

    function get_child($id, $p = '') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("(id_parent = '$id')");
        if ($p <> '') {
            $this->db->where('publish', "$p");
        }
        return $this->db->get();
    }

}
/**
 * end of class mmenu.php
 * Location: system/application/models/mmenu.php
 */
?>
