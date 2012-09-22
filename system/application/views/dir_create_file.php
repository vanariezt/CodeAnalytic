<div class="notes">
    <?php 
        $dir = $temp;
    ?>
    <div class="notes">
        <div>
            <?php echo ca_translate("crete new file in"); ?> <?php echo $dir ?>
        </div>
        <div>
            <?php echo $file_allowed; ?>
        </div>
    </div>

    <form id="" style="width: 100%; margin-bottom: 10px; float: left;">
        <p> 
            <input validation="required" style="width: 100%" type="text" name="file_name" value="<?php echo isset($default['file_name']) ? $default['file_name'] : '' ?>">
        </p>
    </form>
</div>
<div class='footer' style="width: 98%"> 
    <a type="btn_launcher" class="button-red" onclick="ca_create_file('<?php echo $file ?>','<?php echo $ext ?>','<?php echo $m ?>')"><?php echo ca_translate("yes"); ?></a>
    <a type="btn_launcher" class="button-red" onclick="ca_close_box()" ><?php echo ca_translate("no"); ?></a>
</div>
