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
 * madmpoll Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/madmpoll
 */ 

class madmpoll extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = "ca_poll";
    var $table1 = "ca_pollresult";
    var $table2 = "ca_ippoll";
    
    /**
     * function constructor 
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @param type $limit
     * @param type $offset
     * @return type 
     */
    function get_all($limit, $offset) {
        $this->db->select('*');
        $this->db->from("$this->table");
        ($this->input->post("s_content")) ? $this->db->like("question", $this->input->post("s_content")) : "";
        ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("order", "asc");
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }
    /**
     *
     * @return type 
     */
    function count() {
        $this->db->select('*');
        $this->db->from($this->table);
        ($this->input->post("s_content")) ? $this->db->like("question", $this->input->post("s_content")) : "";
        return $this->db->get()->num_rows();
    }
    /**
     *
     * @return type 
     */
    function get_last_pid() {
        $this->db->select('pid');
        $this->db->from("$this->table");
        $this->db->limit(1);
        $this->db->order_by('pid', 'desc');
        return $this->db->get()->rows()->pid;
    }
    /**
     *
     * @param type $id
     * @return type 
     */
    function get_by_id($id) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("pid = $id");
        return $this->db->get();
    }
    /**
     *
     * @param type $pid 
     */
    function delete($pid) {
        $this->db->delete($this->table, array('pid' => $pid));
        $this->db->delete("$this->table1", array('pid' => $pid));
        $this->db->delete("$this->table2", array('pid' => $pid));
    }
    /**
     *
     * @param type $data 
     */
    function insert($data) {
        $this->db->insert($this->table, $data);
    }
    /**
     *
     * @param type $data 
     */
    function insert1($data) {
        $this->db->insert($this->table1, $data);
    }
    /**
     *
     * @param type $pid
     * @param type $data 
     */
    function update($pid, $data) {
        $this->db->where('pid', $pid);
        $this->db->update($this->table, $data);
    }

}
/**
 * end of class madd_ons.php
 * Location: system/application/models/madd_ons.php
 */
?>
