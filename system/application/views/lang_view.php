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
 * @link		http://docs.codeanalytic.com/view/lang_view
 */ 
?>
<form class="max_dir">
    <div id="file_name">
        <h2><?php echo $dir ?></h2>        
    </div> 
    <div id="file_act">
        <a style="float: left;" href="javascript:void(0)" type="button" class="button-red"  id="btn_submit" onclick="ca_edit_action('dir/change/<?php echo $file; ?>',this);">
            <?php echo ca_translate("submit"); ?>
        </a>
        <a style="float: left;" href="javascript:void(0)" onclick="ca_lightbox('dir/delete/<?php echo $file ?>/lang')" class="button-red" ><?php echo ca_translate("delete"); ?></a>
            <a style="float: left;" href="javascript:void(0)" class="button-red" onclick="ca_max_application()">max</a> 
    </div>
    <p>
        <textarea class="editor" name="content" style="width: 100%;"><?php echo $text ?></textarea>
    </p>
</form> 
<?php ca_editor_line(); ?>