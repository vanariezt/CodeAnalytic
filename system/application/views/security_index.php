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
 * @link		http://docs.codeanalytic.com/view/security_index
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="security">
            <h2><?php echo ca_translate("security") ?></h2>
        </div>
    </div> 
    <div id="bar_button_right">&nbsp;</div>
</div>
<div class="notes">
    <?php echo ca_translate('manage your security website for better secure'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("security") ?></span>
</div>
<div class="left_security" style="float: left; width: 60%"> 
    <div class="header"><h2 style="float: left;">&nbsp;<?php echo ca_translate('list ip banned'); ?></h2>
        <a href="javascript:void(0)" style="float: right" onclick="ca_load('security', '#cen_right')">refresh</a>
    </div>
    <ul class="ip_banned">
        <?php
        $ex = explode(',', $ip_banned);
        for ($i = 0; $i < count($ex); $i++) {
            ?>
            <li>&nbsp;[<span><?php echo $ex[$i]; ?></span>=><a href="javascript:void(0)" style="float: right" onclick="ca_delete_ip(this)"><?php echo ca_translate('delete') ?></a>]</li>
            <?php
        }
        ?>
    </ul>
</div> 
<div class="email_setting" style="float: left; width: 35%; margin-left: 2%; border: 1px solid #EBEBEB; border-bottom: none">
    <div id="bar_button" style="float: left; width: 100%; padding: 2px;">
        <a href="javascript:void(0)" id="header" class="hide"  onclick="ca_slide_(this,'ul.content')"><?php echo ca_translate('security option'); ?></a> 
    </div> 
    <ul class="content">
        <li>
            <a href="javascript:void(0)" onclick="ca_lightbox('security/ip_banned')">ip banned</a>
        </li> 
    </ul>
</div>
