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
 * @link		http://docs.codeanalytic.com/view/posts_find
 */ 
?>
<script type="text/javascript">
    jQuery(document).ready(function () {	
        $('input.dateSimple').simpleDatepicker({x:0});
    });
</script>
<div id="search_content">
    <div id="left">
        <form id="myform" method="post" onsubmit="return false">
            <p>
                <label><?php echo ca_translate("title"); ?></label>
                <input type="text" name="s_title" size="45" class="keyboardInput" class="form_field">
            </p> 
            <p>
                <label><?php echo ca_translate('date'); ?></label>
                <input type="text" name="s_from" size="25" class="form_field dateSimple"> to
                <input type="text" name="s_to" size="25" class="form_field dateSimple">
            </p>
            <p>
                <label><?php echo ca_translate("categories"); ?></label>
                <?php echo form_dropdown('s_cat_id', $s_cat_id, isset($default['s_cat_id']) ? $default['s_cat_id'] : '', "class = form_field validation='required'"); ?>
            </p>     
            <p>
                <label><?php echo ca_translate("content"); ?></label>
                <textarea id="s_content" name="s_content" class="keyboardInput" cols="50" rows="2"></textarea> 
            </p>    
            <p id="p_submit">
                <a href="javascript:void(0)"  id="btn_submit" onclick="ca_find_action('<?php echo $action_form ?> ','#center_content');"> <?php echo ca_translate('search') ?></a> 
                <a id="btn_submit" href="javascript:void(0)" onclick="ca_close_find()"><?php echo ca_translate("close"); ?></a>
            </p> 
        </form> 
    </div>
    <div id="right">
        <div id="top_tap">
            <span><?php echo ca_translate("search information"); ?></span>
        </div>
        <div id="s_info"></div>
    </div>
</div>
<?php ca_vir_keyboard() ?>