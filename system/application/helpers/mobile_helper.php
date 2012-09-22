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
 * mobile Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/mobile_helper
 */

/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic mobile Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */


/* | 
  |----------------------------------------------------------------------------
  | helper: ca_mobile+setting
  |----------------------------------------------------------------------------
  | get return data mobile_setting
 */
if (!function_exists('ca_mobile_setting')) {

    function ca_mobile_setting($key) {
        $CA = & get_instance();
        $CA->load->library('ca_conf');
        $CA->ca_conf->load('views/'.ca_theme_dir(),'mconfig');
        return $CA->ca_conf->item($key);
    }

}

?>