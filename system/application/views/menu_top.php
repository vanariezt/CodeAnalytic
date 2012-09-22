<div id="panel_logo_admin">&nbsp;</div>
<div id="top_account">
    <a href="javascript:void(0)" class="show" id="slide_a" onclick="ca_slide_account(this)">
        <img src="<?php echo base_url() . "assets/images/user/" . $photo ?>" align="left" id="img">
        <?php echo $username . " (" . $email . ")"; ?>
    </a>
    <span id="ico-a" style="border: #FFF;color: #fff">&nabla;</span>
    <div id="det_acount" style="display: none"> 
        <div id="content_det">
            <ul> 
                <li>
                   
                </li>
                <li class="site_domain">
                    <a id="site_domain" href="<?php echo base_url() ?>" target="_blank"><?php echo ca_setting('site_domain'); ?></a>
                </li>
                <li class="setting">
                    <a href="javascript:void(0)" onclick="ca_lightbox('user/manage')"><?php echo ca_translate('account setting'); ?></a>
                </li> 
                <li class="account">
                    <a href="javascript:void(0)" onclick="ca_lightbox('user/change_photo')"><?php echo ca_translate('change photo'); ?></a>
                </li>
            </ul>
            <a style="color: #333;" class="logout" style="width: 40px; float: right; text-transform: capitalize; margin-top: 20px; padding: 2px 7px;" href="<?php echo base_url() ?>calogin/logout"><?php echo ca_translate('logout'); ?></a>
        </div>
    </div>
</div> 
