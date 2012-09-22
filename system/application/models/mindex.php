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
 * mindex Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mindex
 */ 

class mindex extends Model {

    var $table = "ca_posts";

    function __construct() {
        parent::__construct();
    }

    function get_all($id, $limit, $offset) {
        $this->db->select("p.title, p.id as id, c.name as category,p.meta_keyword as meta,p.permalink, p.link, p.is_show_thumb, p.content,u.username, p.img, p.user_id, p.date, p.publish, p.view");
        $this->db->from("$this->table as p , ca_categories as c, ca_users as u");
        $this->db->where("p.cat_id = c.id");
        $this->db->where("p.cat_id = '$id'");
        $this->db->where("p.user_id = u.user_id");
        $this->db->where("p.publish = '1'");
        if ($this->input->post('s_from') <> '') {
            $s_from = date_format(date_create($this->input->post('s_from')), 'Y-m-d');
        }
        if ($this->input->post('s_to') <> '') {
            $s_to = date_format(date_create($this->input->post('s_to')), 'Y-m-d');
        }
        ($this->input->post('s_from') && $this->input->post('s_to') == '') ? $this->db->like('date', $s_from, 'after') : '';
        ($this->input->post('s_from') && $this->input->post('s_to')) ? $this->db->where("date BETWEEN DATE('$s_from') AND DATE('$s_to')") : '';
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function get_cat() {
        return $this->db->query("
            SELECT
                *
            FROM
                ca_categories
            ");
    }

    function count($id) {
        $this->db->from("$this->table as p , ca_categories as c");
        $this->db->where("p.cat_id = c.id");
        $this->db->where("p.cat_id = '$id'");
        $this->db->where("p.publish = '1'");
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

}

/**
 * end of class mindex.php
 * Location: system/application/models/mindex.php
 */
?>
