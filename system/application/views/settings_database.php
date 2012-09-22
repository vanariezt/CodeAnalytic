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
 * @link		http://docs.codeanalytic.com/view/setting_database
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="database">
            <h2><?php echo ca_translate("database") ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
    <?php echo ca_translate('you must fill in fields database name, user and password.'); ?>
</div>
<div class="main_right">
    <div id="center_content" class="big_form"> 
        <div id="top_tap">
            <span><?php echo ca_translate("database info") ?> </span>
        </div>
        <form  id="sform">      
            <p style="padding: 0px; margin: 0px;">
                <label style="float: left; width: auto">* <?php echo ca_translate("database driver") ?>  </label>
                <b>&nbsp; ( <?php echo $default['db_driver'] ?> )</b>
            </p>
            <p style="padding: 0px; margin: 0px;">
                <label style="float: left; width: 97%">* <?php echo ca_translate("database name") ?> </label>
                <b>&nbsp; ( <?php echo ($default['db_name']) ? $default['db_name'] : '' ?> )</b>
                <i><?php echo ca_translate("name of your database") ?></i>
            </p>
            <p style="padding: 0px; margin: 0px;">
                <label style="float: left; width: 97%">* <?php echo ca_translate("database user") ?>  </label>
                <b>&nbsp; ( <?php echo ($default['db_user']) ? $default['db_user'] : '' ?> )</b>
                <i><?php echo ca_translate("user grant of your database") ?></i>
            </p>
            <p style="padding: 0px; margin: 0px;">
                <label style="float: left; width: 97%">* <?php echo ca_translate("database password") ?> </label>
                <b>&nbsp; ( <?php echo ($default['db_pass']) ? $default['db_pass'] : '' ?> )</b>
                <i><?php echo ca_translate("user password of your database") ?></i>
            </p>
        </form> 
    </div>
</div>     
<div class="main_left" style="border-left: 1px solid #EBEBEB">
    <div class="small_form">
        <div id="top_tap"><span><?php echo ca_translate('backup database');?></span></div>
        <div class="tabs_bar" style="float: left; width: 97%">
            <a onclick="ca_tabs(this,'.list_tb')" class="selected" href="javascript:void(0)"><?php echo ca_translate('table list');?></a>
            <a onclick="ca_tabs(this,'.backup_list')" href="javascript:void(0)"><?php  echo ca_translate('backup list');?></a>
        </div>
        <div id="tabs_bar" style="float: left;width: 96%">
            <div class="list_tb box">
                <form id="backup_db">                
                    <div class="tables" style="border: 1px solid #EBEBEB; float: left">
                        <?php
                        while ($data = mysql_fetch_row($tables_name)) {
                            echo "<div id='$data[0]' style='float:left;width:30%; margin-left:2%'><input type='checkbox' name='id[]' id='1' onclick='ca_check_table(this)' class='check' value='" . $data[0] . "'>" . $data[0] . "</div>";
                        }
                        ?> 
                    </div>
                    <div style="float: left; width: 100%; border-top: 1px solid #EBEBEB; margin-top: 20px" id="bar_button">
                        <input type="checkbox" id="1" class="ck" style="cursor: pointer; margin-left: 3%;" onclick="ca_check_all('.ck')"><?php echo ca_translate('check all or check one for');?>
                        <a href="javascript:void(0)" class="button-red" onclick="ca_backupdb()">backup</a> <?php echo ca_translate('table');?>
                    </div>
                </form>
            </div>
        </div>
        <div id="tabs_bar" style="float: left; width: 96%;">
            <div style="border:1px solid #EBEBEB; float: left; width: 96%; padding: 10px; display: none;" class="backup_list box">
                <?php
                $base = "./system/application/backup";
                $dir = opendir($base);
                while (false !== ($file = readdir($dir))) {
                    $data[] = $file;
                }
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i] <> '.' && $data[$i] <> '..' && $data[$i] <> 'index.html' ) {
                        ?>
                <div style="float: left; width: 100%; border-bottom: 1px solid #EBEBEB; background: #F9F9F9" class="db_<?php echo $i ?>">
                    <a href="javascript:void(0)" style="float: left" onclick="ca_dbrestore('<?php echo $data[$i] ?>')"><?php echo ca_translate('restore');?> | </a>
                    <a href="javascript:void(0)" style="float: left" onclick="ca_db_delete('<?php echo $data[$i] ?>','db_<?php echo $i ?>')">&nbsp;<?php echo ca_translate('delete');?> | </a> 
                    <a href="<?php echo base_url().'settings/download_db/'. $data[$i] ?>">&nbsp;<?php echo ca_translate('download');?></a>
                    
                    <a href="javascript:void(0)" style="float: right; width: 60%" id="header" class="hide" onclick="ca_slide_(this,'ul.db_<?php echo $i ?>')"><?php echo $data[$i] ?></a>
                    </div>
                <ul class="db_<?php echo $i ?>">
                        <?php
                        $ca = ca_list_dir($base . "/" . $data[$i]);
                        for ($j = 0; $j < count($ca); $j++) {
                            echo "<li>" . $ca[$j] . "</li>";
                        }
                        ?>
                    </ul>
                    <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
</div>
