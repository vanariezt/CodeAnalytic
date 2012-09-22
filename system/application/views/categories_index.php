<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ca_right_top("categories", FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE); ?>
<div id="center_content" >
    <div class="notes">
        <?php echo ca_translate('postings that you make should be published based on an existing category, it will look more presentable and attractive.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('categories/insert', '.main_right');
            })
        </script>
    </div>
    <div class="main_left">
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div>
        <form action="#" id="s_order" onsubmit="return false"> 
            <input type="hidden" name="s_name" value="<?php echo $s_name ?>">
            <input type="hidden" name="s_keyword" value="<?php echo $s_keyword ?>">
            <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
            <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
            <table id="table_list" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #EBEBEB;">
                <tr class="header ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                    <th style="width: 30px" align="center">#
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort categories by publish as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('categories/index/','publish','asc')">&nbsp;</a>
                            <a href="javascript:void(0)" name="sort categories by publish as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('categories/index/','publish','desc')">&nbsp;</a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("category"); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort categories by name as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('categories/index/','name','asc')">&nbsp;</a>
                            <a href="javascript:void(0)" name="sort categories by name as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('categories/index/','name','desc')">&nbsp;</a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("keyword"); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort categories by keyword as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('categories/index/','meta_keyword','asc')">&nbsp;</a>
                            <a href="javascript:void(0)" name="sort categories by keyword as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('categories/index/','meta_keyword','desc')">&nbsp;</a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("description"); ?></th>
                    <th align="left"><?php echo ca_translate("permalink"); ?></th>
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
                            $txt_show = "<a href='javascript:void(0)' name='hide this categories' class='screenshot hidex' onclick=\"ca_action_publish('categories/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' name='show this categories' class='screenshot showx' onclick=\"ca_action_publish('categories/publish/$r->id/$r->publish',this)\">&nbsp;</a>";
                        }

                        echo"<td style=\"width: 30px\" align='center'>$txt_show</td>";
                        echo"<td>$r->name&nbsp;</td>";
                        echo"<td>$r->meta_keyword&nbsp;</td>";
                        echo"<td>$r->meta_description&nbsp;</td>";
                        echo"<td><a href='" . base_url() . "$r->permalink' target='_blank'>$r->permalink</a></td>";
                        echo"</tr>";
                    }
                }
                ?>

            </table>
            <div class="my_paging">
                <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='categories/index/'"); ?>
                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('categories'); ?>