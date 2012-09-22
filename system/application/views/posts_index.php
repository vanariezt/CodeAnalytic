<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed'); ca_right_top("posts", FALSE);

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
 * @link		http://docs.codeanalytic.com/view/posts_index
 */
?>
<div id="center_content">    
    <div class="notes">
<?php echo ca_translate('write down any news that you have by category or not to inform your visitors out there.'); ?>
    </div>
    <div id="top_tap" class="dinamic_tap">
        <span><?php echo ca_translate("tabular data") ?></span>            
    </div>
    <form action="#" id="s_order" onsubmit="return false">
        <input type="hidden" name="s_title" value="<?php echo $s_title ?>">
        <input type="hidden" name="s_cat_id" value="<?php echo $s_cat_id ?>">
        <input type="hidden" name="s_content" value="<?php echo $s_content ?>">
        <input type="hidden" name="s_order" value="<?php echo $s_order ?>">
        <input type="hidden" name="s_by" value="<?php echo $s_by ?>">
        <table id="table_list" cellpadding="0" cellspacing="0" border="0">
            <tr class="header ui-state-disabled">
                <th style="width: 30px" align="center"><input type="checkbox" id="1" name="check all posting" class="screenshot ck" style="cursor: pointer" onclick="ca_check_all('.ck')"></th>
                <th style="width: 30px" align="center"> #
                    <span id="short-sc">
                        <a href="javascript:void(0)"  name="sort posting by publish as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('posts/index/','publish','asc')"></a>
                        <a href="javascript:void(0)" name="sort posting by publish as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('posts/index/','publish','desc')"></a>
                    </span>
                </th> 
                <th align="left" style="width: 15%;"><?php echo ca_translate("title"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort posting by title as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('posts/index/','title','asc')"></a>
                        <a href="javascript:void(0)" name="sort posting by title as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('posts/index/','title','desc')"></a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate("writer"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort posting by admin as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('posts/index/','username','asc')"></a>
                        <a href="javascript:void(0)" name="sort posting by admin as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('posts/index/','username','desc')"></a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate("post date"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort posting by date as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('posts/index/','p.date','asc')"></a>
                        <a href="javascript:void(0)" name="sort posting by date as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('posts/index/','p.date','desc')"></a>
                    </span>
                </th>
                <th align="left"><?php echo ca_translate("category"); ?>
                    <span id="short-sc">
                        <a href="javascript:void(0)" name="sort posting by category as ascending (A-Z)" class="screenshot ico-as asc" onclick="order_field('posts/index/','cat_id','asc')"></a>
                        <a href="javascript:void(0)" name="sort posting by category as descending (Z-A)" class="screenshot ico-as desc" onclick="order_field('posts/index/','cat_id','desc')"></a>
                    </span>
                </th> 
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
                        $txt_show = "<a href='javascript:void(0)' name='hide this post' class='screenshot hidex' onclick=\"ca_action_publish('posts/publish/$r->id/$r->publish',this)\"></a>";
                    } else {
                        $txt_show = "<a href='javascript:void(0)' name='show this post' class='screenshot showx' onclick=\"ca_action_publish('posts/publish/$r->id/$r->publish',this)\"></a>";
                    }
                    
                    echo"<td style=\"width: 30px\" align='center'>$txt_show</td>";
                    echo"<td align='left'> $r->title </td>";
                    echo"<td align='left'> $r->username </td>";
                    echo"<td align='left'>" . date_format(date_create($r->date), "d F Y H:i:s") . "</td>";
                    echo"<td align='left'>".$this->mposts->get_permalink_cat_in($r->cat_id)."</td>";
                    echo"<td><a href='" . base_url() . "$r->permalink' target='_blank'>$r->permalink</a></td>";
                    echo"</tr>";
                }
            }
            ?>

        </table> 
        <div class="my_paging">
                <?php echo ca_translate("show") ?>: <?php echo form_dropdown('max_show', $max_show, isset($default['max_show']) ? $default['max_show'] : '', "id='show_max' class='posts/index/'"); ?>

            <span id="pagination">
<?php echo $ca_paging; ?>
            </span>
        </div>
    </form>
</div>
<?php ca_sort_order('posts') ?>