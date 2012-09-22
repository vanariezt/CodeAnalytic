<?php if (!defined('BASEPATH'))    exit('no direct script user allowed'); ca_right_top("polling", FALSE);

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
 * @link		http://docs.codeanalytic.com/view/polling_index
 */ 
?>
<div id="center_content">
    <div class="notes">
        <?php echo ca_translate('how big is your comparison to the public via Polling survey. create, edit, or delete the poll that you want here.'); ?>
    </div>
    <div id="top_tap" class="dinamic_tap">
        <span><?php echo ca_translate("tabular data") ?></span>            
    </div>
    <form action="#" id="s_order" onsubmit="return false"> 
        <input type="hidden" name="s_content" value="<?php echo $s_content ?>">
        <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
        <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header ui-state-disabled">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px">#
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','title','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','title','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left" style="width: 35%"><?php echo ca_translate('question') ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','question','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','question','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">(N)
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','noofanswers','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','noofanswers','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans1
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer1','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer1','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans2
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer2','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer2','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans3
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer3','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer3','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans4
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer4','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer4','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans5
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer5','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer5','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left">Ans6
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('polling/index/','answer6','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('polling/index/','answer6','desc')">&nbsp;</a>
                    </span>
                </th>
            </tr>
            <?php
            if ($rows > 0) {
                foreach ($result as $r) {
                    $id = $r->pid;
                    echo"<tr id='id_$r->pid' onclick='ca_check_this(this)'>";
                    ?>

                    <td style="width: 30px" align="center">
                        <input onclick="ca_check_this($(this).parent().parent())" type="checkbox" name="id[]" class="check" value="<?php echo$r->pid ?>" >
                    </td>

                    <?php
                    $show = $r->publish;
                    if ($show == '1') {
                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('polling/publish/$r->pid/$r->publish',this)\">&nbsp;</a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('polling/publish/$r->pid/$r->publish',this)\">&nbsp;</a>";
                    }

                    echo"<td>$txt_show</td>";
                    echo"<td>$r->question</td>";
                    echo"<td align='center'>$r->noofanswers&nbsp;</td>";
                    echo"<td>$r->answer1&nbsp;</td>";
                    echo"<td>$r->answer2&nbsp;</td>";
                    echo"<td>$r->answer3&nbsp;</td>";
                    echo"<td>$r->answer4&nbsp;</td>";
                    echo"<td>$r->answer5&nbsp;</td>";
                    echo"<td>$r->answer6&nbsp;</td>";
                    echo"</tr>";
                }
            }
            ?>
        </table>
        <div class="my_paging">
            <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='polling/index/'"); ?>
            <span id="pagination">
                <?php echo $ca_paging; ?>
            </span>
        </div>
    </form>
</div>
<?php ca_sort_order('polling') ?>