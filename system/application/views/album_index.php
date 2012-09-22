<?php if (!defined('BASEPATH')) exit('No direct script access allowed');ca_right_top("album", FALSE, TRUE, TRUE, FALSE, TRUE, TRUE, FALSE); ?>
<div id="center_content">
    <div class="notes">
        <?php echo ca_translate('create a new album here.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('album/insert', '.main_right');
            })
        </script>
    </div> 
    <div class="main_left">
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div> 
        <form action="#" id="myform" onsubmit="return false">
            <input type="hidden" name="s_name" value="<?php echo $s_name ?>"> 
            <input type="hidden" name="s_description" value="<?php echo $s_description ?>">
            <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
            <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
            <table id="table_list" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #EBEBEB;">
                <tr class="ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                    <th style="width: 30px" align="center"> #
                        <span id="short-sc">
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('album/index/','publish','asc')"> </a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('album/index/','publish','desc')"> </a>
                        </span>
                    </th> 
                    <th align="left"><?php echo ca_translate('name'); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('album/index/','name','asc')"> </a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('album/index/','name','desc')"> </a>
                        </span>
                    </th>
                    <th><?php echo ca_translate("description"); ?></th>
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
                            $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('album/publish/$r->id/$r->publish',this)></a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('album/publish/$r->id/$r->publish',this)></a>";
                        }

                        echo"<td>$txt_show</td>";
                        echo"<td>$r->name</td>";
                        echo"<td>$r->description</td>";
                        echo"</tr>";
                    }
                }
                ?>

            </table>
            <div class="my_paging">
                <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='album/index/'"); ?>
                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('album') ?>