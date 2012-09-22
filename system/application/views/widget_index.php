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
 * @link		http://docs.codeanalytic.com/view/widget_index
 * 
 */
?>
<div id="top_tap">
    <span><?php echo ca_translate('codeanalytic widget for browser');?></span>
</div>
<a class="right_box" onclick='ca_close_setting()'>x</a>  
<div class="notes_no_remove">
    <?php echo ca_translate('click and drag the widget to widget area on the right.'); ?> or
    <a href="javascript:void(0)" class="button" onclick="ca_lightbox('dir/create_file/widgets/wi')"><?php echo ca_translate('create new file') ?></a>
<?php echo ca_translate('or'); ?> <?php echo ca_translate('choose file to upload'); ?> &nbsp;<a href="javascript:void(0)" id="upload" class="icons" ><?php echo ca_translate('upload') ?></a> 
</div>
<script type="text/javascript">
    $(function() {
        $("ul.droptrue").sortable({
            connectWith: 'ul'
        });
        $("div#des ul").sortable({
            update: function(){
                var order = $(this).sortable("serialize");
                $.ajax({
                    type:"POST",
                    url: site+"widget/order",
                    data: order,
                    success: function(response){
                        ca_load("widget/widget_list",'ul.widget_list');
                    },
                    error: function(xhr){
                        alert(xhr)
                    }
                });
            }
        });
        $("ul.dropfalse").sortable({ 
            update: function(){
                id=$(this).attr("id");
                var order = $(this).sortable("serialize");
                $.ajax({
                    type:"POST",
                    url: site+"widget/do_insert/"+id,
                    data: order,
                    success: function(response){
                        $("ul#"+id).html("{{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}");
                        ca_load('widget/get_current/'+id,"div.pos_"+id+" ul"); 
                    },
                    dataType:"html",
                    error: function(xhr){
                        alert(xhr)
                    }
                });
            }
        }); 
    });
     
</script>

<div class="table_list" style="width: 100%;margin-bottom: 40px;">
    <div class="daft_widget"> 
        <ul id="sortable1" class='droptrue widget_list'>

        </ul>
    </div>
    <div class="right_destination">        
<?php if (ca_template_setting('column_top') == 'TRUE') { ?>
            <div class="dest_head"> 
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_1')"> Header Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="1" class='dropfalse wi_1'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>    
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/1/0')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_1" id="des">
                <ul class="wi_1"></ul>
            </div>
<?php } if (ca_template_setting('column_timeline') == 'TRUE') { ?>
            <div class="dest_head">
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_5')"> Timeline Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="5" class='dropfalse wi_5'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/5/0')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_5" id="des">
                <ul class="wi_5"></ul>
            </div> 
<?php } if (ca_template_setting('column_right') == 'TRUE') { ?>
            <div class="dest_head">
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_2')"> Right Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="2" class='dropfalse wi_2'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/2/0')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_2" id="des">
                <ul class="wi_2"></ul>
            </div>
<?php } if (ca_template_setting('column_bottom') == 'TRUE') { ?>
            <div class="dest_head">
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_3')"> Bottom Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="3" class='dropfalse wi_3'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/3/0')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_3" id="des">
                <ul class="wi_3"></ul>
            </div>
<?php } if (ca_template_setting('column_left') == 'TRUE') { ?>
            <div class="dest_head">
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_4')"> Left Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="4" class='dropfalse wi_4'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/4/0')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_4" id="des">
                <ul class="wi_4" ></ul>
            </div>
<?php } ?>

    </div>
    <script type="text/javascript">
        $(function(){ 
<?php if (ca_template_setting('column_top') == 'TRUE') { ?>
            ca_load('widget/get_current/1',"div.pos_1 ul"); 
<?php } if (ca_template_setting('column_right') == 'TRUE') { ?>
            ca_load('widget/get_current/2',"div.pos_2 ul");
<?php } if (ca_template_setting('column_bottom') == 'TRUE') { ?>
            ca_load('widget/get_current/3',"div.pos_3 ul");
<?php } if (ca_template_setting('column_left') == 'TRUE') { ?>
            ca_load('widget/get_current/4',"div.pos_4 ul");
<?php } if (ca_template_setting('column_timeline') == 'TRUE') { ?>
            ca_load('widget/get_current/5',"div.pos_5 ul");
<?php } ?> 
        ca_load('widget/widget_list',"ul.widget_list");
                    
    })
                
    </script>
</div> 

<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload"), {
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
                    ca_notive('Your widgets is success to upload'); 
                    ca_load('widget/index',"#template_setting"); 
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  