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


if (!function_exists('ca_google_add_plush')) {

    function ca_google_add_plush() {
        ?>
        <!-- Place this tag where you want the +1 button to render -->
       <span id="plus_share">
        <g:plusone size="medium" style="width:100px"></g:plusone>

        <!-- Place this render call where appropriate -->
        <script type="text/javascript">
            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
        </script>
       </span>
        <?php
    }

}
?>
