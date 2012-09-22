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
 * @link		http://docs.codeanalytic.com/view/setting_email
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="email">
            <h2><?php echo ca_translate('email') ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
    <?php echo ca_translate('set up e-mail with your personal domain.'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate('email') ?></span>
</div>

<form  id="sform" style="float: left; width: 60%"> 
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.basic')"><?php echo ca_translate('Basic Setting'); ?></a> 
    </div>
    <p class="basic">
        <label><?php echo ca_translate('Mailtype'); ?></label>
        <span id="con_set">
            <input name="mailtype" type="radio" value="text" <?php echo set_radio('mailtype', "text", isset($default['mailtype']) && $default['mailtype'] == "text" ? TRUE : FALSE)
    ?>
                   /> <?php echo ca_translate('Text'); ?>
            &nbsp; <input name="mailtype" type="radio" value="html" <?php echo set_radio('mailtype', "html", isset($default['mailtype']) && $default['mailtype'] == "html" ? TRUE : FALSE)
    ?>
                          /> <?php echo ca_translate('Html'); ?>
        </span>
        &nbsp;&nbsp;&nbsp;<i><?php echo ca_translate('email type'); ?></i>
    </p>
    <p class="basic">
        <label><?php echo ca_translate('Protocol'); ?></label>
        <input type="text" validation="required"  name="protocol" size="25" value="<?php echo ($default['protocol']) ? $default['protocol'] : '' ?>">
        <i><?php echo ca_translate("email protocol"); ?></i>
    </p> 
    <p class="basic">
        <label><?php echo ca_translate('smtp user'); ?></label>
        <input type="text" validation="required"  name="smtp_user" size="25" value="<?php echo ($default['smtp_user']) ? $default['smtp_user'] : '' ?>">
        <i><?php echo ca_translate('smtp user'); ?></i>
    </p>
    <p class="basic">
        <label><?php echo ca_translate('smtp password'); ?></label>
        <input type="text" validation="required"  name="smtp_pass" size="25" value="<?php echo ($default['smtp_pass']) ? $default['smtp_pass'] : '' ?>">
        <i><?php echo ca_translate('smtp password'); ?></i>
    </p>
    <p class="basic">
        <label><?php echo ca_translate('smtp host'); ?></label>
        <input type="text" validation="required"  name="smtp_host" size="25" value="<?php echo ($default['smtp_host']) ? $default['smtp_host'] : '' ?>">
        <i><?php echo ca_translate('smtp host'); ?></i>
    </p>
    <p class="basic">
        <label><?php echo ca_translate('smtp port'); ?></label>
        <input type="text" validation="required"  name="smtp_port" size="25" value="<?php echo ($default['smtp_port']) ? $default['smtp_port'] : '' ?>">
        <i><?php echo ca_translate('smtp port'); ?></i>
    </p> 
    <p id="p_submit">
        <a href="javascript:void(0)" style="left: -5px;" id="btn_submit" onclick="ca_edit_setting_action('settings/update_email')">
            <?php echo ca_translate('submit'); ?></a>   
        &nbsp;<i><b style="margin-left: 10px;"><?php echo ca_translate('submit all setting'); ?></b></i>
    </p>
</form> 
<div class="email_setting" style="float: left; width: 35%; margin-left: 2%; border: 1px solid #EBEBEB; border-bottom: none">
    <div id="bar_button" style="float: left; width: 100%; padding: 2px;">
        <a href="javascript:void(0)" id="header" class="hide"  onclick="ca_slide_(this,'ul.content')"><?php echo ca_translate('Manage content email your website'); ?></a> 
    </div> 
    <ul class="content">
        <li>
            <a href="javascript:void(0)" onclick="ca_lightbox('settings/content_email/comments')"><?php echo ca_translate('comments'); ?></a>
        </li>
        <li>
            <a href="javascript:void(0)" onclick="ca_lightbox('settings/content_email/forgot_password')"><?php echo ca_translate('forgot password'); ?></a>
        </li>
        <li>
            <a href="javascript:void(0)" onclick="ca_lightbox('settings/content_email/news_letter')"><?php echo ca_translate('news letter'); ?></a>
        </li>
        <li>
            <a href="javascript:void(0)" onclick="ca_lightbox('settings/content_email/registration')"><?php echo ca_translate('registration'); ?></a>
        </li>
    </ul>
</div>
