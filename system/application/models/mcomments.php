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
 * mcomments Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mcomments
 */ 

class mcomments extends Model {

    /**
     * define table used
     * @var type 
     */
    var $table = "ca_comments";

    /**
     * model constructor 
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
        if (isUser()) {
            $this->db->select("c.*,m.username, m.email");
            $this->db->from("ca_comments as c , ca_members as m");
            ($this->input->post("s_username")) ? $this->db->like("m.username", $this->input->post("s_username")) : "";
            ($this->input->post("s_content")) ? $this->db->like("c.content", $this->input->post("s_content")) : "";
            ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("c.order", "asc");
            $this->db->where("c.member_id = m.id");
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
            $this->db->select("m.id");
            $this->db->from("ca_comments as c , ca_members as m");
            ($this->input->post("s_username")) ? $this->db->like("m.username", $this->input->post("s_username")) : "";
            ($this->input->post("s_content")) ? $this->db->like("c.content", $this->input->post("s_content")) : "";
            $this->db->where("c.member_id = m.id");
            return $this->db->get()->num_rows();
        }
    }

    /**
     *
     * @param type $id 
     */
    function delete($id) { 
            $this->db->delete($this->table, array('id' => $id)); 
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
     * @param type $id
     * @param type $data 
     */
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
 
     function get_comments($id,$limit) {
        return $this->db->query("
                SELECT
                    c .*,
                    m.username,
                    m.email, 
                    m.photo, 
                    m.id as member_id 
                FROM 
                    ca_comments as c ,
                    ca_members as m 
                WHERE 
                    c.id_posts='$id' 
                    AND m.id=c.member_id 
                    AND c.publish='1' 
                ORDER BY 
                    c.id DESC
                LIMIT $limit")->result();
    }
}
/**
 * end of class mcomments.php
 * Location: system/application/models/mcomments.php
 */
?>
