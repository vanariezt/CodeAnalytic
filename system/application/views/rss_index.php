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
 * Views 
 *
 * @package		CodeAnalytic
 * @subpackage          View
 * @category            Function
 * @author		CodeAnalytic Team Web Developer
 * @link		http://docs.codeanalytic.com/view/rss_index
 */ 

header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>
       <rss version='2.0'>
        <channel>
            <title>".ca_setting('site_name')."</title>
            <link>" . ca_setting('site_domain') . "</link>
            <description>".  ca_setting('meta_description')."</description>
            <language>en-id</language>";
foreach ($rs->result() as $r) { 
    $date = $r->date;
    $explode = explode(' ', $date);
    $date = explode('-', $explode['0']);
    $time = explode(':', $explode['1']); 
    $title = ca_text_replace($r->title); 
    $link = ca_setting('site_domain').'/'.$r->permalink;
    
    $title= htmlspecialchars($r->title);  
    $desc= htmlspecialchars(character_limiter(ca_embed_replace($r->content), ca_template_setting('limit_caracter')));
    $date=date_format(date_create($r->date),"d F Y , H:i:s");
    $img= htmlspecialchars("<img src='".base_url()."assets/images/upload/thumb/$r->img' align='left'/>");
    echo "<item>
                <title>$title</title>
                <pubDate>$date</pubDate>
                <link>$link</link>
                <description>$img $desc</description>
                <guid isPermaLink='false'>$link</guid>
            </item>";
}
echo "</channel>
    </rss>";
?>

