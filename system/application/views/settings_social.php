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
 * @link		http://docs.codeanalytic.com/view/setting_social
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="social">
            <h2><?php echo ca_translate("social") ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
    <?php echo ca_translate('information about your social site. please configure any way you wanted'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("social") ?></span>
</div>
<form  id="sform" >               
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.fb')"><?php echo ca_translate('facebook setting');?></a> 
    </div>    
    <p class="fb">  
        <label><?php echo ca_translate('url');?></label>
        <input type="text" name="fb_url" size="40px" class="form_field" validation="required"  value="<?php echo set_value('fb_url', isset($default['fb_url']) ? $default['fb_url'] : ''); ?>"> (<i><?php echo ca_translate('facebook url');?></i>)
    </p>
    <p class="fb">  
        <label><?php echo ca_translate('user id');?></label>
        <input type="text" name="fb_user_id" size="40px" class="form_field" validation="required"  value="<?php echo set_value('fb_user_id', isset($default['fb_user_id']) ? $default['fb_user_id'] : ''); ?>"> (<i><?php echo ca_translate('facebook user id');?></i>)
    </p>
    <p class="fb">  
        <label><?php echo ca_translate('application id');?></label>
        <input type="text" name="fb_appl_id" size="40px" class="form_field" validation="required"  value="<?php echo set_value('fb_appl_id', isset($default['fb_appl_id']) ? $default['fb_appl_id'] : ''); ?>"> (<i><?php echo ca_translate('facebook application id');?></i>)
    </p>
   <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.twit')"><?php echo ca_translate('twitter setting');?></a> 
    </div> 
    <p class="twit">  
        <label><?php echo ca_translate('twitter url');?></label>
        <input type="text" name="twit_url" size="40px" class="form_field" validation="required"  value="<?php echo set_value('twit_url', isset($default['twit_url']) ? $default['twit_url'] : ''); ?>"> (<i><?php echo ca_translate('the twitter url');?></i>)
    </p>
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.go')"><?php echo ca_translate('google setting');?></a> 
    </div> 
    <p class="go">  
        <label><?php echo ca_translate('google plush url');?></label>
        <input type="text" name="gp_url" size="40px" class="form_field" validation="required"  value="<?php echo set_value('gp_url', isset($default['gp_url']) ? $default['gp_url'] : ''); ?>"> (<i><?php echo ca_translate('the google plush url');?></i>)
    </p>
    <p id="p_submit">
        <a href="javascript:void(0)" id="btn_submit" style="left: 0px" onclick="ca_edit_setting_action('settings/update_social')">
            <?php echo ca_translate("submit") ?>
        </a>    
        &nbsp;<i><b style="margin-left: 10px;"><?php echo ca_translate('submit all setting') ?></b></i>
    </p>
</form>  