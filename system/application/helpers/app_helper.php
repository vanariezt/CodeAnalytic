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
 * app Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/app_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/**
 * Get return value of application setting
 * function ca_setting();
 * @access public
 * @category function php
 * @example 
 * This example is how to get config value of your codeanalytic cms
 * 1. get site name -> ca_setting("site_name");
 * 2. get base_url -> ca_setting("site_name","config");
 */
if (!function_exists('ca_setting')) {

    function ca_setting($key, $config_file = 'codeanalytic') {
        if ($config_file <> 'database') {
            $CA = & get_instance();
            $CA->config->load($config_file);
            if ($key == 'mobile_theme') {
                return ($CA->session->userdata("mobile_theme") ? $CA->session->userdata("mobile_theme") : ca_mobile_setting('mobile_theme'));
            } else {
                return $CA->config->item($key);
            }
        } else {
            $fname = "./system/application/config/$config_file" . EXT;
            if (is_file($fname)) {
                $content = ca_get_content_text($fname);
                $ext = explode($key . "'] = '", $content);
                $val = explode('$db', $ext[1]);
                $rep = array("';", '";');
                return trim($v = str_replace($rep, '', $val[0]));
            }
        }
    }

}
/**
 * function ca_set_setting
 * change value of config
 * @access public
 * @category function php
 * @example
 * This exmaple how to change value of config
 * $key is array key config that will be change
 * $val is new value
 * $old_value is the old value
 * $config_file is name of file config
 * $path is the path where yuu take file php config
 * ca_set_setting($key, $val, $old_val, $config_file = 'codeanalytic', $path = './system/application/config/')
 */
if (!function_exists('ca_set_setting')) {

    function ca_set_setting($key, $val, $old_val, $config_file = 'codeanalytic', $path = './system/application/config/') {
        $fname = $path . $config_file . EXT;
        if (is_file($fname)) {
            $content = ca_get_content_text($fname);
            if ($config_file <> 'database') {
                $content = str_replace('$config[\'' . $key . '\'] = \'' . $old_val . '\';', '$config[\'' . $key . '\'] = \'' . $val . '\';', $content);
            } else {
                $content = str_replace('$db[\'default\'][\'' . $key . '\'] = \'' . $old_val . '\';', '$db[\'default\'][\'' . $key . '\'] = \'' . $val . '\';', $content);
            }
            ca_write_content_text($fname, $content);
        }
    }

}

/**
 * function ca_send_mail
 * sending email easy with ca_send_email()
 * @access public
 * @category function php
 * @example
 * sending email to address cacode@google.com
 * ca_send_email('youremail@google.com', 'yourname', 'cacode@google.com', 'your subject', 'your message')
 */
if (!function_exists('ca_send_mail')) {

    function ca_send_email($from, $name, $to, $subject, $message) {
        $CA = & get_instance();
        $CA->load->library('email');
        if (ca_check_connection()) {
            $CA->email->from($from, $name);
            $CA->email->to($to);
            $CA->email->subject($subject);
            $CA->email->message($message);
            $CA->email->send();
        }
    }

}

/**
 * function ca_get_content_text
 * return value of file
 * @access public
 * @category function php
 * @example ca_get_content_text('./system/application/config/config.php');
 */
if (!function_exists('ca_get_content_text')) {

    function ca_get_content_text($fname = '') {
        if ($fname <> '') {
            if (is_file($fname)) {
                $fhandle = fopen($fname, 'r');
                if (filesize($fname) > 0) {
                    $content = fread($fhandle, filesize($fname));
                }
                return $content;
                fclose($fhandle);
            }
        }
    }

}

/**
 * function ca_write_content_text
 * write and value of file
 * @access public
 * @category function php
 * @example ca_write_content_text('./system/application/config/config.php','your new content');
 */
if (!function_exists('ca_write_content_text')) {

    function ca_write_content_text($fname, $newcontent) {
        if (is_file($fname)) {
            $fhandle = fopen($fname, 'w');
            fwrite($fhandle, html_entity_decode($newcontent));
            fclose($fhandle);
        }
    }

}

/**
 * function ca_sort_order
 * easy sorting and order table
 * @access public
 * @category function php 
 */
if (!function_exists('ca_sort_order')) {

    function ca_sort_order($pages) {
        if (isUser()) {
            ?>
            <script type="text/javascript">
                $(function() {
                    ca_show_list("<?php echo $pages ?>")
                    ca_table_sort("<?php echo $pages ?>/order");  
                });
            </script> 
            <?php
        }
    }

}


