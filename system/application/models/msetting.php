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
 * msetting Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/msetting
 */
class msetting extends Model {
    
    /**
     * define table name
     * @var type 
     */
    var $tabel = "ca_settings";

    function __construct() {
        parent::__construct();
    }

    function page_setting($key) {
        $this->db->select("*");
        $this->db->from($this->tabel);
        $this->db->where("key", $key);
        return $this->db->get()->row();
    }
 
    function table_list() {
        if (isSuperAdmin()) {
            return mysql_query("SHOW TABLES");
        }
    }

}

/**
 * end of class msetting.php
 * Location: system/application/models/msetting.php
 */
?>
