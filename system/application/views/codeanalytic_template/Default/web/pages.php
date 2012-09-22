<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="post">
    <div class="post_title">
        <a href="<?php echo site_url($link) ?>"><?php echo $title ?></a>
    </div>
    <div class="content">
        <?php
        if (ca_template_setting('is_parse_smiley') == 'TRUE') {
            $content = parse_smileys($content, base_url() . 'assets/images/smileys/');
        }
        if (ca_template_setting('is_censor') == 'TRUE') {
            $content = ca_word_censor($content);
        }
        echo $content;
        ?>
    </div> 
    <div class="button_share"> 
        <?php
        if ($is_share) {
            echo ca_button_twitter();
            echo ca_fb_button_send();
            echo ca_google_add_plush();
        }
        ?>
    </div>    
</div>