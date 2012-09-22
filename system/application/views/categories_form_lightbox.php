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
 * @link		http://docs.codeanalytic.com/view/categories_form_lightbox
 */ 
?>
    <script type="text/javascript">
        $(function(){ 
            $('.title_permalink').keyup(function(){ 
                $('input.permalink').val(($(this).val()).replace(' ',''));
            })
        }) 
    </script>
    <div class="header">
        <h2><?php echo ca_translate('add new category in post');?></h2>
    </div>
    <form id="myform" method="post" onsubmit="return false">
        <p>
            <label style="width: 30%"><?php echo ca_translate('category'); ?></label>
            <input type="text" style="width: 65%" name="name" size="25" class="form_field title_permalink keyboardInput" validation="required" value="<?php echo set_value('name', isset($default['name']) ? $default['name'] : ''); ?>">
        </p>
        <p>  
            <label style="width: 30%"><?php echo ca_translate('keyword'); ?></label>
            <input type="text" style="width: 65%" name="keyword" size="55" class="form_field keyboardInput" size="" validation="required"  value="<?php echo set_value('keyword', isset($default['keyword']) ? $default['keyword'] : ''); ?>">
        </p>
        <p><?php echo ca_translate("separate with coma (,)") ?></p>
        <p>  
            <label style="width: 30%"><?php echo ca_translate('description'); ?></label>
            <input type="text" style="width: 65%" name="description" size="55" class="form_field keyboardInput" validation="required"  value="<?php echo set_value('description', isset($default['description']) ? $default['description'] : ''); ?>">
        </p>
        <p>  
            <label style="width: 30%"><?php echo ca_translate('permalink'); ?></label>
            
            <input type="hidden" name="old_permalink" class="form_field " size=""  value="<?php echo set_value('old_permalink', isset($default['old_permalink']) ? $default['old_permalink'] : ''); ?>">
            <input type="text" style="width: 65%" name="permalink" class="form_field permalink" size="" validation="required"  value="<?php echo set_value('permalink', isset($default['permalink']) ? $default['permalink'] : ''); ?>">
        </p>
        <p>Default <i>posts/kanal/category</i></p>
        
        <div class="footer">
            <a class="button-red" href="javascript:void(0)" onclick="<?php echo isset($type) ? "ca_add_action('categories/$action_form',this);" : "ca_edit_action('categories/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
            <a class="button-red" href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate('close') ?></a>
        </div>   
    </form>