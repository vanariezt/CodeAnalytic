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
 * ca_conf Libraries
 *
 * @package		CodeAnalytic
 * @subpackage          Libraries
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/libraries/ca_conf
 */


class ca_conf {

    var $config = array();
    var $count;
    var $array;
    var $is_loaded = array();

    function ca_conf() {
        $this->config = & get_config();
        log_message('debug', "Config Class Initialized");
    }

    function load($path = '', $file = '', $use_sections = FALSE, $fail_gracefully = FALSE) {
        if (isset($path)) {
            $file = ($file == '') ? 'config' : str_replace(EXT, '', $file);

            if (in_array($file, $this->is_loaded, TRUE)) {
                return TRUE;
            }

            if (!file_exists(APPPATH . $path . $file . EXT)) {
                if ($fail_gracefully === TRUE) {
                    return FALSE;
                }
                show_error('The configuration file ' . $file . EXT . ' does not exist.');
            }

            include(APPPATH . $path . $file . EXT);
            // return number of config array
            $this->count = count($config);
            // return array name
            $this->array = $config;
            if (!isset($config) OR !is_array($config)) {
                if ($fail_gracefully === TRUE) {
                    return FALSE;
                    
                }
                show_error('Your ' . $file . EXT . ' file does not appear to contain a valid configuration array.');
            }

            if ($use_sections === TRUE) {
                if (isset($this->config[$file])) {
                    $this->config[$file] = array_merge($this->config[$file], $config);
                } else {
                    $this->config[$file] = $config;
                }
            } else {
                $this->config = array_merge($this->config, $config);
            }

            $this->is_loaded[] = $file;
            unset($config);

            log_message('debug', 'Config file loaded: config/' . $file . EXT);
            return TRUE;
        }
    }

    function item($item, $index = '') {
        if ($index == '') {
            if (!isset($this->config[$item])) {
                return FALSE;
            }

            $pref = $this->config[$item];
        } else {
            if (!isset($this->config[$index])) {
                return FALSE;
            }

            if (!isset($this->config[$index][$item])) {
                return FALSE;
            }

            $pref = $this->config[$index][$item];
        }

        return $pref;
    }
 

    function set_item($item, $value) {
        $this->config[$item] = $value;
    }

}

