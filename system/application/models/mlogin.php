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
 * mlogin Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/mlogin
 */

class mlogin extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = "ca_users";  
    /**
     * function constructor 
     * @access public
     */
    public function __construct() {
        parent::__construct();  
    }  
    
    /**
     *
     * @param type $username
     * @param type $password
     * @return boolean 
     * @access public
     * @example $this->mlogin->check($username,$password)
     * 
     */
    public function check($username, $password) {
        /**
         * generate query 
         */
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row(); 
            $this->session->set_userdata('session_limiter', "5");
            $this->session->set_userdata($data);
            $id = $this->session->userdata('user_id');
            $data_user =
                    array(
                        'last_login' => date('Y-m-d H:i:s')
            );
            $this->db->where('user_id', $id);
            $this->db->update('ca_users', $data_user);

            $statistic = array( 
                        'user_id' => $id,
                        'date' => date('Y-m-d H:i:s')
            );
            $this->db->insert('ca_users_statistic', $statistic);
            $this->session->set_userdata('app_language', 'en');
            return TRUE;  
        } else {
            return FALSE;
        }
    }  

}
/**
 * End of class mlogin.php
 * Location : system/application/models/mlogin.php 
 */

?>
