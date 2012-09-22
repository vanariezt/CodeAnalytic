<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<div class="post">
    <form class="add_new" action="<?php echo base_url() ?>member/recovery_password" method="post">
        <p class="info"> 
            Insert your email registred to get new password. After succec, please check your inbox, and find your new password in <?php echo ca_setting('site_name'); ?>  
        </p>
        <?php
        echo isset($message) ? "<span class='info' style='color:red'>" . $message . "</span>" : "";
        ?>
        <p>
            <label style="text-align: right; font-weight: bold; padding: 5px;">Email </label>   <input style="width: 400px" type="text" name="email"> 
            <input type="submit" style="border: none" class="button-red submit" value="Get New Password">
        </p>
        <?php echo form_error('email', '<span class="field_error">', '</span>'); ?> 
            
    </form>
</div>