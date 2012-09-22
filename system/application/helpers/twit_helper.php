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
 * twit Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/twit_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/**
 * 
 */
if (!function_exists('ca_twit_index_header')) {

    function ca_twit_index_header() {
        ?>
        <script type="text/javascript" charset="utf-8">
            window.twttr = (function (d,s,id) {
                var t, js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
                js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
                return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
            }(document, "script", "twitter-wjs"));
        </script>
        <?php
    }

}
/* |
  | Helper : ca_button_twitter
  |----------------------------------------------------------------------------
  |
  |----------------------------------------------------------------------------
  |
 */

if (!function_exists('ca_button_twitter')) {

    function ca_button_twitter($type = 'share&like', $via = 'codeanalytic') {
        echo "<span id='twitter_share'>";
        switch ($type) {
            case 'share&like':
                ?>
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $via; ?>" data-lang="<?php echo ca_setting('lang_default'); ?>">Tweet</a>
                <?php
                break;
            case 'follow':
                ?>
                <a href="https://twitter.com/<?php echo $via ?>" class="twitter-follow-button" data-show-count="false" data-lang="<?php echo ca_setting('lang_default'); ?>"><?php echo ca_translate('Follow') . "" . $via ?></a>
                <?php
                break;
            case 'hastag':
                ?>
                <a href="https://twitter.com/intent/tweet?button_hashtag=#" class="twitter-hashtag-button" data-lang="<?php echo ca_setting('lang_default'); ?>" data-related="<?php echo $via; ?>">Tweet #</a>
                <?php
                break;
            case 'mention':
                ?>
                <a href="https://twitter.com/intent/tweet?screen_name=<?php echo $via ?>" class="twitter-mention-button" data-lang="<?php echo ca_setting('lang_default'); ?>" data-related="<?php echo $via ?>">Tweet to @<?php echo $via ?></a>
                <?php
                break;
            default:
        }
        echo "</span>";
    }

}
?>
