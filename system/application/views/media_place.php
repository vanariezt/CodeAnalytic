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
 * @link		http://docs.codeanalytic.com/view/media_place
 */ 
?>
<script type='text/javascript'>
    var site = "<?php echo base_url(); ?>";
    var loadImg = "<img src='<?php echo base_url(); ?>assets/loading.gif' align='center'/>";  
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/panel/tinymce.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/panel/lightbox.css"/>

<script language="javascript" type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/tinymce/tiny_mce_popup.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/upload/ajaxupload.js"></script>

<script type="text/javascript"> 
    $(function(){  
        ca_notive('successfull','tiny');
        new AjaxUpload($("a#upload_image"), {
            action: site+'media/image_upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|jpeg|png|gif)$/.test(ext))){
                    ca_notive('Only jpg|jpeg|png|gif files are allowed','tiny');
                    return false;
                }  
                ca_loading('tiny');
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
                                "<img style='width:100px; height:75px; cursor:pointer' onclick='FileBrowserDialogue.mySubmit(this.src);' id='caImage'  src='"+site+'assets/media/upload/image/'+rs+"'/>"+ 
                                "</li>");                       
                        }
                    }) 
                    $.ajax({ 
                        url:site+"media/image_thumb_middle/"+response
                        
                    }) 
                    
                }  else{
                    ca_notive(response);
                }
            }
        });
    })  
    var FileBrowserDialogue = { 
        init : function () {
        },
        mySubmit : function (src) {
            var URL = src.replace('small','big');
            var win = tinyMCEPopup.getWindowArg("window");
            win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;
            win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;
            win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;
            if (typeof(win.ImageDialog) != "undefined")
            {
                
                if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
                if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(URL);
            }
            tinyMCEPopup.close();
        }
    }

    tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script>
<div class="box-image i_img">
    <div id="top_tap">
        <span>Image</span>
        <a id="upload_image"  href="javascript:void(0)" class="button_upload" >Upload</a>
    </div> 
    <div id="notive"></div>
    <ul class="list_image">
        <?php
        $dir = opendir(base_upload() . 'image/');
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, 'small.gif', 1) || strpos($file, 'small.jpg', 1) || strpos($file, 'small.png', 1) || strpos($file, 'small.jpeg', 1)) {
                echo "<li><img style='width:100px; height:75px; cursor:pointer' onclick='FileBrowserDialogue.mySubmit(this.src);' id='caImage' src='" . base_url() . "assets/media/upload/image/" . $file . "'/></li>";
            }
        }
        ?>
    </ul> 
</div> 



