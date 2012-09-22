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
 * @link		http://docs.codeanalytic.com/view/media_index
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="media">
            <h2>media</h2>
        </div>           
    </div>
    <div id="bar_button_right">
        <a href="javascript:void(0)" class="icons" onclick="ca_i_show('.i_doc')"><?php echo ca_translate('document') ?></a>
        <a href="javascript:void(0)" class="icons" onclick="ca_i_show('.i_img')"><?php echo ca_translate('image') ?></a>  
        <a href="javascript:void(0)" class="icons" onclick="ca_i_show('.i_zip')"><?php echo ca_translate('zip') ?></a>
        <a href="javascript:void(0)" class="icons" onclick="ca_lightbox('media/config')"><?php echo ca_translate('setting') ?></a>
    </div>
</div>
<div class="notes">
    <?php echo ca_translate("all media files that you upload will be stored here. it's safe on directory where you upload as in document, image, or zip file format."); ?>
</div>
<div class="box-image i_doc">
    <div id="top_tap">
        <span><?php echo ca_translate('document'); ?></span>
        <a id="upload_doc" href="javascript:void(0)" ><span><?php echo ca_translate('upload'); ?></span></a>
    </div>
    <ul class="list_doc">
        <?php
        $dir = opendir(base_upload() . 'doc/');
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, '.xls', 1) || strpos($file, '.txt', 1) || strpos($file, '.xlsx', 1) || strpos($file, '.docx', 1) || strpos($file, '.doc', 1) || strpos($file, '.pptx', 1) || strpos($file, '.ppt', 1) || strpos($file, '.pdf', 1)) {
                $ex = explode('.', $file);
                $filename = substr($file, 0, 10) . '..';
                echo "<li class='icon_$ex[1]'>
                        <span id='caImage'  dir='" . base_upload() . "doc/" . $file . "'>$filename</span>
                        <a href='javascript:void(0)' onclick='ca_file_delete(this)' class='button-red'>x</a>
                      </li>";
            }
        }
        ?>

    </ul> 
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.media.tooltip.js"></script>  

<div class="box-image i_img" style="display: none">
    <div id="top_tap">
        <span><?php echo ca_translate('image'); ?></span>
        <a id="upload"  href="javascript:void(0)"><span><?php echo ca_translate('upload'); ?></span></a>
    </div> 
    <ul class="list_image">
        <?php
        $dir = opendir(base_upload() . 'image/');
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, 'small.gif', 1) || strpos($file, 'small.jpg', 1) || strpos($file, 'small.png', 1) || strpos($file, 'small.jpeg', 1)) {
                $middle = str_replace('small', 'middle', $file);
                echo "<li>
                        <a href='javascript:void(0)' class='screenshot' name='$file' rel='" . base_upload() . 'image/' . $middle . "'>
                            <img onclick='FileBrowserDialogue.mySubmit(this.src);' id='caImage'  src='" . base_upload() . 'image/' . $file . "'/>
                        </a>
                        <a href='javascript:void(0)' onclick='ca_light_delete(this)' class='button-red'>x</a>
                        <!--<a href='javascript:void(0)' style='top:30px;' onclick='ca_image_setting(this)' class='button-red'>/</a>-->
                      </li>";
            }
        }
        ?>
    </ul>
</div>  
<div class="box-image i_zip" style="display: none">
    <div id="top_tap">
        <span><?php echo ca_translate('zip'); ?></span>
        <a id="upload_zip" href="javascript:void(0)" ><span><?php echo ca_translate('upload'); ?></span></a>
    </div>
    <ul class="list_zip">
        <?php
        $dir = opendir(base_upload() . 'zip/');
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, '.zip', 1)) {
                $filename = substr($file, 0, 10) . '..';
                echo "<li class='icon_zip'>
                        <span id='caImage'  dir='" . base_upload() . "zip/" . $file . "'>$filename</span>
                        <a href='javascript:void(0)' onclick='ca_file_delete(this)' class='button-red rounded'>x</a>
                      </li>";
            }
        }
        ?>

    </ul> 
