<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ca_right_top("comments", FALSE, TRUE, TRUE, FALSE, FALSE, TRUE, FALSE); ?> 
<div id="center_content">
    <div class="notes">
        <?php echo ca_translate('are there any new comments?, whether his comments?, publish or not?, please check and set here.'); ?>
    </div>
       <div id="top_tap" class="dinamic_tap">
        <span><?php echo ca_translate("tabular data") ?></span>            
    </div>
    <form action="#" onsubmit="return false">
        <input type="hidden" name="s_username" value="<?php echo $s_username ?>">
        <input type="hidden" name="s_content" value="<?php echo $s_content ?>"> 
        <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
        <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header ui-state-disabled">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px" align="center"> #
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('comments/index/','publish','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('comments/index/','publish','desc')">&nbsp;</a>
                    </span>
                </th> <th align="left"><?php echo ca_translate("writer") ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('comments/index/','username','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('comments/index/','username','desc')">&nbsp;</a>
                    </span>
                </th>
                <th><?php echo ca_translate("post date"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('comments/index/','date','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('comments/index/','date','desc')">&nbsp;</a>
                    </span>
                </th>
                <th><?php echo ca_translate("ip"); ?></th>
                <th><?php echo ca_translate("email"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('comments/index/','email','asc')">&nbsp;</a>
                        <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('comments/index/','email','desc')">&nbsp;</a>
                    </span>
                </th>
                <th><?php echo ca_translate("url");?></th>
                <th align="left"><?php echo ca_translate("content");?></th>
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
                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('comments/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('comments/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                    }

                    echo"<td style=\"width: 30px\" align='center'>$txt_show</td>";
                    echo"<td> $r->username </td>";
                    echo"<td align='center'> $r->date </td>";
                    echo"<td align='center'> $r->ip </td>";
                    echo"<td align='center'> $r->email </td>";
                    echo"<td align='center'><a href='$r->com_url' target='_blank'>uri</a> </td>";
                    echo"<td>".html_entity_decode($r->content, ENT_NOQUOTES, 'UTF-8')."</td>";
                    echo"</tr>";
                }
            }
            ?>

        </table> 
        <div class="my_paging">
            <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='comments/index/'"); ?>

            <span id="pagination">
                <?php echo $ca_paging; ?>
            </span>
        </div>
    </form>
</div>
<?php ca_sort_order('comments') ?>
<?php ca_sort_order('comments') ?>
<div style="float: left; width: 97%">
    <script type="text/javascript">        
        ca_load('comments_statistic', 'div.box_com','n');
    </script>
    <div class="box_form">
        <div id="top_tap"><span><?php echo ca_translate("comments"); ?></span></div>
        <div  class="_stat com_stat" style="background: #F9F9F9; float: left; width: 100%;">
            <a href="javascript:void(0)" style="float: right; margin-right: 5px;" onclick="ca_load('comments_statistic/find', '#com_find')"><?php echo ca_translate('search') ?></a>
        </div> 
        <div id="com_find"></div>
        <div class="box_com" style="float: left; width: 100%; margin-left: 1%;"></div> 
    </div>
</div>