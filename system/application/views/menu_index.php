<?php if (!defined('BASEPATH'))    exit('no direct script user allowed'); ca_right_top("menu", FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE);

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
 * @link		http://docs.codeanalytic.com/view/menu_index
 */ 
?>
<div id="center_content">  
    <div class="notes">
    <?php echo ca_translate('create menu that you want here to make visitors interested in what you publish.'); ?>
    </div>
    <div class="main_right">
        <script type="text/javascript">
            $(function(){
                ca_load('menu/insert', '.main_right');
            })
        </script>
    </div>
    <div class="main_left">
        <div id="top_tap" class="dinamic_tap">
            <span><?php echo ca_translate("tabular data") ?></span>            
        </div>
        <form action="#" id="s_order" onsubmit="return false">
            <input type="hidden" name="s_name" value="<?php echo $s_name ?>">
            <table id="table_list" style="border-left: 1px solid #EBEBEB" class="table_content" cellpadding="0" cellspacing="0" border="0">
                <tr class="header ui-state-disabled">
                    <th style="width: 30px" align="center"><input type="checkbox" id="1" class="ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                    <th style="width: 30px" align="center">#</th>
                    <th align="left"><?php echo ca_translate("title"); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('menu/index/','name','asc')"></a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('menu/index/','name','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate("url"); ?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" class="ico-as asc" onclick="order_field('menu/index/','url','asc')"></a>
                            <a href="javascript:void(0)" class="ico-as desc" onclick="order_field('menu/index/','url','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('target');?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('menu/index/','target','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('menu/index/','target','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('class');?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('menu/index/','attr_class','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('menu/index/','attr_class','desc')"></a>
                        </span>
                    </th>
                    <th align="left"><?php echo ca_translate('id');?>
                        <span id="short-sc">
                            <a href="javascript:void(0)" name="sort by ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('menu/index/','attr_id','asc')"></a>
                            <a href="javascript:void(0)" name="sort by descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('menu/index/','attr_id','desc')"></a>
                        </span>
                    </th>
                </tr>
                <?php
                if ($rows > 0) {
                    foreach ($result as $r) {
                        $id = $r->id;
                        echo"<tr id='id_$r->id' onclick='ca_check_this(this);'>";
                        ?>

                        <td style="width: 30px" align="center">
                            <input type="checkbox" onclick="ca_check_this($(this).parent().parent())" name="id[]" class="check" value="<?php echo$r->id ?>" >
                        </td>

                        <?php
                        $show = $r->publish;
                        if ($show == '1') {
                            $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('menu/publish/$r->id/$r->publish',this)></a>";
                        } else {
                            $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('menu/publish/$r->id/$r->publish',this)></a>";
                        }

                        echo"<td style='width:30px' align='center'>$txt_show</td>";
                        echo"<td>";
                        if ($this->mmenu->get_child($r->id)->num_rows() > 0) {
                            echo"<span class='show_hide' onclick=ca_show_child('.tr_$r->id')>+ ";
                        } else {
                            echo"     ";
                        }
                        echo"<a href='javascript:void(0)'>$r->name</a></td>";
                        echo"<td><a href='javascript:void(0)'>$r->url</a></td>";
                        echo"<td>$r->target</td>";
                        echo"<td>$r->attr_class</td>";
                        echo"<td>$r->attr_id</td>";
                        //-------------
                        $rs1 = $this->mmenu->get_child($r->id);
                        foreach ($rs1->result() as $r1) {
                            echo"<tr id='id_$r1->id' style='display:none' class='tr_$r->id' onclick='ca_check_this(this);'>";
                            ?>

                            <td align="center">
                                <input type="checkbox" name="id[]" class="check" value="<?php echo$r1->id ?>" >
                            </td>

                            <?php
                            $show = $r1->publish;
                            if ($show == '1') {
                                $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('menu/publish/$r1->id/$r1->publish',this)></a>";
                            } else {
                                $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('menu/publish/$r1->id/$r1->publish',this)></a>";
                            }

                            echo"<td align='center'>$txt_show</td>";
                            echo"<td>";
                            if ($this->mmenu->get_child($r1->id)->num_rows() > 0) {
                                echo"<span style='float:left;margin-left:20px' class='show_hide' onclick=ca_show_child('.tr_$r1->id')>+ ";
                            } else {
                                echo"<b style='float:left;margin-left:20px'>-</b>";
                            }
                            echo"<a href='javascript:void(0)'>$r1->name</a></td>";
                            echo"<td><a href='javascript:void(0)'>$r1->url</a></td>";
                            echo"<td>$r1->target</td>";
                            echo"<td>$r1->attr_class</td>";
                            echo"<td>$r1->attr_id</td>";
                            echo"</tr>";

                            $rs2 = $this->mmenu->get_child($r1->id);
                            foreach ($rs2->result() as $r2) {
                                echo"<tr id='id_$r2->id' style='display:none' class='tr_$r1->id tr_$r1->id' onclick='ca_check_this(this);'>";
                                ?>

                                <td align="center">
                                    <input type="checkbox" name="id[]" class="check" value="<?php echo$r2->id ?>" >
                                </td>

                                <?php
                                $show = $r2->publish;
                                if ($show == '1') {
                                    $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('menu/publish/$r2->id/$r2->publish',this)></a>";
                                } else {
                                    $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('menu/publish/$r2->id/$r2->publish',this)></a>";
                                }

                                echo"<td align='center'>$txt_show</td>";
                                echo"<td>";
                                if ($this->mmenu->get_child($r2->id)->num_rows() > 0) {
                                    echo"<span style='float:left;margin-left:40px' class='show_hide' onclick=ca_show_child('.tr_$r2->id')>+</span>";
                                } else {
                                    echo"<b style='float:left;margin-left:40px'>-</b>";
                                }
                                echo"<a href='javascript:void(0)'>$r2->name</a></td>";
                                echo"<td><a href='javascript:void(0)'>$r2->url</a></td>";
                                echo"<td>$r2->target</td>";
                                echo"<td>$r2->attr_class</td>";
                                echo"<td>$r2->attr_id</td>";
                                echo"</tr>";

                                //---
                                $rs3 = $this->mmenu->get_child($r2->id);
                                foreach ($rs3->result() as $r3) {
                                    if ($this->mmenu->get_child($r3->id)->num_rows() > 0) {
                                        echo"<tr id='id_$r3->id' style='display:none' class='tr_$r2->id tr_$r1->id tr_$r2->id' onclick='ca_check_this(this); show_child(.tr_$r3->id)'>";
                                    } else {
                                        echo"<tr id='id_$r3->id' style='display:none' class='tr_$r2->id tr_$r1->id tr_$r2->id' onclick='ca_check_this(this); '>";
                                    }
                                    ?>

                                    <td align="center">
                                        <input type="checkbox" name="id[]" class="check" value="<?php echo$r3->id ?>" >
                                    </td>

                                    <?php
                                    $show = $r3->publish;
                                    if ($show == '1') {
                                        $txt_show = "<a href='javascript:void(0)' class='hidex' onclick=ca_action_publish('menu/publish/$r3->id/$r3->publish',this)></a>";
                                    } else {
                                        $txt_show = "<a href='javascript:void(0)' class='showx' onclick=ca_action_publish('menu/publish/$r3->id/$r3->publish',this)></a>";
                                    }

                                    echo"<td align='center'>$txt_show</td>";
                                    echo"<td>";
                                    echo"<b style='float:left;margin-left:60px'>-</b>";
                                    echo"<a href='javascript:void(0)'>$r3->name</a></td>";
                                    echo"<td><a href='javascript:void(0)'>$r3->url</a></td>";
                                    echo"<td>$r3->target</td>";
                                    echo"<td>$r3->attr_class</td>";
                                    echo"<td>$r3->attr_id</td>";
                                    echo"</tr>";
                                }
                            }
                        }

                        echo"</tr>";
                    }
                }
                ?>

            </table>
            <div class="my_paging" style="width: 100%">
                <?php echo ca_translate("show") ?>:<?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='menu/index/'"); ?>
                <span id="pagination">
                    <?php echo $ca_paging; ?>
                </span>
            </div>
        </form>
    </div>
</div>
<?php ca_sort_order('menu') ?>