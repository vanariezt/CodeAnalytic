<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<?php
$uri_segment = 3;
$offset = $this->uri->segment($uri_segment);
$config['base_url'] = site_url("home/pagging/");
$config['total_rows'] = $rows;
$config['per_page'] = $limit;
$config['div'] = 'div#wrap_center';
$config['uri_segment'] = $uri_segment;
$this->pagination->initialize($config);
echo "<ul class='list_berita' style='list-style:none'>";
foreach ($query->result() as $r) {
    $id = $r->id;
    $d = explode(" ", $r->date);
    $d1 = explode("-", $d['0']);
    $d2 = explode(":", $d['1']);
    $datecreate = date_create("$d1[0]-$d1[1]-$d1[2]");
    $timecreate = date_create("$d2[0]:$d2[1]:$d2[2]");
    $date = date_format($datecreate, "d");
    $month = date_format($datecreate, "M");
    $format_date = date_format($timecreate, "d F Y");
    $format_time = date_format($timecreate, "h:i:s");
    $link = $r->permalink;
    $num_com = $this->mposts->get_num_comments($id);
    ?>
    <li>
        <div class="post">
            <h2 class="post_title">
                <a href="<?php echo site_url($link) ?>">
                    <?php echo $r->title; ?>
                </a>
            </h2>
            <div class="post_info">
                <?php if (ca_template_setting("is_show_post_date") == "TRUE") { ?>
                    <span id="date"><?php echo $format_date ?></span>
                <?php } if (ca_template_setting("is_show_post_time") == "TRUE") { ?>
                    <span id="time"><?php echo $format_time ?></span>
                <?php } if (ca_template_setting("is_show_post_user") == "TRUE") { ?>
                    <span id="admin">posted by <?php echo $r->username ?></span>
                    <?php
                }

                if (!$this->agent->is_mobile()) {
                    if (ca_template_setting('is_comment') == 'TRUE') {
                        if (ca_template_setting('comment_via') == 'default') {
                            ?>
                            <span class="comments"><a href="#"><?php echo $num_com ?> comments</a></span>
                            <?php
                        } else if (ca_template_setting('comment_via') == 'fb') {
                            ?>
                            <span class="comments"><a href="#"><?php echo ca_count_comment_via_fb($link) ?> comments</a></span>
                            <?php
                        }
                    }
                    ?>
                    | <span class="views"><a href="#"><?php echo $r->view ?> Times Viewed</a></span>
                    <?php
                }
                ?>
            </div> 
            <div class="content">

                <?php 
                if ($r->is_show_thumb) {
                    if ($this->agent->is_mobile()) {
                        ?>
                        <img src="<?php echo base_url() . "assets/media/upload/image/" . $r->img ?>" class="image_write" align="left">
                        <?php
                    } elseif ($this->agent->is_browser()) {
                        ?>
                        <img class="image" src="<?php echo base_url() . "assets/media/upload/image/" . str_replace('small', 'big', $r->img) ?>" class="image_write" align="left">
                        <?php
                        echo "<div class='meta_description'>" . $r->meta_description . "</div>";
                    } else {
                        ?>
                        <img src="<?php echo base_url() . "assets/media/upload/image/" . str_replace('small', 'big', $r->img) ?>" class="image_write" align="left">
                        <?php
                    }
                }
                if (ca_template_setting("is_parse_smiley") == "TRUE") {
                    $content = parse_smileys($r->content, base_url() . "assets/images/smileys/");
                } else {
                    $content = $r->content;
                }
                echo character_limiter($content, 400);
                ?>
                        <a class="readmore" href="<?php echo base_url() . "$link" ?>" >Continue Reading → </a>
            </div> 
        </div>
    </li>
    <?php
}
echo "</ul>";
?>
<p>
    <span id="pagination">
        <?php
        echo $this->pagination->create_links();
        ?>
    </span>
</p>
