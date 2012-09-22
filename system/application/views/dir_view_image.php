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
 * @link		http://docs.codeanalytic.com/view/dir_view_image
 */ 
?>
<div class="header">
    <h2><?php echo ca_translate('manage image here'); ?></h2>
</div>
<p> 
     <img class="img_user" src="<?php echo $file ?>" align="left" style="float: left; padding: 5px; margin-right: 10px;">
    <a style="float: left;" href="javascript:void(0)" onclick="ca_lightbox('dir/delete/<?php echo $file ?>')" class="button-red" ><?php echo ca_translate("delete"); ?></a>
<p>  
    
<div class="footer">
    <a class="button-red"  href="javascript:void(0)" onclick="ca_close_box()"><?php echo ca_translate("exit"); ?></a>
</div>