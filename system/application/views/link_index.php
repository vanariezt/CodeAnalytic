<?php if (!defined('BASEPATH')) exit('No direct script access allowed');ca_right_top('link',FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE); ?>
<div id="center_content">     
    <div class="notes">
        <?php echo ca_translate('create, edit or delete links that connect your profiles on here.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('link/insert', '.main_right');
            })
        </script>
    </div>
    <div class="main_left">  
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div> 
        <form action="#" id="s_order" onsubmit="return false">
            <input type="hidden" name="s_title" value="<?php echo $s_title ?>">
            <table id="table_list" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #EBEBEB;">
                <tr class="header ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" name="check all rows" class="screenshot ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                    <th style="width: 30px" align="center">#
                        <span id="short-sc">
                            <a href="javascript:void(0)"  name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('link/index/','publish','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('link/index/','publish','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('title') ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('link/index/','title','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('link/index/','title','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('url') ?></th>
                    <th align="left"><?php echo ca_translate('target') ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('link/index/','target','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('link/index/','target','desc')"></a>
                        </span>
                    </th>
                    <th align="left">class
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('link/index/','attr_class','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('link/index/','attr_class','desc')"></a>
                        </span>
                    </th>
                    <th align="left">id
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('link/index/','attr_id','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('link/index/','attr_id','desc')"></a>
                        </span>
                    </th>

                </tr>
                <?php
                if ($rows > 0) {
                    foreach ($result as $r) {
                        $id = $r->id;
                        echo"<tr id='id_$r->id' onclick='ca_check_this(this)' class='ui-state-highlight'>";
                        ?>

                        <td style="width: 30px" align="center">
                            <input onclick="ca_check_this($(this).parent().parent())" type="checkbox" name="id[]" class="check" value="<?php echo$r->id ?>" >
                        </td>

                        <?php
                        $show = $r->publish;
                        if ($show == '1') {
                            $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('link/publish/$r->id/$r->publish',this)></a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('link/publish/$r->id/$r->publish',this)></a>";
                        }

                        echo"<td style=width: 30px align='center'>$txt_show</td>";
                        echo"<td>$r->title</td>";
                        echo"<td><a href='$r->url' target='_blank'>$r->url</a></td>";
                        echo"<td>$r->target</td>";
                        echo"<td>$r->attr_class</td>";
                        echo"<td>$r->attr_id</td>";
                        echo"</tr>";
                    }
                }
                ?>

            </table>
            <div class="my_paging">
                <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='link/index/'"); ?>

                <span id="pagination">
                    <?php echo $ca_paging ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('link') ?>