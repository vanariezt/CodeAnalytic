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
 * @link		http://docs.codeanalytic.com/view/menu_bottom
 */ 
?>
<div id="bottom_left">
<ul>
    <li>
        <?php echo CA_COPYRIGHT ?>
    </li> 
    <li>
        <a href="http://codeanalytic.com/codeanalytic-privacy-policy"><?php echo ca_translate("term of privacy") ?></a>
    </li>
    <li>
        <a href="http://codeanalytic.com/codeanalytic-term-and-conditon"><?php echo ca_translate("term of use") ?></a>
    </li>
</ul>
</div>
<div id="bottom_right" >
       <?php ca_list_lang(); ?>
       <div id="bottom_fix">   
           <div id="btn_fix_right" class="open" onclick="ca_slide_log(this)"> <span>Logs</span></div> 
            <div id="btn_fix_dest" contenteditable="editable" class="hide"></div>                    
        </div> 
</div>