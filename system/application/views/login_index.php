<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html>
    <head>
        <title><?php echo $title ?></title>
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/themes/panel/images/favicon.png"/>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/login/reset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/login/main.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/panel/lightbox.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>        
        <script type='text/javascript'>
            var site = "<?php echo base_url(); ?>";
            var loadImg = "<img src='<?php echo base_url(); ?>assets/loading.gif' align='center'/>"; 
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.app.js"></script>        
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.validation.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/codeanalytic.lang.js"></script>
    </head>
    <body>

        <div id="header">
            <div id="head_left"><a href="<?php echo base_url() ?>"><div id="panel_logo"></div></a></div>
            <div id="head_right"><div id="panel_lang"><?php ca_list_lang(); ?></div>
            </div>
        </div>
        <div id="wrapper_box">
            <div id="wrapper">

                <div id="cen_right">
                    <div id="left_login" style="line-height: 30px">
                        <form id="mylogin" action="<?php echo site_url() ?>calogin/check_login"  method="post">
                            <?php
                            echo isset($message) ? ' <div id="title">' . $message . '</div> ' : ''
                            ?> 
                            <?php echo form_error('username', '<div id="title">', '</div> ') ?>
                            <?php echo form_error('password', '<div id="title">', '</div> ') ?>

                            <div class="box-input" style="margin-top: 50px;">
                                <input type="text" name="username" class="text-input" maxlength="20" value="<?php echo ca_translate("username"); ?>" onblur="if(this.value=='') this.value='<?php echo ca_translate("username"); ?>'" onfocus="if(this.value =='<?php echo ca_translate("username"); ?>' ) this.value='';">
                            </div>
                            <div class="box-input">
                                <input type="text" name="password" id="password" class="text-input"  maxlength="20" value="<?php echo ca_translate("password"); ?>" onblur="if(this.value=='') this.value='<?php echo ca_translate("password"); ?>'; this.type='password'" onfocus="if(this.value =='<?php echo ca_translate("password"); ?>' ) this.value=''; this.type='password'">
                            </div>
                            <div class="box-login">
                                <span id="left_submit">
                                    <input type="submit" class="button-submit" value=" <?php echo ca_translate("login"); ?>">
                                </span>
                                <span id="right_submit">
                                    <span style="float: left;padding: 4px;margin-left: 10px;"> 
                                        <a href="javascript:void(0)" onclick="ca_lightbox('user/forgot')" ><?php echo ca_translate("forgot password?"); ?></a>
                                    </span> 
                                    <span id="capsplock" style="visibility:hidden;padding:4px;float: left; color: red"><?php echo ca_translate("caps lock is on."); ?></span> 

                                </span>
                            </div>
                            <script type="text/javascript">
                                $('#password').keypress(function(e) { 
                                    var s = String.fromCharCode( e.which );
                                    if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
                                        $('span#capsplock').css({
                                            'visibility' : 'visible'
                                        })
                                    }else{
                                        $('span#capsplock').css({
                                            'visibility' : 'hidden'
                                        })
                                    }
                                });
                            </script>
                        </form>

                    </div>
                    <div id="right_login">
                        <p style="line-height: 30px; padding: 20px 0;"><h2><?php echo ca_translate("codeanalytic 'One Touch In All Solutions'"); ?></h2></p>
                        <p style="line-height: 30px"><?php echo ca_translate("codeAnalytic is create by OOP programing technique with optimized the rich of internet sources."); ?>
                            <?php echo ca_translate("we try to give application form, that easy to create and manage website with CodeAnalytic"); ?></p>
                        <ul>
                            <li class="platform"> 
                                <p class="title"><?php echo ca_translate("multi platform") ?></p>
                                <p> <?php echo ca_translate("codeAnalytic is run and view in another platform like computer and mobile phone (android, blackberry os, ios)"); ?><a href="http://codeanalytic.org/mobile-platform" target="_blank"> <?php echo ca_translate("learn more"); ?> </a></p> 
                            </li>
                            <li class="seo"> 
                                <p class="title"><?php echo ca_translate("SEO friendly") ?></p>
                                <p><?php echo ca_translate("optimized SEO your website with CA (CodeAnalytic)"); ?><a href="http://codeanalytic.org/seo-friendly" target="_blank"> <?php echo ca_translate("learn more"); ?> </a> </p> 
                            </li>
                            <li class="ajax">  
                                <p class="title"><?php echo ca_translate("ajax aplication back end") ?></p>
                                <p> <?php echo ca_translate("codeAnalytic using ajax technology. get touch in application back end is run so fast"); ?> <a href="http://codeanalytic.org/ajax-aplication-back-end" target="_blank"> <?php echo ca_translate("learn more"); ?> </a></p> 
                            </li>
                        </ul>

                    </div>
                    <div id="bottom"> 
                        <div id="bottom_right">
                            <ul>
                                <li>
                                    <?php
                                    /*
                                     * please define CONSTANT CA_COPYRIGHT..
                                     * if it's not define this page can't be access
                                     */
                                    echo CA_COPYRIGHT
                                    ?>
                                </li>
                                <li>
                                    <a href="http://codeanalytic.org/TermOfPrivacy"><?php echo ca_translate("term of privacy") ?></a>
                                </li>
                                <li>
                                    <a href="http://codeanalytic.org/termOfUse"><?php echo ca_translate("term of use") ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
