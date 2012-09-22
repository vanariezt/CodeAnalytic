<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');

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
 * home Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/home
 */

class home extends Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('mtemplate','mposts','mwidget','mmenu'));
        $this->load->helper(array('fb','app','twit', 'page','template','widget','text','smiley','mobile'));
        $this->load->library(array('pagination','table','user_agent')); 
    }

    function index($offset = 0) {
        $data = array(
            'title' => 'home', 
            'query' => $this->mposts->get_all(ca_template_setting('results_per_page'), $offset, '1'),
            'limit' => ca_template_setting('results_per_page'),
            'rows' => $this->mposts->count('1'),
            'offset' => $offset,
            'meta_title' => ca_setting('meta_title'),
            'meta_keyword' => CA_KEY . ',' . ca_setting('meta_keyword'),
            'meta_description' => ca_setting('meta_description'),
        );
        (ca_template_setting('column_full') == 'TRUE') ? $data['column_full'] = 'web/home' : '';
        (ca_template_setting('column_timeline') == 'TRUE') ? $data['column_timeline'] = 'web/column_timeline' : '';
        (ca_template_setting('column_center') == 'TRUE') ? $data['column_center'] = 'web/home' : '';
        (ca_template_setting('column_top') == 'TRUE') ? $data['column_top'] = 'web/column_top' : '';
        (ca_template_setting('column_right') == 'TRUE') ? $data['column_right'] = 'web/column_right' : '';
        (ca_template_setting('column_bottom') == 'TRUE') ? $data['column_bottom'] = 'web/column_bottom' : '';
        (ca_template_setting('column_left') == 'TRUE') ? $data['column_left'] = 'web/column_left' : '';
        $m_data = array(
            'title' => 'home',
            'category' => $this->mposts->get_cat(),
            'limit' => ca_template_setting('results_per_page'),
            'offset' => $offset, 
            'mobile_center' => 'mobile/home',
            'meta_title' => ca_setting('meta_title'),
            'meta_keyword' => CA_KEY . ',' . ca_setting('meta_keyword'),
            'meta_description' => ca_setting('meta_description'),
        );
        (ca_mobile_setting('m_column_top') == 'TRUE') ? $m_data['m_column_top'] = 'mobile/top' : '';
        (ca_mobile_setting('m_column_bottom') == 'TRUE') ? $m_data['m_column_bottom'] = 'mobile/bottom' : '';

        if (is_mobile_user_agent()) { 
            $this->load->view(ca_theme_dir() . 'mindex', $m_data);
        } else {
            $this->load->view(ca_theme_dir() . 'index', $data);
        }
    }

    function pagging($offset = 0) {
        $data = array(
            'query' => $this->mposts->get_all(ca_template_setting('results_per_page'), $offset, '1'),
            'rows' => $this->mposts->count('1'),
            'limit' => ca_template_setting('results_per_page'),
            'offset' => $offset
        );
        $this->load->view(ca_theme_dir() . 'web/home', $data);
    }

}

?>