<div id="section_menu"> 
    <div id="menu_header">
    <?php
    ca_widget_show('1');
    $this->load->widgets('menu_wi');
    menu_wi();
    ?>
        <div class="full_ico">
            <div class="icon_title">
                FOLLOW ME
            </div> 
            <a class='icon rss' title="rss" target='_blank' href='<?php echo base_url() ?>rss'>&nbsp</a>
            <a class='icon fb'  title="facebook" target='_blank' href='<?php echo ca_setting('fb_url') ?>'>&nbsp</a>
            <a class='icon twit' title="twitter" target='_blank' href='<?php echo ca_setting('twit_url') ?>'>&nbsp</a>
        </div>
    </div>
</div>
<div id="section">
    <div class="art-header-inner" >        
        <div class="art-headerobject"></div>
        <div class="art-logo"> 
            <h2 class="art-logo-name">
                <a href="<?php echo base_url() ?>" data-role="button" data-icon="home"  data-direction="reverse" class="ui-btn-right jqm-home"><?php echo ca_setting('site_name'); ?></a>
            </h2>
            <h3 class="art-logo-text"><?php echo ca_setting('site_tag_line'); ?></h3>
        </div>
    </div>
    <div id="search">
        <form method="post" action="<?php echo base_url() ?>posts/search">
            <fieldset>
                <input width="25px" type="text" onblur="if (this.value == '') {this.value = 'Search...'}" onfocus="if (this.value == 'Search...') {this.value = ''}" value='Search...' name="s_content" id="s">
                <input type="submit" id="search-submit" value="&nbsp;">
            </fieldset>
        </form>
    </div>
</div> 
