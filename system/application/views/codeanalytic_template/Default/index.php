<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<html>
    <head>
        <title><?php
echo ca_template_setting('site_name') . ' | ';
echo isset($title) ? $title : ''
?></title> 
        <meta charset="utf-8">
        <meta http-equiv='expires' content='-1' />
        <meta http-equiv= 'pragma' content='no-cache' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <link rel="shortcut icon" href="<?php echo base_url() ?>system/application/views/<?php echo ca_theme_dir() ?>/images/favicon.png"/>
        <?php echo isset($meta_title) ? "<meta name=\"title\" content='$meta_title'/>\n" : "" ?>
        <?php echo isset($meta_keyword) ? "<meta name=\"keywords\" content='codeanalytic, $meta_keyword'/>\n" : "" ?>
        <?php echo isset($meta_description) ? "<meta name=\"description\" content='$meta_description'/>\n" : "" ?>
        <?php echo ca_setting('google_analytic_code', 'seo'); ?>
        <?php echo ca_setting('alexa_code', 'seo'); ?>
        <?php ca_index_header(); ?>  
    </head> 
    <body onload="prettyPrint()" class="<?php echo isset($title) ? $title : "" ?>"> 

        <?php $this->load->view(ca_theme_dir() . '/web/login'); ?>
           <?php if (isset($column_top)) { ?>
                    <div id='top'>
                        <?php $this->load->view(ca_theme_dir() . $column_top); ?>
                    </div> 
                <?php } ?>
        <div id="wrapper"> 
            <div id="box-content">
                   <div id="content_all">
                    <?php
                    if (isset($column_full)) {
                        $this->load->view(ca_theme_dir() . $column_full);
                    } else {
                        ?>
                        <?php if (isset($column_timeline)) { ?>
                            <div id="timeline">
                                <?php $this->load->view(ca_theme_dir() . $column_timeline); ?>
                            </div>  
                        <?php } ?>

                        <div id="wrap_main">
                            <div id="body_main"> 

                                <?php if (isset($column_left)) { ?>
                                    <div id='wrap_left'>
                                        <?php $this->load->view(ca_theme_dir() . $column_left); ?>
                                    </div> 
                                <?php } ?>

                                <?php if (isset($column_center)) { ?>
                                    <div id='wrap_center'>
                                        <?php $this->load->view(ca_theme_dir() . $column_center); ?>
                                    </div> 
                                <?php } ?>

                                <?php if (isset($column_right)) { ?>
                                    <div id='wrap_right'>
                                        <?php $this->load->view(ca_theme_dir() . $column_right) ?>
                                    </div>  
                                <?php } ?>
                            </div> 
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div> 
        <?php if (isset($column_bottom)) { ?>
            <div id="wrap_bottom"> 
                <?php $this->load->view(ca_theme_dir() . $column_bottom); ?>
            </div>
        <?php } ?>
        <div class="site_link">  
            <div id="site_menu"> 
                <div style="float:left;width:50%;text-align: left;color: white;padding: 5px 0;">© blog.codeanalytic.com 2012</div>  
                <div class="site_info">
                    <?php echo CA_ENGINE ?> 
                </div>
            </div>
        </div>   
        <script type="text/javascript">
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