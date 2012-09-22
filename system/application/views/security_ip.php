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
 * Views 
 *
 * @package		CodeAnalytic
 * @subpackage          View
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/view/security_ip
 */ 
?>
<div style="width: 650px">
    <div class="header">
        <h2><?php echo $title ?></h2>
    </div>
    <form id="myForm" method="post" onsubmit="return false">
        <p>
            <textarea validation="required"  name="ip_banned" style="width: 640px; height: 250px"><?php echo  $ip_banned; ?></textarea>
        </p>
        <div class="footer">
            <a style="margin-left: 57px;" href="javascript:void(0)"  class="button-red" onclick="ca_edit_user('security/do_ip_banned/',this); ca_load('security', '#cen_right')"> <?php echo ca_translate("submit") ?></a> 
            <a class="button-red"  href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate("exit"); ?></a>
        </div>
    </form> 
</div>