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
 * @link		http://docs.codeanalytic.com/view/album_form
 */ 
?>
<div id="top_tap" class="dinamic_tap">
    <span><?php echo ca_translate("album form") ?></span>            
</div>
<div class="small_form" style="border-right: 1px solid #EBEBEB; float: left; padding-right: 5px "> 
    <form id="myform" method="post" onsubmit="return false">
        <p>
            <label style="width: 28%"><?php echo ca_translate("name"); ?></label>
            <input type="text" name="name" validation="required" style="width: 65%" class="keyboardInput" value="<?php echo set_value('name', isset($default['name']) ? $default['name'] : ''); ?>">
        </p> 
        <div class="box_form">
            <div id="top_tap"><span><?php echo ca_translate("description"); ?></span></div>
            <textarea name="description" class="keyboardInput" validation="required" style="width: 92%; height: 70px; border: 1px solid #EBEBEB; margin-left: 10px;"><?php echo isset($default['description']) ? $default['description'] : ''; ?></textarea>
        </div>
        <p id="p_submit"  style="width: 98%; margin-left: -3.3%">
            <a style="left: 13px" href="javascript:void(0)"  id="btn_submit" onclick="<?php echo isset($type) ? "ca_add_action('album/$action_form',this);" : "ca_edit_action('album/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate('submit') : ca_translate('update') ?></a> 
            <a style="left: 13px" id="btn_submit" href="javascript:void(0)" onclick="ca_load('album/index/', '#cen_right')"><?php echo ca_translate('close');?></a>
        </p>    
    </form>
</div>
 <?php ca_vir_keyboard(); ?>