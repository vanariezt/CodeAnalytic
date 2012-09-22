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
 * @link		http://docs.codeanalytic.com/widgets/link
  /**
 *
 * widgets for link
 */
if (!function_exists('simple_link_css')) {

    function simple_link_css() {
        $bg_header = ca_widget_setting('bg_header', 'simple_link');
        $background = ca_widget_setting('background', 'simple_link');
        $link_color = ca_widget_setting('link_color', 'simple_link');
        $margin = ca_widget_setting('margin', 'simple_link');
        $border_color = ca_widget_setting('border_color', 'simple_link');
        ?>
        <style type="text/css">
            .wi_title_simple_link{
                background: <?php echo $bg_header ?>;
                padding: 5px;
                text-transform: capitalize;
                font-weight: bold;
            }         
            #simple_link{
                margin: 0px;
                padding: 0px;
                background: <?php echo $background ?>
            } 
            #simple_link li,#simple_link li a{
                float: left;
                width: 98%;
                background: <?php echo $background ?>
            }
            #simple_link li a{
                padding: 5px;
                border-bottom: 1px solid <?php echo $border_color ?>;
                color: <?php echo $link_color ?>
            }
            #simple_link li:last-child a{
                border-bottom: none;
            }
            .widget_simple_link{
                margin: <?php echo $margin ?>;
                border: 1px solid <?php echo $border_color ?>;
                border-radius: 1px solid #EBEBEB;
                -moz-border-radius: 1px solid #EBEBEB;
                -webkit-border-radius: 1px solid #EBEBEB;
                -o-border-radius: 1px solid #EBEBEB;
                -ms-border-radius: 1px solid #EBEBEB;
            }
        </style> 
        <?php
    }

}
if (!function_exists('simple_link_wi')) {

    function simple_link_wi() {
        $CA = & get_instance();
        $title_ = ca_widget_setting('title', 'simple_link');
        $width = ca_widget_setting('width', 'simple_link');
        $limit = ca_widget_setting('limit', 'simple_link');
        echo "<div class='widget_simple_link' style='width:$width;float:left;'>";
        echo "<div class='wi_title_simple_link'>$title_</div>";
        simple_link_css();
        ?>  
        <ul id="simple_link">     
            <?php
            $query = $CA->db->query("
            SELECT 
                * 
            FROM 
                ca_link
            WHERE 
                `publish` = '1'
                AND `publish` = '1'
            LIMIT $limit"
            );
            if ($query->num_rows() > 0) {
                $no = 1;
                foreach ($query->result() as $r) {
                    ?>
                    <li style="list-style: radial-gradient">
                        <a target="<?php echo $r->target ?>" id="<?php echo $r->attr_id ?>" class="<?php echo str_replace(',', '', $r->attr_class); ?>" href="<?php echo "$r->url" ?>"><?php echo $r->title; ?></a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul> 
        <?php
    }

    echo "</div>";
}
?>