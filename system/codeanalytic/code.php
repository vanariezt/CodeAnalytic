<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * archives Class
 *
 * @package		Application
 * @subpackage          CodeAnalytic
 * @category            Class
 * @author		CodeAnalytic Team Web Developer 
 */
// CA POWERED 
// CI Version
require BASEPATH . 'codeanalytic/active' . EXT;
require BASEPATH . 'codeanalytic/constants' . EXT;
require BASEPATH . 'codeanalytic/CodeAnalytic' . EXT;

if (is_dir(FCPATH . 'installer')) {
    exit('please remove installer directory');
} else {
    if (ca_permitted()) {
        if (defined('CA_COPYRIGHT')) {
            $panel = file_get_contents(BASEPATH . 'application/views/menu_bottom.php');
            if (preg_match('/CA_COPYRIGHT/', $panel)) {
                $panel = file_get_contents(BASEPATH . 'application/views' . $active . 'index.php');
                if (preg_match('/CA_ENGINE/', $panel)) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $proxy = file_get_contents(BASEPATH . 'codeanalytic/proxy' . EXT);
                    $ban = explode(',', $proxy);
                    if (!in_array($ip, $ban)) {
                        define('CI_VERSION', '1.7.2');

                        /*
                         * ------------------------------------------------------
                         *  Load the global functions
                         * ------------------------------------------------------
                         */
                        require(BASEPATH . 'codeanalytic/Common' . EXT);

                        /*
                         * ------------------------------------------------------
                         *  Load the compatibility override functions
                         * ------------------------------------------------------
                         */
                        require(BASEPATH . 'codeanalytic/Compat' . EXT);

                        /*
                         * ------------------------------------------------------
                         *  Load the framework constants
                         * ------------------------------------------------------
                         */
                        require(APPPATH . 'config/constants' . EXT);

                        /*
                         * ------------------------------------------------------
                         *  Define a custom error handler so we can log PHP errors
                         * ------------------------------------------------------
                         */
                        set_error_handler('_exception_handler');

                        if (!is_php('5.3')) {
                            @set_magic_quotes_runtime(0); // Kill magic quotes
                        }

                        /*
                         * ------------------------------------------------------
                         *  Start the timer... tick tock tick tock...
                         * ------------------------------------------------------
                         */

                        $BM = & load_class('Benchmark');
                        $BM->mark('total_execution_time_start');
                        $BM->mark('loading_time_base_classes_start');

                        /*
                         * ------------------------------------------------------
                         *  Instantiate the hooks class
                         * ------------------------------------------------------
                         */

                        $EXT = & load_class('Hooks');

                        /*
                         * ------------------------------------------------------
                         *  Is there a "pre_system" hook?
                         * ------------------------------------------------------
                         */
                        $EXT->_call_hook('pre_system');

                        /*
                         * ------------------------------------------------------
                         *  Instantiate the base classes
                         * ------------------------------------------------------
                         */

                        $CFG = & load_class('Config');
                        $URI = & load_class('URI');
                        $RTR = & load_class('Router');
                        $OUT = & load_class('Output');

                        /*
                         * ------------------------------------------------------
                         * 	Is there a valid cache file?  If so, we're done...
                         * ------------------------------------------------------
                         */

                        if ($EXT->_call_hook('cache_override') === FALSE) {
                            if ($OUT->_display_cache($CFG, $URI) == TRUE) {
                                exit;
                            }
                        }

                        /*
                         * ------------------------------------------------------
                         *  Load the remaining base classes
                         * ------------------------------------------------------
                         */

                        $IN = & load_class('Input');
                        $LANG = & load_class('Language');

                        /*
                         * ------------------------------------------------------
                         *  Load the app controller and local controller
                         * ------------------------------------------------------
                         *
                         *  Note: Due to the poor object handling in PHP 4 we'll
                         *  conditionally load different versions of the base
                         *  class.  Retaining PHP 4 compatibility requires a bit of a hack.
                         *
                         *  Note: The Loader class needs to be included first
                         *
                         */
                        if (!is_php('5.0.0')) {
                            load_class('Loader', FALSE);
                            require(BASEPATH . 'codeanalytic/Base4' . EXT);
                        } else {
                            require(BASEPATH . 'codeanalytic/Base5' . EXT);
                        }

// Load the base controller class
                        load_class('Controller', FALSE);

// Load the local application controller
// Note: The Router class automatically validates the controller path.  If this include fails it 
// means that the default controller in the Routes.php file is not resolving to something valid.
                        if (!file_exists(APPPATH . 'controllers/' . $RTR->fetch_directory() . $RTR->fetch_class() . EXT)) {
                            show_error('Unable to load your default controller.  Please make sure the controller specified in your Routes.php file is valid.');
                        }

                        include(APPPATH . 'controllers/' . $RTR->fetch_directory() . $RTR->fetch_class() . EXT);

// Set a mark point for benchmarking
                        $BM->mark('loading_time_base_classes_end');


                        /*
                         * ------------------------------------------------------
                         *  Security check
                         * ------------------------------------------------------
                         *
                         *  None of the functions in the app controller or the
                         *  loader class can be called via the URI, nor can
                         *  controller functions that begin with an underscore
                         */
                        $class = $RTR->fetch_class();
                        $method = $RTR->fetch_method();

                        if (!class_exists($class)
                                OR $method == 'controller'
                                OR strncmp($method, '_', 1) == 0
                                OR in_array(strtolower($method), array_map('strtolower', get_class_methods('Controller')))
                        ) {
                            show_404("{$class}/{$method}");
                        }

                        /*
                         * ------------------------------------------------------
                         *  Is there a "pre_controller" hook?
                         * ------------------------------------------------------
                         */
                        $EXT->_call_hook('pre_controller');

                        /*
                         * ------------------------------------------------------
                         *  Instantiate the controller and call requested method
                         * ------------------------------------------------------
                         */

// Mark a start point so we can benchmark the controller
                        $BM->mark('controller_execution_time_( ' . $class . ' / ' . $method . ' )_start');

                        $CI = new $class();

// Is this a scaffolding request?
                        if ($RTR->scaffolding_request === TRUE) {
                            if ($EXT->_call_hook('scaffolding_override') === FALSE) {
                                $CI->_ci_scaffolding();
                            }
                        } else {
                            /*
                             * ------------------------------------------------------
                             *  Is there a "post_controller_constructor" hook?
                             * ------------------------------------------------------
                             */
                            $EXT->_call_hook('post_controller_constructor');

                            // Is there a "remap" function?
                            if (method_exists($CI, '_remap')) {
                                $CI->_remap($method);
                            } else {
                                // is_callable() returns TRUE on some versions of PHP 5 for private and protected
                                // methods, so we'll use this workaround for consistent behavior
                                if (!in_array(strtolower($method), array_map('strtolower', get_class_methods($CI)))) {
                                    show_404("{$class}/{$method}");
                                }

                                // Call the requested method.
                                // Any URI segments present (besides the class/function) will be passed to the method for convenience
                                call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));
                            }
                        }

// Mark a benchmark end point
                        $BM->mark('controller_execution_time_( ' . $class . ' / ' . $method . ' )_end');

                        /*
                         * ------------------------------------------------------
                         *  Is there a "post_controller" hook?
                         * ------------------------------------------------------
                         */
                        $EXT->_call_hook('post_controller');

                        /*
                         * ------------------------------------------------------
                         *  Send the final rendered output to the browser
                         * ------------------------------------------------------
                         */

                        if ($EXT->_call_hook('display_override') === FALSE) {
                            $OUT->_display();
                        }

                        /*
                         * ------------------------------------------------------
                         *  Is there a "post_system" hook?
                         * ------------------------------------------------------
                         */
                        $EXT->_call_hook('post_system');

                        /*
                         * ------------------------------------------------------
                         *  Close the DB connection if one exists
                         * ------------------------------------------------------
                         */
                        if (class_exists('CI_DB') AND isset($CI->db)) {
                            $CI->db->close();
                        }
                    } else {
                        exit("I'm sorry, you've been banned. $ip");
                    }

                    /* End of file CodeIgniter.php */
                    /* Location: ./system/codeanalytic/CodeIgniter.php */
                } else {
                    
                    exit('You can not access this application. Please do not change powered engine by codeanalytic.com');
                }
            } else {
                exit('You can not access this application. Please do not change powered engine by codeanalytic.com');
            }
        } else {
            exit('You can not access this application. Please do not change powered engine by codeanalytic.com');
        }
    } else {
        exit('You can not access this application. Please do not change powered engine by codeanalytic.com');
    }
}
