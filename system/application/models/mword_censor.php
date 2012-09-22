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
 * mword_censor Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mword_censor
 */
class mword_censor extends Model {
    
    /**
     * define table name
     * @var type 
     */
    var $table = 'ca_word_censor';

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        if (isUser()) {
            $this->db->select('*');
            $this->db->from($this->table);
            ($this->input->post('s_word')) ? $this->db->like('word', $this->input->post('s_word')) : '';
            ($this->input->post('s_order') && $this->input->post('s_by')) ? $this->db->order_by($this->input->post('s_order'), $this->input->post('s_by')) : $this->db->order_by('order', 'asc');
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }

    function count() {
        $this->db->select('*');
        $this->db->from($this->table);
        ($this->input->post('s_title')) ? $this->db->like('title', $this->input->post('s_title')) : '';
        return $this->db->get()->num_rows();
    }

    function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }

    function delete($id) {
        if (isUser()) {
            $this->db->delete($this->table, array('id' => $id));
        }
    }

    function insert($data) {
        if (isUser()) {
            $this->db->insert($this->table, $data);
        }
    }

    function update($id, $data) {
        if (isUser()) {
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
        }
    }

}

/**
 * end of class mprivileges.php
 * Location: system/application/models/mword_censor.php
 */
?>
