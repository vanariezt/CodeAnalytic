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
 * @link		http://docs.codeanalytic.com/view/media_view
 */ 
?>
<div class="header">
    <h2><?php echo ca_translate("all photo's in your media") ?></h2>
</div>
<div class="box-image">    
    <ul class="list_image">
        <?php
        $dir = opendir(base_upload().$abc);
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, 'small.gif', 1) || strpos($file, 'small.jpg', 1) || strpos($file, 'small.png', 1) || strpos($file, 'small.jpeg', 1)) {
                echo "<li><img onclick=\"ca_append_image(this)\" alt='$file' id='caImage'  src='" . base_url() . "assets/media/upload/" .$abc.$file . "'/></li>";
            }
        }
        ?>
    </ul>
</div>
<div class='footer'>
    <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate('exit') ?></a>
</div> 