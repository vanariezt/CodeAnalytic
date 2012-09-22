<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');  ca_right_top("third_party", FALSE, TRUE, TRUE, FALSE, FALSE, TRUE, FALSE);

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
 * @link		http://docs.codeanalytic.com/view/plugin_index
 */ 
?>
<div id="center_content">       
    <div class="notes">
        <?php echo ca_translate('you can add new third_party javascript in here, set and choose publish or not publish directory used'); ?>
    </div> 
    <div id="top_tap" class="dinamic_tap">
        <span><?php echo ca_translate("tabular data") ?></span>            
    </div>
    <form id="myform" method="post" onsubmit="return false">
        <div id="bar_button" style="float: left; width:100%;">
            <div id="bar_button_right" style="float: left; margin-left: 1%;">
                Select file to upload <a href="javascript:void(0)" id="upload_third_party" class="icons" style="margin-left: 10px;"><?php echo ca_translate('add') ?></a>                  
            </div>
        </div>
    </form> 

    <form action="#" id="s_order" onsubmit="return false">
        <input type="hidden" name="s_title" value="<?php echo $s_title ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" name="check all rows" class="screenshot ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px" align="center">#
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('third_party/index/','publish','asc')"></a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('third_party/index/','publish','desc')"></a>
                    </span>
                </th>
                <th align="left" style="width: 150px"><?php echo ca_translate('date upload'); ?></th>
                <th align="left"><?php echo ca_translate('plugin title'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('third_party/index/','title','asc')"></a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('third_party/index/','title','desc')"></a>
                    </span>
                </th> 
            </tr>
            <?php
            if ($rows > 0) {
                foreach ($result as $r) {
                    $id = $r->id;
                    echo"<tr id='id_$r->id' onclick='ca_check_this(this)'>";
                    ?>

                    <td style="width: 30px" align="center"  valign="top">
                        <input type="checkbox" onclick="ca_check_this($(this).parent().parent())" name="id[]" class="check"value="<?php echo$r->id ?>" >
                    </td>

                    <?php
                    $show = $r->publish;
                    if ($show == '1') {
                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('third_party/publish/$r->id/$r->publish',this)></a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('third_party/publish/$r->id/$r->publish',this)></a>";
                    }

                    echo"<td style=width: 30px align='center' valign='top'>$txt_show</td>";
                    echo"<td valign='top'>" . date_format(date_create($r->date), 'd F Y H:i:s') . "</td>";
                    ?>
                    <td>
                        <a href="javascript:void(0)" id="header" class="show icon-folder"><b><?php echo $r->title ?></b></a> 
                        <div class="db_<?php echo $r->title ?>">
                            <?php
                            $ca = ca_list_dir($base . $r->title);
                            if (count($ca) > 0) {
                                for ($j = 0; $j < count($ca); $j++) {
                                    $pl = explode('/', $ca[$j]);
                                    $t_1 = $pl[count($pl) - 1];
                                    echo " [<a href=\"javascript:void(0)\" class=\"button\" >" . $t_1 . "</a>]";
                                }
                            }
                            ?>
                        </div>  
                    </td>
                    <?php
                    echo"</tr>";
                }
            }
            ?>

        </table>
        <div class="my_paging">
            <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='third_party/index/'"); ?>

            <span id="pagination">
                <?php echo $ca_paging; ?>
            </span>
        </div>
    </form>
</div> 
<?php ca_sort_order('third_party') ?>
<script type="text/javascript">
    $(function(){ 
        new AjaxUpload($("a#upload_third_party"), {
            action: site+'third_party/upload/',
            name: 'userfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(zip)$/.test(ext))){
                    ca_notive('Only zip files are allowed');
                    return false;
                }
                 
            },
            onComplete: function(file, response){
                if(response!="error"){
                    ca_load('third_party/',"#cen_right"); 
                    ca_notive('Your plugin is success to upload');
                } else{
                    alert(response);
                }
            }
        });
    })
</script>  