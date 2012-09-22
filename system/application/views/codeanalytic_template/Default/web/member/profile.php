<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<a class="button-red red_rounded" onclick='close_box();'>x</a>

<form id="myform" method="post" onsubmit="return false" style="width: 720px;">
    <div class="header_box">
        <h2>
            Update Profile 
        </h2>
    </div> 
    <div style="float: left; width: 350px">
        <p>
            <label>Username</label>
            <input type="text" name="username" size="35" class="form_field" id="username" validation="required min max" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>">
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" size="35" class="form_field" id="email" validation="required email" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
        </p>
        <p>
            <label>First/Last Name</label>
            <input type="text" name="first_name" size="13" class="form_field" validation="required" value="<?php echo set_value('first_name', isset($default['first_name']) ? $default['first_name'] : ''); ?>">
            <input type="text" name="last_name" size="14" class="form_field" validation="required" value="<?php echo set_value('last_name', isset($default['last_name']) ? $default['last_name'] : ''); ?>">
        </p> 
    </div>
    <div style="float: left; width: 350px">

        <p>
            <label>Born</label>
            <input type="text" name="born" size="20" id="born" class="form_field dateSimple" onclick="date_pick(this)" validation="required" value="<?php echo set_value('born', isset($default['born']) ? $default['born'] : ''); ?>"> yyyy-mm-dd
        </p>
        <p>
            <label>Address</label>
            <input type="text" name="address" size="35" class="form_field" validation="required" value="<?php echo set_value('address', isset($default['address']) ? $default['address'] : ''); ?>">
        </p>
        <p>
            <label>Telp/Hp</label>
            <input type="text" name="phone" size="35" class="form_field" validation="required" value="<?php echo set_value('phone', isset($default['phone']) ? $default['phone'] : ''); ?>">
        </p>

    </div>
    <div style="float: left; width: 700px">
        <p>
            <label style="float: left; width: 80px">About</label>
            <textarea name="about" style="border: 1px solid #EBEBEB; width:605px; height: 50px"><?php echo isset($default['about']) ? $default['about'] : '' ?></textarea>
        </p>
    </div>
    <div style="float: left; width: 350px">
        <p> 
            <label>&nbsp;</label>
            <a href="javascript:void(0)" class="button_upload"  style="margin-left: 0px;" id="btn_submit" onclick="change_profile()">Update</a> 
        </p> 
    </div>
</form>  