/**
 * function ca_text_replace 
 * replace string 
 */
if (!function_exists("ca_text_replace")) {

    function ca_text_replace($text, $width = ' ', $method = '1') {
        switch ($method) {
            case 1:
                $arr_rep = array("'", '.', ',', '(', ')', '[', ']', '"', ' ', '-', '*', '&', '%', '#', '@', '!', '$', '^', ';', '{', '}');
                break;
            case 2:
                $arr_rep = array("<p>", '</p>', '<div>', '</div>', '<h2>', '</h2>', '<strong>', '</strong>', '<b>', '</b>');
            default:
                break;
        }
        return str_replace($arr_rep, $width, $text);
    }

}


/**
 * function ca_get_month
 * get return value of month
 * @access public
 * @category function php 
 */
if (!function_exists("ca_get_month")) {

    function ca_get_month($i) {
        switch ($i) {
            case '1':
                return 'January';
                break;
            case '2':
                return 'Februari';
                break;
            case '3':
                return 'March';
                break;
            case '4':
                return 'April';
                break;
            case '5':
                return 'Mei';
                break;
            case '6':
                return 'Juny';
                break;
            case '7':
                return 'July';
                break;
            case '8':
                return 'Agustus';
                break;
            case '9':
                return 'September';
                break;
            case '10':
                return 'October';
                break;
            case '11':
                return 'november';
                break;
            case '12':
                return 'December';
                break;
            default:
                break;
        }
    }

}

/**
 * function ca_delete_popup
 * view popup window for delete
 * @access public
 * @category function php 
 */
if (!function_exists("ca_delete_poppup")) {

    function ca_delete_poppup($page) {
        if (isUser()) {
            ?>
            <div class="information">
                <?php
                echo ca_translate("are you sure, want to delete table row was selected ?. <br/> choose one yes or no");
                ?>
            </div>
            <div class='footer'>
                <a class="button-red" onclick="ca_action_remove('<?php echo $page ?>');"><?php echo ca_translate("yes"); ?></a>
                &nbsp;
                <a class="button-red" onclick='ca_close_box()'><?php echo ca_translate("no"); ?></a>
            </div>
            <?php
        }
    }

}

/**
 * function ca_recursive_delete
 * delete file or folder
 * @access public
 * @category function php 
 */
if (!function_exists('ca_recursive_delete')) {

    function ca_recursive_delete($str) {
        if (isSuperadmin()) {
            if (is_file($str)) {
                return @unlink($str);
            } elseif (is_dir($str)) {
                $scan = glob(rtrim($str, '/') . '/*');
                foreach ($scan as $index => $path) {
                    ca_recursive_delete($path);
                }
                return @rmdir($str);
            }
        }
    }

}

/**
 * function ca_recursive_copy
 * easy sorting and order table
 * @access public
 * @category function php 
 */
