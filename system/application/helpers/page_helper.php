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
 * g+ Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/g+_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* |
  | Helper : ca_page_print
  |----------------------------------------------------------------------------
  |
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_page_print')) {

    function ca_page_print() {
        echo "<a class=\"print_page\" href=\"javascript:void(0)\" onclick=\"window.print()\"> </a> ";
    }

}
/* |
  | Helper : ca_font_page
  |----------------------------------------------------------------------------
  |
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_font_page')) {

    function ca_font_page() {
        echo "<a href=\"javascript:void(0)\" onclick=\"font_plus('.content')\">A+</a><a href=\"javascript:void(0)\" onclick=\"font_min('.content')\">A-</a>";
    }

}

/**
 * js plugin in use 
 */
if (!function_exists('ca_plugin_js_active')) {

    function ca_plugin_js_active() {
        $CA = & get_instance();
        //$CA->output->cache(1);
        $dir = 'system/application/third_party/';
        foreach ($CA->db->query('SELECT title FROM ca_third_party WHERE publish="1"')->result() as $r) {
            $start_dir = $dir . $r->title;
            $third_party = ca_list_dir('./' . $start_dir);
            if (count($third_party) > 0) {
                for ($j = 0; $j < count($third_party); $j++) {
                    $pl = explode('/', $third_party[$j]);
                    $title = $pl[count($pl) - 1];
                    $p = explode('.', $third_party[$j]);
                    $ext = $p[count($p) - 1];
                    $src = base_url() . $start_dir . "/" . $title;
                    if ($ext == 'css') {
                        echo "<link rel='stylesheet' type='text/css' href='$src'/>";
                    } else if ($ext == 'js') {
                        echo "<script type='text/javascript' src='$src'></script>";
                    }
                }
            }
        }
    }

}

/* |
  | Helper : ca_index_header
  |----------------------------------------------------------------------------
  | Get return value of application index header
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_index_header')) {

    function ca_index_header() {
        $CA = & get_instance();
        //$CA->output->cache(1);
        if (ca_template_setting('is_share')) {
            ca_fb_index_header();
            ca_twit_index_header();
        }
        ?>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>system/application/views/codeanalytic_template/<?php echo ca_theme_current()->name ?>/main.css"/>
        <meta name="robots" content="<?php echo ca_setting('meta_robot') ?>">
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script> 
        <link href="<?php echo base_url() ?>system/application/third_party/prettify/prettify.css" type="text/css" rel="stylesheet"/> 
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/prettify/prettify.css"></script> 
        <script type='text/javascript' src='<?php echo base_url() ?>system/application/third_party/core/codeanalytic.validation.js'></script>
        <script type='text/javascript' src='<?php echo base_url() ?>system/application/third_party/core/codeanalytic.web.js'></script>
        <script type='text/javascript'>
            var site = "<?php echo base_url(); ?>";
            var loadImg = "<img src='<?php echo base_url(); ?>assets/loading.gif' align='center'/>";    
        </script>  
        
        <?php
        ca_plugin_js_active();
    }

}

/* |
  | Helper : ca_index_header
  |----------------------------------------------------------------------------
  | Get return value of application index header
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_mobile_index_header')) {

    function ca_mobile_index_header() {
        $CA = & get_instance();
        if (ca_template_setting('is_share')) {
            ca_fb_index_header();
            ca_twit_index_header();
        }
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>system/application/views/codeanalytic_template/<?php echo ca_theme_current()->name ?>/mobile/mobile_main.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script> 
        <link href="<?php echo base_url() ?>system/application/third_party/prettify/prettify.css" type="text/css" rel="stylesheet"/> 
        <script type='text/javascript'>
            var site = "<?php echo base_url(); ?>";
            var loadImg = "<img src='<?php echo base_url(); ?>assets/loading.gif' align='center'/>";   
            
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/mobile/js/jquery.mobile_1.0.min.js"></script>  
        <?php
    }

}

if (!function_exists('ca_word_censor')) {

    function ca_word_censor($texts) {
        $CA = & get_instance();
        $w = $CA->db->query("SELECT * FROM ca_word_censor WHERE publish ='1'");
        foreach ($w->result() as $r) {
            $texts = str_ireplace($r->word, $r->replace, $texts);
        }
        return $texts;
    }

}

function ca_get_smiley($element, $number_col = 8) {
    $CA = & get_instance();
    $CA->load->library('table');
    $CA->load->helper('smiley');
    echo smiley_js();
    $image_array = get_clickable_smileys(base_url() . '/assets/images/smileys/', "$element");
    $val = $CA->table->make_columns($image_array, $number_col);
    echo $CA->table->generate($val);
}
?>