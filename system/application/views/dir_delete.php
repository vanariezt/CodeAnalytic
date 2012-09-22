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
 * @link		http://docs.codeanalytic.com/view/dir_delete
 */ 
?>
<div class="information">
    <?php echo ca_translate("are you sure want to delete this file");?> ("<?php echo $file ?>") ?
</div>
<div class='footer'> 
    <a type="btn_launcher" class="button-red"onclick="ca_file_remove('<?php echo $url ?>/do_delete/<?php echo $act ?>','<?php echo $m ?>','<?php echo $wi_type ?>')"><?php echo ca_translate("yes");?></a>
    &nbsp;
    <a type="btn_launcher" class="button-red" onclick="ca_close_box()" ><?php echo ca_translate("no");?></a>
</div>
 