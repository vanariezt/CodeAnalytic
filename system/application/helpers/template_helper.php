<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');

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
 * template Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/template_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic template Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* |
  | Helper : ca_theme_current
  |----------------------------------------------------------------------------
  | Get data of theme current use
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists("ca_theme_current")) {

    function ca_theme_current() {
        $CA = & get_instance();
        return $CA->mtemplate->used();
    }

}
/* |
  | Helper : ca_theme_current
  |----------------------------------------------------------------------------
  | Get real path of template
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_theme_dir')) {

    function ca_theme_dir() {
        return 'codeanalytic_template/' . ca_theme_current()->name . '/';
    }

}

/* |
  | Helper : ca_theme_id
  |----------------------------------------------------------------------------
  | Get real id of template
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_theme_id')) {

    function ca_theme_id() {
        return ca_theme_current()->id;
    }

}

/* |
  | Helper : ca_template_setting
  |----------------------------------------------------------------------------
  | Get return value of template setting
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_template_setting')) {

    function ca_template_setting($key) {
        $active = ca_theme_dir();
        $CA = & get_instance();
        $CA->load->library('ca_conf');
        $CA->ca_conf->load('views/'.$active, 'config'. EXT);
        return $CA->ca_conf->item($key);
    }

}
?>
