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
 * fb Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/fb_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */


if (!function_exists('ca_fb_index_header')) {

    function ca_fb_index_header() {
        ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1&appId=<?php echo ca_setting('fb_appl_id', 'social') ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <meta property="fb:admins" content="<?php echo ca_setting('fb_user_id', 'social') ?>"/>
        <meta property="fb:app_id" content="<?php echo ca_setting('fb_appl_id', 'social') ?>"/>
        <?php
    }

}
/* |
 * | Helper : ca_comment_via_fb
 * |----------------------------------------------------------------------------
 * |
 * |----------------------------------------------------------------------------
 */
if (!function_exists('ca_comment_via_fb')) {

    function ca_comment_via_fb($link, $dnp = "5", $width = '550') {
        ?>
        <div class="fb-comments" data-href="<?php echo ca_setting('site_domain') . '/' . $link ?>" data-num-posts="<?php echo $dnp ?>" data-width="<?php echo $width ?>"></div>
        <?php
    }

}

/* |
 * | Helper : ca_count_comment_via_fb
 * |----------------------------------------------------------------------------
 * |
 * |----------------------------------------------------------------------------
 */
if (!function_exists('ca_count_comment_via_fb')) {

    function ca_count_comment_via_fb($link) {
        ?>
        <fb:comments-count href=<?php echo ca_setting('site_domain') . '/' . $link ?>></fb:comments-count>
        <?php
    }

}

if (!function_exists('ca_fb_button_send')) {

    function ca_fb_button_send() {
        ?>
        <span id="fb_share"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div></span><?php
    }

}
?>