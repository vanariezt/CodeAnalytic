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
 * media.php
 *
 * @package		Application
 * @subpackage          Config
 * @category            Array
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/config/media
 */
$config['type_document'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
$config['desc']['type_document'] = 'type document allowed to upload in folder document if more than one split with(|)';
$config['type_zip'] = 'zip';
$config['desc']['type_zip'] = 'type zip allowed to upload in folder zip';
$config['type_image'] = 'jpg|gif|png|jpeg';
$config['desc']['type_image'] = 'type image allowed to upload in folder image if more than one split with(|)';

$config['max_file_size'] = '1024000000000'; // in size bite
$config['desc']['max_file_size'] = 'maximal size of file, that you upload';
$config['big_thumb_width'] = '600';
$config['desc']['big_thumb_width'] = 'size of width image big thumb';
$config['big_thumb_height'] = '350';
$config['desc']['big_thumb_height'] = 'size of height image big thumb';
$config['middle_thumb_width'] = '300';
$config['desc']['middle_thumb_width'] = 'size of width image middle thumb';
$config['middle_thumb_height'] = '175';
$config['desc']['big_thumb_height'] = 'size of height image middle thumb';
$config['small_thumb_width'] = '100';
$config['desc']['small_thumb_width'] = 'size of width image small thumb';
$config['small_thumb_height'] = '75';
$config['desc']['small_thumb_height'] = 'size of hieght image small thumb';
 

//-------------------------------------------------------------------------------
// End of file media.php  
// Location: ./system/application/config/media.php  
//-----------------------------------------------------------