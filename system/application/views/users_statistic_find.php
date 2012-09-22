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
 * @link		http://docs.codeanalytic.com/view/user_statistic_find
 */ 
?>
<div id="search_content">
    <div id="left">
        <form id="myform" method="post" onsubmit="return false">
            <p>
                <label style="width: 18.5%"><?php echo ca_translate('year / month') ?></label>
                <?php echo form_dropdown('m', $m, isset($default['m']) ? $default['m'] : '', "class = form_field"); ?>
                <?php echo form_dropdown('Y', $Y, isset($default['Y']) ? $default['Y'] : '', "class = form_field"); ?>
            </p>  
            <p id="p_submit">
                <a href="javascript:void(0)"  id="btn_submit" onclick="ca_find_action('<?php echo $action_form ?> ','#chart');"> <?php echo ca_translate('search') ?></a> 
                <a id="btn_submit" href="javascript:void(0)" onclick="ca_close_find()"><?php echo ca_translate("close");?></a>
            </p> 
        </form> 
    </div>
    <div id="right">
        <div id="top_tap">
            <span><?php echo ca_translate("search information");?></span>
        </div>
        <div id="s_info"></div>
    </div>
</div>