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
 * mpolling Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mpolling
 */
class mpolling extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = "ca_poll";
    var $table1 = "ca_ippoll";
    var $table2 = "ca_pollresult";
 
    function __construct() {
        parent::__construct();
    }
 
    function get_poll_result() {
        $this->db->select("a.pid as pid,
                            a.question,
                            a.answer1 as answer1,
                            a.answer2 as answer2,
                            a.answer3 as answer3,
                            a.answer4 as answer4,
                            a.answer5 as answer5,
                            a.answer6 as answer6,
                            a.noofanswers,
                            b.answer1 as ranswer1,
                            b.answer2 as ranswer2,
                            b.answer3 as ranswer3,
                            b.answer4 as ranswer4,
                            b.answer5 as ranswer5,
                            b.answer6 as ranswer6");
        $this->db->from("$this->table as a, $this->table2 as b");
        $this->db->where("b.pid = a.pid");
        $this->db->where("publish", "1");
        return $this->db->get()->result();
    } 
    function insert_ip($data) {
        $this->db->insert($this->table1, $data);
    } 
    function cek_ip($pid, $ip) {
        $this->db->select("ip");
        $this->db->from($this->table1);
        $this->db->where("pid", "$pid");
        $this->db->where("ip", "$ip");
        return $this->db->get()->num_rows();
    } 
    function update($id, $data) {
        $this->db->where('pid', $id);
        $this->db->update($this->table2, $data);
    } 
    function get_all2() {
        $this->db->select("*");
        $this->db->from("$this->table as a, $this->table2 as b");
        $this->db->where("b.pid = a.pid");
        $this->db->where("publish", "1");
        return $this->db->get()->result();
    }

}
/**
 * end of class mpolling.php
 * Location: system/application/models/mpolling.php
 */
?>
