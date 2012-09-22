<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/view/setting_general
 */
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="general">
            <h2><?php echo ca_translate('general'); ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
<?php echo ca_translate('information about your site exists disni Profile. Please configure any way you wanted.'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("general") ?></span>
</div>

<form  id="sform" >               
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.basic')"><?php echo ca_translate('basic setting'); ?></a> 
    </div> 
    <p class="basic">  
        <label><?php echo ca_translate('site domain') ?></label>
        <input type="text" name="site_domain" size="40px" class="form_field" validation="required"  value="<?php echo set_value('site_domain', isset($default['site_domain']) ? $default['site_domain'] : ''); ?>"> (<i><?php echo ca_translate('this is domain name your site') ?></i>)
    </p>
    <p class="basic">  
        <label><?php echo ca_translate('site email') ?></label>
        <input type="text" name="site_email" size="40px" class="form_field" validation="required"  value="<?php echo set_value('site_email', isset($default['site_email']) ? $default['site_email'] : ''); ?>"> (<i><?php echo ca_translate('this is email address your site') ?></i>)
    </p>
    <p class="basic">  
        <label><?php echo ca_translate('site telphone') ?></label>
        <input type="text" name="site_telp" size="40px" class="form_field" validation="required"  value="<?php echo set_value('site_telp', isset($default['site_telp']) ? $default['site_telp'] : ''); ?>"> (<i><?php echo ca_translate('this is telphone number your site') ?></i>)
    </p>
    <p class="basic">  
        <label><?php echo ca_translate('site address') ?></label>
        <input type="text" name="site_address" size="40px" class="form_field" validation="required"  value="<?php echo set_value('site_address', isset($default['site_address']) ? $default['site_address'] : ''); ?>"> (<i><?php echo ca_translate('this is adsdress your site') ?></i>)
    </p>
    <p class="basic">
        <label><?php echo ca_translate('site description') ?></label>
        <textarea name="site_description" class="tinymce" cols="50" rows="5"><?php echo ($default['site_description']) ? $default['site_description'] : '' ?></textarea>
    </p>

    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.animation')"><?php echo ca_translate('panel animation') ?></a> 
    </div>
    <p class="animation">
        <span id="con_set">
            <?php
            $anim = ca_setting('anim_avail', 'animation');
            asort($anim);
            foreach ($anim as $key => $value) {
                ?>
                <input name="animation" type="radio" value="<?php echo $value ?>" <?php echo set_radio('animation', "$value", isset($default['animation']) && $default['animation'] == "$value" ? TRUE : FALSE)
                ?>/><?php
                   echo $key;
               }
            ?>
        </span><br/>
            <?php echo ca_translate('to make animation selected is worked, please refresh the page after update') ?>
        
    </p> 

    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.page_post')"><?php echo ca_translate('language') ?></a> 
    </div>
    <p class="page_post">
        <label><?php echo ca_translate("default language"); ?></label>
        <span id="con_set">
            <?php
            $lang = ca_setting('lang_name', 'lang_detect');
            asort($lang);
            foreach ($lang as $key => $value) {
                ?>
                <input name="lang_default" type="radio" value="<?php echo $value ?>" <?php echo set_radio('lang_default', "$value", isset($default['lang_default']) && $default['lang_default'] == "$value" ? TRUE : FALSE)
                ?>/><?php
                   echo $key;
               }
            ?>
        </span>
    </p>  
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.logs')"><?php echo ca_translate('logs setting'); ?></a> 
    </div>
    <p class="logs">
        <label><?php echo ca_translate("is record error 404"); ?></label>
        <span id="con_set">
            <input name="is_record_404" type="radio" value="1" <?php echo set_radio('is_record_404', "1", isset($default['is_record_404']) && $default['is_record_404'] == "1" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("yes"); ?>
            <input name="is_record_404" type="radio" value="0" <?php echo set_radio('is_record_404', "0", isset($default['is_record_404']) && $default['is_record_404'] == "0" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("no"); ?>
        </span>
        &nbsp; <i>(<?php echo ca_translate('if you want to record or not error 404 or page not found') ?>)</i>
    </p>
    <p class="logs">
        <label><?php echo ca_translate("is record error authentification"); ?></label>
        <span id="con_set">
            <input name="is_record_auth" type="radio" value="1" <?php echo set_radio('is_record_auth', "1", isset($default['is_record_auth']) && $default['is_record_auth'] == "1" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("yes"); ?>
            <input name="is_record_auth" type="radio" value="0" <?php echo set_radio('is_record_auth', "0", isset($default['is_record_auth']) && $default['is_record_auth'] == "0" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("no"); ?>
        </span>
        &nbsp; <i>(<?php echo ca_translate('if you want to record or not error authentification') ?>)</i>
    </p>
    <p class="logs">
        <label><?php echo ca_translate("is record member activity"); ?></label>
        <span id="con_set">
            <input name="is_record_member" type="radio" value="1" <?php echo set_radio('is_record_member', "1", isset($default['is_record_member']) && $default['is_record_member'] == "1" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("yes"); ?>
            <input name="is_record_member" type="radio" value="0" <?php echo set_radio('is_record_member', "0", isset($default['is_record_member']) && $default['is_record_member'] == "0" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("no"); ?>
        </span>
        &nbsp; <i>(<?php echo ca_translate('if you want to record or not member activity') ?>)</i>
    </p>

    <p class="logs">
        <label><?php echo ca_translate("is record user activity"); ?></label>
        <span id="con_set">
            <input name="is_record_user" type="radio" value="1" <?php echo set_radio('is_record_user', "1", isset($default['is_record_user']) && $default['is_record_user'] == "1" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("yes"); ?>
            <input name="is_record_user" type="radio" value="0" <?php echo set_radio('is_record_user', "0", isset($default['is_record_user']) && $default['is_record_user'] == "0" ? TRUE : FALSE)
            ?>/> <?php echo ca_translate("no"); ?>
        </span>
        &nbsp; <i>(<?php echo ca_translate('if you want to record or not user activity') ?>)</i>
    </p>
    <p id="p_submit">
        <a href="javascript:void(0)" id="btn_submit" style="left: 0px" onclick="ca_edit_setting_action('settings/update_general')">
<?php echo ca_translate("submit") ?>
        </a> 
        &nbsp;<i><b style="margin-left: 10px;"><?php echo ca_translate('submit all setting') ?></b></i>
    </p>
</form>  