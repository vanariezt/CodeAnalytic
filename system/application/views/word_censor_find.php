<div id="search_content">
    <div id="left">
    <form id="myform" method="post" onsubmit="return false">
        <p>
            <label><?php echo ca_translate('title');?></label>
            <input type="text" name="s_word" size="45" class="form_field keyboardInput">
        </p> 
        <p id="p_submit">
            <a href="javascript:void(0)"  id="btn_submit" onclick="ca_find_action('<?php echo $action_form ?> ','#center_content');"> <?php echo ca_translate('search') ?></a> 
            <a id="btn_submit" href="javascript:void(0)" onclick="ca_close_find()"><?php echo ca_translate('close');?></a>
        </p> 
    </form> 
    </div>
    <div id="right">
        <div id="top_tap">
            <span><?php echo ca_translate('search information');?></span>
        </div>
        <div id="s_info"></div>
    </div>
</div>
<?php ca_vir_keyboard(); ?>