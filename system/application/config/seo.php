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
 * seo.php
 *
 * @package		Application
 * @subpackage          Config
 * @category            Array
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/config/seo
 */
$config['meta_title'] = 'codeanalytic cms';
$config['meta_keyword'] = 'codeanalytic,cms';
$config['meta_description'] = 'codeanalytic official website';
$config['meta_robot'] = 'all,index';
$config['google_analytic_code'] = html_entity_decode(ca_get_content_text(BASEPATH.'seo/google_analytic_code.txt'));
$config['alexa_code'] = html_entity_decode(ca_get_content_text(BASEPATH.'seo/alexa_code.txt'));
 

//-------------------------------------------------------------------------------
// End of file seo.php  
// Location: ./system/application/config/seo.php  
//-------------------------------------------------------------------------------