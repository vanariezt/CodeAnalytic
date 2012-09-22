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
 * media_auth Libraries
 *
 * @package		CodeAnalytic
 * @subpackage          Libraries
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/libraries/media_auth
 */


class media_auth {

    var $CA = null;

    function __construct() { 
        $this->CA = & get_instance();
    }     
    function set_thumb_big($path,$img) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $img;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = ca_setting('big_thumb_width','media'); 
        $config['height'] = ca_setting('big_thumb_height','media'); 
        $config['thumb_marker'] = '_ca_thumb_big';
        return $config;
    } 
    function set_thumb_middle($path,$img) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $img;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = ca_setting('middle_thumb_width','media');  
        $config['height'] = ca_setting('middle_thumb_height','media');  
        $config['thumb_marker'] = '_ca_thumb_middle';
        return $config;
    } 
     function set_thumb_small($path,$img) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $img;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = ca_setting('small_thumb_width','media'); 
        $config['height'] = ca_setting('small_thumb_height','media'); 
        $config['thumb_marker'] = '_ca_thumb_small';
        return $config;
    }   
}

// End of library class
// Location: system/application/libraries/Auth.php
