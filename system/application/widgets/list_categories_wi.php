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
 * @link		http://docs.codeanalytic.com/widgets/categories
 */
/**
 * widget for archives 
 */
if (!function_exists('list_categories_css')) {

    function list_categories_css() {
        $bg_header = ca_widget_setting('bg_header', 'list_categories');
        $background = ca_widget_setting('background', 'list_categories');
        $link_color = ca_widget_setting('link_color', 'list_categories');
        $margin = ca_widget_setting('margin', 'list_categories');
        $border_color = ca_widget_setting('border_color', 'list_categories');
        ?>
        <style type="text/css">
            .wi_title_list_category{
                padding: 5px;
                color: <?php echo $link_color ?>;
                background: <?php echo $bg_header ?>;
                font-weight: bold;
                text-transform: uppercase;
            }
            ul.widget_list_categories{
                list-style: none;
                width: 100%;
            }
            ul.widget_list_categories li, ul.ca_categories li a{ 
                float: left;
                width: 96%;
                margin: 0px;
                list-style: none;
                text-transform: capitalize;
                color: <?php echo $link_color ?>;
            }
            ul.widget_list_categories li{
                padding: 5px; 
                border-bottom: 1px solid <?php echo $border_color ?>
            }
            ul.widget_list_categories li:last-child{
                border-bottom: none;
            }
            .widget_list_category{
                background: <?php echo $background ?>;
                margin: <?php echo $margin ?>;
                border: 1px solid <?php echo $border_color ?>;
                border-radius:5px;
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                -o-border-radius:5px;
                -ms-border-radius:5px;
            }
        </style>
        <?php
    }

}

if (!function_exists('list_categories_wi')) {

    function list_categories_wi() {
        $CA = & get_instance();
        $title = ca_widget_setting('title', 'list_categories');
        $limit = ca_widget_setting('limit', 'list_categories');
        $width = ca_widget_setting('width', 'list_categories');
        $show_number = ca_widget_setting('show_number', 'list_categories');
        list_categories_css();
        echo "<div class='widget_list_category' style='width:$width;float:left;'>";
        echo "<div class='wi_title_list_category'>$title</div>";
        $CA->load->model('mcategories');
        echo "<ul class='widget_list_categories'>";
        foreach ($CA->mcategories->widget($limit) as $r) {
            if ($show_number) {
                echo"<li><a href='" . base_url() . "$r->permalink'>$r->name (" . $CA->mcategories->count_by_id($r->id) . ")</a></li>";
            } else {
                echo"<li><a href='" . base_url() . "$r->permalink'>$r->name</a></li>";
            }
        }
        echo "</ul>
        </div>";
    }

}
?>
