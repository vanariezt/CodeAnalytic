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
 * @link		http://docs.codeanalytic.com/view/gallery_form
 */ 
?>

<div id="top_tap" class="dinamic_tap">
    <span><?php echo ca_translate("gallery form") ?></span>            
</div>
<div class="small_form" style="border-right: 1px solid #EBEBEB; float: left; padding-right: 5px"> 
    <form id="myform" method="post" onsubmit="return false"> 
        <p>
            <label style="width: 28%"><?php echo ca_translate('title'); ?></label>
            <input type="text" name="title" validation="required" style="width: 65%" class="keyboardInput" value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : ''); ?>">
        </p>
        <p>
            <label style="width: 28%"><?php echo ca_translate('album'); ?></label>
            <?php echo form_dropdown('album', $album, isset($default['album']) ? $default['album'] : '', 'validation="required" style="width:55%"'); ?>
            &nbsp; <a href="javascript:void(0)" class="screenshot" title="add new album" onclick="ca_lightbox('album/insert/lightbox')">...</a>
        </p>
        <div class="box_form">
            <div id="top_tap"><span><?php echo ca_translate("thumb"); ?></span></div>
            <input type="hidden" name="image" class="form_field thumb"  validation="required" value="<?php echo set_value('image', isset($default['image']) ? $default['image'] : 'codeanalytic_media_ca_thumb_small.jpg'); ?>">
            <div class="img_thumb" style="float: left">
                <image src="<?php echo base_url() ?>assets/media/upload/image/<?php echo isset($default['image']) ? $default['image'] : 'codeanalytic_media_ca_thumb_small.jpg' ?>" align="center" valign="center">
            </div>
            <div class="img_thumb_act" style="float: left">
                <div class="img_thumb_upload">
                    <a id="upload_media" href="javascript:void(0)" class="button_upload rounded" title="browse">U</a>
                </div>
                <div class="img_thumb_upload">
                    <a href="javascript:void(0)" class="button-red rounded" onclick="ca_lightbox('media/media_view/')">B</a>
                </div>
            </div>
        </div> 
        <div class="box_form">
            <div id="top_tap"><span><?php echo ca_translate("description"); ?></span></div> 
            <textarea name="description" style="width: 93%; border: 1px solid #EBEBEB; margin-left: 8px;" class="keyboardInput" rows="5" validation="required"><?php echo set_value('description', isset($default['description']) ? $default['description'] : ''); ?></textarea>
        </div> 
        <p id="p_submit"  style="width: 98%; margin-left: -3.3%">
            <a style="left: 11px" href="javascript:void(0)"  id="btn_submit" onclick="<?php echo isset($type) ? "ca_add_action('gallery/$action_form',this);" : "ca_edit_action('gallery/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
            <a style="left: 11px" id="btn_submit" href="javascript:void(0)" onclick="ca_load('gallery/data/', '#cen_right')"><?php echo ca_translate('reset') ?></a>
        </p>    
    </form>
</div>
<?php ca_ajax_upload('a#upload_media', 'jpg|jpeg|png|gif', 'media/image_upload', 'input.thumb', 'div.img_thumb img') ?>
<?php ca_vir_keyboard() ?>