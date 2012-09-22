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
 * Widget 
 *
 * @package		CodeAnalytic
 * @subpackage          Widgets
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/widgets/subscribe
 */

/**
 * widgets for subscribe
 */
function subscribe_wi() {
    $CA = & get_instance(); 
    $title=  ca_widget_setting('title', 'subscribe');
    $width=  ca_widget_setting('width', 'subscribe');
    $margin=  ca_widget_setting('margin', 'subscribe');
    //echo "<div class='wi_title'>$title</div>";
    ?>
<style type="text/css">
    div#subscribe form input{
        border: 1px solid #EBEBEB;
        padding: 5px;
        
    }
    div#subscribe{
        width: <?php echo $width ?>;
        margin: <?php echo $margin ?>
    }
    div#subscribe form input.field{
        width: 70%;
    }
    div#subscribe form input#ss-submit{
        background: #F9F9F9;
        cursor: pointer;
        width: 28%;
    }
</style>
<div id="subscribe"> 
        <form method="post" action="<?php echo base_url() ?>subscribe/do_insert"> 
            <input class="field" type="text" onblur="if (this.value == '') {this.value = 'subscribe your email...'}" onfocus="if (this.value == 'subscribe your email...') {this.value = ''}" value='subscribe your email...' name="email" id="s">
            <input type="submit" id="ss-submit" value="Subscribe"> 
        </form>
    </div>
    <?php
}
?>