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
 * @link		http://docs.codeanalytic.com/view/setting_mobile
 */ 
?>
<a class="right_box" onclick='ca_close_setting()'>x</a> 
<form  id="sform" >               
    <div id="bar_button">
        <a href="javascript:void(0)" id="header" class="hide" onclick="ca_slide_(this,'p.theme')"><?php echo ca_translate('mobile theme setting'); ?></a> 
    </div>
   
 
    <p id="p_submit">
        <a href="javascript:void(0)" id="btn_submit" style="left: 0px" onclick="ca_edit_setting_action('settings/update_mobile')">
<?php echo ca_translate("submit") ?>
        </a> 
        &nbsp;<i><b style="margin-left: 10px;"><?php echo ca_translate('Submit all setting') ?></b></i>
    </p>
</form>  