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
 * mpages Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mpages
 */
class mpages extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = 'ca_pages';

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        if (isUser()) {
            $this->db->select('p.title, p.id as id, u.username as username, p.content, p.link,p.permalink, p.date, p.publish');
            $this->db->from("$this->table as p , ca_users as u");
            $this->db->where('p.user_id = u.user_id');
            ($this->input->post('s_title')) ? $this->db->like('title', $this->input->post('s_title')) : '';
            ($this->input->post('s_content')) ? $this->db->like('content', $this->input->post('s_content')) : '';
            if ($this->input->post('s_from') <> '') {
                $s_from = date_format(date_create($this->input->post('s_from')), 'Y-m-d');
            }
            if ($this->input->post('s_to') <> '') {
                $s_to = date_format(date_create($this->input->post('s_to')), 'Y-m-d');
            }
            ($this->input->post('s_from') && $this->input->post('s_to') == '') ? $this->db->like('date', $s_from, 'after') : '';

            ($this->input->post('s_from') && $this->input->post('s_to')) ? $this->db->where("date BETWEEN DATE('$s_from') AND DATE('$s_to')") : '';

            ($this->input->post('s_order') && $this->input->post('s_by')) ? $this->db->order_by($this->input->post('s_order'), $this->input->post('s_by')) : $this->db->order_by('p.order', 'asc');
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }

    function count() {
        $this->db->select('p.title, p.id as id, u.username as name, p.content,  p.date, p.publish');
        $this->db->from("$this->table as p , ca_users as u");
        $this->db->where('p.user_id = u.user_id');
        ($this->input->post('s_title')) ? $this->db->like('title', $this->input->post('s_title')) : '';
        ($this->input->post('s_content')) ? $this->db->like('content', $this->input->post('s_content')) : '';
        if ($this->input->post('s_from') <> '') {
            $s_from = date_format(date_create($this->input->post('s_from')), 'Y-m-d');
        }
        if ($this->input->post('s_to') <> '') {
            $s_to = date_format(date_create($this->input->post('s_to')), 'Y-m-d');
        }
        ($this->input->post('s_from') && $this->input->post('s_to') == '') ? $this->db->like('date', $s_from, 'after') : '';

        ($this->input->post('s_from') && $this->input->post('s_to')) ? $this->db->where("date BETWEEN DATE('$s_from') AND DATE('$s_to')") : '';

        return $this->db->get()->num_rows();
    }

    function get_last_id() {
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->row()->id + 1;
    }

    function get_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id = '$id'");
        return $this->db->get();
    }

    function delete($id) {
        if (isUser()) {
            $row = $this->get_by_id($id)->row();
            $fname = './system/application/config/routes.php';
            $content = file_get_contents($fname);
            $content = str_replace('$route[\'' . $row->permalink . '\'] = \'' . $row->link . '\';', '', $content);
            $fhandle = fopen($fname, 'w');
            fwrite($fhandle, $content);
            fclose($fhandle);
            $this->db->delete($this->table, array('id' => $id));
            $this->db->delete('ca_menu', array('id' => $id));
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

    function get_detail($id, $date) {
        $this->db->select('
                p.id as id,
                p.is_like,
                p.is_share,
                p.view,
                p.meta_keyword,
                p.title as title,
                p.date as date,
                p.content as content, 
                p.order as orders,
                p.publish as publish,
                u.username as user');
        $this->db->from(
                "$this->table as p,
                ca_users as u");
        $this->db->where('p.user_id = u.user_id');
        $this->db->where('p.publish', '1');
        $this->db->where('p.id', $id);
        $this->db->where('p.date', $date);
        $this->db->order_by('p.order', 'desc');
        return $this->db->get();
    }

}
/**
 * end of class mpages.php
 * Location: system/application/models/mpages.php
 */
?>
