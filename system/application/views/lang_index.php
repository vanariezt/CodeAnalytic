<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.js"></script>

<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="language">
            <h2><?php echo ca_translate('language') ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?> 
</div>
<div id="bar_button">
    <div id="bar_button_left">&nbsp;</div>
    <div id="bar_button_right"> 
        <?php echo ca_translate('choose file languages to upload'); ?> &nbsp;<a href="javascript:void(0)" id="upload" class="icons" ><?php echo ca_translate('upload') ?></a> 
    </div>
</div>
<div class="notes"><?php echo ca_translate("you can add or edit language translate as you want here. need help, how to upload and setting language in CA ? please visit http://codeanalytic.com/lang"); ?></div>

<div class="css_content">
    <form class="max_dir">
        <div id="file_name">
            <h2><?php echo $dir ?></h2>
        </div>
        <div id="file_act">
            <a style="float: left;" href="javascript:void(0)" type="button" class="button-red" id="btn_submit" onclick="ca_edit_action('dir/change/<?php echo $file ?>',this);">
                <?php echo ca_translate("submit"); ?>
            </a>
            <a style="float: left;" href="javascript:void(0)" onclick="ca_lightbox('dir/delete/<?php echo $file ?>/lang')" class="button-red" ><?php echo ca_translate("delete"); ?></a>
            <a style="float: left;" href="javascript:void(0)" class="button-red" onclick="ca_max_application()">max</a>    
        </div>
        <p>
            <textarea class="editor" name="content" style="width: 100%;"><?php echo $text ?></textarea>
        </p>
    </form>
</div>
<div class="css_list"> 

    <div class="list_app" class="db_view" style="margin-left: 10px;border-bottom: none;">
        <a href="javascript:void(0)" id="header" class="show" onclick="ca_slide_(this,'ul.db_config')">config</a> 
    </div>
    <ul class="db_config" style="margin-left: 10px;border-bottom: none; display: none">  
        <li>
            <a href="javascript:void(0)" class="button icon_js" onclick="ca_selected(this); ca_load('languages/view/.-assets-js-codeanalytic.lang.js','.css_content')">codeanalytic.lang.js</a>
        </li>
        <li>
            <a href="javascript:void(0)" class="button icon_php" onclick="ca_selected(this); ca_load('languages/view/.-system-application-config-lang_detect.php','.css_content')">lang_detect.php</a>
        </li>
    </ul>

   <script type="text/javascript">
    $(document).ready( function() {				
        $('.css_list #tree').fileTree({ root: './system/application/language/', script: '<?php echo site_url('languages/tree') ?>' }, function(file) {  
            
            if(file != undefined){ 
                ex= file.split('.');
                id= ex.length -1;
                if(ex[id]=='png'||ex[id]=='jpg'||ex[id]=='gif'){
                    ca_lightbox('laguages/view_image/'+file);
                }else{
                    ca_load('languages/view/'+file,'.css_content')
                }
            }
        });
    });
</script>
<div class="css_list css_dir"> 
    <div id="tree"></div>
</div>
<?php ca_editor_line(); ?>

<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload"), {
            action: site+'/dir/upload/',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(zip)$/.test(ext))){
                    ca_notive('Only zip files are allowed');
                    return false;
                }
                 
            },
            onComplete: function(file, response){
                if(response!="error"){
                    ca_load('languages/',"#cen_right"); 
                    ca_notive('Your language is success to upload');
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  