<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php
if (ca_template_setting('comment_via') == 'default' && $this->session->userdata("member_id") <> '') {
?>
<div id="fix_top">
    <div class="ca_login">
    <?php
            $id = $this->session->userdata('member_id');
            $q = $this->db->query("SELECT * FROM ca_members WHERE id='$id'")->row(); 
            echo "<a class='data_i' href='" . base_url() . "member/account'>Hi $q->username (Account)</a> | "; 
            echo "<a class='data_i' href='" . base_url() . "member/logout'>Logout</a>";
             ?>
    </div>
</div>
<?php } ?>