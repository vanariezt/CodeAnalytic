<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<html>
    <head>
        <title><?php echo ca_template_setting('site_name') . "-" ?> <?php echo isset($title) ? $title : "" ?> - CA mobile version 0.1</title> 
        <meta charset="utf-8">
        <meta http-equiv='expires' content='-1' />
        <meta http-equiv= 'pragma' content='no-cache' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <meta name="robots" content="<?php echo ca_setting('meta_robot') ?>">         
        <link rel="shortcut icon" href="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/images/favicon.png"/>
        <?php echo isset($meta_title) ? "<meta name=\"title\" content='$meta_title'/>\n" : "" ?>
        <?php echo isset($meta_keyword) ? "<meta name=\"keywords\" content='codeanalytic, $meta_keyword'/>\n" : "" ?>
        <?php echo isset($meta_description) ? "<meta name=\"description\" content='$meta_description'/>\n" : "" ?>
        <?php echo ca_setting('google_analytic_code', 'seo'); ?>
        <?php echo ca_setting('alexa_code', 'seo'); ?>
        <?php ca_mobile_index_header(); ?>
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/mobile/js/ca_mobile_0.1.js"></script>
    </head> 
    <body class="<?php echo isset($title) ? $title : "" ?>" data-theme="<?php echo ca_setting('mobile_theme'); ?>"> 
        <div data-role="page" class="type-home" data-theme="<?php echo ca_setting('mobile_theme'); ?>">
            <div id='top' data-role="header" data-theme="<?php echo ca_setting('mobile_theme') ?>" data-theme="<?php echo ca_setting('mobile_theme'); ?>" data-icon="home">
                <h1><?php echo ca_setting('site_name'); ?></h1>
                <a href="<?php echo base_url(); ?>" data-theme="<?php echo ca_setting('mobile_theme'); ?>" data-iconpos="notext" data-role="button" data-icon="home" data-ajax="false" data-direction="reverse">
                    <?php echo ca_setting('site_tag_line'); ?>
                </a>  
                <a href="javascript:void(0)" onclick="m_menu('#m_menu')" data-role="collapsible"  data-transition="slidedown" data-rel="dialog" data-icon="grid" data-iconpos="notext" data-theme="<?php echo ca_setting('mobile_theme'); ?>" class="ui-btn-right"></a>
            </div>
            <div data-role="content" data-theme="<?php echo ca_setting('mobile_theme'); ?>">  
                <div id="m_menu" class="hide" style="display: none">                   
                    <?php
                    $this->load->widget('mobile/basic_menu');
                    basic_menu_wi();
                    ?>
                </div>
                    <?php isset($m_column_top) ? $this->load->view(ca_theme_dir() . $m_column_top) : ''; ?>
                <form method="post" action="<?php echo base_url() ?>posts/search" data-ajax="false" data-theme="<?php echo ca_setting('mobile_theme'); ?>"> 
                    <div data-role="fieldcontain">
                        <input type="search" style="width: 100%" onblur="if (this.value == '') {this.value = 'Search...'}" onfocus="if (this.value == 'Search...') {this.value = ''}" value='Search...' name="s_content">
                    </div>
                </form>
                
                <nav data-theme="<?php echo ca_setting('mobile_theme'); ?>">                            
                    <?php isset($mobile_center) ? $this->load->view(ca_theme_dir() . $mobile_center) : ''; ?>
                </nav>  
                <?php isset($m_column_bottom) ? $this->load->view(ca_theme_dir() . $m_column_bottom) : ''; ?>
                <div class="site_menu" data-theme="<?php echo ca_setting('mobile_theme'); ?>">
                    <div class="site_info" style="text-transform: capitalize"><?php echo CA_ENGINE ?> Mobile Ver 0.1</div> 
                </div>  
            </div> 
        </div> 
        <script type="text/javascript">
            $('body iframe').removeAttr('width').removeAttr('height'); 
            $(document).ready(function() {

                // add prettyprint class to all <pre><code></code></pre> blocks
                var prettify = false;
    
   
                $("pre").each(function() {
                    $(this).addClass('prettyprint');  
                    prettify = true;
                }); 

                // if code blocks were found, bring in the prettifier ...
                if ( prettify ) {
                    $.getScript(site+"system/application/third_party/prettify/prettify.js", function() { prettyPrint() });
                }
    
            });
        </script>
    </body> 
</html> 