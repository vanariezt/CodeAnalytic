<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
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
 * mcategories Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mcategories
 */
class mcategories extends Model {

    var $table = "ca_categories";

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        $this->db->select("*");
        $this->db->from($this->table);
        ($this->input->post("s_name")) ? $this->db->like("name", $this->input->post("s_name")) : "";
        ($this->input->post("s_keyword")) ? $this->db->like("meta_keyword", $this->input->post("s_keyword")) : "";
        ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("order", "asc");
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function count() {
        $this->db->select("*");
        $this->db->from($this->table);
        ($this->input->post("s_name")) ? $this->db->like("name", $this->input->post("s_name")) : "";
        ($this->input->post("s_keyword")) ? $this->db->like("meta_keyword", $this->input->post("s_keyword")) : "";
        return $this->db->get()->num_rows();
    }
    function widget($limit) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('publish','1');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    function count_by_id($id){ 
        $this->db->select("id");
        $this->db->from("ca_posts"); 
        $this->db->where("cat_id LIKE'%$id%'");
        return $this->db->get()->num_rows(); 
    }

    function get_by_id($id) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id", $id);
        return $this->db->get();
    }

    function delete($id) {
        $row = $this->get_by_id($id)->row();
        $fname = './system/application/config/routes.php';
        $content = file_get_contents($fname);
        $content = str_replace('$route[\'' . $row->permalink . '\'] = \'posts/kanal/' . $row->id . '\';', '', $content);
        $fhandle = fopen($fname, 'w');
        fwrite($fhandle, $content);
        fclose($fhandle);
        $this->db->delete($this->table, array('id' => $id));
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

}
/**
 * end of class mcategories.php
 * Location: system/application/models/mcategories.php
 */
?>
