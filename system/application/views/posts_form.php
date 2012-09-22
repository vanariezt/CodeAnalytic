<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');ca_right_top("posts", "posts form");

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
 * @link		http://docs.codeanalytic.com/view/posts_form
 */
?> 
<script type="text/javascript">
    $(function(){ 
        $('.title_permalink').keyup(function(){  
            $('input.permalink').val(($(this).val()));
        })
    })  
    jQuery(document).ready(function () {	
        $('input.dateSimple').simpleDatepicker({x:0});
    });
</script>
<form id="myform" method="post" onsubmit="return false">
    <div class="main_left">
        <div id="center_content" class="big_form"> 
            <p style="position: relative">
                <input type="text" name="title" <?php echo ca_auto_field('insert title here ...') ?> class="form_field keyboardInput title_permalink" validation="required" value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : 'insert title here ...') ?>">
            </p>
            <p>
                <textarea id="content" class="tinymce" name="content" style="width: 97%; height: 350px"><?php echo set_value('content', isset($default['content']) ? $default['content'] : ''); ?></textarea> 
            </p>             
        </div>
        <p>&nbsp;</p>
        <div class="box_form">
            <div id="top_tap"><span><?php echo ca_translate("like and share"); ?></span></div>
            <div>  
                <input type="checkbox" name="is_like" class="form_field" value="1" <?php
if ($default['is_like'] == '1') {
    echo "checked='TRUE'";
}
?>>
                       <?php echo ca_translate('show like in this post') ?>
            </div> 
            <div>  
                <input type="checkbox" name="is_share" class="form_field" value="1" <?php
                       if ($default['is_share'] == '1') {
                           echo "checked='TRUE'";
                       }
                       ?>>
                       <?php echo ca_translate('show share button in this post') ?>
            </div> 
        </div>
        <div class="box_form"> 
            <div id="top_tap"><span><?php echo ca_translate("meta tag"); ?></span></div>
            <p>  
                <label style="width: 25%"><?php echo ca_translate("keyword"); ?> </label> 
                <input type="text" style="width: 70%" name="keyword" class="form_field keyboardInput" size="" validation="required"  value="<?php echo set_value('keyword', isset($default['keyword']) ? $default['keyword'] : ''); ?>">
            <div style="margin-left: 10px"><i><?php echo ca_translate("separate with coma (,)") ?></i></div>
            </p>
            <p>  
                <label style="width: 25%"><?php echo ca_translate("description") ?></label>
                <input type="text" name="description" style="width: 70%" class="form_field keyboardInput" validation="required"  value="<?php echo set_value('description', isset($default['description']) ? $default['description'] : ''); ?>">
            </p>
        </div>
    </div>
    <div class="main_right">
        <div class="small_form">
            <div class="box_form">
                <div class="notes">
                    <a style="padding-left: 30px;" href="http://codeanalytic.com/how-to-creat-a-post"><?php echo ca_translate('need help, how to creat a post?'); ?></a>
                </div>
            </div>
            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate("save or draft"); ?></span></div>
                <p id="bar_button">
                    <span style="float: left; margin-left: 10px;" id="btn_submit" >
                        <a href="javascript:void(0)" class="button-red rounded" onclick="<?php echo isset($type) ? "ca_add_action('posts/$action_form',$(this).parent().parent().parent().parent());" : "ca_edit_action('posts/$action_form',$(this).parent().parent().parent().parent())" ?>" > <?php echo isset($type) ? "submit" : "update" ?></a> 
                    </span>
                    <span style="float: right" id="btn_submit" >
                        <a  id="btn_submit" href="javascript:void(0)" class="button-red rounded" onclick="ca_load('posts/index/', '#cen_right')">close</a>
                    </span>
                </p> 
            </div>
            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate("thumb"); ?></span></div>

                <input type="hidden" name="img" class="form_field thumb"  validation="required" value="<?php echo set_value('img', isset($default['img']) ? $default['img'] : 'codeanalytic_media_ca_thumb_small.jpg'); ?>">
                <div class="img_thumb">
                    <img src="<?php echo base_url() ?>assets/media/upload/image/<?php echo isset($default['img']) ? $default['img'] : 'codeanalytic_media_ca_thumb_small.jpg' ?>" align="center" valign="center">
                </div>

                <div class="img_thumb_act">
                    <div class="img_thumb_upload">
                        <a id="upload_media" href="javascript:void(0)" class="button_upload rounded" title="browse">U</a>
                    </div>
                    <div class="img_thumb_upload">
                        <a href="javascript:void(0)" class="button-red rounded" onclick="ca_lightbox('media/media_view/')">B</a>
                    </div>
                </div>
                <div style="float: left; width: 100%">  
                    <input type="checkbox" name="is_show_thumb" class="form_field" value="1" <?php
                       if ($default['is_show_thumb'] == '1') {
                           echo "checked='TRUE'";
                       }
                       ?>>
                           <?php echo ca_translate('check if you want show thumb nail in your post'); ?>
                </div>
            </div>

            <div class="box_form">
                <div id="top_tap"><span><?php echo ca_translate("categories"); ?></span></div>
                <div>
                    <?php
                    if ($cat->num_rows() > 0) {
                        foreach ($cat->result() as $r) {
                            $check='';
                            if (empty($type)) {
                                if (in_array($r->id, $cat_id)) {
                                    $check = 'checked';
                                } 
                            }
                            ?>
                            <input type="checkbox" name="cat_id[]" <?php echo $check ?> value="<?php echo $r->id; ?>"> <?php echo $r->name ?><br/>
                            <?php
                        }
                    }
                    ?>
                </div>
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
<?php ca_ajax_upload("a#upload_media", "jpg|jpeg|png|gif", "media/image_upload", "input.thumb", "div.img_thumb img") ?>
<?php ca_tiny_mce('textarea.tinymce', '1'); ?>
<?php ca_vir_keyboard() ?>