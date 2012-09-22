<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<a class="button-red red_rounded" onclick='close_box();'>x</a>

<form id="myform" method="post" onsubmit="return false" style="width: 350px;">
    <div class="header_box">
        <h2>
            Login / Sign In 
        </h2>
    </div>
    <p id="status_login"></p>
    <p>
        <label>Email</label>
        <input type="text" name="email" size="25" class="form_field" validation="required email" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
    </p>
    <p>
        <label>Password</label>
        <input type="password" name="password" validation="required min max" size="25" class="form_field" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">
    </p> 
    <p>
        <label>&nbsp;</label>
        <a href="javascript:void(0)" class="button_upload"  style="margin-left: 0px;" id="btn_submit" onclick="login_member('member/do_login')">Login</a> 
        <a href="javascript:void(0)" class="button_upload"  style="margin-left: 0px;" id="btn_submit" onclick="lightbox('member/register')">Register</a>
        or <a href="<?php echo base_url() ?>member/forgot/">Forgot Password ?</a>
    </p> 
    
</form> 