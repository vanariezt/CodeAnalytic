<h2>
    General Account Setting
</h2> 
<div class="mem_info mem"> 
    <p class="mem_editor">
        <a href="javascript:void(0)" class="btn_mem_edit" onclick="lightbox('member/change_profile')">edit</a>
    </p>
    <p>
        <label>Username</label>
        <?php echo $m->username ?>
    </p> 
    <p>
        <label>Email</label>
        <?php echo $m->email ?>
    </p>
    <p>
        <label>Firts name</label>
        <?php echo $m->first_name ?>
    </p>
    <p>
        <label>Last name</label>
        <?php echo $m->last_name ?>
    </p>
    <p>
        <label>Born</label>
        <?php echo $m->born ?>
    </p>
    <p>
        <label>Address</label>
        <?php echo $m->address ?>
    </p>
    <p>
        <label>Telp/Hp</label>
        <?php echo $m->phone ?>
    </p>
    <p>
        <label>About</label>
        <?php echo $m->about ?>
    </p>

</div>