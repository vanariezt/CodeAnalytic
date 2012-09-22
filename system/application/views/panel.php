<?php
if (!defined('BASEPATH'))
    exit('no direct script user allowed');

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
 * @link		http://docs.codeanalytic.com/view/panel
 */
?>
<html>
    <head>
        <title><?php echo $title ?></title>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/themes/panel/images/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/panel/main.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.ui.touch-punch.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/panel/red.css"/>
        <script type='text/javascript'>
            var site = "<?php echo base_url(); ?>";
            var loadImg = "<img src='<?php echo base_url(); ?>assets/loading.gif' align='center'/>";             
            var ca_animate_='<?php echo ca_setting('animation'); ?>';
        </script>         
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.app.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.lang.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.validation.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/tinymce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/tinymce/tiny_mce.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/upload/ajaxupload.js"></script>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>system/application/third_party/calendar/simpleDatepicker.css" /> 
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/calendar/simpleDatepicker.js"></script>  
        <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/charts/FusionCharts.js"></script> 


        <script type="text/javascript">
            $(function(){
                $("#content_toolbar1, #content_toolbar2").css({
                    "float":"left",
                    "width":"400px"
                })
            })
        </script>

    </head> 
    <body class="<?php echo $title ?>">
        <div id="notive"></div>
        <div id="wrapper">
            <div id="main">
                <div id="wrap_main">
                    <div id="top">
<?php isset($top) ? $this->load->view($top) : ''; ?>     
                    </div>


                    <div id="center">                        
                        <?php
                        if (isset($center)) {
                            $this->load->view($center);
                        } else {
                            ?>
                            <div id='cen_left'>
    <?php isset($left) ? $this->load->view($left) : ''; ?>
                            </div>
                            <div class="cen_split">&nbsp;</div>  

                            <div id='cen_right'> 
                            <?php isset($right) ? $this->load->view($right) : ''; ?>

                            </div>  
                            <?php
                        }
                        ?>

                        <div id="cen_detil"></div>
                    </div>
                    <div id="bottom">
<?php isset($bottom) ? $this->load->view($bottom) : ''; ?>
                    </div>
                </div>
            </div>
        </div>         
        <?php
        ca_split_lenght();
        ?>
    </body>
</html> 
