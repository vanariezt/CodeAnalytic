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
 * mgallery Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mgallery
 */ 

class mgallery extends Model {

    var $table = 'ca_gallery';

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset, $publish = '') {
        if (isUser()) {
            $this->db->select(
                    'p.id as id,
                 p.album_id as album_id,
                 p.title as title,
                 p.img as image,
                 p.date as date,
                 p.description as description,
                 p.order as orders,
                 p.publish as publish,
                 u.username as user,
                 c.name as album');
            $this->db->from(
                    'ca_gallery as p,
                 ca_users as u,
                 ca_album as c');
            $this->db->where('p.user_id = u.user_id');
            $this->db->where('p.album_id = c.id');
            ($publish) ? $this->db->where("p.publish = '$publish'") : '';
            ($this->input->post('s_title')) ? $this->db->like('title', $this->input->post('s_title')) : '';
            ($this->input->post('s_album')) ? $this->db->where('album_id', $this->input->post('s_album')) : '';
            ($this->input->post('s_description')) ? $this->db->like('description', $this->input->post('s_description')) : '';
            ($this->input->post('s_order') && $this->input->post('s_by')) ? $this->db->order_by($this->input->post('s_order'), $this->input->post('s_by')) : $this->db->order_by('p.order', 'asc');
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }

    function count($publish = '') {
        if (isUser()) {
            $this->db->select('*');
            $this->db->from($this->table);
            ($publish) ? $this->db->where("publish = '$publish'") : '';
            ($this->input->post('s_title')) ? $this->db->like('title', $this->input->post('s_title')) : '';
            ($this->input->post('s_album')) ? $this->db->where('album_id', $this->input->post('s_album')) : '';
            ($this->input->post('s_description')) ? $this->db->like('description', $this->input->post('s_description')) : '';
            return $this->db->get()->num_rows();
        }
    }

    function get_by_id($id) {
        if (isUser()) {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id', $id);
            return $this->db->get()->row();
        }
    }

    function get_detil($id, $date) {
        $this->db->select('
                p.id as id,
                p.title as title,
                p.img as image,
                p.date as date,
                p.description as description,
                p.order as orders,
                p.publish as publish,
                u.username as user,
                c.name as album');
        $this->db->from(
                'ca_gallery as p,
                ca_users as u,
                ca_album as c');
        $this->db->where('p.user_id = u.user_id');
        $this->db->where('p.album_id = c.id');
        $this->db->where('p.publish', '1');
        $this->db->where('p.id', $id);
        $this->db->where('p.date', $date);
        $this->db->order_by('p.order', 'desc');
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

    function get_album_name($id) { 
        $this->db->select('id,name');
        $this->db->from('ca_album');
        $this->db->where("id = '$id'");
        return $this->db->get();
    }
     function get_album() { 
        $this->db->select('*');
        $this->db->from('ca_album');
        $this->db->where("publish = '1'");
        return $this->db->get();
    }

    function get_by_cat($id = '0') {
        $this->db->select('g.id, g.title, g.description, g.img, a.id, a.name as album');
        $this->db->from('ca_album as a, ca_gallery as g');
        $this->db->where('g.album_id = a.id');
        if ($id <> '0') {
            $this->db->where("g.album_id = '$id'");
        }
        return $this->db->get();
    }

}
/**
 * end of class mgallery.php
 * Location: system/application/models/mgallery.php
 */
?>
