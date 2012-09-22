<?php if (!defined('BASEPATH'))    exit('no direct script user allowed'); ca_right_top('pages', FALSE); 

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
 * @link		http://docs.codeanalytic.com/view/pages_index
 */ 
?>
<div id="center_content">
    <div class="notes">
        <?php echo ca_translate('pages that you create an effect with what you offer on your site.'); ?>
    </div>
            <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div>
    <form action="#" id="s_order" onsubmit="return false">
        <input type="hidden" name="s_title" value="<?php echo $s_title ?>"> 
        <input type="hidden" name="s_content" value="<?php echo $s_content ?>">
        <input type="hidden" name="s_from" value="<?php echo $s_from ?>"> 
        <input type="hidden" name="s_to" value="<?php echo $s_to ?>">
        <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
        <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header ui-state-disabled">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px">#
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by ascending (A-Z)') ?>" class="screenshot ico-as asc" onclick="order_field('pages/index/','title','asc')"> </a>
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by descending (Z-A)') ?>" class="screenshot ico-as desc" onclick="order_field('pages/index/','title','desc')"> </a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate('title'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by ascending (A-Z)') ?>" class="screenshot ico-as asc" onclick="order_field('pages/index/','title','asc')"> </a>
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by descending (Z-A)') ?>" class="screenshot ico-as desc" onclick="order_field('pages/index/','title','desc')"> </a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate('writer'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by ascending (A-Z)') ?>" class="screenshot ico-as asc" onclick="order_field('pages/index/','username','asc')"> </a>
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by descending (Z-A)') ?>" class="screenshot ico-as desc" onclick="order_field('pages/index/','username','desc')"> </a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate('post date'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by ascending (A-Z)') ?>" class="screenshot ico-as asc" onclick="order_field('pages/index/','date','asc')"> </a>
                        <a href="javascript:void(0)" name="<?php echo ca_translate('sort by descending (Z-A)') ?>" class="screenshot ico-as desc" onclick="order_field('pages/index/','date','desc')"> </a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate('link'); ?></th>  
                <th align="left"><?php echo ca_translate('permalink'); ?></th>  
            </tr>
            <?php
            if ($rows > 0) {
                foreach ($result as $r) {
                    $id = $r->id;
                    echo"<tr id='id_$r->id' onclick='ca_check_this(this)'>";
                    ?>
            <td style="width: 30px;" align="center"><input onclick="ca_check_this($(this).parent().parent())" type="checkbox" name="id[]" class="check" value="<?php echo$r->id ?>"></td>
                    <?php
                    $show = $r->publish;
                    if ($show == '1') {
                        $txt_show = "<a href='javascript:void(0)' name='hide this pages' class='screenshot hidex' onclick=\"ca_action_publish('pages/publish/$r->id/$r->publish',this)\"></a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' name='show this pages' class='screenshot showx' onclick=\"ca_action_publish('pages/publish/$r->id/$r->publish',this)\"></a>";
                    }
                    echo"<td style=\"width: 30px\" align='center'>$txt_show</td>";
                    echo"<td>$r->title </td>";
                    echo"<td align='left'>$r->username </td>";
                    echo"<td align='left'>" . date_format(date_create($r->date), 'd F Y H:i:s') . "</td>";
                    echo"<td><a href='" . base_url() . "$r->link' target='_blank'>$r->link</a> </td>";
                    echo"<td><a href='" . base_url() . "$r->permalink' target='_blank'>$r->permalink</a></td>";
                    echo"</tr>";
                }
            }
            ?>
        </table>
        <div class="my_paging">
            <?php echo ca_translate('show') ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='pages/index/'"); ?>
            <span id="pagination">
                <?php echo $ca_paging; ?>
            </span>
        </div>
    </form>
</div>
<?php ca_sort_order('pages'); ?>
