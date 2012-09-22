<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<a class="button-red red_rounded" onclick='close_box();'>x</a>

<form id="myform" method="post" onsubmit="return false" style="width: 350px;">
    <div class="header_box">
        <h2>
            Register / Sign Up
        </h2>
    </div>
    <p>
        <label>Username</label>
        <input type="text" name="username" size="35" class="form_field" id="username" validation="required min max" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>">
    </p>
    <p>
        <label>Email</label>
        <input type="text" name="email" size="35" class="form_field" id="email" validation="required email" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
    </p>
    <p>
        <label>Password</label>
        <input type="password" name="password" size="35" id="password" class="form_field" validation="required min max" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">
    </p> 
    <p>
        <label>&nbsp;</label>
        <a href="javascript:void(0)" class="button_upload"  style="margin-left: 0px;" id="btn_submit" onclick="register_member('member/do_register')">register</a> 
        or <a href="javascript:void(0)" onclick="lightbox('member/login')">login</a>
    </p> 
</form> 