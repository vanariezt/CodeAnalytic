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
 * widget Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/widget_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* |
  | Helper : ca_widget_setting
  |----------------------------------------------------------------------------
  | Get return value of widget setting
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_widget_setting')) {

    function ca_widget_setting($key, $function, $type = '0') {
        $CA = & get_instance();
        $CA->load->library('ca_conf');
        if ($type == '0') {
            $CA->ca_conf->load('widgets/config/', 'config_' . $function . '_wi' . EXT);
        } else if ($type == '1') {
            $CA->ca_conf->load('widgets/mobile/mconfig/', 'config_' . $function . '_wi' . EXT);
        }

        return $CA->ca_conf->item($key);
    }

}
/*
 * | helper : ca_widget_show for browser
 */
if (!function_exists('ca_widget_show')) {

    function ca_widget_show($id) {
        switch ($id) {
            case '1':
                $title = 'top';
                break;
            case '2':
                $title = 'right';
                break;
            case '3':
                $title = 'bottom';
                break;
            case '4':
                $title = 'left';
                break;
            case '5':
                $title = 'timeline';
                break;
            default:
                break;
        }
        $CA = & get_instance();
        $CA->load->model('mwidget');
        if ($CA->mwidget->get_all($id, ca_theme_id())->num_rows() > 0) {
            foreach ($CA->mwidget->get_all($id, ca_theme_id())->result() as $r) {
                if ($r->id_htmlarea == '0') {
                    $w[] = str_replace('wi_', '', $r->name);
                    $f[] = $r->name;
                    $d[] = '';
                } else {
                    $w[] = 'htmlarea';
                    $d[] = $r->id_htmlarea;
                    $f[] = 'htmlarea_wi';
                }
            }
            $CA->load->widgets($w);
            for ($i = 0; $i < count($f); $i++) {
                echo "<div class='widget_$title'>";
                if ($w[$i] == 'htmlarea') {
                    $f[$i]($id, $d[$i]);
                } else if (function_exists("$f[$i]")) {
                    $f[$i]();
                }
                echo "</div>";
            }
        }
    }

}

/*
 * | helper : ca_widget_show for browser
 */
if (!function_exists('ca_mwidget_show')) {

    function ca_mwidget_show($id) {
        switch ($id) {
            case '6':
                $title = 'mobile top';
                break;
            case '7':
                $title = 'mobile bottom';
                break; 
            default:
                break;
        }
        $CA = & get_instance();
        $CA->load->model('mwidget');  
        if ($CA->mwidget->get_all($id, ca_theme_id(),'1')->num_rows() > 0) {
            foreach ($CA->mwidget->get_all($id, ca_theme_id(),'1')->result() as $r) {
                if ($r->id_htmlarea == '0') {
                    $w[] = "mobile/".str_replace('wi_', '', $r->name);
                    $f[] = $r->name;
                    $d[] = '';
                } else {
                    $w[] = 'htmlarea';
                    $d[] = $r->id_htmlarea;
                    $f[] = 'htmlarea_wi';
                }
            }
            
            $CA->load->widgets($w); 
            for ($i = 0; $i < count($f); $i++) {
                echo "<div class='widget_$title'>";
                if ($w[$i] == 'htmlarea') {
                    $f[$i]($id, $d[$i]);
                } else if (function_exists("$f[$i]")) {
                    $f[$i]();
                }
                echo "</div>";
            }
        }
    }

}
?>
