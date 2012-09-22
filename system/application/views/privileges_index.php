<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/view/priveleges_index
 */ 
?>

<div id="bar_button">
    <div id="bar_button_left" style="width: 30%">
        <div id="top_title" class="privilages">
            <h2><?php echo ca_translate("privileges") ?></h2>
        </div>              
    </div>
    <div id="bar_button_right">
        &nbsp;    
    </div>
</div>
<div class="notes">
    <?php echo ca_translate('right to access what you give to them, please set up here'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("privileges") ?></span>
</div>
<div id="table_list">
    <form action="#" onsubmit="return false">

        <table id="table_list" cellpadding="0" cellspacing="0" border="0">    
            <tr>
                <th width="250px" align="left"><?php echo ca_translate("user access"); ?></th> 
                <th width="50px"><?php echo ca_translate("insert"); ?></th>
                <th width="50px"><?php echo ca_translate("update"); ?></th>
                <th width="50px"><?php echo ca_translate("delete"); ?></th>
                <th width="50px"><?php echo ca_translate("publish"); ?></th>
                <th><?php echo ca_translate("description"); ?></th>
            </tr>
            <?php
            $rs = $this->mprivileges->get_all();
            foreach ($rs as $r) {
                echo"<tr>";
                echo"<td>$r->priv_name</td>";

                $insert = $r->insert;
                if ($insert == '1') {
                    $txt_insert = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('privileges/insert/$r->priv_id/$r->insert',this)\">&nbsp;</a>";
                } else {
                    $txt_insert = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('privileges/insert/$r->priv_id/$r->insert',this)\">&nbsp;</a>";
                }
                $update = $r->update;
                if ($update == '1') {
                    $txt_update = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('privileges/update/$r->priv_id/$r->update',this)\">&nbsp;</a>";
                } else {
                    $txt_update = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('privileges/update/$r->priv_id/$r->update',this)\">&nbsp;</a>";
                }

                $delete = $r->delete;
                if ($delete == '1') {
                    $txt_delete = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('privileges/delete/$r->priv_id/$r->delete',this)\">&nbsp;</a>";
                } else {
                    $txt_delete = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('privileges/delete/$r->priv_id/$r->delete',this)\">&nbsp;</a>";
                }

                $publish = $r->publish;
                if ($publish == '1') {
                    $txt_publish = "<a href='javascript:void(0)' class='hidex' onclick=\"ca_action_publish('privileges/publish/$r->priv_id/$r->publish',this)\">&nbsp;</a>";
                } else {
                    $txt_publish = "<a href='javascript:void(0)' class='showx' onclick=\"ca_action_publish('privileges/publish/$r->priv_id/$r->publish',this)\">&nbsp;</a>";
                }

                echo"<td align='center'>$txt_insert</td>";
                echo"<td align='center'>$txt_update</td>";
                echo"<td align='center'>$txt_delete</td>";
                echo"<td align='center'>$txt_publish</td>";
                echo"<td>" . character_limiter($r->description, 40) . "</td>";
                echo"</tr>";
            }
            ?>

        </table>
    </form> 
</div> 