if (!function_exists('ca_recurse_copy')) {

    function ca_recurse_copy($src, $dst) {
        if (isSuperadmin()) {
            $dir = opendir($src);
            @mkdir($dst);
            while (false !== ( $file = readdir($dir))) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if (is_dir($src . '/' . $file)) {
                        ca_recurse_copy($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        }
    }

}
/* |
  | Helper : ca_unzip
  |----------------------------------------------------------------------------
  | Unzip file
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_unzip')) {

    function unzip($path, $dest = '.') {
        if (isSuperadmin()) {
            $zip = new ZipArchive;
            if ($zip->open($path) === true) {

                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $zip->extractTo($dest, array($zip->getNameIndex($i)));
                }
                return $zip->getNameIndex('0');
                $zip->close();
            }
        }
    }

}

/* |
  | Helper : ca_right_top
  |----------------------------------------------------------------------------
  | Get view top application panel
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_right_top')) {

    function ca_right_top($page, $title, $search = TRUE, $list = TRUE, $insert = TRUE, $update = TRUE, $delete = TRUE, $type = TRUE) {
        if (isUser()) {
            ?>

            <div id="bar_button">
                <div id="bar_button_left">
                    <div id="top_title" class="<?php echo $page ?>">
                        <h2><?php echo ca_translate("$page") ?></h2>
                    </div>
                </div>
                <div id="bar_button_right">&nbsp;                
                    <?php
                    if ($search) {
                        ?>
                        <a href="javascript:void(0)" class="icons" onclick="ca_load('<?php echo $page; ?>/find', '#cen_find')"><?php echo ca_translate('search') ?></a>
                        <?php
                    }

                    $index = '';
                    if ($page == 'forum') {
                        $index = 'forum/data';
                    } else if ($page == 'gallery') {
                        $index = 'gallery/data';
                    } else {
                        $index = $page;
                    }
                    if ($list) {
                        ?>
                        <a href="javascript:void(0)" class="icons" onclick="ca_load('<?php echo $index; ?>', '#cen_right')"><?php echo ca_translate('list') ?></a>
                        <?php
                    } if ($insert) {
                        ?>
                        <a href="javascript:void(0)" class="icons" onclick="ca_load('<?php echo $page; ?>/insert','#cen_right')"><?php echo ca_translate('add') ?></a>
                        <?php
                    } if ($update) {
                        ?>
                        <a href="javascript:void(0)" class="icons" onclick="ca_edit_view('<?php echo $page; ?>/update', '<?php
                if ($type) {
                    echo '#cen_right';
                } else {
                    echo '.main_right';
                }
                        ?>')"><?php echo ca_translate('edit') ?></a>
                           <?php
                       } if ($delete) {
                           ?>
                        <a href="javascript:void(0)" class="icons" onclick="ca_delete_view('<?php echo $page; ?>/delete')"><?php echo ca_translate('delete') ?></a>
                    <?php } ?>
                </div>
            </div>
            <div id="cen_find"></div>        
            <?php
            if ($title != FALSE) {
                ?>
                <div id="top_tap" class="dinamic_tap">
                    <span><?php echo ca_translate("$title") ?></span>            
                </div>
                <?php
            }
        }
    }

}

/* |
  | Helper : ca_list_dir
  |----------------------------------------------------------------------------
  | Get list of directory
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_list_dir')) {

    function ca_list_dir($start_dir = '.') {
        $files = array();
        if (is_dir($start_dir)) {
            $fh = opendir($start_dir);
            while (($file = readdir($fh)) !== false) {
                # loop through the files, skipping . and .., and recursing if necessary
                if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0)
                    continue;
                $filepath = $start_dir . '/' . $file;
                if (is_dir($filepath))
                    $files = array_merge($files, ca_list_dir($filepath));
                else
                    array_push($files, $filepath);
            }
            closedir($fh);
        } else {
            # false if the function was called with an invalid non-directory argument
            $files = false;
        }

        return $files;
    }

}

/* |
  | Helper : ca_auto_field
  |----------------------------------------------------------------------------
  | Get auto_filed
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_auto_filed')) {

    function ca_auto_field($title) {
        return "onblur=\"if (this.value == '') {this.value = '$title'}\"  onfocus=\"if (this.value == '$title') {this.value = ''}\"";
    }

}
/* |
  | Helper : ca_tiny_mce
  |----------------------------------------------------------------------------
  | call tinyMCE function
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_tiny_mce')) {

    function ca_tiny_mce($atr, $methode) {
        if (isUser()) {
            switch ($methode) {
                case '1':
                    $button1 = 'formatselect,bullist,numlist,|,outdent,indent,blockquote|,tablecontrols';
                    $button2 = 'justifyleft,justifycenter,justifyright,justifyfull,|,pasteword,|,link,unlink,image,media,video,cleanup,|,forecolor,backcolor,|,hr,removeformat,|,sub,sup,|,fullscreen,|,code';
                    break;
                case '2':
                    $button1 = 'formatselect,justifyleft,justifycenter,justifyright,justifyfull,|,code';
                    $button2 = 'bullist,numlist,|,link,unlink,image,media,cleanup,|,forecolor,backcolor,|,hr,removeformat,|,fullscreen';
                    break;
                default:
                    break;
            }
            ?>

            <script type="text/javascript">  
                $().ready(function() {            
                    $('<?php echo $atr ?>').tinymce({
                        // Location of TinyMCE script
                        script_url : '<?php echo base_url() ?>system/application/third_party/tinymce/tiny_mce.js',
                        file_browser_callback : 'ca_media',
                        // General options
                        theme : 'advanced',
                        plugins : 'autolink,lists,pagebreak,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist',

                        // Theme options
                        theme_advanced_buttons1 : '<?php echo $button1 ?>',
                        theme_advanced_buttons2 : '<?php echo $button2 ?>',
                        theme_advanced_buttons3 : '',
                        theme_advanced_buttons4 : '',
                        theme_advanced_toolbar_location : 'top',
                        theme_advanced_toolbar_align : 'left',
                        theme_advanced_statusbar_location : 'bottom' 
                    });
                });
            </script> 
            <?php
        }
    }

}
/* |
  | Helper : ca_menu_setting
  |----------------------------------------------------------------------------
  | Get return value of application menu setting
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists('ca_menu_setting')) {

    function ca_menu_setting() {
        ?>
        <div id="bar_button_right"> 
            <a href="javascript:void(0)" class="icons" onclick="ca_load('dir', '#cen_right')"><?php echo ca_translate("application") ?></a>
            <a href="javascript:void(0)" class="icons" onclick="ca_load('languages', '#cen_right')"><?php echo ca_translate("language") ?></a> 
            <a href="javascript:void(0)" class="icons" onclick="ca_load('settings/database','#cen_right')"><?php echo ca_translate('database') ?></a>
            <a href="javascript:void(0)" class="icons" onclick="ca_load('settings/email','#cen_right')"><?php echo ca_translate('email') ?></a> 
            <a href="javascript:void(0)" class="icons" onclick="ca_load('settings/general','#cen_right')"><?php echo ca_translate('general') ?></a> 
            <a href="javascript:void(0)" class="icons" onclick="ca_load('settings/seo', '#cen_right')"><?php echo ca_translate('seo') ?></a>  
            <a href="javascript:void(0)" class="icons" onclick="ca_load('template','#cen_right')"><?php echo ca_translate('template') ?></a> 
        </div>
        <?php
    }

}
/**
 * | ca_check_connection()
 * | ----------------------------------------------------------------------------
 * | return value is you computer connect to internet
 */
if (!function_exists('ca_check_connection')) {

    function ca_check_connection() {
        $conn = @fsockopen("www.google.com", 80, $errno, $errstr, 30);
        if ($conn) {
            $status = TRUE;
            fclose($conn);
        } else {
            $status = FALSE;
        }
        return $status;
    }

}
/**
 * function is_ipad_user_agent
 * we give special atention in ipad, so the view will be show like computer browser
 * @return boolean 
 */
if (!function_exists('is_ipad_user_agent')) {

    function is_ipad_user_agent() {
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod')) {
            return TRUE;
        }
    }

}
/**
 * cek browser agent
 * @return boolean 
 */
if (!function_exists('is_mobile_user_agent')) {

    function is_mobile_user_agent() {
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
            return false;
        } else {
            if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|ipaq|ipad|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
                return true;
            else
                return false;
        }
    }

}

