<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php
$id = $r->id; 
$datecreate = date_create($r->date); 
$format_date = date_format($datecreate, ca_template_setting('date_format'));
$format_time = date_format($datecreate, ca_template_setting('time_format'));
?>
<div class="post"> 
    <div class="post_title">
        <a href="<?php echo site_url($this_link) ?>" data-ajax='false'>
            <?php
            echo str_replace("-", " ", $r->title);
            ?>
        </a>
    </div> 
    <div class="post_info">
        <?php if (ca_template_setting('is_show_post_user') == 'TRUE') { ?>
            <span id="admin">Posted By: <?php echo $r->username ?></span>
            <?php
        }
        if (ca_template_setting('is_comment') == 'TRUE') {
            if (ca_template_setting('comment_via') == 'default') {
                ?>
                <span class="comments"><a href="#"><?php echo $num_com ?> Comments</a></span>
                <?php
            } else if (ca_template_setting('comment_via') == 'fb') {
                ?>
                <span class="comments"><a href="#"><?php echo ca_count_comment_via_fb($this_link) ?></a></span>
                <?php
            }
        }
        if (ca_template_setting('is_show_post_date') == 'TRUE') {
            ?>
                <span id="date"><?php echo $format_date ?></span>
            <?php
        }
        if (ca_template_setting('is_show_post_time') == 'TRUE') {
            ?>
                <span id="date"><?php echo $format_time ?></span>
            <?php
        }
        ?>         
        |  <span class="views"><a href="#"><?php echo $r->view ?> View</a></span>
        <?php ?>
    </div> 
    <?php
    if (ca_template_setting("is_parse_smiley") == "TRUE") {
        $this->load->helper('smiley');
        $content = parse_smileys($r->content, base_url() . "assets/images/smileys/");
    } else {
        $content = $r->content;
    }
    ?>
    <div class="content content_post">
        <div class="img_viewers">
            <?php
            if ($r->is_show_thumb) {
                if ($this->agent->is_mobile()) {
                    ?>
                    <img src="<?php echo base_url() . "assets/media/upload/image/" . str_replace('small', 'middle', $r->image) ?>" class="image_write" align="left">
                    <?php
                } elseif ($this->agent->is_browser()) {
                    ?>
                    <img src="<?php echo base_url() . "assets/media/upload/image/" . str_replace('small', 'big', $r->image) ?>" class="image_write" align="left">
                    <?php
                    echo "<div class='meta_description'>" . $r->meta_description . "</div>";
                } else {
                    ?>
                    <img src="<?php echo base_url() . "assets/media/upload/image/" . str_replace('small', 'big', $r->image) ?>" class="image_write" align="left">
                    <?php
                }
            }
            ?> 
        </div>
        <?php
        echo ($content);
        ?>
    </div> 

    <div class="meta"> 
        <span class="listed">Posted in <?php echo $this->mposts->get_permalink_cat_in($r->cat_id) ?></span>
        <span class="tags">Tags:
            <?php
            $m = explode(",", $r->meta_keyword);
            $sum = count($m);
            for ($i = 0; $i < $sum; $i++) {
                echo "<a data-ajax='false' href='" . site_url($this_link) . "'>$m[$i], </a>";
            }
            echo "<a data-ajax='false' href='$this_link'>others</a>";
            ?>
        </span>
    </div> 

    <?php
    if ($r->is_share) {
        echo '<div class="button_share">';
        echo ca_fb_button_send();
        echo ca_button_twitter();
        echo ca_google_add_plush();
        echo '</div>';
    }
    ?>
    <div class="relate">
        <h2>Follow Article</h2>
        <ul class="relate_post">
            <?php
            $rs = $this->mposts->get_other($r->id, $r->cat_id, 5);
            foreach ($rs as $r) {
                //format date base of settings
                $date = $r->date;
                $explode = explode(' ', $date);
                $date = explode('-', $explode['0']);
                $time = explode(':', $explode['1']);
                $link = $r->permalink;
                echo "<li>";
                echo anchor($link, $r->title, array("data-ajax" => "false"));
                echo "</li>";
            }
            ?>
        </ul>
    </div>
    <?php
    if (!is_mobile_user_agent()) {
        ?>
    <div class="list_comments">
        <h2>Write Comment</h2>
        <?php if ($this->session->flashdata("error") <> '') { ?>
            <p class="info" onclick="$(this).remove()" style="color:red;padding: 5px;width: 98%; float: left; background: #ffffcc;border:1px solid red;">
                Comment is required, need min[1] characters  
            </p>
        <?php }
        if ($this->session->flashdata("success") <> '') {
            ?>
            <p class="info" onclick="$(this).remove()" style="color:red;padding: 5px;width: 98%; float: left; background: #ffffcc;border:1px solid red;">
                Thanks to comment, your comment will be authorize by user admin, before showed in this page
            </p>
            <?php
        }
        if (ca_template_setting('is_comment')) {
            if (ca_template_setting('comment_via') == 'default' && !$this->agent->is_mobile()) {
                ?>
                <div class="comment_via"> 
                    <script type="text/javascript"> 
                        load('comments/comment_via/<?php echo $num_com . '/' . $this_link . '/' . $id . '/3' ?>', '.comment_via');
                    </script>
                </div>
                <?php
            } else if (ca_template_setting('comment_via') == 'fb' && !$this->agent->is_mobile()) {
                ?> 
                <div class="fb_com">
                    <?php
                    ca_comment_via_fb($this_link, 3, ca_template_setting('plugin_comment_width'));
                    ?>
                </div>
                <?php
            }
        }
    }
    ?>
    </div>
</div>  