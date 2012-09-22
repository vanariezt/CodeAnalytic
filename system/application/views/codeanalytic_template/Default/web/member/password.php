<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<a class="button-red red_rounded" onclick='close_box();'>x</a>

<form id="myform" method="post" onsubmit="return false" style="width: 500px;">
    <div class="header_box">
        <h2>
           Change password
        </h2>
    </div>
    <p id="status_login"></p>
    <p>
        <label style="width: 35%">Old Password</label>
        <input style="width: 58%" type="password" id="old_password" name="old_password" class="form_field" validation="required min max">
    </p>
    <p>
        <label style="width: 35%">New Password</label>
        <input style="width: 58%" type="password" name="password" id="confirm" validation="required min max" class="form_field">
    </p>
    <p>
        <label style="width: 35%">Confirm New Password</label>
        <input style="width: 58%" type="password" name="c_password"  validation="required min max confirm" class="form_field">
    </p>
    <p>
        <label style="width: 35%">&nbsp;</label>
        <a href="javascript:void(0)" class="button_upload"  style="margin-left: 0px;" id="btn_submit" onclick="change_password()">Update</a> 
       </p> 
</form> 