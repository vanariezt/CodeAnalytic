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
 * @link		http://docs.codeanalytic.com/widgets/htmlarea
 */

/**
 * widget for htmlarea 
 */
function htmlarea_wi($pos,$id) {
    $CA = & get_instance();
    $r=$CA->db->query("SELECT * FROM ca_htmlarea WHERE pos='$pos' && id='$id'")->row();
    echo "<div class='wi_title'>$r->title</div>"; 
    echo "<div class='ca_htmlarea'>"; 
       echo $r->html;
    echo "</div>";
}

?>
