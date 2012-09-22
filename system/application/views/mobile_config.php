<?php if (!defined('BASEPATH'))    exit('no direct script user allowed'); $active = ca_theme_dir();

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
 * @link		http://docs.codeanalytic.com/view/mobile_config
 */ 
?>
<div id="top_tap">
    <span><?php echo ca_translate('codeanalytic theme config for mobile');?></span>
</div>
<a class="right_box" onclick='ca_close_setting()'>x</a>
<div class="header" style="position: relative">
    <?php
    $ex=  explode('/', $active);
    ?>
    <h2 align="center"><?php echo ca_translate('update configuration setting theme of') . ' "' .$ex['1'].'"' ; ?></h2>
</div>
<form id="config" style="width: 98%; margin-bottom: 10px; float: left; padding: 10px">
    <?php
    if (is_file(APPPATH . 'views/' . $active . 'mconfig.php')) {
        $this->ca_conf->load('views/' . $active, 'mconfig.php');
        if ($this->ca_conf->count > 0) {
            foreach ($this->ca_conf->array as $key => $value) {
                $desc = '';
                if (isset($this->ca_conf->array['desc'][$key])) {
                    $desc.=$this->ca_conf->array['desc'][$key];
                }
                if (!is_array($value)) {
                    if(($value=='a') || ($value=='b') || ($value=='c') || ($value=='d') || ($value=='e')){
                        ?>
                        <p class="theme">
                            <label>
                                <?php echo ca_translate("theme color"); ?>
                                <br/><i><?php echo $desc ?></i>
                            </label>
                            <span id="con_set">
                                <input name="mobile_theme" type="radio" value="a" <?php echo set_radio('mobile_theme', "a", isset($value) && $value == "a" ? TRUE : FALSE)
                                ?>/> <?php echo ca_translate("black"); ?>
                                <input name="mobile_theme" type="radio" value="b" <?php echo set_radio('mobile_theme', "b", isset($value) && $value == "b" ? TRUE : FALSE)
                                ?>/> <?php echo ca_translate("blue"); ?>
                                <input name="mobile_theme" type="radio" value="c" <?php echo set_radio('mobile_theme', "c", isset($value) && $value == "c" ? TRUE : FALSE)
                                ?>/> <?php echo ca_translate("grey"); ?>
                                <input name="mobile_theme" type="radio" value="d" <?php echo set_radio('mobile_theme', "d", isset($value) && $value == "d" ? TRUE : FALSE)
                                ?>/> <?php echo ca_translate("grey shine"); ?>
                                <input name="mobile_theme" type="radio" value="e" <?php echo set_radio('mobile_theme', "e", isset($value) && $value == "e" ? TRUE : FALSE)
                                ?>/> <?php echo ca_translate("yellow"); ?>
                            </span> 
                        </p>
                        <?php
                    }
                    else if (($value == 'TRUE') || ($value == 'FALSE') || ($value == 'true') || ($value == 'flase')) {
                        ?>
                        <p> 
                            <label><?php echo str_replace('_', ' ', $key); ?></label>
                            <span id="con_set">
                                <input name="<?php echo $key; ?>" type="radio" value="TRUE" <?php echo set_radio('is_record_404', "TRUE", (isset($value) && $value == "TRUE" ) ? TRUE : FALSE)?>/> 
                                    <?php echo ca_translate("yes"); ?>
                                <input name="<?php echo $key; ?>" type="radio" value="FALSE" <?php echo set_radio('is_record_404', "FALSE", (isset($value) && $value == "FALSE" ) ? TRUE : FALSE)?>/>
                                    <?php echo ca_translate("no"); ?>
                                &nbsp;&nbsp<i><?php echo $desc ?></i>
                            </span>
                        </p>
                        <?php
                    } else if ($value == 'fb' || $value == 'default') {
                        ?>
                        <p> 
                            <label><?php echo str_replace('_', ' ', $key); ?>
                                <span><i><?php echo $desc ?></i></span>
                            </label>
                            <span id="con_set">
                                <input name="<?php echo $key; ?>" type="radio" value="default" <?php echo set_radio('is_record_404', "default", (isset($value) && $value == "default" ) ? TRUE : FALSE) ?>/>
                                using default comment
                                <input name="<?php echo $key; ?>" type="radio" value="fb" <?php echo set_radio('is_record_404', "fb", (isset($value) && $value == "fb" ) ? TRUE : FALSE) ?>/> 
                                using facebook comment
                            </span>
                        </p>
                        <?php
                    } else {
                        ?>
                        <p> 
                            <label><?php echo str_replace('_', ' ', $key); ?>
                                <span><i><?php echo $desc ?></i></span>
                            </label>
                            <input validation="required" style="width: 63%" type="text" name="<?php echo $key; ?>" value="<?php echo $value ?>" size="25px">
                        </p>
                        <?php
                    }
                }
            }
        }
    }
    ?>
    <p id="p_submit">
        <label>&nbsp;</label>
        <a class="submit button-red rounded" style="left: 36%; position: absolute" href="javascript:void(0)" onclick="ca_edit_action('template/mobile_config_update/',this);"><?php echo ca_translate("update"); ?></a>
        <a class="submit button-red rounded" style="left: 45%; position: absolute" onclick='ca_close_setting()'><?php echo ca_translate("exit"); ?></a>
    </p>
</form>

