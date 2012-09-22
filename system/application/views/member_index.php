<?php if (!defined('BASEPATH'))    exit('no direct script user allowed'); ca_right_top('member', FALSE, true, true, false, false, true, false)

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
 * @link		http://docs.codeanalytic.com/view/member_index
 */ 
?> 
<div id="center_content">  
    <form action="#" id="s_order" onsubmit="return false">
        <div class="notes">
            <?php echo ca_translate("who's your a member?, this is a list of those who become your member."); ?>
        </div>
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div>
        <input type="hidden" name="s_username" value="<?php echo $s_username ?>">
        <input type="hidden" name="s_email" value="<?php echo $s_email ?>"> 
        <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
        <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header ui-state-disabled">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px" align="left"> #
                    <span id="short-sc"> 
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('member/index/','publish','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('member/index/','publish','desc')">&nbsp;</a>
                    </span>
                </th>
                <th align="left" style="width: 100px"><?php echo ca_translate('username'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('member/username/','title','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('member/username/','title','desc')">&nbsp;</a>
                    </span>                    
                </th>
                <th align="left"><?php echo ca_translate('thumb'); ?></th>
                <th align="left"><?php echo ca_translate('full name'); ?></th> 
                <th align="left"><?php echo ca_translate('email'); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('member/index/','email','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('member/index/','email','desc')">&nbsp;</a>
                    </span>
                </th> 
                <th align="left"><?php echo ca_translate('last login'); ?></th> 
            </tr>
            <?php
            if ($rows > 0) {
                foreach ($result as $r) {
                    $id = $r->id;
                    echo"<tr id='id_$r->id' onclick='ca_check_this(this)'>";
                    ?>

                    <td style="width: 30px" align="center">
                        <input onclick="ca_check_this($(this).parent().parent())" type="checkbox" name="id[]" class="check" value="<?php echo$r->id ?>" >
                    </td>

                    <?php
                    $show = $r->publish;
                    if ($show == '1') {
                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('member/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('member/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                    } 

                    echo"<td style=\"width: 30px\" align='center'>$txt_show&nbsp;</td>";
                    echo"<td>$r->username&nbsp;</td>";
                    echo"<td><a href='javascript:void(0)' class=\"screenshot\" rel='" . base_url() . "assets/images/member/" . $r->photo . "'>$r->photo</a></td>";
                    echo"<td>$r->first_name -$r->last_name&nbsp;</td>";
                    echo"<td>$r->email&nbsp;</td>"; 
                    echo"<td>$r->last_login&nbsp;</td>";
                    echo"</tr>";
                }
            }
            ?>

        </table>
        <div class="my_paging">
            <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='member/index/'"); ?>

            <span id="pagination">
                <?php echo $ca_paging ?>
            </span>
        </div>
    </form>
</div>
<?php ca_sort_order('member') ?>