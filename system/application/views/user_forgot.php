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
 * @link		http://docs.codeanalytic.com/view/user_forgot
 */ 
?>
<div class="information">
    <?php
    echo ca_translate("get your new password with type your valid email. new password will be sended to your email");
    ?>
</div>
<div class="light_content">
    <p id="status"></p>
    <form> 
        <input style="width: 300px; border: 1px solid #EBEBEB; padding: 5px;" type="text" onblur="if (this.value == '') {this.value = 'type your email...'}" onfocus="if (this.value == 'type your email...') {this.value = ''}" value='type your email...' name="email" id="s">
        <font style="color: red">(*)</font> <?php echo ca_translate("type your email"); ?>
    </form>
</div>
<div class='footer'>
    <a class="button-red" href="javascript:void(0)" onclick="forgot_pasword()"><?php echo ca_translate("get new password"); ?></a>     
    <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate("exit"); ?></a>
</div>