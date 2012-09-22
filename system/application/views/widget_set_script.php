<div class="header">
    <h2><?php echo ca_translate('choose file to update');?></h2>
</div>
<div class="content">
    <a href="javascript:void(0)" class="box-wi" onclick="ca_lightbox('dir/pop_up/<?php echo $f ?>/widgets')"><?php echo ca_translate('widget script');?></a>
    <a href="javascript:void(0)" class="box-wi" onclick="ca_lightbox('dir/pop_up/<?php echo $config ?>/widgets')"><?php echo ca_translate('widget config');?></a>
</div>
<div class="footer">
    <a href="javascript:void(0)" class="button-red" onclick="ca_close_box()"><?php echo ca_translate('close') ?></a>
</div>