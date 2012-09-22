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
 * rss Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/rss
 */
class rss extends Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('template','app'));
        $this->load->model(array('mtemplate','mposts'));
    }

    function index() {
        $data['rs'] = $rs = $this->mposts->get_all(ca_template_setting('results_per_page'), 0);
        $this->load->view("rss_index", $data);
    }

    function kanal($cat_ = '') {
        if ($cat_ <> '') {
            $cat = ca_text_replace($cat_);
            $data['rs'] = $rs = $this->mposts->post_by_cat($cat, ca_template_setting('results_per_page'), 0);
            $this->load->view("rss_index", $data);
        }
    }

}

?>