<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<div class="member_content">    
    
    <div class="mem_info mem"> 
        <img src="<?php echo base_url() . "assets/images/member/" . $m->photo ?>" style="max-width: 100px" align="right"> 
     
        <p>
            <label>Username</label>
            <?php echo $m->username ?>
        </p> 
        <p>
            <label>Email</label>
            <?php echo $m->email ?>
        </p>
        <p>
            <label>First name</label>
            <?php echo $m->first_name ?>
        </p>
        <p>
            <label>Last name</label>
            <?php echo $m->last_name ?>
        </p>
        <p>
            <label>Date of birth</label>
            <?php echo $m->born ?>
        </p>
        <p>
            <label>Address</label>
            <?php echo $m->address ?>
        </p>
        <p>
            <label>Phone number</label>
            <?php echo $m->phone ?>
        </p>
        <p>
            <label>About</label>
            <?php echo $m->about ?>
        </p>

    </div>
</div> 