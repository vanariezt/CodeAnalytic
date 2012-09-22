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
 * @link		http://docs.codeanalytic.com/view/template index
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="template">
            <h2><?php echo ca_translate('template');?></h2>
        </div>
    </div> 
    <div id="bar_button_right">
        <a href="javascript:void(0)" class="icons" onclick="ca_load('template/index/', '#cen_right')"><?php echo ca_translate('list') ?></a>        
        <a href="javascript:void(0)" class="icons" id="upload_template" ><?php echo ca_translate('add') ?></a> 
        <a href="javascript:void(0)" class="icons" onclick="ca_delete_view('template/delete')"><?php echo ca_translate('delete') ?></a>
    </div> 
</div>
<div>
    <?php
    $r = $this->mtemplate->used();
    ?>
    <div class="notes" style="float: left;position: relative;z-index: 4" onclick="$(this).remove();">
        <?php echo ca_translate('publish a theme that you want to use. if you not satisfied, you can change and create your theme self. for more information please visit http://codeanalytic.com/themes'); ?>
    </div>
    <div id="top_tap">
        <span><?php echo ca_translate("current template") ?></span>
    </div>

    <div class="theme_current"> 
        <div id="top_title" style="float: left; width: 100%">
            <h3 style="float: left;margin-right: 10px;"><?php echo $r->name ?></h3> By (<?php echo $r->maker ?>)
        </div>
        <div id="template_setting"></div>
        <img max-width="200px" src="<?php echo base_url() . "system/application/views/" .ca_theme_dir().'/'. $r->thumb ?>" align="right">
        <div class="option_theme">
            <h3 style="float: left;  margin-right: 10px;">Option</h3>
            <a href="javascript:void(0)" class="button-red rounded" onclick="ca_template_setting('widget')">browser widget</a> | 
            <a href="javascript:void(0)" class="button-red rounded" onclick="ca_template_setting('template/browser_config')">browser config</a> |
            <a href="javascript:void(0)" class="button-red rounded" onclick="ca_template_setting('widget/mobile')">mobile widget</a> |
            <a href="javascript:void(0)" class="button-red rounded" onclick="ca_template_setting('template/mobile_config')">mobile config</a> |
            <a href="javascript:void(0)" class="button-red rounded" onclick="ca_template_setting('css/index')">file</a>
        </div>
        
        <div class="theme_desc">
            <h3 style="float: left; margin-right: 10px;"><?php echo ca_translate('theme description');?></h3> 
            <?php echo $r->description; ?>
        </div>

    </div>
    <div id="top_tap">
        <span><?php echo ca_translate('template'); ?></span>
    </div>
    <div class="table_list">  
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/tooltip.js"></script>
        <form action="" method=""> 
            <div class="option_template">

                <?php
                if($rows>0){ 
                echo "<ul class='modules_apps'>";
                foreach ($result as $r) {
                    if ($r->publish == 1) {
                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish_template('template/publish/$r->id/$r->publish',this)\">Unpublish</a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish_template('template/publish/$r->id/$r->publish',this)\">Publish</a>";
                    }
                    echo"<li id='id_$r->id'>
                            <div class='inf_head_template'>
                            &nbsp;<input type=\"checkbox\" name=\"id[]\" id=\"cek\" value=\"$r->id\" > cek to delete or <span>$txt_show<br/><span>
                            <img align='left' width=\"200px\" height=\"200px\" title='$r->thumb' src='" . base_url() . "system/application/views/codeanalytic_template/" .$r->name.'/'. $r->thumb . "' />
                            </div> 
                            <span class='module_maker'>
                                    <b>( $r->name )</b> &nbsp;
                                    Created by $r->maker 
                                </span>
                            <span class='module_desc'>" . character_limiter($r->description, 250) . "</span>
                         </li>";
                }
                echo"</ul>";
                }
                ?>
            </div> 
            <div class="my_paging">
                <?php echo ca_translate('show') ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='template'"); ?>

                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>

    </div>
    <div class='light_footer'></div>
</div>

<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload_template"), {
            action: site+'/template/upload/',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(zip)$/.test(ext))){
                    ca_notive('Only zip files are allowed');
                    return false;
                }
                 
            },
            onComplete: function(file, response){
                if(response!="error"){
                    ca_load('template/',"#cen_right"); 
                    ca_notive('Your themes is success to upload');
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  

<script type="text/javascript"> 
    $(function() {
        ca_show_list("template")
        ca_table_sort("template/order")
    });
</script> 