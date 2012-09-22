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
 * @subpackage          Template
 * @category            Config file
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/template/mconfig
 */

$config['mobile_theme'] = 'b'; 
$config['desc']['mobile_theme'] = 'please check one, the mobile theme collor that you like';

$config['limit_caracter'] = '150';
$config['desc']['limit_caracter'] = 'number caracter to limit post content in mobile';

$config['m_column_top'] = 'TRUE';
$config['desc']['m_column_top'] = 'is show top position for top mobile widget';

$config['m_column_bottom'] = 'TRUE';
$config['desc']['m_column_bottom'] = 'is show top position for bottom mobile widget';

// End of mobile setting
//------------------------------------------------------------------------------------------

?>
