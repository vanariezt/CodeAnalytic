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
 * config.php
 *
 * @package		Application
 * @subpackage          Template
 * @category            Config file
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/template/config
 */

$config['column_full'] = 'FALSE';
$config['desc']['column_full'] = 'if you want to view full page and no if not';

$config['column_top'] = 'TRUE';
$config['desc']['column_top'] = 'if you want to show top site in page and no if not';

$config['column_timeline'] = 'TRUE';
$config['desc']['column_timeline'] = 'if you want to view timeline in page and no if not';

$config['column_center'] = 'TRUE';
$config['desc']['column_center'] = 'if you want to view center site in page and no if not';

//if you want to add column left
//$config['column_left'] = 'TRUE';
//$config['desc']['column_left'] = 'if you want to view left site in page and no if not';

$config['column_right'] = 'TRUE';
$config['desc']['column_right'] = 'if you want to view right site in page and no if not';

$config['column_bottom'] = 'TRUE';
$config['desc']['column_bottom'] = 'if you want to view bottom site in page and no if not';

$config['plugin_number_of_comment'] = '7';
$config['desc']['plugin_number_of_comment'] = 'number of your comment';

$config['plugin_width'] = '300';
$config['desc']['plugin_width'] = 'size width of your plugin';

$config['plugin_comment_width'] = '635';
$config['desc']['plugin_comment_width'] = 'size width of your plugin comment, it is in pixel';

$config['plugin_height'] = '300';
$config['desc']['plugin_height'] = 'size height of your plugin';

$config['plugin_border'] = '#EBEBEB';
$config['desc']['plugin_border'] = 'border color of your plugin';

$config['site_name'] = 'CodeAnalytic Eng.CMS';
$config['desc']['site_name'] = 'site name of your situs';

$config['site_tag_line'] = 'New Spirit WEB Technology From Indonesia';
$config['desc']['site_tag_line'] = 'the tag line of your situs';

$config['results_per_page'] = '10';
$config['desc']['result_per_page'] = 'number of post show in page';

$config['date_format'] = 'd F Y';
$config['desc']['date_format'] = 'format time in post Ex:Y m d(1990-28-11), d F Y (28 November 1990)';

$config['time_format'] = 'h:i:s';
$config['desc']['time_format'] = 'format time in post Ex:h:i:s(10:10:10)';

$config['is_parse_smiley'] = 'TRUE';
$config['desc']['is_parse_smiley'] = 'if you want to parse post content to smiley image';

$config['is_censor'] = 'TRUE';
$config['desc']['is_censor'] = 'if you want to censor your post and comment from bad words';

$config['is_share'] = 'TRUE';
$config['desc']['is_share'] = 'if you want to share your web page';

$config['comment_via'] = 'fb';
$config['desc']['comment_via'] = 'select comment via facebook(fb) or default(default) Ex:fb or default';

$config['is_show_post_user'] = 'TRUE';
$config['desc']['is_show_post_user'] = 'if you want to show user post';

$config['is_show_post_date'] = 'TRUE';
$config['desc']['is_show_post_date'] = 'if you want to show date post';

$config['is_show_post_time'] = 'TRUE';
$config['desc']['is_show_post_time'] = 'if you want to show time post';

$config['limit_caracter'] = '400';
$config['desc']['limit_caracter'] = 'number caracter to limit post content';

/**
 * comment config 
 */
$config['is_comment'] = 'TRUE';
$config['desc']['is_comment'] = 'if you want your page can be comment from member or visitor';

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//----------------------------------