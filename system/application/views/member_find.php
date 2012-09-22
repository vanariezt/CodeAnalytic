<div id="search_content">
    <div id="left">
    <form id="myform" method="post" onsubmit="return false">
        <p>
            <label><?php echo ca_translate('username');?></label>
            <input type="text" name="s_username" size="45" class="form_field">
        </p>    
        <p>
            <label><?php echo ca_translate('email')?></label>
            <input type="text" name="s_email" size="45" class="form_field">
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