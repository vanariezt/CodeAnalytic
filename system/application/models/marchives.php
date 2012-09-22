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
 * marchives Class
 *
 * @package		CodeAnalytic
 * @subpackage          Models
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/models/marchives
 */ 

class marchives extends Model {
    /**
     * define table use
     * @var type 
     */
    var $table = "ca_posts";

    function __construct() {
        parent::__construct();
    }
    /**
     *
     * @param type $year
     * @param type $month
     * @param type $limit
     * @param type $offset
     * @return type 
     */
    function get_all($year, $month, $limit, $offset) {
        $this->db->select("p.title, p.id as id, c.name as category,p.meta_keyword as meta,p.permalink, p.link, p.is_show_thumb, p.content,u.username, p.img, p.user_id, p.date, p.publish, p.view");
        $this->db->from("$this->table as p , ca_categories as c, ca_users as u");
        $this->db->where("p.cat_id = c.id"); 
        $this->db->where("YEAR(p.date) = '$year'");
        $this->db->where("MONTH(p.date) = '$month'");
        $this->db->where("p.user_id = u.user_id");
        $this->db->where("p.publish = '1'");
        $this->db->limit($limit, $offset);
        $this->db->order_by('p.order','asc');
        return $this->db->get();
    }
    /**
     *
     * @param type $year
     * @param type $month
     * @return type 
     */
    function count($year, $month) {
        $this->db->from("$this->table as p , ca_categories as c");
        $this->db->where("p.cat_id = c.id"); 
        $this->db->where("p.publish = '1'");
        $this->db->where("YEAR(p.date) = '$year'");
        $this->db->where("MONTH(p.date) = '$month'");
        return $this->db->get()->num_rows();
    }
    /**
     *
     * @return type 
     */
    function get_first_year(){
        return $this->db->query("SELECT DATE_FORMAT(`date`, '%Y') AS first_year FROM (`ca_posts`) ORDER BY `id` ASC LIMIT 1")->row()->first_year;
         
    }
    /**
     *
     * @return type 
     */
    function get_first_month(){
       return $this->db->query("SELECT DATE_FORMAT(`date`, '%m') AS first_month FROM (`ca_posts`) ORDER BY `id` ASC LIMIT 1")->row()->first_month;
        
    }
    /**
     *
     * @param type $year
     * @return type 
     */
    function count_year($year) {
        $this->db->from($this->table);
        $this->db->where("YEAR(date) = '$year'");
        $this->db->where("publish = '1'");
        return $this->db->get()->num_rows();
    }
    /**
     *
     * @param type $month
     * @param type $year
     * @return type 
     */
    function count_month($month,$year) {
        $this->db->from($this->table);
        $this->db->where("MONTH(date) = '$month'");
        $this->db->where("YEAR(date) = '$year'");
        $this->db->where("publish = '1'");
        return $this->db->get()->num_rows();
    }

}
/**
 * end of class mmenu.php
 * Location: system/application/models/marchives.php
 */
?>
