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
 * @link		http://docs.codeanalytic.com/view/setting_index
 */ 
?>
<div id="bar_button">
    <div id="bar_button_left">
        <div id="top_title" class="info_page">
            <h2><?php echo ca_translate("info") ?></h2>
        </div>
    </div>
    <?php ca_menu_setting(); ?>
</div>
<div class="notes">
    <?php echo ca_translate('information engine you use. do not forget to update the latest version if you not.'); ?>
</div>
<div id="top_tap">
    <span><?php echo ca_translate("info") ?></span>
</div>
<form  id="sform" > 
    <p>
        <label><?php echo ca_translate("application") ?>  </label>  <b><?php echo ca_setting("app_name"); ?></b> 
        <i> (<?php echo ca_translate("this is name of application cms which build your website") ?>)</i>
    </p>
    <p>
        <label><?php echo ca_translate("version") ?> </label>
        <b>  <?php echo ca_setting("app_version"); ?> </b>
        <i> (<?php echo ca_translate("the version relase of CodeAnalytic cms") ?>)</i>
    </p>
    <p>
        <label><?php echo ca_translate("created by") ?>  </label>
        <b>CodeAnalytic, Inc</b> <i> (<?php echo ca_translate("for more information visited http://codeanalytic.org") ?>)</i>
    </p> 
</form> 