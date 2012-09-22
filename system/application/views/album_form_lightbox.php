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
 * @link		http://docs.codeanalytic.com/view/album_form_lightbox
 */ 
?>
<div class="header">
    <h2><?php echo ca_translate('add new album') ?></h2>
</div>
<form id="config" method="post" onsubmit="return false">
    <p>
        <label><?php echo ca_translate('name'); ?>
            <span><i><?php  echo ca_translate('type name of album that you want to create'); ?></i></span>
        </label><input type="text" name="name" validation="required" style="width: 62%" value="<?php echo set_value('name', isset($default['name']) ? $default['name'] : ''); ?>">
    </p> 
    <p>
        <label><?php echo ca_translate('description'); ?>
        <span><i><?php  echo ca_translate('give description about the album that you want to create'); ?></i></span>
        </label><textarea name="description" validation="required" style="width: 62%"><?php echo isset($default['description']) ? $default['description'] : ''; ?></textarea>
    </p>
    <div class="footer">
        <a href="javascript:void(0)"  class="button-red" onclick="<?php echo isset($type) ? "ca_add_action('album/$action_form',this);" : "ca_edit_action('album/$action_form');" ?>" > <?php echo isset($type) ? ca_translate('submit') : ca_translate('update') ?></a> 
        <a class="button-red" href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate('close'); ?></a>
    </div>    
</form> 