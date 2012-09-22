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
 * malbum Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/maalbum
 */ 

class malbum extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = 'ca_album';
    
    /**
     * function constructor 
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * 
     * @param type $id
     * @return type 
     */
    function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    /**
     *
     * @return type 
     */
    function get() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('publish', '1');
        $this->db->order_by('order', 'order');
        return $this->db->get();
    }
    /**
     *
     * @param type $limit
     * @param type $offset
     * @return type 
     */
    function get_all($limit, $offset) {
        if (isUser()) {
            $this->db->select('*');
            $this->db->from($this->table);
            ($this->input->post('s_name')) ? $this->db->like('name', $this->input->post('s_name')) : '';
            ($this->input->post('s_description')) ? $this->input->post('s_description') : '';
            ($this->input->post('s_order') && $this->input->post('s_by')) ? $this->db->order_by($this->input->post('s_order'), $this->input->post('s_by')) : $this->db->order_by('order', 'asc');
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }
    /**
     * 
     * @return type 
     */
    function count() {
        if (isUser()) {
            $this->db->select('*');
            $this->db->from($this->table);
            ($this->input->post('s_name')) ? $this->db->like('name', $this->input->post('s_name')) : '';
            $data['s_description'] = ($this->input->post('s_description')) ? $this->input->post('s_description') : '';
            return $this->db->get()->num_rows();
        }
    }
    /**
     *
     * @param type $id 
     */
    function delete($id) {
        if (isUser()) {
            $this->db->delete('ca_gallery', array('album_id' => $id));
            $this->db->delete($this->table, array('id' => $id));
        }
    }
    /**
     *
     * @param type $data 
     */
    function insert($data) {
        if (isUser()) {
            $this->db->insert($this->table, $data);
        }
    }
    /**
     *
     * @param type $id
     * @param type $data 
     */
    function update($id, $data) {
        if (isUser()) {
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
        }
    }

}
/**
 * end of class madd_ons.php
 * Location: system/application/models/malbum.php
 */
?>