/**
 * replace html embed 
 * @param type $word
 * @return type 
 */
if (!function_exists('ca_embed_replace')) {

    function ca_embed_replace($word) {
        $word = str_replace('<p>&lt;object', '<p><object', $word);
        $word = str_replace('&lt;/object&gt;&nbsp;</p>', '></object>&nbsp;</p>', $word);
        $word = str_replace('<p>&lt;iframe', '<p><iframe', $word);
        $word = str_replace('&gt;&lt;/iframe&gt;</p>', '></iframe></p>', $word);
        $word = str_replace('<div>&lt;iframe', '<div><iframe', $word);
        $word = str_replace('&gt;&lt;/iframe&gt;</div>', '></iframe></div>', $word);
        return $word;
    }

}
/**
 * revers html embed
 * @param type $word
 * @return type 
 */
if (!function_exists('ca_embed_reverse')) {

    function ca_embed_reverse($word) {
        $word = str_replace('<p><object', '<p>&lt;object', $word);
        $word = str_replace('></object>&nbsp;</p>', '&lt;/object&gt;&nbsp;</p>', $word);
        $word = str_replace('<p><iframe', '<p>&lt;iframe', $word);
        $word = str_replace('></iframe></p>', '&gt;&lt;/iframe&gt;</p>', $word);
        $word = str_replace('<div><iframe', '<div>&lt;iframe', $word);
        $word = str_replace('></iframe></div>', '&gt;&lt;/iframe&gt;</div>', $word);
        return $word;
    }

}


if (!function_exists('ca_captcha')) {

    function ca_captcha() {
        $CA = &get_instance();
        $CA->load->helper('captcha');
        $vals = array(
            'word' => random_string('alnum',10),
            'img_path' => './assets/images/captcha/',
            'img_url' => './assets/images/captcha/', 
            'img_width' => '140',
            'img_height' => 30,
            'expiration' => 7200
        );
        return create_captcha($vals);
    }

}
/**
 * End of app_helper.php
 * Location: system/application/helpers/app_helper.php 
 */
?>