<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.js"></script>

<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="dir">
            <h2><?php echo ca_translate('application') ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?> 
</div>
<div id="bar_button">
    <div id="bar_button_left">&nbsp;</div>
    <div id="bar_button_right"> 
        <?php echo ca_translate('choose file to upload'); ?> &nbsp;<a href="javascript:void(0)" id="upload_dir" class="icons" ><?php echo ca_translate('upload') ?></a> 
    </div>
</div>

<div class="notes"><?php echo ca_translate("you can write program directly here, as you write on the IDE. Make a plugin, widget with easy even make modules - new modules to the concept of MVC."); ?></div>

<div class="css_content">
    <form class="max_dir">
        <div id="file_name">
            <h2><?php echo $dir ?></h2>
        </div>
        <div id="file_act">
            <a style="float: left;" href="javascript:void(0)" type="button" class="button-red" id="btn_submit" onclick="ca_edit_action('dir/change/<?php echo $file ?>',this,'n');">
                <?php echo ca_translate("submit"); ?>
            </a>
            <a style="float: left;" href="javascript:void(0)" onclick="ca_lightbox('dir/delete/<?php echo $file ?>')" class="button-red" ><?php echo ca_translate('delete'); ?></a>
            <a style="float: left;" href="javascript:void(0)" class="button-red" onclick="ca_max_application()">max</a>    
        </div>
        <p>
            <textarea class="editor" name="content" style="width: 100%;"><?php echo $text ?></textarea>
        </p> 
    </form>

</div>

<script type="text/javascript">
    $(document).ready( function() {				
        $('.css_list #tree').fileTree({ root: './', script: '<?php echo site_url('dir/tree') ?>' }, function(file) {  
            
            if(file != undefined){ 
                ex= file.split('.');
                id= ex.length -1;
                if(ex[id]=='png'||ex[id]=='jpg'||ex[id]=='gif'){
                    ca_lightbox('dir/view_image/'+file);
                }else{
                    ca_load('dir/view/'+file,'.css_content')
                }
            }
        });
    });
</script>
<div class="css_list">    
    <div id="tree"></div>
</div>
<script type="text/javascript">
    
    $(function(){ 
        new AjaxUpload($("a#upload_dir"), {
            action: site+'dir/upload/',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(zip)$/.test(ext))){
                    ca_notive('Only zip files are allowed');
                    return false;
                }
                 
            },
            onComplete: function(file, response){ 
                if(response!="error"){
                    ca_load('dir/',"#cen_right"); 
                    ca_notive('Your application is success to upload');
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  
<?php ca_editor_line(); ?>