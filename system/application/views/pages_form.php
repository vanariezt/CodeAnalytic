<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');ca_right_top('pages', 'pages form'); 

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
 * @link		http://docs.codeanalytic.com/view/pages_form
 */ 
?> 

<script type="text/javascript">
    $(function(){ 
        $('.title_permalink').keyup(function(){ 
            $('input.permalink').val(($(this).val()).replace(' ',''));
        })
    })  
    jQuery(document).ready(function () {	
        $('input.dateSimple').simpleDatepicker({x:0});
    });
</script>
<form id="myform" method="post" onsubmit="return false">
    <div class="main_left">
        <div id="center_content" class="big_form"> 
            <p>
                <input type="text"  name="title" <?php echo ca_auto_field('insert title here ...') ?> class="form_field title_permalink  keyboardInput" validation="required"  value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : 'insert title here ...'); ?>">
            </p> 
            <p>
                <textarea id="content" class="tinymce" name="content" style="width: 97%; height: 350px"><?php echo set_value('content', isset($default['content']) ? $default['content'] : ''); ?></textarea> 
            </p>  
        </div>
        <p>&nbsp;</p>
        <div class="box_form">
            <div id="top_tap"><span><?php echo ca_translate('like and share'); ?></span></div>
            <p>  
                <input type="checkbox" name="show_as_menu" class="form_field" value="1" <?php
if ($default['show_as_menu'] == '1') {
    echo "checked='TRUE'";
}
?>>
                       <?php echo ca_translate('show this post as menu') ?>
            </p>
            <p>  
                <input type="checkbox" name="is_like" class="form_field" value="1" <?php
                       if ($default['is_like'] == '1') {
                           echo "checked='TRUE'";
                       }
                       ?>>
                       <?php echo ca_translate('show like in this page') ?>
            </p> 
            <p>  
                <input type="checkbox" name="is_share" class="form_field" value="1" <?php
                       if ($default['is_share'] == '1') {
                           echo "checked='TRUE'";
                       }
                       ?>>
                       <?php echo ca_translate('show share button in this page') ?>
            </p> 
        </div>
    </div>
    <div class="main_right">
        <div class="small_form">
            <div class="box_form">
                <div class="notes">
                    <a style="padding-left: 30px;" href="http://codeanalytic.com/how-to-creat-a-page"><?php echo ca_translate('need help, how to creat a page?'); ?></a>
                </div>
            </div>
            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate('save or draft'); ?></span></div>
                <p id="bar_button">
                    <span style="float: left; margin-left: 10px;" id="btn_submit" >
                        <a href="javascript:void(0)" class="button-red rounded" onclick="<?php echo isset($type) ? "ca_add_action('pages/$action_form',$(this).parent().parent().parent().parent());" : "ca_edit_action('pages/$action_form',$(this).parent().parent().parent().parent())" ?>" > <?php echo isset($type) ? ca_translate('submit') : ca_translate('update') ?></a> 
                    </span>
                    <span style="float: right" id="btn_submit" >
                        <a id="btn_submit" href="javascript:void(0)" class="button-red rounded" onclick="ca_load('pages/index/', '#cen_right')">close</a>
                    </span>
                </p> 
            </div>
            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate('meta tag'); ?></span></div>
                <p>  
                    <label><?php echo ca_translate('Keyword'); ?> </label>
                    <input type="text" name="keyword" class="form_field keyboardInput" size="" validation="required"  value="<?php echo set_value('keyword', isset($default['keyword']) ? $default['keyword'] : ''); ?>">

                </p>
                <p> <i><?php echo ca_translate('separate with coma (,)') ?></i></p>
                <p>  
                    <label><?php echo ca_translate('description') ?></label>
                    <input type="text" name="description" class="form_field keyboardInput" validation="required"  value="<?php echo set_value('description', isset($default['description']) ? $default['description'] : ''); ?>">
                </p>
            </div>
            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate('date & time'); ?></span></div>
                <p>   
                    <input type="text" name="date" class="form_field dateSimple" size="" validation="required"  value="<?php echo set_value('date', isset($default['date']) ? $default['date'] : ''); ?>">
                </p>
                <div class="box_form">
                    <div id="top_tap"><span><?php echo ca_translate('url & permalink'); ?></span></div>
                    <?php if (isset($default['url'])) { ?>
                        <p>  
                            <label><?php echo ca_translate('url'); ?></label>
                            <input type="text" name="url" class="form_field link_page" size="" validation="required"  <?php echo isset($default['url']) ? "value='$default[url]'" : ''; ?>>
                        </p>
                    <?php } ?>
                    <p>  
                        <label><?php echo ca_translate('permalink'); ?></label>
                        <input type="hidden" name="old_permalink" class="form_field" size=""  value="<?php echo set_value('old_permalink', isset($default['old_permalink']) ? $default['old_permalink'] : ''); ?>">
                        <input type="text" name="permalink" class="form_field permalink" size="" validation="required"  value="<?php echo set_value('permalink', isset($default['permalink']) ? $default['permalink'] : ''); ?>">
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
ca_tiny_mce('textarea.tinymce', '1');
ca_vir_keyboard();
?>
