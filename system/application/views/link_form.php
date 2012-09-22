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
 * @link		http://docs.codeanalytic.com/view/link_form
 */ 
?>
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("link form") ?></span>            
        </div>
<div class="small_form" style="border-right: 1px solid #EBEBEB; float: left; padding-right: 5px "> 
    <form id="myform" method="post" onsubmit="return false">
        <p class="ui-state-highlight">
            <label style="width: 28%"><?php echo ca_translate('title'); ?></label>
            <input type="text" name="title" style="width: 68%" class="form_field keyboardInput"  validation="required" value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : ''); ?>">
        </p>
        <p class="ui-state-highlight">
            <label style="width: 28%"><?php echo ca_translate('url'); ?></label>
            <span style="float: left; width: 68%">
                <input type="text" name="url" style="width: 100%" class="form_field" validation="required|url" value="<?php echo set_value('url', isset($default['url']) ? $default['url'] : ''); ?>">
                <i>Ex: http://code-an.com <br/> Ex: http://www.code.com</i>
            </span>
        </p>
        <p class="ui-state-highlight">
            <label style="width: 28%"><?php echo ca_translate('target'); ?></label>
            <span style="float: left; width: 68%">
                <input type="radio" style="float: left; width: 10px" name="target" value="_blank" class="form_field" <?php
if ($default['target'] == '_blank') {
    echo "checked=TRUE";
}
?>><?php echo ca_translate('_blank — new window or tab');?>  <br/>
                <input style="float: left; width: 10px" type="radio" name="target" value="_top" class="form_field" <?php
                       if ($default['target'] == '_top') {
                           echo "checked=TRUE";
                       }
?>><?php echo ca_translate('_top — current window, without frame');?>  <br/>
                <input style="float: left; width: 10px" type="radio" name="target" value="_self" class="form_field" <?php
                       if ($default['target'] == '_self') {
                           echo "checked=TRUE";
                       }
?>><?php echo ca_translate('_self — same window or tab');?> 
            </span>
        </p>
        <p class="ui-state-highlight">
            <label style="width: 28%">class</label>
            <input type="text" name="attr_class" style="width: 68%" class="form_field" value="<?php echo set_value('attr_class', isset($default['attr_class']) ? $default['attr_class'] : ''); ?>">
            <span style="float: left; margin-left: 31%"><?php echo ca_translate("separate with coma (,)") ?></span>
        </p>
        <p class="ui-state-highlight">
            <label style="width: 28%">id</label>
            <input type="text" name="attr_id" style="width: 68%" class="form_field" value="<?php echo set_value('attr_id', isset($default['attr_id']) ? $default['attr_id'] : ''); ?>">
        </p>

        <p class="ui-state-disabled" id="p_submit"  style="width: 98%; margin-left: -3.3%">
            <a href="javascript:void(0)"  id="btn_submit" style="left: 33%" onclick="<?php echo isset($type) ? "ca_add_action('link/$action_form',this);" : "ca_edit_action('link/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate('submit') : ca_translate('update') ?></a> 
            <a id="btn_submit" href="javascript:void(0)" style="left: 33%" onclick="ca_load('link/index/', '#cen_right')"><?php echo ca_translate('reset'); ?></a>
        </p>
    </form>
</div>
<?php ca_vir_keyboard() ?>