<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<div class="member_">
    <script type="text/javascript" src="<?php echo base_url() ?>system/application/third_party/upload/ajaxupload.js"></script>

    <div id="mem_left">
        <?php $this->load->view(ca_theme_dir().'web/member/left') ?>
    </div>
    <div id="mem_right">
        <script type="text/javascript">
            load('member/general','#mem_right');
        </script>
    </div>
</div>