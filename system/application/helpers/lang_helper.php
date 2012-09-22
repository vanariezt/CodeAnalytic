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
 * lang Heplers 
 *
 * @package		CodeAnalytic
 * @subpackage          Helper
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/helpers/lang_helper
 */
/* | 
  |----------------------------------------------------------------------------
  | CodeAnalytic Helper
  |----------------------------------------------------------------------------
  | All application helper create in codeanalytic is prefixs by ca_
 */

/* |
  | Helper : list_lang
  |----------------------------------------------------------------------------
  | Get list of language in codeanalytic
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists("ca_list_lang")) {

    function ca_list_lang() {
        $CA = & get_instance();
        echo form_open('languages/change', array('name' => 'langForm', 'id' => 'langForm'));
        ?>
        <input type="hidden" name="dlang" id="dlang">
        <input type="hidden" name="current" id="current" value="<?php echo substr(uri_string(), 1, strlen(uri_string())); ?>">
        <?php
         $CA->config->load('lang_detect');
        $default['lang_'] = ($CA->session->userdata("app_language") ? $CA->session->userdata("app_language") : $CA->config->item('lang_default'));
        $lang = $CA->config->item('lang_name');
        asort($lang);
        foreach ($lang as $key => $value) {
            $lang_[$value] = $key;
        }
        echo form_dropdown('lang_', $lang_, isset($default['lang_']) ? $default['lang_'] : '', "id='lang_' class ='form_field' onChange=\"ca_list_lang(this.value);\"");
        echo form_close();
    }

}
/* |
  | Helper : ca_translate
  |----------------------------------------------------------------------------
  | Return string translate
  |----------------------------------------------------------------------------
  |
 */
if (!function_exists("ca_translate")) {

    function ca_translate($str) {
        $CA = & get_instance();  
        $CA->lang->calang();
        return $CA->lang->line($str);
    }

}
?>