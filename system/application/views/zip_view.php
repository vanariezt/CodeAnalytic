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
 * @link		http://docs.codeanalytic.com/view/zip_view
 */ 
?>
<div class="box-image">    
    <ul class="list_image">
        <?php
        $dir = opendir(base_upload().$abc);
        while (false !== ($file = readdir($dir))) {
            if (strpos($file, '.zip', 1)) {
                echo "<li><a href='javascript:void(0)' onclick=\"$('input.zip').val(this.rel);ca_close_box()\" rel='$file' id='caImage' style='max-width:100px;max-height:100px;' src='" . base_url() . "assets/images/upload/" .$abc . "'>$file</a></li>";
            }
        }
        ?>
    </ul>
</div>
<div class='footer'>
    <a class="button-red rounded" onclick='ca_close_box()'><?php echo ca_translate('exit');?></a>
</div> 