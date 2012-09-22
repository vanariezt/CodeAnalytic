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
 * mmember Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mmember
 */
class mmember extends Model {

    var $table = "ca_members";

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $offset) {
        $this->db->select("*");
        $this->db->from($this->table);
        ($this->input->post("s_username")) ? $this->db->like("username", $this->input->post("s_username")) : "";
        ($this->input->post("s_email")) ? $this->db->like("email", $this->input->post("s_email")) : "";
        ($this->input->post("s_order") && $this->input->post("s_by")) ? $this->db->order_by($this->input->post("s_order"), $this->input->post("s_by")) : $this->db->order_by("order", "asc");
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function count() {
        $this->db->select("*");
        $this->db->from($this->table);
        ($this->input->post("s_username")) ? $this->db->like("username", $this->input->post("s_username")) : "";
        ($this->input->post("s_email")) ? $this->db->like("email", $this->input->post("s_email")) : "";
        return $this->db->get()->num_rows();
    }

    function get_by_id($id) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id = '$id'");
        return $this->db->get();
    }

    function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
        $this->db->delete('ca_shoutbox', array('member_id' => $id));
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function check($email, $password) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("email", $email);
        $this->db->where("password", md5($password));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $this->session->set_userdata('session_limiter', "5");
            $this->session->set_userdata("member_id", $data->id); 
            $id = $this->session->userdata("member_id");
            $data_user =
                    array(
                        "last_login" => date("Y-m-d H:i:s")
            );
            $this->db->where('id', $id);
            $this->db->update("ca_members", $data_user);

            $statistic =
                    array(
                        "member_id" => $id,
                        "date" => date("Y-m-d H:i:s")
            );
            $this->db->insert("ca_members_statistic", $statistic);
            $this->session->set_userdata('app_language', 'en');
            return TRUE;  // jika user dengan info inputan ditemukan
        } else {
            return FALSE;
        }
    }

    function cek_email_avilable($email) {
        return $this->db->query("SELECT email FROM ca_members WHERE email='$email'")->num_rows();
    }

    function cek_username_avilable($username) {
        return $this->db->query("SELECT username FROM ca_members WHERE username='$username'")->num_rows();
    }

}
/**
 * end of class mmember.php
 * Location: system/application/models/mmember.php
 */
?>