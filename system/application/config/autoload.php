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
 * autoload.php
 *
 * @package		Application
 * @subpackage          Config
 * @category            Array
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/config/autoload
 */

/**
 * add libraries, helpers, plugins, config, language and model that always call in every where 
 * use array if you call ,more than one
 * 
 */
$autoload['libraries'] = array('database', 'lang_detect', 'session');
$autoload['helper'] = array('url','text','smiley');
$autoload['plugin'] = array();
$autoload['config'] = array('lang_detect');
$autoload['language'] = array();
$autoload['model'] = array();


//-------------------------------------------------------------------------------
// End of file autoload.php  
// Location: ./system/application/config/autoload.php  
//------------------------------------------------------------------------------- 

