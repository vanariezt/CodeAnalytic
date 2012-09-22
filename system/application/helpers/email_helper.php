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
 * email Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/email_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/**
 * function ca_get_email_setting
 * @access public
 * @category function php
 * get return value of email setting 
 */
if (!function_exists('ca_get_email_setting')) {

    function ca_get_email_setting($email) {
        include APPPATH."config/email.php";  
        $data = array_merge($config['auth']['mail']);
        return $data[$email]; 
    }

}
/**
 * function ca_set_email_setting
 * @access public
 * @category function php
 * set value of email setting 
 */
if (!function_exists('ca_set_email_setting')) {

    function ca_set_email_setting($key, $val, $old_val) {
        if (isSuperadmin()) {
            $fname = APPPATH.'config/email'.EXT;
            $content = ca_get_content_text($fname);
            $content = str_replace('$config[\'auth\'][\'mail\'][\'' . $key . '\'] = \'' . $old_val . '\';', '$config[\'auth\'][\'mail\'][\'' . $key . '\'] = \'' . $val . '\';', $content);
            ca_write_content_text($fname, $content);
        }
    }

}
/**
 * End of file email_helper.php
 * Location ./system/application/helpers/email_helper.php 
 */
?>
