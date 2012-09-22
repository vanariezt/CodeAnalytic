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
 * capanel Class
 *
 * @package		Application
 * @subpackage          Controllers
 * @category            Class
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/controllers/capanel
 */
class capanel extends Controller {
    /**
     * define file translation 
     */
    var $langfile = 'ca/panel';
    /**
     * function constructor
     * @access public
     */
    function __construct() {
        parent::__construct();
        /**
         * load class language
         * @access public
         * @example libraries/language.php
         */
        $this->lang->index($this->langfile);
        /**
         * load class model and helper 
         */  
        $this->load->model(array('mmodule','mposts','mpanel'));
        $this->load->helper(array('form','lang','session','log','app','js')); 
    }
    /**
     * function index
     * @access public 
     */
    function index() {
        /* check valid user */
        if (isUser ()) {
            /**
             * if user login in is valid user
             * generate userdata 
             */
            $userdata=$this->mpanel->get_user_data(); 
            $photo = str_replace('middle','small', $userdata->photo);
            $data = array(
                'title' => 'Panel - '. ca_setting('app_name'),
                'top' => 'menu_top',
                'left'=> 'menu_left',
                'right' => 'panel_index',
                'email' => $userdata->email,
                'first_name' => $userdata->first_name,
                'last_name' => $userdata->last_name,
                'photo' => $photo,
                'username'=> $userdata->username,
                'fast_post'=>'posts_form_fast',
                'com_stat'=>'comments_statistic',
                'bottom'=> 'menu_bottom'
            );
            /* load file views/panel.php */
            $this->load->view('panel', $data);
        } else {
            /* pass to error authentification*/
            ca_error_auth('view', 'panel');
        }
    }
}
/**
 * End of class capanel
 * Location : system/application/controllers/capanel.php 
 */
?>