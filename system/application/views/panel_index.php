<div class="main_left" style="width: 50%">
    <script type="text/javascript">    
        ca_load('users_statistic', '#chart');
    </script>
    <div style="padding: 10px; margin: 0px; margin-left: 10px; float: left">
        <p><h2><?php echo ca_translate("codeanalytic 'One Touch In All Solutions'"); ?></h2></p>
        <p><?php echo ca_translate("optimized SEO your website with CA (CodeAnalytic)"); ?> </p>
        <p>
            <?php echo ca_translate("codeAnalytic is create by OOP programing technique with optimized the rich of internet sources."); ?>
            <?php echo ca_translate("we try to give application form, that easy to create and manage website with CodeAnalytic"); ?>.</p>
        <p>
            <?php echo ca_translate("codeAnalytic is run and view in another platform like computer and mobile phone (android, blackberry os, ios)"); ?>
        </p>
        <p> 
    </div> 
    <div class="tabs">
        <a href="javascript:void(0)" class="selected" onclick="$('.stat').hide(); $('.user_stat').show() ;ca_load('users_statistic', '#chart'); ca_selected_chart(this)"><?php echo ca_translate('users'); ?></a>
        <a href="javascript:void(0)" onclick="$('.stat').hide(); $('.mem_stat').show(); ca_load('members_statistic', '#chart'); ca_selected_chart(this)"><?php echo ca_translate('members'); ?></a>
<!--        <a href="http://codeanalytic.com/site-metrics/" target="_blank"><?php echo ca_translate('site metrics'); ?></a>-->
    </div>
    <div  class="stat user_stat" style="background: #F9F9F9; float: left; width: 100%">
        <a href="javascript:void(0)" style="float: right; margin-right: 5px;" onclick="ca_load('users_statistic/find', '#cen_find')"><?php echo ca_translate('search') ?></a>
    </div>
    <div  class="stat mem_stat" style="background: #F9F9F9; float: left; width: 100%; display: none">
        <a href="javascript:void(0)" style="float: right; margin-right: 5px;" onclick="ca_load('members_statistic/find', '#cen_find')"><?php echo ca_translate('search') ?></a>
    </div> 
</div>
<div class="main_right" style="width: 45%">
    <div class="box_form">
        <div id="top_tap"><span><?php echo ca_translate("fast post"); ?></span></div> 
    </div>
    <?php isset($fast_post) ? $this->load->view($fast_post) : ""; ?>

    <?php ca_tiny_mce('textarea.tinymce', '2'); ?> 

</div>
<div style="float: left; width: 97%">


    <div id="cen_find" style="border-top:1px solid #EBEBEB"></div> 
    <div id="chart" style="float: left; width: 100%; margin-top: 10px;"></div>
</div>