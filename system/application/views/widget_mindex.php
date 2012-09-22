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
    <span><?php echo ca_translate('codeanalytic widget for mobile'); ?></span>
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
                    url: site+"widget/do_insert/"+id+"/1",
                    data: order,
                    success: function(response){
                        $("ul#"+id).html("{{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}");
                        ca_load('widget/get_current/'+id+'/1',"div.pos_"+id+" ul"); 
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
        <?php if (ca_mobile_setting('m_column_top') == 'TRUE') { ?>
            <div class="dest_head"> 
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_6')"> Mobile Top Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="6" class='dropfalse wi_6'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>    
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/6/1')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_6" id="des">
                <ul class="wi_6"></ul>
            </div>
        <?php } if (ca_mobile_setting('m_column_bottom') == 'TRUE') { ?>
            <div class="dest_head">
                <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'ul.wi_7')"> Mobile Bottom Widget Area</a> 
            </div>
            <div class="drag_here">
                <ul id="7" class='dropfalse wi_7'>
                    {{ <?php echo ca_translate("drag here <i> ( place your widget here )</i>"); ?> }}
                </ul>
            </div>
            <div class="htmlarea">
                <a href="javascript:void(0)" onclick="ca_lightbox('htmlarea/insert/7/1')"><?php echo ca_translate('add new html area') ?></a>
            </div>
            <div class="pos_7" id="des">
                <ul class="wi_7"></ul>
            </div> 
        <?php } ?>

    </div>
    <script type="text/javascript">
        $(function(){ 
<?php if (ca_mobile_setting('m_column_top') == 'TRUE') { ?>
            ca_load('widget/get_current/6/1',"div.pos_6 ul"); 
<?php } if (ca_mobile_setting('m_column_bottom') == 'TRUE') { ?>
            ca_load('widget/get_current/7/1',"div.pos_7 ul");
<?php } ?>
    ca_load('widget/widget_list/1',"ul.widget_list");
    })
                
    </script>
</div> 

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
                    ca_notive('Your widgets is success to upload'); 
                    ca_load('widget/mobile',"#template_setting"); 
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  