<?php if (!defined('BASEPATH'))    exit('no direct script user allowed');$active = ca_theme_dir();

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
 * Views
 *
 * @package		CodeAnalytic
 * @subpackage          View
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/view/media_config
 */ 
?>
?>
<div class="header">
    <h2><?php echo ca_translate("update configuration setting media") ?></h2>
</div>
<form id="config" style="width: 98%; margin-bottom: 10px; float: left; padding: 10px">
    <?php
    if (is_file(APPPATH . 'config/media.php')) {
        $this->ca_conf->load('config/', 'media.php');
        if ($this->ca_conf->count > 0) {
            foreach ($this->ca_conf->array as $key => $value) {
                $desc = '';
                if (isset($this->ca_conf->array['desc'][$key])) {
                    $desc.=$this->ca_conf->array['desc'][$key];
                }
                if (!is_array($value)) {
                    if (($value == 'TRUE') || ($value == 'FALSE') || ($value == 'true') || ($value == 'flase')) {
                        ?>
                        <p> 
                            <label style="width: 23%"><?php echo str_replace('_', ' ', $key); ?></label>
                            <span id="con_set">
                                <input name="<?php echo $key; ?>" type="radio" value="TRUE" <?php echo set_radio('is_record_404', "TRUE", (isset($value) && $value == "TRUE" ) ? TRUE : FALSE)
                        ?>/> <?php echo ca_translate("Yes"); ?>
                                <input name="<?php echo $key; ?>" type="radio" value="FALSE" <?php echo set_radio('is_record_404', "FALSE", (isset($value) && $value == "FALSE" ) ? TRUE : FALSE)
                    ?>/> <?php echo ca_translate("No"); ?>
                                &nbsp;&nbsp<i><?php echo $desc ?></i>
                            </span>
                        </p>
                        <?php
                    } else {
                        ?>
                        <p> 
                            <label style="width: 23%"><?php echo str_replace('_', ' ', $key); ?>
                                <span><i><?php echo $desc ?></i></span>
                            </label>
                            <input validation="required" style="width: 73%" type="text" name="<?php echo $key; ?>" value="<?php echo $value ?>" size="25px">
                        </p>
                        <?php
                    }
                }
            }
        }
    }
    ?>
    <div class="footer">
        <label>&nbsp;</label>
        <a class="submit button-red rounded" href="javascript:void(0)" onclick="ca_edit_action('media/do_update/',this);"><?php echo ca_translate("update"); ?></a>
        <a class="button-red rounded" onclick='ca_close_box()'><?php echo ca_translate("exit"); ?></a>
    </div>
</form>

