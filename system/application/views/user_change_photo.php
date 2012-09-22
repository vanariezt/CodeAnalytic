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
 * @link		http://docs.codeanalytic.com/view/user_change_photo
 */ 
?>
<div class="header">
    <h2><?php echo ca_translate('change your photo profile'); ?></h2>
</div>
<p> 
    <img class="img_user" src="<?php echo base_url() . "assets/images/user/" . $row->photo ?>" align="left" style="float: left">
    Hi, &nbsp;<?php echo $row->first_name . " (" . $row->username . ")"; ?> 
    Click <a href="javascript:void(0)" id="upload">upload</a> to change and upload new photo
</p>  
<div class="footer">
    <a class="button-red"  href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate("exit"); ?></a>
</div>
<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload"), {
            action: site+'user/upload',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|gif)$/.test(ext))){
                    ca_notive('Only jpg|png|gif files are allowed');
                    return false;
                }  
            },
            onComplete: function(file,res){ 
                /**
                 * using js funtion split, cause in any part of my time, I found bugs string in some case
                 * <div id="mediaScreenId"></div>
                 * so I try to split and get the right value
                 */
                x=res.split('<div');
                response=x['0'];    
                if(response!="error"){ 
                        $.ajax({ 
                            url:site+"user/image_thumb_small/"+response,
                            success: function(){
                                $("img.img_user").attr("src",'<?php echo base_url() ?>assets/images/user/'+response); 
                                $("div#top_account a img#img").attr("src",'<?php echo base_url() ?>assets/images/user/'+response);
                        
                            }
                            ,error : function(x,h,r){
                                alert(r.status);
                            }
                        }) 
                    } else{
                        alert(response);
                    }
                }
            });
        })
</script>