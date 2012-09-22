<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/widgets/menu
 */

/**
 * widget for menu
 */
function mobile_menu() {
    $CA = & get_instance();
    ?> 
    <div id="menu-content">
        <ul id="menu" class="localnav parent">
            <?php
            $menu = $CA->mmenu->get('1', 'desc');
            foreach ($menu->result() as $a) {
                echo
                "<li>
                <a href='" . base_url() . "$a->url' class='" . str_replace(',', '', $a->attr_class) . "' id='$a->attr_id'  target='" . $a->target . "' >$a->name</a>";
                if ($CA->mmenu->get_child($a->id)->num_rows() > 0) {
                    echo "<ul>";
                    foreach ($CA->mmenu->get_child($a->id, '1')->result() as $b) {
                        echo "
                        <li>
                            <a target='" . $b->target . "' href='" . base_url() . "$b->url' class='" . str_replace(',', '', $b->attr_class) . "' id='$b->attr_id'>$b->name</a>";
                        if ($CA->mmenu->get_child($b->id, '1')->num_rows() > 0) {
                            echo "<ul>";
                            foreach ($CA->mmenu->get_child($b->id, '1')->result() as $c) {
                                echo "
                                    <li>
                                        <a target='" . $c->target . "' href='" . base_url() . "$c->url' class='" . str_replace(',', '', $c->attr_class) . "' id='$c->attr_id'>$c->name</a>
                                    </li>";
                            }
                            echo"</ul>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
                echo"</li>";
            }
            ?>
            <li>
                <a href="<?php echo base_url() ?>template/mobile">Mobile Themes</a>
            </li> 
        </ul>
    </div> 
    <?php
}

function basic_menu_wi() {
    mobile_menu();
}
?>
