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
 * @link		http://docs.codeanalytic.com/widgets/archives
 */
/**
 * widget for archives 
 * created by CodeAnalytic 
 */
if (!function_exists('archives_css')) {

    function archives_css() {
        $bg_header = ca_widget_setting('bg_header', 'archives');
        $background = ca_widget_setting('background', 'archives');
        $link_color = ca_widget_setting('link_color', 'archives');
        $margin = ca_widget_setting('margin', 'archives');
        $border_color = ca_widget_setting('border_color', 'archives');
        ?>
        <style type="text/css">
            .wi_title_archives{
                padding: 5px;
                color: <?php echo $link_color ?>;
                background: <?php echo $bg_header ?>;
                font-weight: bold;
                text-transform: uppercase;
            }
            div.arc_year{
                
            }
            ul.widget_archives{
                list-style: none;
                width: 98%;
                float: left;
            }
            ul.widget_archives li, ul.ca_categories li a{ 
                float: left;
                width: 98%;
                margin: 0px;
                list-style: none;
                text-transform: capitalize;
                color: <?php echo $link_color ?>;
            }
            ul.widget_archives li{
                padding: 5px 0px; 
                margin-left: 10px;
            }
            #widget_archives{
                background: <?php echo $background ?>;
                margin: <?php echo $margin ?>;
                border:1px solid #EBEBEB;
                border-radius:5px;
                -moz-border-radius:5px;
                -o-border-radius:5px;
                -webkit-border-radius:5px;
            }
        </style>
        <?php
    }

}

function archives_wi() {
    $CA = & get_instance();
    $CA->load->model('marchives');
    $title = ca_widget_setting('title', 'archives');
    $width = ca_widget_setting('width', 'archives');
    echo "<div id='widget_archives' style='width:$width;float:left;'>";
    echo "<div class='wi_title_archives'>$title</div>";
    archives_css();
    echo "<ul class='widget_archives'>";
    for ($i = date('Y'); $i >= $CA->marchives->get_first_year(); $i--) {
        $count_year = $CA->marchives->count_year($i);
        echo "<li>
            <div class='arc_year'><a onclick=$('.arch_month').hide('slow');$('.arch_y_$i').show('slow'); href='javascript:void(0)'>$i ($count_year)</a></div>";
        if (date('Y') - $i == 1) {
            $display = "display:none";
        } else {
            $display = '';
        }
        echo "<ul style='$display'  class='arch_month arch_y_$i'>";
        for ($m = 1; $m <= 12; $m++) {
            $count_month = $CA->marchives->count_month($m, $i);
            if ($count_month > 0) {
                echo"<li>&raquo; <a href='" . base_url() . "archives/index/$i/$m'>" . ca_get_month($m) . " ($count_month)</a></li>";
            }
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ul>
        </div>";
}

?>
        
