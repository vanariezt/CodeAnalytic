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
 * email.php
 *
 * @package		Application
 * @subpackage          Config
 * @category            Array
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/config/email
 */

$config['auth']['mail']['mailtype'] = 'html';
$config['auth']['mail']['protocol'] = 'smtp';
$config['auth']['mail']['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['auth']['mail']['smtp_user'] = 'demo.codeanalytic@gmail.com';
$config['auth']['mail']['smtp_pass'] = 'demo1234354';
$config['auth']['mail']['smtp_port'] = '465';
$config['auth']['mail']['charset'] = 'utf-8';
$config['auth']['mail']['wordwrap'] = TRUE;



//-------------------------------------------------------------------------------
// End of file email.php  
// Location: ./system/application/config/email.php  
//------------------------------------------------------------------------------- 