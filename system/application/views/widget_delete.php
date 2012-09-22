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
 * @link		http://docs.codeanalytic.com/view/widget_delete
 */ 
?>
<div class="information">
    <?php echo ca_translate("are you sure want to delete this widget ?");?>
</div>
<div class='footer'>
    <?php
    $ul=$this->mwidget->get_where($id)->row()->position;
    ?>
    <a type="btn_launcher" class="button-red"onclick="ca_remove_widget('<?php echo $ul ?>','widget/do_delete/<?php echo $id ?>');"><?php echo ca_translate("yes");?></a>
    &nbsp;
    <a type="btn_launcher" class="button-red" onclick="ca_close_box()" ><?php echo ca_translate("no");?></a>
</div>
 