</div>
<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload"), {
            action: site+'media/image_upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(<?php echo ca_setting('type_image', 'media') ?>)$/.test(ext))){
                    ca_notive('Only <?php echo ca_setting('type_image', 'media') ?> files are allowed');
                    return false;
                } 
                ca_loading();
            },
            onComplete: function(file, res){ 
                /**
                 * using js funtion split, cause in any part of my time, I found bugs string in some case
                 * <div id="mediaScreenId"></div>
                 * so I try to split and get the right value
                 */
                x=res.split('<div');
                response=x['0'];    
                if(response!="error"){ 
                    $.ajax({ 
                        url:site+"media/image_thumb_small/"+response,
                        success: function(rs){
                            ca_close_box();
                            $("ul.list_image").append("<li>"+
                                "<a href='javascript:void(0)'>"+
                                      "<img onclick='FileBrowserDialogue.mySubmit(this.src);' id='caImage'  src='"+'./assets/media/upload/image/'+rs+"'/>"+
                                "</a>"+
                                "<a href='javascript:void(0)' onclick='ca_light_delete(this)' class='button-red'>x</a>"+
                                "</li>");                       
                        }
                    }) 
                    $.ajax({ 
                        url:site+"media/image_thumb_middle/"+response                        
                    }) 
                    
                }  else{
                    ca_notive(response+' file max size[<?php echo ca_setting('max-file-size', 'media') ?>]kb');
                }
            }
        });
    })
    
</script>  
<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload_doc"), {
            action: site+'media/doc_upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(<?php echo ca_setting('type_document', 'media') ?>)$/.test(ext))){
                    ca_notive('Only <?php echo ca_setting('type_document', 'media') ?> files are allowed');
                    return false;
                }  
            },
            onComplete: function(file, res){ 
                /**
                 * using js funtion split, cause in any part of my time, I found bugs string in some case
                 * <div id="mediaScreenId"></div>
                 * so I try to split and get the right value
                 */
                x=res.split('<div');
                response=x['0'];     
                if(response!="error"){  
                    $("input.thumb").val(response)
                    e=response.split('.');
                    var responename=response.substr(0, 10)+'...';
                    $("ul.list_doc").append("<li class='icon_"+e['1']+"'><span id='caImage' style='width:75px;height:55px;' dir='<?php echo base_upload() ?>doc/"+response+"'>"+responename+"</span>\n\
                    <a href='javascript:void(0)' onclick='ca_file_delete(this)' class='button-red rounded'>x</a></li>");
                } else{
                    ca_notive(response+' file max size[<?php echo ca_setting('max-file-size', 'media') ?>]kb');
                }
            }
        });
    })
</script>
<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload_zip"), {
            action: site+'media/zip_upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(<?php echo ca_setting('type_zip', 'media') ?>)$/.test(ext))){
                    ca_notive('Only <?php echo ca_setting('type_zip', 'media') ?> files are allowed');
                    return false;
                }  
            },
            onComplete: function(file,  res){ 
                /**
                 * using js funtion split, cause in any part of my time, I found bugs string in some case
                 * <div id="mediaScreenId"></div>
                 * so I try to split and get the right value
                 */
                x=res.split('<div');
                response=x['0'];    
                if(response!="error"){  
                    $("input.thumb").val(response)
                    var responename=response.substr(0, 10)+'...';
                    $("ul.list_zip").append("<li><span id='caImage' style='width:75px;height:55px;' dir='<?php echo base_upload() ?>zip/"+response+"'>"+responename+"</span>\n\
                    <a href='javascript:void(0)' onclick='ca_file_delete(this)' class='button-red rounded'>x</a></li>");
                } else{
                    ca_notive(response+' file max size[<?php echo ca_setting('max-file-size', 'media') ?>]kb');
                }
            }
        });
    })
</script>