<div id="top_tap" class="dinamic_tap">
    <span><?php echo ca_translate("menu form") ?></span>            
</div>
<div class="small_form" style="border-right: 1px solid #EBEBEB; float: left; padding-right: 5px "> 
    <form id="myform" method="post" onsubmit="return false;">
        <p>
            <label style="width: 28%"><?php echo ca_translate('title');?></label>
            <input type="text" name="title"  style="width: 65%" class="form_field keyboardInput" validation="required" value="<?php echo set_value('title', isset($default['title']) ? $default['title'] : ''); ?>">

        </p> 
        <p>
            <label style="width: 28%"><?php echo ca_translate('parent');?></label>
            <?php echo form_dropdown('parent', $parent, isset($default['parent']) ? $default['parent'] : '', "class ='form_field' style='width:68%'");
            ?>
        </p>
        <p>
            <label style="width: 28%"><?php echo ca_translate('url');?></label>
            <input type="text" name="url" style="width: 68%" class="form_field" validation="required" value="<?php echo set_value('url', isset($default['url']) ? $default['url'] : ''); ?>">
        </p>
        <p>
            <label  style="width: 28%"><?php echo ca_translate('target');?></label>
            <span style="float: left;width: 68%">
                <input type="radio" style="float: left; width: 10px" name="target" value="_blank" class="form_field" <?php if($default['target']=='_blank'){ echo "checked=TRUE"; } ?>><?php echo ca_translate('_blank — new window or tab');?>  <br/>
                <input type="radio" style="float: left; width: 10px" name="target" value="_top" class="form_field" <?php if($default['target']=='_top'){ echo "checked=TRUE"; } ?>><?php echo ca_translate('_top — current window, without frame');?>  <br/>
                <input type="radio" style="float: left; width: 10px" name="target" value="_self" class="form_field" <?php if($default['target']=='_self'){ echo "checked=TRUE"; } ?>><?php echo ca_translate('_self — same window or tab');?> 
            </span>
        </p>
        <p>
            <label  style="width: 28%"><?php echo ca_translate('class');?></label>
            <input type="text" name="attr_class"  style="width: 68%" class="form_field" value="<?php echo set_value('attr_class', isset($default['attr_class']) ? $default['attr_class'] : ''); ?>">
            <span style="float: left; margin-left: 31%"><?php echo ca_translate("separate with coma (,)") ?></span>
        </p>
        <p>
            <label  style="width: 28%"><?php echo ca_translate('id');?></label>
            <input type="text" name="attr_id"  style="width: 68%" class="form_field" value="<?php echo set_value('attr_id', isset($default['attr_id']) ? $default['attr_id'] : ''); ?>">
        </p>
        <p id="p_submit" style="float: left; margin-left: -2.7%;">
        <a href="javascript:void(0)" style="left: 31%" id="btn_submit" onclick="<?php echo isset($type) ? "ca_add_action('menu/$action_form',this);" : "ca_edit_action('menu/$action_form',this)" ?>" > <?php echo isset($type) ? ca_translate("submit") : ca_translate("update") ?></a> 
            <a id="btn_submit" style="left: 31%" href="javascript:void(0)" onclick="ca_load('menu/index/', '#cen_right')"><?php echo ca_translate("reset");?></a>
        </p> 
    </form> 
</div>
<?php ca_vir_keyboard() ?>