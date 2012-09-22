<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/view/css_index
 */
?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tree/jqueryFileTree.js"></script>
<div id="top_tap">
    <span><?php echo ca_translate("codeanalytic file of theme current");?></span>
</div>
<a class="right_box" onclick='ca_close_setting()'>x</a> 
<div class="css_content">     
    <form class="max_dir"> 
        <div id="file_name">
            <h2><?php $ex = explode('codeanalytic_template/', $fname);
echo $ex['1'] ?></h2>
        </div>
        <div id="file_act" >
            <a style="float: left;" href="javascript:void(0)" type="button" class="button-red" id="btn_submit" onclick="ca_edit_action('dir/change/<?php echo $file ?>',this,'n');">
<?php echo ca_translate("submit"); ?>
            </a>
            <a style="float: left;" href="javascript:void(0)" onclick="ca_lightbox('dir/delete/<?php echo $file ?>/css')" class="button-red" ><?php echo ca_translate("delete"); ?></a>
            <a style="float: left;" href="javascript:void(0)" class="button-red" onclick="ca_max_application()">max</a>        
        </div> 
        <p>
            <textarea class="editor" name="content" style="width: 99%; height: 80%"><?php echo $text ?></textarea>
        </p> 
    </form>

</div>
<script type="text/javascript">
    $(document).ready( function() {				
        $('.css_list #tree').fileTree({ root: './system/application/views/<?php echo ca_theme_dir() ?>', script: '<?php echo site_url('css/tree') ?>' }, function(file) {  
            
            if(file != undefined){ 
                ex= file.split('.');
                id= ex.length -1;
                if(ex[id]=='png'||ex[id]=='jpg'||ex[id]=='gif'){
                    ca_lightbox('css/view_image/'+file);
                }else{
                    ca_load('css/view/'+file,'.css_content')
                }
            }
        });
    });
</script>
<div class="css_list css_dir"> 
    <div id="tree"></div>
</div>
<?php ca_editor_line(); ?>