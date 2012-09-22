<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');ca_right_top("user", FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE); 

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
 * @link		http://docs.codeanalytic.com/view/user_index
 */ 
?> 
<div id="center_content" >
    <div class="notes">
        <?php echo ca_translate('these are people who you trust with their access rights - one that you want.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('user/insert', '.main_right');
            })
        </script>
    </div>
    <div class="main_left">
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div>
        <form action="#" id="s_order" onsubmit="return false"> 
            <input type="hidden" name="s_username" value="<?php echo $s_username ?>">
            <input type="hidden" name="s_email" value="<?php echo $s_email ?>"> 
            <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
            <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
            <table id="table_list" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #EBEBEB;">
                <tr class="header ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_cek_all('.ck')"></th>
                    <th style="width: 30px" align="center">#
                        <span id="short-sc"> 
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('user/index/','publish','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('user/index/','publish','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("username"); ?>
                        <span id="short-sc"> 
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('user/index/','username','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('user/index/','username','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('privacy'); ?>
                        <span id="short-sc"> 
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('user/index/','priv_name','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('user/index/','priv_name','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("email"); ?>
                        <span id="short-sc"> 
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('user/index/','email','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('user/index/','email','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("last login"); ?></th> 
                </tr>
                <?php
                if ($rows > 0) {
                    foreach ($result as $r) {
                        $id = $r->user_id;
                        echo"<tr id='id_$r->user_id' onclick='ca_check_this(this)'>";
                        ?>

                        <td style="width: 30px" align="center">
                            <input onclick="ca_check_this($(this).parent().parent())" type="checkbox" name="id[]" class="check" value="<?php echo$r->user_id ?>" >
                        </td>

                        <?php
                        $show = $r->active;
                        if ($show == '1') {
                            $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('user/publish/$r->user_id/$r->active',this)\"></a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('user/publish/$r->user_id/$r->active',this)\"></a>";
                        }

                        echo"<td style=\"width: 30px\" align='center'>$txt_show</td>";
                        echo"<td>$r->username</td>";
                        echo"<td>$r->priv_name</td>";
                        echo"<td>$r->email</td>";
                        echo"<td>$r->last_login</td>";
                        echo"</tr>";
                    }
                }
                ?>

            </table>
            <div class="my_paging">
                <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='user/index/'"); ?>

                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('user') ?>