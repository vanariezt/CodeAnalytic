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
 * mposts Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mposts
 */
class mposts extends Model {

    /**
     * define table use
     * @var type 
     */
    var $table = "ca_posts";

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset, $publish = '') {
        $this->db->select("
            p.title,
            p.id as id,
            p.meta_description,
            p.cat_id,          
            p.meta_keyword as meta,
            p.permalink, 
            p.link, 
            p.is_show_thumb, 
            p.content,
            u.username,
            p.img, 
            p.user_id,
            p.date, 
            p.publish, 
            p.view");
        $this->db->from("$this->table as p");
        $this->db->join(
                "ca_categories as c", "p.cat_id = c.id", "left");
        $this->db->join(
                "ca_users as u", "p.user_id = u.user_id", "left");
        ($publish) ? $this->db->where("p.publish = '$publish'") : "";
        ($this->input->post("s_title")) ? $this->db->like("p.title", $this->input->post("s_title")) : "";
        ($this->input->post("s_cat_id")) ? $this->db->like("p.cat_id",$this->input->post("s_cat_id")) : "";
        ($this->input->post("s_content")) ? $this->db->like("content", $this->input->post("s_content")) : "";
        if ($this->input->post('s_from') <> '') {
            $s_from = date_format(date_create($this->input->post('s_from')), 'Y-m-d');
        }
        if ($this->input->post('s_to') <> '') {
            $s_to = date_format(date_create($this->input->post('s_to')), 'Y-m-d');
        }
        ($this->input->post('s_from') && $this->input->post('s_to') == '') ? $this->db->like('date', $s_from, 'after') : '';
        ($this->input->post('s_from') && $this->input->post('s_to')) ? $this->db->where("date BETWEEN DATE('$s_from') AND DATE('$s_to')") : '';
        ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("p.order", "asc");
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function count($publish = '') {
        $this->db->from("$this->table as p");
        $this->db->join(
                "ca_categories as c", "p.cat_id = c.id", "left");
        $this->db->join(
                "ca_users as u", "p.user_id = u.user_id", "left");
        ($publish) ? $this->db->where("p.publish = '$publish'") : "";
        ($this->input->post("s_title")) ? $this->db->like("title", $this->input->post("s_title")) : "";
        ($this->input->post("s_cat_id")) ? $this->db->like("p.cat_id",$this->input->post("s_cat_id")) : "";
        ($this->input->post("s_content")) ? $this->db->like("content", $this->input->post("s_content")) : "";
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

    function count_cat($id) {
        $this->db->select("id");
        $this->db->from("ca_posts"); 
        $this->db->where("cat_id LIKE'%$id%'");
        return $this->db->get()->num_rows(); 
    }

    function get_by_id($id) {
        return $this->db->query("
            SELECT 
                *
            FROM 
                $this->table
            WHERE
                id = '$id'
            ");
    }
 
    function get_permalink_cat_in($id) {
        $query = $this->db->query("SELECT permalink,name FROM ca_categories WHERE id IN($id)");
        $cat = '';
        $num = $query->num_rows();
        if ($num > 0) {
            $no = 1;
            foreach ($query->result() as $row) {
                if ($num == 1 || $no == ($num)) {
                    $cat.="<a data-ajax='false' href='".base_url()."$row->permalink'>$row->name</a>";
                } else if ($num > 1) {
                    $cat.="<a data-ajax='false' href='".base_url()."$row->permalink'>$row->name</a>,&nbsp;";
                }
                $no++;
            }
            return $cat;
        } 
        return false;
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
            $this->db->delete('ca_comments', array('id_posts' => $id));
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

    function post_by_cat($id, $limit, $offset) {
        return $this->db->query("
            SELECT
                p.id,
                p.view,
                p.title, 
                p.img,
                p.date,
                p.content, 
                u.username,
                c.name as category,
                p.meta_keyword,
                p.is_show_thumb,
                p.permalink
             FROM
                ca_posts as p 
            LEFT JOIN ca_categories as c ON p.cat_id = c.id 
            LEFT JOIN ca_users as u ON p.user_id = u.user_id
            WHERE 
                p.cat_id LIKE'%$id%' 
                AND p.publish ='1'
            ORDER BY
                p.date desc
            LIMIT $limit OFFSET $offset
            ");
    }

    function get_cat() {
        return $this->db->query("SELECT * FROM ca_categories");
    }

    function get_detail($id, $date) {
        return $this->db->query("
            SELECT
                p.id,
                p.view,
                p.meta_keyword,
                p.meta_description,
                p.title,
                p.img as image,
                p.date,
                p.is_show_thumb,
                p.content, 
                p.is_like,
                p.is_share, 
                u.username,
                p.cat_id,
                c.permalink as permalink_category,
                p.permalink
            FROM
                ca_posts as p 
            LEFT JOIN ca_categories as c ON p.cat_id = c.id 
            LEFT JOIN ca_users as u ON p.user_id = u.user_id
            WHERE                
                p.publish = '1' 
                AND p.id = '$id'
                AND p.date = '$date'
            ORDER BY p.order asc");
    }

    function get_other($id, $cat_id, $limit) {
        return $this->db->query("
            SELECT
                p.id as id,
                p.title as title, 
                p.date as date,
                p.permalink
             FROM
                ca_posts as p 
            LEFT JOIN ca_categories as c ON p.cat_id = c.id 
            LEFT JOIN ca_users as u ON p.user_id = u.user_id
            WHERE                
                p.cat_id IN($cat_id)
                AND p.id <> '$id'
                AND p.publish = '1'
           ORDER BY
                p.date asc
           LIMIT $limit
           ")->result();
    }

    function get_num_comments($id) {
        return $this->db->query("
                SELECT 
                    count(id) as count 
                FROM 
                    ca_comments 
                WHERE 
                    id_posts='$id'
                    AND publish='1'"
                )->row()->count;
    }

    function get_search($limit, $offset, $publish = '') {
        $search = $this->input->post('s_content');
        $this->db->select("
            p.title,
            p.id as id,
            c.name as category,
            p.meta_keyword as meta,
            p.permalink, 
            p.link, 
            p.is_show_thumb, 
            p.content,
            u.username, 
            p.img, 
            p.user_id, 
            p.date, 
            p.publish,
            p.view");
        $this->db->from("$this->table as p");
        $this->db->join(
                'ca_categories as c', 'c.id=p.cat_id', 'left');
        $this->db->join(
                'ca_users as u', 'u.user_id=p.user_id', 'left');
        $this->db->where("p.content LIKE '%$search%' OR p.title LIKE '%$search%' OR c.name LIKE '%$search%'");
        $this->db->where("p.publish = '$publish'");
        $this->db->order_by("p.order", "asc");
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function count_search($publish = '') {
        $search = $this->input->post('s_content');
        $this->db->from("$this->table as p");
        $this->db->join(
                'ca_categories as c', 'c.id=p.cat_id', 'left');
        $this->db->join(
                'ca_users as u', 'u.user_id=p.user_id', 'left');
        $this->db->where("p.content LIKE '%$search%' OR p.title LIKE '%$search%' OR c.name LIKE '%$search%'");
        $this->db->where("p.publish = '$publish'");
        return $this->db->get()->num_rows();
    }

}

/**
 * end of class mposts.php
 * Location: system/application/models/mposts.php
 */
?>
