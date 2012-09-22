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
 * @link		http://docs.codeanalytic.com/view/user_manage
 */ 
?>
<div class="header">
    <h2><?php echo ca_translate('manage your account here'); ?></h2>
</div>
<form id="myform" method="post" onsubmit="return false">
    <p>
        <label><?php echo ca_translate("username"); ?></label>
        <input type="text" name="username" size="45" class="form_field" validation="required"  value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>">
    </p> 
    <p>
        <label><?php echo ca_translate("password"); ?></label>
        <input type="password" name="password" <?php
if ($type == '1') {
    echo 'validation="required"';
}
?> size="35" class="form_field" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">
               <?php
               if ($type <> '1') {
                   echo '<i>'.  ca_translate('insert new pasword if you want to change the old password').'</i>';
               }
               ?>
    </p> 
    <p>
        <label><?php echo ca_translate("firstname"); ?></label>
        <input type="text" name="first_name" size="45" class="form_field" validation="required"  value="<?php echo set_value('first_name', isset($default['first_name']) ? $default['first_name'] : ''); ?>">

    </p>
    <p>
        <label><?php echo ca_translate("lastname"); ?></label>
        <input type="text" name="last_name" size="45" class="form_field" validation="required" value="<?php echo set_value('last_name', isset($default['last_name']) ? $default['last_name'] : ''); ?>">
    </p>
    <p>
        <label><?php echo ca_translate("email"); ?></label>
        <input type="text" name="email" size="35" class="form_field" validation="required|email" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
    </p>
    <div class="footer">
        <a style="margin-left: 57px;" href="javascript:void(0)"  class="button-red" onclick="ca_edit_user('user/<?php echo $action_form ?>',this)"> <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
        <a class="button-red"  href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate("exit"); ?></a>

    </div>
</form> 