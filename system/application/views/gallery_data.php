<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ca_right_top('gallery', FALSE, TRUE, TRUE, FALSE, TRUE, TRUE, FALSE); ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.tooltip.js"></script>  
<div id="center_content">
    <div class="notes">
        <?php echo ca_translate('you can add new album, and upload images that you have.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('gallery/insert', '.main_right','n');
            })
        </script>
    </div>
    <div class="main_left">
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div> 
        <form action="#" onsubmit="return false"> 
            <table id="table_list" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #EBEBEB;">
                <tr class="ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                    <th style="width: 30px">#</th>
                    <th align="left"><?php echo ca_translate('album'); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('gallery/data/','album','asc')"> </a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('gallery/data/','album','desc')"> </a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('thumb'); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('gallery/data/','image','asc')"> </a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('gallery/data/','image','desc')"> </a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('title'); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('gallery/data/','title','asc')"> </a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('gallery/data/','title','desc')"> </a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('post date'); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('gallery/data/','date','asc')"> </a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('gallery/data/','date','desc')"> </a>
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
                            $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('gallery/publish/$r->id/$r->publish',this)>&nbsp;</a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('gallery/publish/$r->id/$r->publish',this)>&nbsp;</a>";
                        }

                        echo"<td>$txt_show</td>";
                        $date = date_format(date_create($r->date), 'd F Y H:i:s');
                        echo"<td>$r->album</td>";
                        echo"<td><a href='javascript:void(0)' class=screenshot rel='" . base_url() . "assets/media/upload/image/" . $r->image . "'>[img]</a></td>";
                        echo"<td>$r->title</td>";
                        echo"<td>$date</td>";
                        echo"</tr>";
                    }
                }
                ?>
            </table>
            <div class="my_paging">
                <?php echo ca_translate('show') ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='gallery/data/'"); ?>

                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('gallery') ?>