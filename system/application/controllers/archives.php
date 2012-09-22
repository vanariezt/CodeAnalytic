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
 * archives Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/archives
 */

class archives extends Controller { 
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('mtemplate','mwidget','mmenu','marchives'));
        $this->load->helper(array('fb','app','twit', 'page','template','widget'));
        $this->load->library(array('pagination','table','user_agent'));  
    }

    function index($year = '', $month = '', $offset = 0) {
        $this->load->helper(array('page', 'twit', 'fb'));
        ($year == '') ? date('Y') : $year;
        ($month == '') ? date('m') : $month;
        $data = array(
            'offset' => $offset,
            'year' => $year,
            'month' => $month,
            'title' => "archives $year in $month",
            'rows' => $this->marchives->count($year, $month),
            'limit' => ca_setting('results_per_page'),
            'query' => $this->marchives->get_all($year, $month, ca_setting('results_per_page'), $offset),
            'column_top' => 'web/column_top',
            'column_left' => 'web/column_left',
            'column_center' => 'web/archives',
            'column_right' => 'web/column_right',
            'column_bottom' => 'web/column_bottom',
            'meta_title' => "Archives $year in $month ". ca_setting('site_domain'),
            'meta_keyword' => CA_KEY.','."Archives $year $month ". ca_setting('site_domain'),
            'meta_description' => "All archives $year $month ". ca_setting('site_domain'),
        );
        $m_data = array(
            'offset' => $offset,
            'year' => $year,
            'month' => $month,
            'title' => "archives $year in $month",
            'rows' => $this->marchives->count($year, $month),
            'limit' => ca_setting('results_per_page'),
            'query' => $this->marchives->get_all($year, $month, ca_setting('results_per_page'), $offset),
            'mobile_top' => 'web/column_mobile_top',
            "mobile_center" => "web/archives_mobile_index",
            'meta_title' => "Archives $year in $month ". ca_setting('site_domain'),
            'meta_keyword' => CA_KEY.','."Archives $year $month ". ca_setting('site_domain'),
            'meta_description' => "All archives $year $month ". ca_setting('site_domain'),
        );
        if (is_mobile_user_agent()) {
            $this->load->view(ca_theme_dir().'mindex', $m_data);
        } else {
            $this->load->view(ca_theme_dir().'index', $data);
        }
    }

    function index_($year, $month, $id = '', $offset = 0) {
        $this->load->helper(array('twit', 'fb', 'page'));
        $this->load->model('mcategories'); 
        $data = array(
            'offset' => $offset,
            'year' => $year,
            'month' => $month,
            'title' => "archives $year in $month",
            'rows' => $this->marchives->count($year, $month),
            'limit' => ca_setting('results_per_page'),
            'query' => $this->marchives->get_all($year, $month, ca_setting('results_per_page'), $offset),
        );

        $m_data = array(
            'offset' => $offset,
            'year' => $year,
            'month' => $month,
            'title' => "archives $year in $month",
            'rows' => $this->marchives->count($year, $month),
            'limit' => ca_setting('results_per_page'),
            'query' => $this->marchives->get_all($year, $month, ca_setting('results_per_page'), $offset),
            'mobile_top' => 'web/column_mobile_top',
            'mobile_center' => "web/archives_mobile_index",
            'meta_title' => "Archives $year in $month ". ca_setting('site_domain'),
            'meta_keyword' => CA_KEY.','."Archives $year $month ". ca_setting('site_domain'),
            'meta_description' => "All archives $year $month ". ca_setting('site_domain'),
        );

        if (is_mobile_user_agent()) {
             $this->load->view(ca_theme_dir().'mindex', $m_data);
        }else {
            $this->load->view(ca_theme_dir().'web/archives', $data);
        }
    }

}

?>
