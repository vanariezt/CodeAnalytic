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
 * @link		http://docs.codeanalytic.com/view/user_form
 */ 
?>
<div id="top_tap" class="dinamic_tap">
    <span><?php echo ca_translate("user form") ?></span>            
</div>
<div class="small_form" style="border-right: 1px solid #EBEBEB; float: left; margin-left: -10px; ">
    <form id="myform" method="post" onsubmit="return false">
        <p>
            <label style="width: auto"><?php echo ca_translate("username"); ?></label> <i>(<?php echo ca_translate('username for login') ?>)</i>
        </p>
        <p>
            <input type="text" name="username" style="width: 95%" class="form_field keyboardInput" validation="required"  value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>">
        </p>
        <p>
            <label style="width: auto"><?php echo ca_translate("user access"); ?></label>
            <?php echo ca_translate("username"); ?></label> <i>(<?php echo ca_translate('user privilages') ?>)</i>
        </p>
        <p>
            <?php echo form_dropdown('access', $access, isset($default['access']) ? $default['access'] : '', "class='form_field' style=\"width: 95%\"");?>
        </p>
        <p>
            <label style="width: auto"><?php echo ca_translate("password"); ?></label>
            <i>(<?php echo ca_translate('user password') ?>)</i>
        </p>
        <p>
            <input type="password" name="password" <?php
            if ($type == '1') {
                echo 'validation="required"';
            }
            ?> style="width: 95%" class="form_field" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">
                   <?php
                   if ($type <> '1') {
                       echo '<br/><i>Please insert if you want to change password</i>';
                   }
                   ?>
        </p>
        <p>
            <label style="width: auto"><?php echo ca_translate("firstname"); ?></label>
            <i>(<?php echo ca_translate('firstname of user') ?>)</i>
        </p>
        <p>
            <input type="text" name="first_name" style="width: 95%" class="form_field keyboardInput" validation="required"  value="<?php echo set_value('first_name', isset($default['first_name']) ? $default['first_name'] : ''); ?>">
        </p>
        <p>
            <label style="width: auto"><?php echo ca_translate("lastname"); ?></label>
            <i>(<?php echo ca_translate('lastname of user') ?>)</i>
        </p>
        <p>
            <input type="text" name="last_name" style="width: 95%" class="form_field keyboardInput" validation="required" value="<?php echo set_value('last_name', isset($default['last_name']) ? $default['last_name'] : ''); ?>">
        </p>
        <p>
            <label style="width:auto"><?php echo ca_translate("email"); ?></label>
            <i>(<?php echo ca_translate('email user') ?>)</i>
        </p>
        <p>
            <input type="text" name="email" style="width: 95%" class="form_field keyboardInput" validation="required|email" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
        </p>
        <p id="p_submit" style="width: 93%">
            <a href="javascript:void(0)" style="left: -1%;"  id="btn_submit" onclick="<?php echo isset($type) ? "ca_add_action('user/$action_form',this);" : "ca_edit_action('user/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
            <a id="btn_submit" style="left: -1%;" href="javascript:void(0)" onclick="ca_load('user/index/', '#cen_right')"><?php echo ca_translate('reset') ?></a>
        </p>   
    </form>
</div>
<?php ca_vir_keyboard() ?>