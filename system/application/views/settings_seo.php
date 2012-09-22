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
 * @link		http://docs.codeanalytic.com/view/setting_seo
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="seo">
            <h2><?php echo ca_translate("seo") ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
    <?php echo ca_translate('make your website become the number one search machined now.');?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("seo") ?></span>
</div>

<form  id="sform" >      
    <p>
        <label><?php echo ca_translate("meta title") ?> </label>
        <input type="text" validation="required"  name="meta_title" size="45" value="<?php echo ($default['meta_title']) ? $default['meta_title'] : '' ?>">
        <i><?php echo ca_translate("title of your website") ?></i>
    </p>
    <p>
        <label><?php echo ca_translate("meta keyword") ?> </label>
        <input type="text" validation="required"  name="meta_keyword" size="45" value="<?php echo ($default['meta_keyword']) ? $default['meta_keyword'] : '' ?>">
        <i><?php echo ca_translate("keyword of your website , separated with coma (,)") ?></i>
    </p>
    <p>
        <label><?php echo ca_translate("meta description") ?>  </label>
        <input type="text" validation="required"  name="meta_description" size="45" value="<?php echo ($default['meta_description']) ? $default['meta_description'] : '' ?>">
        <i><?php echo ca_translate("description of your website") ?></i>
    </p>
    <p>
        <label><?php echo ca_translate("meta robot") ?> </label>
        <input type="text" validation="required"  name="meta_robot" size="45" value="<?php echo ($default['meta_robot']) ? $default['meta_robot'] : '' ?>">
        <i><?php echo ca_translate("robot of your website , separated with coma (,)") ?></i>
    </p>
    <p>
        <label><?php echo ca_translate("google analytic code") ?> </label>
        <textarea validation="required"  name="google_analytic_code" cols="50" rows="5"><?php echo ($default['google_analytic_code']) ? $default['google_analytic_code'] : '' ?></textarea>
   </p>
   <p>
        <label><?php echo ca_translate("alexa code") ?> </label>
        <textarea validation="required"  name="alexa_code" cols="50" rows="5"><?php echo ($default['alexa_code']) ? $default['alexa_code'] : '' ?></textarea> 
   </p>
   <p id="p_submit">
       <a href="javascript:void(0)" onclick="ca_edit_setting_action('settings/update_seo')" style="left: 16.7%" class="submit">
            <?php echo ca_translate("submit") ?>
        </a>
   </p>
</form> 