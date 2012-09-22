<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<html>
    <head>
        <title><?php echo ca_setting('site_name') . "-" ?> <?php echo isset($title) ? $title : "" ?> - CA mobile version 0.1</title> 
        <meta charset="utf-8">
        <meta http-equiv='expires' content='-1' />
        <meta http-equiv= 'pragma' content='no-cache' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/mobile/mobile-main.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script> 
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/themes/panel/images/favicon.png"/>  

    </head> 
    <body class="<?php echo isset($title) ? $title : "" ?>" data-theme="<?php echo ca_setting('mobile_theme'); ?>"> 
        <div data-role="page" class="type-home" data-theme="<?php echo ca_setting('mobile_theme'); ?>">
            <div id='top' data-role="header" data-theme="<?php echo ca_setting('mobile_theme') ?>" data-theme="<?php echo ca_setting('mobile_theme'); ?>" data-icon="home">
                <h1>Mobile Theme</h1>
            </div> 
            <div data-role="content" data-theme="<?php echo ca_setting('mobile_theme'); ?>">                  
                <fieldset data-role="controlgroup">
                    <input name="mobile_theme" type="radio" onclick="window.location='<?php echo base_url(); ?>template/mobile_set/a'" data-ajax="false" id="mobile-theme-a" value="a" <?php echo set_radio('mobile_theme', "a", isset($default['mobile_theme']) && $default['mobile_theme'] == "a" ? TRUE : FALSE) ?>/> 
                    <label for="mobile-theme-a">black</label>
                    <input name="mobile_theme" type="radio" onclick="window.location='<?php echo base_url(); ?>template/mobile_set/b'" data-ajax="false" id="mobile-theme-b" value="b" <?php echo set_radio('mobile_theme', "b", isset($default['mobile_theme']) && $default['mobile_theme'] == "b" ? TRUE : FALSE) ?>/>
                    <label for="mobile-theme-b">blue</label>
                    <input name="mobile_theme" type="radio" onclick="window.location='<?php echo base_url(); ?>template/mobile_set/c'" data-ajax="false" id="mobile-theme-c" value="c" <?php echo set_radio('mobile_theme', "c", isset($default['mobile_theme']) && $default['mobile_theme'] == "c" ? TRUE : FALSE) ?>/> 
                    <label for="mobile-theme-c">grey shine</label>
                    <input name="mobile_theme" type="radio" onclick="window.location='<?php echo base_url(); ?>template/mobile_set/d'" data-ajax="false" id="mobile-theme-d" value="d" <?php echo set_radio('mobile_theme', "d", isset($default['mobile_theme']) && $default['mobile_theme'] == "d" ? TRUE : FALSE) ?>/> 
                    <label for="mobile-theme-d">grey</label>
                    <input name="mobile_theme" type="radio" onclick="window.location='<?php echo base_url(); ?>template/mobile_set/e'" data-ajax="false" id="mobile-theme-e" value="e" <?php echo set_radio('mobile_theme', "e", isset($default['mobile_theme']) && $default['mobile_theme'] == "e" ? TRUE : FALSE) ?>/>
                    <label for="mobile-theme-e">yellow</label>
                </fieldset> 
            </div>  
        </div> 

    </body> 
</html>