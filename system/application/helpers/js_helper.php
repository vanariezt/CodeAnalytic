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
 * js Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/js_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */


/**
 * ca_vir_keyboard()
 * @access public
 * @category javascript library
 * this function is help you to type with another language
 * like : arabic, mandarin , etc
 * you can embed this funtion in form input and textarea
 *  
 * @example <input class="keboardInput" name="username">
 * <?php ca_vir_keyboard() ?>
 */
if (!function_exists('ca_vir_keyboard')) {

    function ca_vir_keyboard() {
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>system/application/third_party/keyboard/keyboard.css" /> 
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/keyboard/keyboard.js" charset="UTF-8"></script>  

        <script type="text/javascript">
            var inputElems = [
                document.getElementsByTagName('input'),
                document.getElementsByTagName('textarea'), 
            ];
            for (var x = 0, elem; elem = inputElems[x++];)
                for (var y = 0, ex; ex = elem[y++];)
                    if (ex.nodeName == "TEXTAREA" || ex.type == "text" || ex.type == "password")
                        if (ex.className.indexOf("keyboardInput") > -1) VKI_attach(ex);

            VKI_addListener(document.documentElement, 'click', function(e) { self.VKI_close(); }, false);
        </script>
        <?php
    }

}

/**
 * ca_alert()
 * @access publick
 * get alert 
 */
if (!function_exists('ca_alert')) {

    function ca_alert($message) {
        ?>
        <script type="text/javascript"> 
            alert("<?php echo $message ?>")
        </script>
        <?php
    }

}
/**
 * ca_back()
 * @access public
 * @category javascript function
 * get back location using javascript
 * @example
 *  <a href="javascript:void(0)" onclick="<?php ca_back() ?>">back</a>
 *  or <?php ca_back() ?>
 */
if (!function_exists('ca_back')) {

    function ca_back() {
        ?>
        <script type="text/javascript"> 
            javascript:history.back(1); 
        </script>
        <?php
    }

}
/* |
  | Helper : ca_editor_line
  |----------------------------------------------------------------------------
  | Get return editor line
  |----------------------------------------------------------------------------
  |
 */

if (!function_exists('ca_editor_line')) {

    function ca_editor_line($attr = '.editor') {
        ?>
        <script src="<?php echo base_url() ?>assets/js/linked/jquery-linedtextarea.js"></script>
        <link href="<?php echo base_url() ?>assets/js/linked/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
        <script>
            $(function() {
                $("<?php echo $attr ?>").linedtextarea(); 
            });    
        </script>
        <?php
    }

}

/* |
  | Helper : ca_split_lenght
  |----------------------------------------------------------------------------
  | Get return value leng of split css
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_split_lenght')) {

    function ca_split_lenght() {
        ?>
        <script type="text/javascript">
            $(function(){
                $(".cen_split").css({
                    height:$("#center").height()
                }) 
                                                                                                                                                                                                            
            })
        </script>
        <?php
    }

}
/**
 * function ca_ajax_upload();
 * @access public
 * get simple animation upload with ajax
 * @category javascript library
 * @example <a href="javascript:void(0)" id="ajaxUpload">ajax upload</a>
 * $attr in this case a#ajaxUpload
 * $type is type file allowed for upload, if more than one split with (|) ex: jpg|png
 * $url is destination url where the image is proccess
 * $dest and $dest2 is the elemen where you will place the return value
 * 
 * <?php ca_ajax_upload($attr, $check, $url, $dest1, $dest2) ?>
 */
if (!function_exists('ca_ajax_upload')) {

    function ca_ajax_upload($attr, $type, $url, $dest1, $dest2) {
        ?>
        <script type="text/javascript">  
            $(function(){ 
                new AjaxUpload($("<?php echo $attr ?>"), {
                    action: site+'<?php echo $url ?>',
                    name: 'userfile',
                    onSubmit: function(file, ext){
                        if (! (ext && /^(<?php echo $type ?>)$/.test(ext))){
                            ca_notive('Only <?php echo $type ?> files are allowed');
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
                            /**
                             * create thumb small thumbnail
                             * and this return value will be view in element dest1 and dest2
                             */
                            $.ajax({ 
                                url:site+"media/image_thumb_small/"+response,
                                success: function(rs){
                                    ca_close_box();
                                    $("ul.list_image").append("<li>"+
                                        "<img onclick='FileBrowserDialogue.mySubmit(this.src);' id='caImage'  src='"+site+'assets/media/upload/image/'+rs+"'/>"+
                                        "<a href='javascript:void(0)' onclick='ca_light_delete(this)' class='button-red'>x</a>"+
                                        "</li>");   
                                    $("<?php echo $dest1 ?>").val(rs)
                                    $("<?php echo $dest2 ?>").attr("src", '<?php echo base_url() ?>assets/media/upload/image/'+rs);
                                        
                                }
                            }) 
                            /**
                             * create middle thumbnail
                             */
                            $.ajax({ 
                                url:site+"media/image_thumb_middle/"+response                        
                            })       
                            /**
                             * close the lightbox and view message
                             */
                            ca_close_box();
                            ca_notive('file is success uploaded');
                        } else{
                            ca_notive(response);
                        }
                    }
                });
            }) 
        </script>
        <?php
    }

}
/**
 * End of js_helper.php
 * Location : systme/application/helpers/js_heler.php
 */
?>
