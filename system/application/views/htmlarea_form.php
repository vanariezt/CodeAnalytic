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
 * @link		http://docs.codeanalytic.com/view/htmlarea_form_lightbox
 */ 
?>
<div class="header">
    <h2><?php 
    echo isset($type) ? ca_translate('add new html area in '.$position) : ca_translate('update html area'); 
    ?></h2>
</div>
<form id="config" method="post" onsubmit="return false">
    <p>
        <label><?php echo ca_translate('title'); ?>
            <span><i><?php  echo ca_translate('type title of htmlarea that you want to create'); ?></i></span>
        </label><input type="text" name="title" validation="required" style="width: 62%" value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : ''); ?>">
    </p> 
    <p>
        <label><?php echo ca_translate('html code'); ?>
        <span><i><?php  echo ca_translate('give html code about the htmlarea that you want to create'); ?></i></span>
        </label><textarea name="html" validation="required" style="width: 62%; height: 300px"><?php echo isset($default['html']) ? $default['html'] : ''; ?></textarea>
    </p>
    <div class="footer">
        <a href="javascript:void(0)"  class="button-red" onclick="<?php echo isset($type) ? "ca_add_action('htmlarea/$action_form/$t',this);" : "ca_edit_action('htmlarea/$action_form/',this);" ?>" > <?php echo isset($type) ? ca_translate('submit') : ca_translate('update') ?></a> 
        <a class="button-red" href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate('close'); ?></a>
    </div>    
</form> 